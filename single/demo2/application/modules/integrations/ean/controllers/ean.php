<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Ean extends MX_Controller {
		private $data = array();
		private $city;
		public $cachekey;
		public $numberofresults;
		public $loggedin;
		public $settings = array();
		private $validlang;

		function __construct() {
// $this->session->sess_destroy();
				parent :: __construct();
				$chk = modules :: run('home/is_main_module_enabled', 'ean');
				if (!$chk) {
						Module_404();
				}
				modules :: load('home');
				$this->settings = $this->settings_model->get_front_settings('ean');
				$citydef = $this->settings[0]->front_search_city;
				$this->numberofresults = $this->settings[0]->front_listings;
				$this->load->library("ean_lib");
				$this->load->model("ean_model");
				$this->load->helper("ean_front");
				$this->data['eanlib'] = $this->ean_lib;
				$this->data['app_settings'] = $this->settings_model->get_settings_data();
				$this->data['lang_set'] = $this->session->userdata('set_lang');
				$this->data['user'] = $this->session->userdata('pt_logged_customer');
				$this->city = $citydef;
				$languageid = $this->uri->segment(2);
                $this->validlang = pt_isValid_language($languageid);

				$this->data['phone'] = $this->load->get_var('phone');
				$this->data['contactemail'] = $this->load->get_var('contactemail');
				$this->data['geo'] = $this->load->get_var('geolib');
				$defaultlang = pt_get_default_language();
				if (empty ($this->data['lang_set'])) {
						$this->data['lang_set'] = $defaultlang;
				}
				$this->loggedin = $this->session->userdata('pt_logged_customer');

				
				$this->load->library('myweather');
				$this->data['myweather_staus'] = $this->myweather->weather_module_details();
				$this->data['baseUrl'] = base_url().'properties/';
		}

		public function index() {
				$unsetdata = array('customerSessionId' => '', 'activePropertyCount' => '', 'cachekey' => '', 'cacheloc' => '');
				$this->session->unset_userdata($unsetdata);
				$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				$this->data['maxprice'] = $this->settings[0]->front_search_max_price;
				
				$this->data['result'] = $this->__firstlist();
				$this->data['resultMap'] = $this->__forMap();
				$this->data['selectedCity'] = $this->city;
			/* for request and response */

              /*  echo "<pre>";
                echo $this->ean_lib->apistr."<br>";
				echo print_r($this->data['result']);
				echo "</pre>";
				exit;*/

				$cachekey = array();
				$cacheloc = array();
				$cachekey = $this->data['result']['HotelListResponse']['cacheKey'];
				$cacheloc = $this->data['result']['HotelListResponse']['cacheLocation'];

				$cachedata = array('customerSessionId' => $this->data['result']['HotelListResponse']['customerSessionId'], 'activePropertyCount' => $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'], 'cachekey' => $cachekey, 'cacheloc' => $cacheloc);
				$this->session->set_userdata($cachedata);
				$this->lang->load("front", $this->data['lang_set']);

				//$this->data['plinks'] = getPaginationEan(site_url('ean/listings'), $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'], $this->numberofresults, 1);
				$this->data['currSign'] = $this->ean_lib->currency;
				$this->data['page_title'] = $this->settings[0]->header_title;
				$this->data['metakey'] = $this->settings[0]->meta_keywords;
				$this->data['metadesc'] = $this->settings[0]->meta_description;
				$this->theme->view('integrations/ean/index', $this->data);
		}

		function listings($offset) {
				$activepcount = $this->session->userdata("activePropertyCount");
				if ($offset == 1) {
						$this->data['result'] = $this->__firstlist();
						$this->data['plinks'] = getPaginationEan(site_url('ean/listings'), $activepcount, $this->numberofresults, $offset);
				}
				else {
						$key = "page" . $offset;
						$next = $offset + 1;
						$nextkey = "page" . $next;
						$ck = $this->session->userdata("cachekey");
						$cl = $this->session->userdata("cacheloc");
						$pInfo['cacheKey'] = $ck[$key];
						$pInfo['cacheLocation'] = $cl[$key];
						$pInfo['customerSessionId'] = $this->session->userdata("customerSessionId");
						$this->data['result'] = $this->ean_lib->HotelListsMore($pInfo);
						$this->data['plinks'] = getPaginationEan(site_url('ean/listings'), $activepcount, $this->numberofresults, $offset);
						$checkkey = array_key_exists($nextkey, $ck);
						if (!$checkkey) {
/*array_push($ck["$nextkey"],$this->data['result']['HotelListResponse']['cacheKey']);

array_push($cl["$nextkey"],$this->data['result']['HotelListResponse']['cacheLocation']);

*/
								$ck[$nextkey] = $this->data['result']['HotelListResponse']['cacheKey'];
								$cl[$nextkey] = $this->data['result']['HotelListResponse']['cacheLocation'];
								$cachedata = array('cachekey' => $ck, 'cacheloc' => $cl);
								$this->session->set_userdata($cachedata);
						}
				}
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['cachekey'] = $this->session->all_userdata();
				$this->data['currSign'] = $this->ean_lib->currency;
				$this->data['page_title'] = $this->settings[0]->header_title;
				$this->data['metakey'] = $this->settings[0]->meta_keywords;
				$this->data['metadesc'] = $this->settings[0]->meta_description;
				$this->theme->view('integrations/ean/index', $this->data);
		}

		function loadMore() {
				$ck = $this->input->post("cacheKey");
				$cl = $this->input->post("cacheLocation");
				$this->data['checkin'] = $this->input->post("checkin");
				$this->data['checkout'] = $this->input->post("checkout");
				$this->data['agesApendUrl'] = $this->input->post("agesappendurl");
				$this->data['adults'] = $this->input->post("adultsCount");
				$Info['cacheKey'] = $ck;
				$Info['cacheLocation'] = $cl;
				$Info['customerSessionId'] = $this->session->userdata("customerSessionId");
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['result'] = $this->ean_lib->HotelListsMore($Info);
				$this->theme->partial('integrations/ean/morehotels', $this->data);
		}

		function search($offset = null) {
				$search = $this->input->get('search');
				if (!empty ($search)) {
						$this->data['checkin'] = trim($_GET['checkIn']);
						$this->data['checkout'] = trim($_GET['checkOut']);
						$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				        $this->data['maxprice'] = $this->settings[0]->front_search_max_price;
				

						if (empty ($offset)) {
// print_r($_POST);
								$arrayInfo["city"] = trim($_GET['city']);
								$tempCity[] = strtok($arrayInfo["city"], " ,-");
								$arrayInfo["destinationId"] = trim($_GET['destinationId']);
								$arrayInfo["city"] = $tempCity[0];
// $arrayInfo['countryCode'] = 'IN';
								$arrayInfo['checkIn'] = trim($_GET['checkIn']);
// $arrayInfo['checkIn'] = "18-08-2014";
								$arrayInfo['checkOut'] = trim($_GET['checkOut']);
								$childAges = $this->input->get('childages');
								//$childCount = 0;
								$childAgesStr = "";
								if(!empty($childAges)){
								//$childCount =  count(explode(",",$childAges));	
								$childAgesStr = ",".$childAges;
								}

								$adults = $this->input->get("adults");
								$this->data['propertyCategory'] = $_GET['propertyCategory'];
								$adultString = $adults.$childAgesStr;

								$this->data['adults'] = $adults;
								//$this->data['child'] = $childCount;
								$this->data['child'] = $this->input->get('child');
								$this->data['childAges'] = $childAges;
								if($this->data['child'] > 0){
									$this->data['agesApendUrl'] = '&ages='.$childAges;	
								}else{
									$this->data['agesApendUrl'] = '';		
								}
								
// $arrayInfo['checkOut'] = "20-08-2014";
//$arrayInfo['rooms'] = "room1=1,3&room2=1,5";
								$arrayInfo['rooms'] = "room1=$adultString";
								$arrayInfo['numberOfResult'] = $this->settings[0]->front_search;
								if(!empty($this->data['propertyCategory'])){
									$propertyCat = implode(",",$this->data['propertyCategory']);
									$arrayInfo['propertyCategory'] = $propertyCat;
										
								}
//$arrayInfo['propertyCategory'] = 1;
//$arrayInfo['amenities'] = 1;
$arrayInfo['maxStarRating']= $this->input->get('stars');
$arrayInfo['minStarRating']= $this->input->get('stars');
$sprice = $this->input->get('price');
if (!empty ($sprice)) {
						$sprice = str_replace(";", ",", $sprice);
						$sprice = explode(",", $sprice);
						$minp = $sprice[0];
						$maxp = $sprice[1];
						$arrayInfo['minRate'] = $minp;
						$arrayInfo['maxRate'] = $maxp;
				}

//$arrayInfo['minRate'] = 1000;
//$arrayInfo['maxRate'] = 10000;
//$arrayInfo['sort'] = "QUALITY";
								$this->data['result'] = $this->ean_lib->HotelLists($arrayInfo);

								//$this->data['plinks'] = getPaginationEan(site_url('ean/search'), $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'], $this->numberofresults, 1);
								//$cachekey = array();
								//$cacheloc = array();
								//$cachekey["page2"] = $this->data['result']['HotelListResponse']['cacheKey'];
								//$cacheloc["page2"] = $this->data['result']['HotelListResponse']['cacheLocation'];
/*

array_push($cachekey,$this->data['result']['HotelListResponse']['cacheKey']);

array_push($cacheloc,$this->data['result']['HotelListResponse']['cacheLocation']);

*/
								$cachedata = array('customerSessionId' => $this->data['result']['HotelListResponse']['customerSessionId'], 'activePropertyCount' => $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'], 'cachekey' => $cachekey, 'cacheloc' => $cacheloc);
								$this->session->set_userdata($cachedata);
						}
						
				}
				else {
						$this->data['result'] = array();
				}
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = 'Search';
				$this->data['currSign'] = $this->ean_lib->currency;
				
				$this->theme->view('integrations/ean/index', $this->data);
		}

		function __firstlist() {
				$checkin = date("m/d/Y", strtotime("+1 days"));
				$checkout = date("m/d/Y", strtotime("+2 days"));
				$this->data['checkin'] = $checkin;
				$this->data['checkout'] = $checkout;
				$adults = 2;
				$this->data['adults'] = $adults;
				$arrayInfo["city"] = $this->city;
				$arrayInfo['checkIn'] = trim($checkin);
				$arrayInfo['checkOut'] = trim($checkout);
				$arrayInfo['rooms'] = "room1=$adults";
				$arrayInfo['numberOfResult'] = $this->numberofresults;
				return $this->ean_lib->HotelLists($arrayInfo);
		}

		function __forMap() {

				$checkin = date("m/d/Y", strtotime("+1 days"));
				$checkout = date("m/d/Y", strtotime("+2 days"));
				$this->data['checkin'] = $checkin;
				$this->data['checkout'] = $checkout;
				$adults = 2;
				$this->data['adults'] = $adults;
				$arrayInfo["city"] = $this->city;
				$arrayInfo['checkIn'] = trim($checkin);
				$arrayInfo['checkOut'] = trim($checkout);
				$arrayInfo['rooms'] = "room1=$adults";
				$arrayInfo['numberOfResult'] = 50;
				return $this->ean_lib->HotelLists($arrayInfo);
		}

		public function hotel($hotelId, $customerSessionId) {
			$isValidLang = pt_isValid_language($hotelId);
			$surl = http_build_query($_GET);
			if($isValidLang){
					$currLang = $hotelId;
                	$hotelId = $this->uri->segment(4);
                	$customerSessionId = $this->uri->segment(5);
                	redirect($this->data['baseUrl']."hotel/".$hotelId."/".$customerSessionId.'?'.$surl,'refresh');
                }else{
                	$currLang = $this->data['lang_set'];
                	
                }
                
      
				$arrayInfo['hotelId'] = $hotelId;
				$arrayInfo['customerSessionId'] = $customerSessionId;
				$result = $this->ean_lib->HotelDetails($arrayInfo);
				$checkinDate = trim($this->input->get('checkin'));
				$checkoutDate = trim($this->input->get('checkout'));
				if(empty($checkinDate)){
					$checkinDate = date("m/d/Y", strtotime("+1 days"));
				
				}

				if(empty($checkoutDate)){
					$checkoutDate = date("m/d/Y", strtotime("+2 days"));
				}

				$arrayInfo['checkIn'] = $checkinDate;
				$arrayInfo['checkOut'] = $checkoutDate;
				$childAges = $this->input->get('ages');
				$this->data['childAges'] = $childAges;
				if(!empty($childAges)){
					$ages = ",".$childAges;
				}else{
					$ages = "";
				}

				$adultsCount = $this->input->get('adults');
				if(empty($adultsCount)){
					$adultsCount = 2;
				}

				$this->data['adultsCount'] = $adultsCount;

				if(!empty($childAges)){
				$this->data['childCount'] = count(explode(",",$childAges));
					
				}
				$adults = $this->input->get('adults').$ages;
				$arrayInfo['rooms'] = "room1=$adults";

				$this->data['hotelid'] = $hotelId;
				$this->data['sessionid'] = $customerSessionId;
				$this->data['HotelInfo'] = $result['HotelInformationResponse'];
				$this->data['HotelSummary'] = $result['HotelInformationResponse']['HotelSummary'];
				$this->data['HotelDetails'] = $result['HotelInformationResponse']['HotelDetails'];
				$this->data['HotelImages'] = $result['HotelInformationResponse']['HotelImages'];
				$this->data['thumbnailImage'] = str_replace("_t", "_b", $result['HotelInformationResponse']['HotelImages']['HotelImage']['0']['thumbnailUrl']);
				$this->session->set_userdata('hotelThumb', $this->data['thumbnailImage']);

				$this->data['Facilities'] = $result['HotelInformationResponse']['RoomTypes']['RoomType']['0']['roomAmenities']['RoomAmenity'];
				$this->data['relatedHotels'] = $this->ean_lib->getRelatedHotels($this->data['HotelSummary']['city']);
				$roomresponse = $this->ean_lib->HotelRoomAvailability($arrayInfo);

				
				$roomsInfo = $roomresponse['HotelRoomAvailabilityResponse'];
				
				/* For Room Availability Request and Response */

                /*echo "<pre>";
                echo $this->ean_lib->apistr."<br>";
                print_r($roomsInfo);
                echo "</pre>";
                exit;*/

				$this->data['loggedin'] = $this->loggedin;

				$this->data['rooms'] = $roomsInfo['HotelRoomResponse'];

				$this->data['checkin'] = $checkinDate; //$roomsInfo['arrivalDate'];
				$this->data['checkout'] = $checkoutDate; //$roomsInfo['departureDate'];


				$this->data['apistr'] = $this->ean_lib->apistr;
				$this->lang->load("front", $currLang);
				$this->data['page_title'] = $this->data['HotelSummary']['name'];

				$this->data['langurl'] = $this->data['baseUrl']."hotel/{langid}/".$hotelId."/".$customerSessionId.'?'.$surl;
				$this->theme->view('integrations/ean/hotel', $this->data);
		}

		public function reservation(){
				$isguest = $this->input->get('user');
				$this->data['affiliateConfirmationId'] = $this->setAffliateConfirmation();

				

				$user = $this->data['user'];

				if($isguest == "guest"){

				}elseif($isguest == "register"){
					unset($_GET['user']);

					$url = http_build_query($_GET);

					redirect('register?' . $url);

				}else{

				if(empty($this->loggedin)){
					unset($_GET['user']);
					
					$url = http_build_query($_GET);
						redirect('login?' . $url);
				}

				}
				
				$this->load->model('admin/countries_model');
				$this->data['allcountries'] = $this->countries_model->get_all_countries();
				$pay = $this->input->post('pay');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('firstName', 'First Name', 'trim');
				$this->form_validation->set_rules('lastName', 'Last name', 'trim');
				$this->form_validation->set_rules('policy', 'Cancellation Policy', 'required');
				$this->form_validation->set_rules('address', 'Address', 'trim');
				$this->form_validation->set_rules('cvv', 'CVV', 'trim');
				$this->form_validation->set_rules('cardno', 'Card Number', 'trim');
				$this->form_validation->set_rules('province', 'State', 'trim');
				$this->form_validation->set_rules('postalcode', 'Postal Code', 'trim');
				$this->form_validation->set_rules('phone', 'Phone', 'trim');
				if (!empty ($pay)) {
						$this->form_validation->run();
						$this->data['result'] = $this->ean_lib->HotelRoomReservation();

						/* For Room Reservation Request and Response */

						/*echo "<pre>";
						echo "https://book.api.ean.com/ean-services/rs/hotel/v3/res? <br>";
						print_r($this->data['result']);
						echo "</pre>";
						exit;*/
			
						$error = $this->data['result']->HotelRoomReservationResponse->EanWsError;
						$bookresponse = $this->data['result']->HotelRoomReservationResponse;
						if (!empty ($error)) {
								$itid = $this->data['result']->HotelRoomReservationResponse->EanWsError->itineraryId;
								$confirmation = "";
								$this->data['msg'] = $error->presentationMessage;
								//$this->data['msg'] = print_r($this->data['result']->HotelRoomReservationResponse);
								$this->data['result'] = "fail";
						}
						else {
								$itid = $this->data['result']->HotelRoomReservationResponse->itineraryId;
								$confirmation = $this->data['result']->HotelRoomReservationResponse->confirmationNumbers;
								$this->data['itineraryID'] = $itid;
								$this->data['confirmationNumber'] = $confirmation;
								$this->data['checkInInstructions'] = $this->data['result']->HotelRoomReservationResponse->checkInInstructions;
								$this->data['nonRefundable'] = $this->data['result']->HotelRoomReservationResponse->nonRefundable;

								$total = (array)$this->data['result']->HotelRoomReservationResponse->RateInfo->ChargeableRateInfo;
								$this->data['grandTotal'] = $total['@total'];
								$this->data['currency'] = $total['@currencyCode'];
								$this->data['surchargeTotal'] = $total['@surchargeTotal'];
								$surchargesArray = (array)$this->data['result']->HotelRoomReservationResponse->RateInfo->ChargeableRateInfo->Surcharges->Surcharge;
								foreach($surchargesArray as $s){
								$surchargeTypes[] = array($s['@type'] => $s['@amount']);
								}
								$this->data['SalesTax'] = $surchargeTypes['SalesTax'];
								$this->data['HotelOccupancyTax'] = $surchargeTypes['HotelOccupancyTax'];
					

								$this->data['msg'] = trans("0336");
								//$this->data['msg'] = $this->data['msg'] = print_r($this->data['result']->HotelRoomReservationResponse);
								if(!empty($confirmation)){
									$this->data['result'] = "success";

								}else{
									$this->data['result'] = "fail";
								}
								
						}
						if ($itid > 1 && !empty($confirmation)) {
								$totalamount = $this->input->post('total');
								if($isguest == "guest"){
									
									$user = $this->ean_model->eanSignup_account($this->input->post());
								}
						
								$insertdata = array('user' => $user, 'checkin' => $this->input->post('checkin'), 'checkout' => $this->input->post('checkout'), 'hotel' => $this->input->post('hotel'), 'thumbnail' => $this->input->post('thumbnail'), 'location' => $this->input->post('location'),'stars' => $this->input->post('hotelstars'),'hotelname' => $this->input->post('hotelname'), 'roomname' => $this->input->post('roomname'), 'roomtotal' => $this->input->post('roomtotal'), 'tax' => $this->input->post('tax'), 'total' => $totalamount, 'email' => $this->input->post('email'), 'itineraryid' => $itid, 'confirmation' => $confirmation, 'nights' => $this->input->post('nights'),'currency' => $this->input->post('currency'),'bookResponse' => json_encode($bookresponse));
								$this->ean_model->insert_booking($insertdata);



						}
				}
				$this->data['checkin'] = $this->input->get('checkin');
				$this->data['checkout'] = $this->input->get('checkout');
				$arrayInfo['hotelId'] = $this->input->get('hotel');
				$arrayInfo['customerSessionId'] = $this->input->get('sessionid');
				$arrayInfo['checkIn'] = trim($this->input->get('checkin'));
				$arrayInfo['checkOut'] = trim($this->input->get('checkout'));
				$arrayInfo['roomTypeCode'] = $this->input->get('roomtype');
		
				$arrayInfo['rateKey'] = $this->input->get('ratekey');
				$arrayInfo['rateCode'] = $this->input->get('ratecode');
				$result = $this->ean_lib->HotelDetails($arrayInfo);
				$roomresponse = $this->ean_lib->HotelRoomAvailability($arrayInfo);
				$paymenttypes = $this->ean_lib->paymentinfo($arrayInfo);

		/* For Payment Types Request and Response */

                /*echo "<pre>";
                echo $this->ean_lib->apistr."<br>";
                print_r($paymenttypes);
                echo "</pre>";
                exit;*/
				$this->data['payment'] = $paymenttypes['HotelPaymentResponse']['PaymentType'];
				$this->data['room'] = $roomresponse['HotelRoomAvailabilityResponse'];
				$this->data['roomsCount'] = count($this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['RoomGroup']);


				$this->data['cancelpolicy'] = $roomresponse['HotelRoomAvailabilityResponse']['HotelRoomResponse']['RateInfos']['RateInfo']['cancellationPolicy'];
				$this->data['roomname'] = $this->data['room']['HotelRoomResponse']['rateDescription'];
				$this->data['nights'] = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['NightlyRatesPerRoom']['@size'];
				$this->data['total'] = round($this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['@total'], 2);
				$surchargesArray = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['Surcharges']['Surcharge'];
				$this->data['tax'] = round($this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['@surchargeTotal'], 2);
				foreach($surchargesArray as $s){
					$surchargeTypes[] = array($s['@type'] => $s['@amount']);
				}
				$this->data['SalesTax'] = $surchargeTypes['SalesTax'];
				$this->data['HotelOccupancyTax'] = $surchargeTypes['HotelOccupancyTax'];
				$this->data['ExtraPersonFee'] = $surchargeTypes['ExtraPersonFee'];
					
				$this->data['currency'] = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['@currencyCode'];
				$this->data['roomtotal'] = round($this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['@nightlyRateTotal'], 2);
				$this->data['HotelSummary'] = $result['HotelInformationResponse']['HotelSummary'];
				$this->data['HotelImages'] = $result['HotelInformationResponse']['HotelImages'];
				$this->data['checkInInstructions'] =  $this->data['room']['checkInInstructions'];
				$stars = $this->data['HotelSummary']['hotelRating'];
				if($stars < 1){
					$stars = 1;
				}
				$this->data['hotelStars'] = $stars;
				
				/*echo "<pre>";
				print_r($this->data['room']);
				echo "</pre>";*/


				if (!empty ($submit)) {
						$this->data['paid'] = "Payment made";
				}

				$this->load->model('admin/accounts_model');
				$loggedin = $this->loggedin;
                $this->data['profile'] = $this->accounts_model->get_profile_details($loggedin);
                $this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = $this->data['HotelSummary']['name'];
				$this->theme->view('integrations/ean/booking', $this->data);
		}

		function cancel() {
				$id = $this->input->post('id');
				$data = $this->ean_model->get_single_booking($id);
				$bookid = $data[0]->book_id;
				$itenid = $data[0]->book_itineraryid;
				$conf = $data[0]->book_confirmation;
				$email = $data[0]->book_email;
				$arrayinfo = array("confirmationnumber" => $conf, "itineraryid" => $itenid, "email" => $email);
				$retdata = $this->ean_lib->HotelRoomCancellation($arrayinfo);
				$cancelnumber = $retdata['HotelRoomCancellationResponse']['cancellationNumber'];
				if (!empty ($retdata['HotelRoomCancellationResponse']['EanWsError'])) {
						echo $retdata['HotelRoomCancellationResponse']['EanWsError']['presentationMessage'];
				}
				else {
						$this->ean_model->cancel_my_booking($id, $cancelnumber);
						echo "0";
				}
//$retdata->HotelRoomCancellationResponse->EanWsError->presentationMessage;
//$retdata->HotelRoomCancellationResponse->cancellationNumber;
		}


		function maps($lat , $long, $title) {
				if (empty ($lat) || empty ($long)) {
						Error_404();
				}
				else {
					$link = "#";
					$img = $this->session->userdata('hotelThumb');
						
						pt_show_map($lat, $long, '100%', '100%', $title, $img, 80, 80, $link);
				}
		}

		public function setAffliateConfirmation(){
			$this->db->select('book_id');
			$this->db->order_by('book_id','desc');
			$res = $this->db->get('pt_ean_booking')->result();
			if(!empty($res)){
				$bookid = $res[0]->book_id + 1;
			}else{
				$bookid = 1;
			}

			return $bookid;
			
		}

}