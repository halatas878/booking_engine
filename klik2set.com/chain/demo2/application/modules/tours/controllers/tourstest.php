<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Tourstest extends MX_Controller {
		private $data = array();
		private $validlang;
		function __construct() {
// $this->session->sess_destroy();
				parent :: __construct();
				$chk = modules :: run('home/is_main_module_enabled', 'tours');
				if (!$chk) {
					Module_404();
				}

				modules :: load('home');
				$this->load->library("tours_lib");
				$this->load->model("tours_model");
				$this->load->helper("tours_front");
				$this->data['app_settings'] = $this->settings_model->get_settings_data();
				$this->data['usersession'] = $userid = $this->session->userdata('pt_logged_customer');
				$this->data['modulelib'] = $this->tours_lib;			
				
				$this->data['phone'] = $this->load->get_var('phone');
				$this->data['contactemail'] = $this->load->get_var('contactemail');
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


				
                $this->tours_lib->set_lang($this->data['lang_set']);
                $this->data['modulelocationsList'] = $this->tours_lib->getLocationsList();
                $this->data['selectedAdults'] = $this->tours_lib->adults;
                $this->data['selectedChild'] = $this->tours_lib->child;
                $this->data['selectedInfants'] = $this->tours_lib->infants;
                 $this->data['currentModule'] = "tours";
              
		}

		public function index() {
				$settings = $this->settings_model->get_front_settings('tours');
				$this->data['minprice'] = $settings[0]->front_search_min_price;
				$this->data['maxprice'] = $settings[0]->front_search_max_price;

                if($this->validlang){
                	$tourslug = $this->uri->segment(3);
                }else{
                    $tourslug = $this->uri->segment(2);
                }

				$check = $this->tours_model->tour_exists($tourslug);
				if ($check && !empty ($tourslug)){
					$this->lang->load("front", $this->data['lang_set']);

						$this->tours_lib->set_tourid($tourslug);
						$this->data['tour'] = $this->tours_lib->tour_details();

						 if (pt_is_module_enabled('reviews')) {
								$this->data['reviews'] = $this->tours_lib->tourReviews($this->data['tour']->id);
								$this->data['avgReviews'] = $this->tours_lib->tourReviewsAvg($this->data['tour']->id);
						}

						$this->data['allowreg'] = $this->data['app_settings'][0]->allow_registration;	
						$this->data['page_title'] = $this->data['tour']->title;
						$this->data['metakey'] = $this->data['tour']->keywords;
						$this->data['metadesc'] = $this->data['tour']->metadesc;
                        $this->data['langurl'] = base_url()."tours/{langid}/".$this->data['tour']->slug;
                        $this->theme->view('tours/tour', $this->data);
				}
				else {
						$this->listing();
				}
		}

		function listing($offset = null) {
			$this->lang->load("front", $this->data['lang_set']);
				$settings = $this->settings_model->get_front_settings('tours');
				$this->data['minprice'] = $settings[0]->front_search_min_price;
				$this->data['maxprice'] = $settings[0]->front_search_max_price;
				$this->data['moduletypes'] = $this->tours_lib->tourTypes();
				$alltours = $this->tours_lib->show_tours($offset);
				$this->data['module'] = $alltours['all_tours'];
				$this->data['info'] = $alltours['paginationinfo'];
				$this->data['plinks2'] = $alltours['plinks2'];
				$this->data['date'] = $this->tours_lib->date;
				$this->data['page_title'] = $settings[0]->header_title;
                $this->data['langurl'] = base_url()."tours/{langid}/";

                $this->theme->view('listing', $this->data);
		}

		function search($country = null, $city = null, $citycode = null,$offset = null) {
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
						redirect('tours/search/'.$country.'/'.$city.'/'.$cityid.'?'.$surl);
					}
					

				}else{
					$cityid = $citycode;
					if(is_numeric($country)){
						$offset = $country;
					}
					
				}
				
				if (array_filter($_GET)) {
				
						$alltours = $this->tours_lib->search_tours($cityid, $offset);
					
						$this->data['tours'] = $alltours['all_tours'];
			        	$this->data['info'] = $alltours['paginationinfo'];
				}
				else {
						$this->data['tours'] = array();
				}

				$this->lang->load("front", $this->data['lang_set']);
				$this->data['city'] = $cityid;

				
				$this->data['selectedLocation'] = $cityid;//$this->tours_lib->selectedLocation;
				$this->data['date'] = $this->tours_lib->date;
				$this->data['selectedTourType'] = $this->tours_lib->selectedTourType;


				$this->data['tourtypes'] = $this->tours_lib->tourTypes();
				$settings = $this->settings_model->get_front_settings('tours');
				$this->data['minprice'] = $settings[0]->front_search_min_price;
				$this->data['maxprice'] = $settings[0]->front_search_max_price;
				$this->data['page_title'] = 'Search Results';
				$this->data['metakey'] = "";
