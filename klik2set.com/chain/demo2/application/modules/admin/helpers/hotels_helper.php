<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');
        if (!function_exists('getBackHotelTranslation')) {

		function getBackHotelTranslation($lang, $id) {
		  if(!empty($id)){
          $CI = get_instance();
          $CI->load->model('hotels/hotels_model');
          $res = $CI->hotels_model->getBackTranslation($lang,$id);
          return $res;
		  }else{
            return '';
		  }

		}

} if (!function_exists('getHotel')) {
		function getHotel($id, $args="") {
		  if(!empty($id)){
          $CI = get_instance();
          $CI->load->model('hotels/hotels_model');
          $res = $CI->hotels_model->shortInfo($id);
          return $res;
		  }else{
            return '';
		  }

		}

} if (!function_exists('getHotels')) {
		function getHotels($id="") {
          $CI = get_instance();
          $CI->load->model('hotels/hotels_model');
          $res = $CI->hotels_model->all_hotels($id);
		  $hasil = array();
		  foreach($res as $k=>$v){
		  	$get1st	 = explode(",",$v->daerah);
			  if($get1st){
			  	$v->daerah = $get1st[0];
			  	$hasil[trim($v->daerah)][]=$v;
			  }
		  }
          return $hasil;
		}

} if (!function_exists('getBackRoomTranslation')) {

		function getBackRoomTranslation($lang, $id) {
		  if(!empty($id)){
          $CI = get_instance();
          $CI->load->model('hotels/rooms_model');
          $res = $CI->rooms_model->getBackTranslation($lang,$id);
          return $res;
		  }else{
            return '';
		  }

		}

}if (!function_exists('GetRoomQuantity')) {

		function GetRoomQuantity($id) {
		  if(!empty($id)){
          $CI = get_instance();
          $CI->load->model('hotels/rooms_model');
          $res = $CI->rooms_model->getRoomQuantity($id);
          return $res;
		  }else{
            return '0';
		  }

		}

}if (!function_exists('getTypesTranslation')) {

		function getTypesTranslation($lang, $id) {
		  if(!empty($id)){
          $CI = get_instance();
          $CI->load->model('hotels/hotels_model');
          $res = $CI->hotels_model->getTypesTranslation($lang,$id);
          return $res;
		  }else{
            return '';
		  }

		}
} if (!function_exists('getShortPrices')) {
	function getShortPrices($id=0){
		if($id>0){
			$CI = get_instance();
	        $CI->load->model('hotels/hotels_model');
	        $res = $CI->hotels_model->getShortPrices($id);
	        return $res;
		}else{
	      return '';
		}
	}
} if (!function_exists('getShortRoom')) {
	function getShortRoom($id=0){
		if($id>0){
			$CI = get_instance();
	        $CI->load->model('hotels/hotels_model');
	        $res = $CI->hotels_model->getShortRoom($id);
	        return $res;
		}else{
	      return '';
		}
	}
} if (!function_exists('getDetailPrices')) {
	function getDetailPrices($id=0){
		if($id>0){
			$CI = get_instance();
	        $CI->load->model('hotels/hotels_model');
	        $res = $CI->hotels_model->getDetailPrices($id);
	        return $res;
		}else{
	      return '';
		}
	}
} if (!function_exists('getListPrice')) {
	function getListPrice($id=0){
		if($id>0){
			$CI = get_instance();
	        $CI->load->model('hotels/hotels_model');
	        $res = $CI->hotels_model->getListPrice($id);
	        return $res;
		}else{
	      return '';
		}
	}
}

