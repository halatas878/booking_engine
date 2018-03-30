<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Tours extends MX_Controller {
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
				$this->data['tourslib'] = $this->tours_lib;			
				
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
                $this->data['locationsList'] = $this->tours_lib->getLocationsList();
                $this->data['selectedAdults'] = $this->tours_lib->adults;
                $this->data['selectedChild'] = $this->tours_lib->child;
                $this->data['selectedInfants'] = $this->tours_lib->infants;
              
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
				$this->data['tourtypes'] = $this->tours_lib->tourTypes();
				$alltours = $this->tours_lib->show_tours($offset);
				$this->data['tours'] = $alltours['all_tours'];
				$this->data['info'] = $alltours['paginationinfo'];
				$this->data['plinks2'] = $alltours['plinks2'];
				$this->data['date'] = $this->tours_lib->date;
				$this->data['minprice'] = $this->tours_lib->convertAmount($settings[0]->front_search_min_price);
				$this->data['maxprice'] = $this->tours_lib->convertAmount($settings[0]->front_search_max_price);
				$this->data['currCode'] = $this->tours_lib->currencycode;
				$this->data['currSign'] = $this->tours_lib->currencysign;
				$this->data['page_title'] = $settings[0]->header_title;
				$this->data['metakey'] = $settings[0]->meta_keywords;
				$this->data['metadesc'] = $settings[0]->meta_description;
                $this->data['langurl'] = base_url()."tours/{langid}/";

                $this->theme->view('tours/tours', $this->data);
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
				$this->data['minprice'] = $this->tours_lib->convertAmount($settings[0]->front_search_min_price);
				$this->data['maxprice'] = $this->tours_lib->convertAmount($settings[0]->front_search_max_price);
				$this->data['currCode'] = $this->tours_lib->currencycode;
				$this->data['currSign'] = $this->tours_lib->currencysign;
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
                      $this->data['extraChkUrl'] = $bookInfo['tour']->extraChkUrl;
                      $this->data['totalGuests'] = $this->tours_lib->guestCount;
                 

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

		function tourmap($tourid) {
				if (!empty ($tourid)) {
						//$starting = pt_tour_start_end_map($tourid, 'start');
						//$ending = pt_tour_start_end_map($tourid, 'end');
						//$visiting = pt_tour_visiting_map($tourid);
						$locationsData = $this->tours_lib->tourLocations($tourid);
						//print_r($locationsData->locations); exit;
						$locations = $locationsData->locations;

						$this->load->library('mapbuilder');
						$map = $this->mapbuilder;
						$map->setScrollwheel(FALSE);
						$map->_setBounds = TRUE;
						$map->setCenter($locations[0]->lat, $locations[0]->long);
						$map->setMapTypeId('ROADMAP');
						$map->setSize('100%', '100%');
						$latDiff = $locations[count($locations) - 1]->lat - $locations[0]->lat;
						$longDiff = $locations[count($locations) - 1]->long - $locations[0]->long;
						$maxDiff = max(array($latDiff,$longDiff));
						//echo "Lat: ".$latDiff."----";
						//echo "Long: ".$longDiff."----";
						//echo $maxDiff; exit;

	if($maxDiff >= 0 && $maxDiff <= 0.0037)  //zoom 17
		$map->setZoom(14);
	else if($maxDiff > 0.0037 && $maxDiff <= 0.0070)  //zoom 16
		$map->setZoom(13);
	else if($maxDiff > 0.0070 && $maxDiff <= 0.0130)  //zoom 15
		$map->setZoom(12);
	else if($maxDiff > 0.0130 && $maxDiff <= 0.0290)  //zoom 14
		$map->setZoom(13);
	else if($maxDiff > 0.0290 && $maxDiff <= 0.0550)  //zoom 13
		$map->setZoom(10);
	else if($maxDiff > 0.0550 && $maxDiff <= 0.1200)  //zoom 12
		$map->setZoom(9);
	else if($maxDiff > 0.1200 && $maxDiff <= 0.4640)  //zoom 10
		$map->setZoom(8);
	else if($maxDiff > 0.4640 && $maxDiff <= 1.8580)  //zoom 8
		$map->setZoom(8);
	else if($maxDiff > 1.8580 && $maxDiff <= 3.5310)  //zoom 7
		$map->setZoom(7);
	else if($maxDiff > 3.5310 && $maxDiff <= 7.3367)  //zoom 6
		$map->setZoom(6);
	else if($maxDiff > 7.3367 && $maxDiff <= 14.222)  //zoom 5
		$map->setZoom(5);
	else if($maxDiff > 14.222 && $maxDiff <= 28.000)  //zoom 4
		$map->setZoom(4);
	else if($maxDiff > 28.000 && $maxDiff <= 58.000)  //zoom 3
		$map->setZoom(3);
	else
		$map->setZoom(1);
						


						/*$locations = array();
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
						}*/

						


						$path1 = array();
						$count = 0;
						foreach ($locations as $location) {
							$count++;
								//if ($i < sizeof($locations)) {
										$path1[] = array($location->lat, $location->long);
								//}
								$map->addMarker($location->lat, $location->long, array('title' => $location->name, 'icon' => "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=$count|2b7de2|FFFFFF",
								'html' => '<b>' . $location->name . '</b>', 'infoCloseOthers' => true));
						}
						$map->addPolyline($path1, '#0658bd', 3, 1);
						$map->show();
				}
		}

		

           }
