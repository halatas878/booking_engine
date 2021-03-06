<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Creditcard extends MX_Controller {

          private $data = array();


  function __construct(){

    parent::__construct();
    if(empty($_POST)){
      exit;
    }


 }


 function index(){
  $settings = $this->settings_model->get_settings_data();
  $this->load->helper('invoice');
  $this->load->model('admin/payments_model');

  $gateway = $this->input->post('paymethod');

  $bookid = $this->input->post('bookingid');
  $ref = $this->input->post('refno');
  $invoicdata = invoiceDetails($bookid,$ref);

  require_once "./application/modules/gateways/" . $gateway . ".php";
  $params = $this->payments_model->getGatewayParams($gateway);

  $params['charset'] = "UTF-8";
  $params['invoiceid'] = $invoicdata->id;
  $params['userid'] = $invoicdata->bookingUser;
  $params['firstname'] = $this->input->post('firstname');
  $params['lastname'] = $this->input->post('lastname');
  $params['email'] = $invoicdata->accountEmail;
  $params['companyname'] = $settings[0]->site_title;
  $params['invoiceref'] = $invoicdata->code;
  $params['amount'] = $invoicdata->checkoutAmount;
  $params['currency'] = $invoicdata->currCode;
  $params['cccvv'] = $this->input->post('cvv');
  $params['cardexp'] = $this->input->post('expMonth')."-".$this->input->post('expYear');
  $params['cardnum'] = $this->input->post('cardnum');
/*echo "<pre>";
     print_r($params); 
  echo "</pre>";
  exit;*/
  if (function_exists($gateway . "_capture")) {
      $msg = call_user_func($gateway . "_capture",$params);  
    }


    if($msg['status'] == "success"){

      updateInvoiceStatus($invoicdata->id,$invoicdata->checkoutAmount,$msg['transactionid'],$gateway,"paid", $invoicdata->module,$invoicdata->checkoutTotal);

        $this->load->model('admin/emails_model');

        $this->emails_model->paid_sendEmail_customer($invoicdata);
        $this->emails_model->paid_sendEmail_admin($invoicdata);
        $this->emails_model->paid_sendEmail_supplier($invoicdata);
        $this->emails_model->paid_sendEmail_owner($invoicdata);

    }else{
    $this->session->set_flashdata('invoiceerror',$msg['msg']);
 
    }
       redirect("invoice?id=".$invoicdata->id."&sessid=".$invoicdata->code);  

 }



}
