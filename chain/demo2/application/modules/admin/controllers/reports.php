<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MX_Controller {

private $data = array();

function __construct(){

parent::__construct();

modules::load('admin');

$chkadmin = modules::run('admin/validadmin');

if(!$chkadmin){
$this->session->set_userdata('prevURL', current_url());
redirect('admin');

}

$this->data['app_settings'] = $this->settings_model->get_settings_data();

$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');


}

public function index()

{

//strtotime(date('Y-m-01'))." ".date('Y-m-t');

$this->data['modules'] = $this->modules_model->get_module_names();

$this->data['chklib'] =  $this->ptmodules;

$filter = $this->input->post('filtermod');

$this->data['selmodule'] = $this->input->post('module');

$module =  $this->data['selmodule'];

if(!empty($filter) && !empty($module)){

$this->$module();

}else{

$this->data['monthly'] = $this->monthly_report();

$this->data['thismonth'] = $this->this_month_report();

$this->data['thisyear'] = $this->this_year_report();

$this->data['thisday'] = $this->this_day_report();

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

}

public function hotels()

{

$this->data['monthly'] = $this->monthly_report('hotels');

$this->data['thismonth'] = $this->this_month_report('hotels');

$this->data['thisyear'] = $this->this_year_report('hotels');

$this->data['thisday'] = $this->this_day_report('hotels');

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

public function cruises()

{

$this->data['monthly'] = $this->monthly_report('cruises');

$this->data['thismonth'] = $this->this_month_report('cruises');

$this->data['thisyear'] = $this->this_year_report('cruises');

$this->data['thisday'] = $this->this_day_report('cruises');

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

public function tours()

{

$this->data['monthly'] = $this->monthly_report('tours');

$this->data['thismonth'] = $this->this_month_report('tours');

$this->data['thisyear'] = $this->this_year_report('tours');

$this->data['thisday'] = $this->this_day_report('tours');

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

public function cars()

{

$this->data['monthly'] = $this->monthly_report('cars');

$this->data['thismonth'] = $this->this_month_report('cars');

$this->data['thisyear'] = $this->this_year_report('cars');

$this->data['thisday'] = $this->this_day_report('cars');

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

function this_day_report($type = null){

$first = time() - 86400;

$last  = time();

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',$first);

$this->db->where('booking_payment_date <=',$last);

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

return round($res[0]->booking_amount_paid,2);

}

function this_month_report($type = null){

$from = strtotime(date('Y-m-01'));

$to = strtotime(date('Y-m-t'));

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',$from);

$this->db->where('booking_payment_date <=',$to);

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

return round($res[0]->booking_amount_paid,2);

}

function this_year_report($type = null){

$year = date("Y");

$first = strtotime($year."-01-01");

$last  = strtotime($year."-12-31");

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',$first);

$this->db->where('booking_payment_date <=',$last);

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

return round($res[0]->booking_amount_paid,2);

}

//  from and to date report

function from_to_report(){

$from = str_replace("/","-",$this->input->post('from'));

$to = str_replace("/","-",$this->input->post('to'));

$type = $this->input->post('type');

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',strtotime($from));

$this->db->where('booking_payment_date <=',strtotime($to));

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

$html = "

<h1><strong>". $this->data['app_settings'][0]->currency_sign.round($res[0]->booking_amount_paid,2)."</strong></h1>

";

$html .= "

<h5>From ".$this->input->post('from')." <br> to ".$this->input->post('to')."</h5>

";

echo $html;

}

function monthly_report($type = null){

$datearray = array();

$resultarray = array();

$year = date("Y");

for($m =1;$m < 13;$m++){

$datearray[strtotime($year."-".$m."-1")] = strtotime($year."-".$m."-31");

}

foreach($datearray as $start => $end){

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_date >=',$start);

$this->db->where('booking_date <=',$end);

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

$resultarray[] = round($res[0]->booking_amount_paid,2);

}

return $resultarray;

}



//Last today bookingreport
function today($type = null){

$info = new stdClass;
$info->paidAmount = 0;
$info->paidCount = 0;

$info->unpaidAmount = 0;
$info->unpaidCount = 0;

$info->reservedCount = 0;

$first = strtotime(date('Y-m-d'));

$last  = time();


if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_date >=',$first);

$this->db->where('booking_date <=',$last);


$result = $this->db->get('pt_bookings')->result();

if(!empty($result)){

foreach($result as $res){
	if($res->booking_status == "paid"){
		$info->paidCount += 1;
		$info->paidAmount += $res->booking_amount_paid;

	}elseif($res->booking_status == "unpaid"){
		$info->unpaidCount += 1;
		$info->unpaidAmount += $res->booking_deposit;

	}elseif($res->booking_status == "reserved"){
		$info->reservedCount += 1;

	}


}

}

$info->totalCount = $info->paidCount + $info->unpaidCount + $info->reservedCount;
$info->totalAmount = $info->paidAmount;


return $info;


}

//end Today booking report



//Last 30 days bookingreport
function thirtydays($type = null){
$info = new stdClass;
$info->paidAmount = 0;
$info->paidCount = 0;

$info->unpaidAmount = 0;
$info->unpaidCount = 0;

$info->reservedCount = 0;

$bookingAmount = 0;

$from = strtotime(date('Y-m-d', strtotime('-30 days')));

$to = time();


if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_date >=',$from);

$this->db->where('booking_date <=',$to);


$result = $this->db->get('pt_bookings')->result();
if(!empty($result)){

foreach($result as $res){

	$temp = 0;
	if($res->booking_status == "paid"){

		$info->paidCount += 1;
		$info->paidAmount += $res->booking_amount_paid;
		

	}elseif($res->booking_status == "unpaid"){
		$info->unpaidCount += 1;
		$info->unpaidAmount += $res->booking_deposit;

	}elseif($res->booking_status == "reserved"){
		$info->reservedCount += 1;

	}




}

}



$info->totalCount = $info->paidCount + $info->unpaidCount + $info->reservedCount;
$info->totalAmount = $info->paidAmount;



return $info;


}

//end last 30 days booking report


//different durations bookings booking report
function diffLastDuration($duration, $type = null){

$info = new stdClass;
$info->paidAmount = 0;
$info->paidCount = 0;

$info->unpaidAmount = 0;
$info->unpaidCount = 0;

 $info->reservedCount = 0;

$first = strtotime(date('Y-m-d', strtotime('-'.$duration.' days')));

$last  = time();


if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_date >=',$first);

$this->db->where('booking_date <=',$last);


$result = $this->db->get('pt_bookings')->result();

if(!empty($result)){

foreach($result as $res){
	if($res->booking_status == "paid"){
		$info->paidCount += 1;
		$info->paidAmount += $res->booking_amount_paid;

	}elseif($res->booking_status == "unpaid"){
		$info->unpaidCount += 1;
		$info->unpaidAmount += $res->booking_deposit;

	}elseif($res->booking_status == "reserved"){
		$info->reservedCount += 1;


	}


}

}

$info->totalCount = $info->paidCount + $info->unpaidCount +  $info->reservedCount;
$info->totalAmount = $info->paidAmount;


return $info;


}

//end different duration booking report


//different durations bookings booking report
function diffLastDurationPaid($duration, $type = null){

$info = new stdClass;
$info->paidAmount = 0;
$info->paidCount = 0;

if($duration > 0){
$first = strtotime(date('Y-m-d', strtotime('-'.$duration.' days')));	
}else{

$first = strtotime(date('Y-m-d'));

}


$last  = time();


if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',$first);

$this->db->where('booking_payment_date <=',$last);


$result = $this->db->get('pt_bookings')->result();

if(!empty($result)){

foreach($result as $res){
	if($res->booking_status == "paid"){
		$info->paidCount += 1;
		$info->paidAmount += $res->booking_amount_paid;

	}


}

}

$info->totalCount = $info->paidCount;
$info->totalPaidAmount = $info->paidAmount;


return $info;


}

//end different duration booking report


function graphReport($type = null){

$datearray = array();

$resultarray = array();

$year = date("Y");

$from = strtotime(date('Y-m-d', strtotime('-30 days')));

$to = time();

for($m = $from;$m <= time() - 86400;$m += 86400){

$datearray[$m] = $m+86400;

}

foreach($datearray as $start => $end){


$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_date >=',$start);

$this->db->where('booking_date <=',$end);

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

$resultarray['amounts'][] = round($res[0]->booking_amount_paid,2);
$resultarray['days'][] = date("d",$start);

}


return $resultarray;

}

// Graph Report Expedia
function graphReportExpedia(){

$datearray = array();

$resultarray = array();

$year = date("Y");

$from = strtotime(date('Y-m-d', strtotime('-30 days')));

$to = time();

for($m = $from;$m <= time() - 86400;$m += 86400){

$datearray[$m] = $m+86400;

}

foreach($datearray as $start => $end){


$this->db->select_sum('book_total');


$this->db->where('book_date >=',$start);

$this->db->where('book_date <=',$end);


$res = $this->db->get('pt_ean_booking')->result();

$resultarray['amounts'][] = round($res[0]->book_total,2);
$resultarray['days'][] = date("d",$start);

}


return $resultarray;

}


//different durations bookings booking report Expedia
function diffLastDurationExpedia($duration){

$info = new stdClass;
$info->paidAmount = 0;
$info->paidCount = 0;

if($duration > 0){
$first = strtotime(date('Y-m-d', strtotime('-'.$duration.' days')));	
}else{
$first = strtotime(date('Y-m-d'));
}


$last  = time();


$this->db->where('book_date >=',$first);

$this->db->where('book_date <=',$last);


$result = $this->db->get('pt_ean_booking')->result();

if(!empty($result)){

foreach($result as $res){

		$info->paidCount += 1;
		$info->paidAmount += $res->book_total;



}

}

$info->totalCount = $info->paidCount;
$info->totalAmount = $info->paidAmount;


return $info;


}

//end different duration bookings expedia




}