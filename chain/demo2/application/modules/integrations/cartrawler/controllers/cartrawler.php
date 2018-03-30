<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cartrawler extends MX_Controller {

       private $data = array();

  function __construct(){
   // $this->session->sess_destroy();
    parent::__construct();

   modules::load('home');



   $this->load->library("cartrawler_lib");
   $this->load->model("cartrawler_model");
   $this->load->helper("cartrawler_front");
  $this->data['app_settings'] = $this->settings_model->get_settings_data();

  $this->data['lang_set'] = $this->session->userdata('set_lang');
  //  $this->city = $this->ean_model->get_city_name($citydef);
 $chk = modules::run('home/is_main_module_enabled','cartrawler');
   if(!$chk){
       Error_404();

   }
     $this->data['phone'] = $this->load->get_var('phone');
         $this->data['contactemail'] = $this->load->get_var('contactemail');
   $this->data['geo'] = $this->load->get_var('geolib');

      $defaultlang = pt_get_default_language();
   if(empty($this->data['lang_set'])){

      $this->data['lang_set'] = $defaultlang;
   }
 
 }

	public function index()
	{
   $pickupDate = $this->input->get('pickupdate');
     $settings =  $this->settings_model->get_front_settings("cartrawler");

   if(!empty($pickupDate)){
    $pickupDateTime = $this->formatDateTime($_GET['pickupdate'],$_GET['timeDepart']);
    $returnDateTime = $this->formatDateTime($_GET['dropoffdate'],$_GET['timeReturn']);
    unset($_GET['pickupdate']);
    unset($_GET['dropoffdate']);
    unset($_GET['timeReturn']);
    unset($_GET['timeDepart']);
    $_GET['pickupDateTime'] = $pickupDateTime;
    $_GET['returnDateTime'] = $returnDateTime;
    $_GET['currency'] = $settings[0]->currency;
    redirect(base_url().'car?'.http_build_query($_GET));
   }
    

  //http_build_query($_GET)

   $this->data['startLocation'] = $this->input->get('startlocation');
   $this->data['returnLocation'] = $this->input->get('endlocation');
   $this->data['pickupLocationId'] = $this->input->get('pickupLocationId');
   $this->data['returnLocationId'] = $this->input->get('returnLocationId');


   $pickupDateTime = $this->reverseFormatDateTime($this->input->get('pickupDateTime'));
   $returnDateTime = $this->reverseFormatDateTime($this->input->get('returnDateTime'));

   $this->data['pickupdate'] = $pickupDateTime->date;
   $this->data['pickuptime'] = $pickupDateTime->time;

   $this->data['returndate'] = $returnDateTime->date;
   $this->data['returntime'] = $returnDateTime->time;
     

  $this->data['timing'] = $this->cartrawler_lib->timingList();
  $this->data['cartrawlerid'] = $settings[0]->cid;
  $this->data['url'] = $settings[0]->secret;
  $this->data['page_title'] = $settings[0]->header_title;
 $loadheaderfooter = $settings[0]->load_headerfooter;
   $this->lang->load("front",$this->data['lang_set']);
  if(empty($loadheaderfooter)){

  $this->theme->partial('integrations/cartrawler/list',$this->data);
  }else{
  $this->theme->view('integrations/cartrawler/list',$this->data);
  }

}

public function getLocations(){

  $query = $this->input->post('term');
  $id = $this->input->post('inputid');

  $cc =  $this->cartrawler_lib->getLocations($query);
  $result = json_decode($cc);
  $response = new stdClass;


   $response->data = "";
  if($result->status == "success"){

   $response->data .= "<ul>";
  foreach($result->locations as $r){
    $val = $r->locationCode;
    $locname = $r->locationName;
    $response->data .= "<li onclick='selectLocationValue(\"$val\", \"$id\", \"$locname\")'>".$r->locationName."</li>";
  }

  $response->data .= "</ul>";

  }

  echo $response->data;

}

public function addLocationstoDb(){
// exit("exit called");


//$xml=simplexml_load_file("https://ota.cartrawler.com/cartrawlerota/files/static/ctlocation.EN.xml") or die("Error: Cannot create object");
$xml=simplexml_load_file("uploads/locations.xml") or die("Error: Cannot create object");

$count =0;

foreach($xml->Country as $c){
  $countryname = (string)$c['name'];

  foreach($c as $location){
   if(!$this->addedAlready((string)$location['Id'])){
   $data = array(
      'country_code' => (string)$location['CountryCode'],
      'country_name' => $countryname,
      'loc_name' => (string)$location['Name'],
      'loc_code' => (string)$location['Id'],
      'loc_lat' => (string)$location['Lat'],
      'loc_long' => (string)$location['Lng'],
      'loc_address' => (string)$location['Address']
      );


 $this->db->insert('cartrawler_locations',$data);
 echo $this->db->insert_id()."<br>";
}
   
  }

 
}




}

function addedAlready($code){

  $this->db->where('loc_code',$code);
  $num = $this->db->get('cartrawler_locations')->num_rows();
  if($num > 0){
    return TRUE;
  }else{
    return FALSE;
  }

}

function formatDateTime($date, $time){
  date_default_timezone_set('GMT');
  $breakDate = explode("/",$date);
  $month = $breakDate[0];
  $day = $breakDate[1];
  $year = $breakDate[2];
  return $year."-".$month."-".$day."T".$time;
}

function reverseFormatDateTime($datetime){
date_default_timezone_set('GMT');
  $breakDateTime = explode("T",$datetime);
  $date = $breakDateTime[0];
  $time = $breakDateTime[1];
  $newdate = new DateTime($date);
  $finalDate = $newdate->format('m/d/Y');
  $result = new stdClass;
  $result->date = $finalDate;
  $result->time = $time;
  return $result;
}



}