// $txtsearch." ".$country;
				$this->data['metadesc'] = "";
//$txtsearch." ".$country;
				$this->theme->view('tours/tours', $this->data);
		}

		function book($tourslug) {

			$check = $this->tours_model->tour_exists($tourslug);
				$this->load->library("paymentgateways");
				$this->data['hideHeader'] = "1";
				//echo "<pre>";
				//print_r($this->paymentgateways->getAllGateways());
				//echo "</pre>";
  				if ($check && !empty($tourslug)) {
  					$this->lang->load("front", $this->data['lang_set']);
  				  	$this->load->model('admin/payments_model');
                      $this->data['error'] = "";
                      $this->tours_lib->set_tourid($tourslug);
                      $tourID = $this->tours_lib->get_id();
                      $bookInfo = $this->tours_lib->getBookResultObject($tourID);
                      $this->data['tour'] = $bookInfo['tour'];

                     /* if($this->data['room']->price < 1 ||  $this->data['room']->stay < 1){
                        $this->data['error'] = "error";
                      }*/

                    //  $this->data['paymentTypes'] = $this->payments_model->get_all_payments_front();
                      $this->load->model('admin/accounts_model');
                      $loggedin = $this->loggedin = $this->session->userdata('pt_logged_customer');
                      $this->data['profile'] = $this->accounts_model->get_profile_details($loggedin);
                      $this->data['page_title'] = $this->data['tour']->title;
					  $this->data['metakey'] = $this->data['tour']->keywords;
					  $this->data['metadesc'] = $this->data['tour']->metadesc;
					  $this->theme->view('tours/booking', $this->data);
				}else{
                   redirect("tours");
				}
		}

		function txtsearch() {

		}

		function tour_maps($tourid) {
				if (!empty ($tourid)) {
						$starting = pt_tour_start_end_map($tourid, 'start');
						$ending = pt_tour_start_end_map($tourid, 'end');
						$visiting = pt_tour_visiting_map($tourid);
						$this->load->library('mapbuilder');
						$map = $this->mapbuilder;
						$map->setCenter($starting[1], $starting[2]);
						$map->setMapTypeId('ROADMAP');
						$map->setSize('100%', '100%');
						$map->setZoom(7);
						$locations = array();
						if (!empty ($starting)) {
								$locations[] = $starting;
						}
						if (!empty ($visiting)) {
								foreach ($visiting as $v) {
										$locations[] = $v;
								}
						}
						if (!empty ($ending)) {
								$locations[] = $ending;
						}
						$path1 = array();
						foreach ($locations as $i => $location) {
								if ($i < sizeof($locations)) {
										$path1[] = array($location[1], $location[2]);
								}
								$map->addMarker($location[1], $location[2], array('title' => $location[0], 'icon' => PT_DEFAULT_IMAGE . 'marker.png',
//  'html' => '<div><img src="' . $location[4] . '" width="' . $location[5] . '" height="' . $location[6] . '" /></div><b>' . $location[0] . '</b>',
								'html' => '<b>' . $location[0] . '</b>', 'infoCloseOthers' => true));
						}
						$map->addPolyline($path1, '#ee3e87', 5, 1);
						$map->show();
				}
				else {
						redirect('tours');
				}
		}

		

           }
