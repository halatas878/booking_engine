<?php
class Dohop_model extends CI_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

     // update front settings
       function update_front_settings(){
        $ufor = $this->input->post('updatefor');
         $data = array(
         'front_icon' =>  $this->input->post('page_icon'),
         'cid' =>  $this->input->post('username'),
         'header_title' =>  $this->input->post('headertitle'),
         'linktarget' =>  $this->input->post('target'),
         'load_headerfooter' =>  $this->input->post('showheaderfooter')

         );
        $this->db->where('front_for',$ufor);
        $this->db->update('pt_front_settings',$data);
        $this->session->set_flashdata('flashmsgs', "Updated Successfully");

      }

      function get_cities(){

     $this->db->order_by('city_name','asc');
     $this->db->where('city_status','1');
    return $this->db->get('pt_cities')->result();

    }

    function get_city_name($id){

    $this->db->select('city_name',$id);
    $this->db->where('city_id',$id);
    $this->db->where('city_status','1');
    $cityname = $this->db->get('pt_cities')->result();
    return $cityname[0]->city_name;

    }


}