<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Cars extends MX_Controller {
		private $data = array();
        private $validlang;

		function __construct() {
				parent :: __construct();
				modules :: load('home');
				$this->load->library("cars_lib");
				$this->load->model("cars/cars_model");
				$this->load->helper("cars_front");
				$this->data['phone'] = $this->load->get_var('phone');
				$this->data['contactemail'] = $this->load->get_var('contactemail');
				$this->data['app_settings'] = $this->settings_model->get_settings_data();
				$this->data['usersession'] = $this->session->userdata('pt_logged_customer');
			   //	$this->data['gridlist'] = $this->cars_lib->listgrid();
				$this->data['carslib'] = $this->cars_lib;
				$chk = modules :: run('home/is_main_module_enabled', 'cars');
				if (!$chk) {
						Error_404();
				}
				$this->data['geo'] = $this->load->get_var('geolib');
                 $languageid = $this->uri->segment(2);
                $this->validlang = pt_isValid_language($languageid);

                if($this->validlang){
                  $this->data['lang_set'] =  $languageid;
                }else{
                  $this->data['lang_set'] = $this->session->userdata('set_lang');
                }

                $defaultlang = pt_get_default_language();
				if (empty ($this->data['lang_set'])){
						$this->data['lang_set'] = $defaultlang;
				}

				$this->data['carslocationsList'] = $this->cars_lib->getLocationsList();
				$this->data['carspickuplocationsList'] = $this->cars_lib->getPickupLocationsList();
				$this->data['carsdropofflocationsList'] = $this->cars_lib->getDropLocationsList();

				
				$this->data['allowreg'] = $this->data['app_settings'][0]->allow_registration;


				

                $this->cars_lib->set_lang($this->data['lang_set']);

		}

		public function index() {

				$settings = $this->settings_model->get_front_settings('cars');
				$this->data['minprice'] = $settings[0]->front_search_min_price;
				$this->data['maxprice'] = $settings[0]->front_search_max_price;

                if($this->validlang){
                	$carname = $this->uri->segment(3);
                }else{
                    $carname = $this->uri->segment(2);
                }

				$check = $this->cars_model->car_exists($carname);
				if ($check && !empty ($carname)) {
						$this->cars_lib->set_carid($carname);
						$this->data['car'] = $this->cars_lib->car_details();
				
						if (pt_is_module_enabled('reviews')) {
								$this->data['reviews'] = $this->cars_lib->carReviews($this->data['car']->id);
								$this->data['avg_reviews'] = $this->cars_lib->carReviewsAvg($this->data['car']->id);
						}

						$this->data['carModTiming'] = $this->cars_lib->timingList();

						$this->data['pickupTime'] = $this->cars_lib->pickupTime;
						$this->data['selectedpickupLocation'] = $this->input->get('pickupLocation');
			        	$this->data['selecteddropoffLocation'] = $this->input->get('dropoffLocation');


						$this->data['carspickuplocationsList'] = $this->cars_lib->getPickupLocationsList($this->data['car']->id);
						$this->data['carsdropofflocationsList'] = $this->cars_lib->getDropLocationsList($this->data['car']->id);

					
						$res = $this->settings_model->get_contact_page_details();
						$this->lang->load("front", $this->data['lang_set']);

						$this->data['fbcomments'] = $settings[0]->front_fb_comments;
						$this->data['sharing'] = $settings[0]->front_sharing;
						$this->data['phone'] = $res[0]->contact_phone;
						$this->data['page_title'] = $this->data['car']->title;
						$this->data['metakey'] = $this->data['details'][0]->car_meta_keywords;
						$this->data['metadesc'] = $this->data['details'][0]->car_meta_desc;
                        $this->data['langurl'] = base_url()."cars/{langid}/".$this->data['car']->slug;
                        $this->theme->view('cars/car', $this->data);
				}
				else {
						$this->listing();
				}
		}

		function listing($offset = null) {
				$this->lang->load("front", $this->data['lang_set']);
				$settings = $this->settings_model->get_front_settings('cars');
				$this->data['cartypes'] = $this->cars_lib->carTypes();
				$this->data['pickupTime'] = $this->cars_lib->pickupTime;

				$this->data['carModTiming'] = $this->cars_lib->timingList();

				$allcars = $this->cars_lib->show_cars($offset);
				$this->data['cars'] = $allcars['all_cars'];
				$this->data['minprice'] = $this->cars_lib->convertAmount($settings[0]->front_search_min_price);
				$this->data['maxprice'] = $this->cars_lib->convertAmount($settings[0]->front_search_max_price);
				$this->data['currCode'] = $this->cars_lib->currencycode;
				$this->data['currSign'] = $this->cars_lib->currencysign;
				$this->data['info'] = $allcars['paginationinfo'];
				$this->data['page_title'] = $settings[0]->header_title;
				$this->data['metakey'] = $settings[0]->meta_keywords;
				$this->data['metadesc'] = $settings[0]->meta_description;
			    $this->data['langurl'] = base_url()."cars/{langid}";


				$this->theme->view('cars/cars', $this->data);


		}

	

		function search($country = null, $city = null, $citycode = null,$offset = null) {
			$this->data['carModTiming'] = $this->cars_lib->timingList();
				$checkout = $this->input->get('checkout');
				$adult = $this->input->get('adults');
				$child = $this->input->get('child');
				//$country = $this->input->get('country');
				//$state = $this->input->get('state');

				$type = $this->input->get('type');
				$txtsearch = $this->input->get('searching');
				$cityid = $this->input->get('location');

				if(empty($country)){
					unset($_GET['location']);
					$surl = http_build_query($_GET);
					$locationInfo = pt_LocationsInfo($cityid);
					$country = url_title($locationInfo->country, 'dash', true);
					$city = url_title($locationInfo->city, 'dash', true);
					$cityid = $locationInfo->id;
					if(!empty($cityid)){
						redirect('cars/search/'.$country.'/'.$city.'/'.$cityid.'?'.$surl);
					}
					

				}else{
					$cityid = $citycode;
					if(is_numeric($country)){
						$offset = $country;
					}
					
				}
				
				if (array_filter($_GET)) {
				
						$allcars = $this->cars_lib->search_cars($cityid, $offset);
					
						$this->data['cars'] = $allcars['all_cars'];
			        	$this->data['info'] = $allcars['paginationinfo'];
				}
				else {
						$this->data['cars'] = array();
				}
				$this->data['city'] = $cityid;

				$this->lang->load("front", $this->data['lang_set']);

				
				$this->data['selectedLocation'] = $cityid;//$this->tours_lib->selectedLocation;
				$this->data['selectedpickupLocation'] = $this->input->get('pickupLocation');
				$this->data['selecteddropoffLocation'] = $this->input->get('dropoffLocation');

				$this->data['pickupDate'] = $this->cars_lib->pickupDate;
				$this->data['selectedPickup'] = $this->input->get('pickup');
				$this->data['selectedCarType'] = $this->cars_lib->selectedCarType;
				$this->data['pickupTime'] = $this->cars_lib->pickupTime;



				$this->data['cartypes'] = $this->cars_lib->carTypes();
				$settings = $this->settings_model->get_front_settings('cars');
				$this->data['minprice'] = $this->cars_lib->convertAmount($settings[0]->front_search_min_price);
				$this->data['maxprice'] = $this->cars_lib->convertAmount($settings[0]->front_search_max_price);
				$this->data['currCode'] = $this->cars_lib->currencycode;
				$this->data['currSign'] = $this->cars_lib->currencysign;
				$this->data['page_title'] = 'Search Results';
				$this->data['metakey'] = "";
// $txtsearch." ".$country;
				$this->data['metadesc'] = "";
//$txtsearch." ".$country;
				$this->theme->view('cars/cars', $this->data);
		}


	function book($carslug) {

			    $check = $this->cars_model->car_exists($carslug);
				$this->load->library("paymentgateways");
				$this->data['hideHeader'] = "1";


  				if ($check && !empty($carslug)) {
  				  	$this->load->model('admin/payments_model');
                      
                      $this->cars_lib->set_carid($carslug);
                      $carID = $this->cars_lib->get_id();
                      $bookInfo = $this->cars_lib->getBookResultObject($carID);
                      $this->cars_lib->checkCarPriceAtBooking($carID);
                      $this->data['car'] = $bookInfo['car'];
                      $this->data['extraChkUrl'] = $bookInfo['car']->extraChkUrl;
                      $this->data['error'] = $this->cars_lib->error;
                      $this->data['errorCode'] = $this->cars_lib->errorCode;
          
                      $this->load->model('admin/accounts_model');
                      $this->lang->load("front", $this->data['lang_set']);
                      
                      $loggedin = $this->loggedin = $this->session->userdata('pt_logged_customer');
                      $this->data['profile'] = $this->accounts_model->get_profile_details($loggedin);
                      $this->data['page_title'] = $this->data['car']->title;
					  $this->data['metakey'] = $this->data['car']->keywords;
					  $this->data['metadesc'] = $this->data['car']->metadesc;
					  $this->theme->view('cars/booking', $this->data);
				}else{
                   redirect("cars");
				}
		}

		function txtsearch() {
				echo $this->cars_model->textsearch();
		}

}