<?php
header('Access-Control-Allow-Origin: *');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'modules/api/libraries/REST_Controller.php';

class Cars extends REST_Controller {

    function __construct() {
        // Construct our parent class
        parent :: __construct();
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['list_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
        $this->load->library('cars/cars_lib');
        $this->settings = $this->settings_model->get_settings_data();
    }

    function list_get() {
        $offset = $this->get('offset');
        $list = $this->cars_lib->show_cars($offset);

        if (!empty ($list['all_cars'])) {
         
            $this->response($list['all_cars'], 200); // 200 being the HTTP response code
        }
        else {
            $this->response(array('response' => array('error' => 'Cars could not be found')), 200);
        }
    }

    function locations_get(){
        $pickuplocations = $this->cars_lib->getPickupLocationsList();
        $dropofflocations = $this->cars_lib->getDropLocationsList();
                
         if (!empty ($pickuplocations) && !empty($dropofflocations)) {
            $this->response(array('pickupLocations' => $pickuplocations, 'dropoffLocations' => $dropofflocations), 200); // 200 being the HTTP response code
        }
        else {
            $this->response(array('response' => array('error' => 'Locations could not be found')), 200);
        }
    }

    function cartypes_get(){
        $location = $this->get('location');
        $locations = $this->cars_lib->getCarTypesLocationBased($location);
  
        
         if (!empty ($locations->types)) {
            $this->response($locations->types, 200); // 200 being the HTTP response code
        }
        else {
            $this->response(array('response' => array('error' => 'Types could not be found')), 200);
        }
    }

    function details_get() {
        $id = $this->get('id');
        $appDate = $this->get('date'); 
        
        if(empty($appDate)){
        $date = ""; 
        }else{
        $date = date($this->settings[0]->date_f, strtotime($appDate));    
        }

        if (empty($id)) {                                        
            $this->response(array('response' => array('error' => 'Car ID is required')), 200);
        }
        $details['car'] = $this->cars_lib->car_details($id, $date);
        $details['car']->desc = strip_tags($details['car']->desc);

        if (pt_is_module_enabled('reviews')) {
                        $details['reviews'] = $this->cars_lib->car_reviews_for_api($details['car']->id);
                        $details['avgReviews'] = $this->cars_lib->carReviewsAvg($details['car']->id);
        }
        
        if (!empty ($details)) {
            $this->response($details, 200); // 200 being the HTTP response code
        }else {
            $this->response(array('response' => array('error' => 'Car Details could not be found')), 200);
        }
            
    }

    function search_get() {
            

   
                $offset = $this->input->get('offset');
                $cityid = $this->get('location');

                /*$appCheckout = $this->get('checkout'); 
                $checkout = date($this->settings[0]->date_f, strtotime($appCheckout));*/
                $details = $this->cars_lib->search_cars($cityid , $offset);
                
                
                if (!empty ($details['all_cars'])) {
                        $this->response($details['all_cars'], 200); // 200 being the HTTP response code
                }
                else {
                        $this->response(array('response' => array('error' => 'Results Not found')), 200);
                }
        }

     function invoice_post() {
                $this->load->model('admin/bookings_model');
                $userid = $this->post('userId');
                if(!empty($userid)){
                $data = $this->bookings_model->do_booking($userid);
                }else{
                $data = $this->bookings_model->doGuestBooking();    
                }
                $message = array('response' => $data);
                $this->response($message, 200); // 200 being the HTTP response code
        }   

    function show_get($param, $vars = null) {
        $arr = $this->input->get();
        $arrstr = "";
        foreach($arr as $key => $val){
            $arrstr .= $key."=".$val."&"; 
        }

         $url = base_url()."api/cars/".$param."?".$arrstr;
        //              $url = base_url() . "api/hotels/hoteldetails?id=40";
        //  $url = base_url()."api/hotels/book?id=40&checkin=20/01/2015&checkout=22/01/2015";
        //  $url = base_url()."api/hotels/user";
        $ch = curl_init();
        $timeout = 3;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata = curl_exec($ch);
        curl_close($ch);
        @ $json = json_decode($rawdata);
        echo "<pre>";
        print_r($json);
    }
}