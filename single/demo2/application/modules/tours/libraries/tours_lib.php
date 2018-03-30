<?php

class Tours_lib {
/**
* Protected variables
*/
		protected $ci = NULL; //codeigniter instance
		protected $db; //database instatnce instance
		public $appSettings;
		public $tourid;
		public $title;
		public $slug;
		public $stars;
		public $desc;
		public $policy;
		public $basicprice;
		public $discountprice;
		protected $lang;
		public $currencysign;
		public $currencycode;
		public $location;
		public $latitude;
		public $longitude;
		public $isfeatured;
		public $thumbnail;
		public $inclusions;
		public $exclusions;
		public $adultStatus;
		public $childStatus;
		public $infantStatus;
		public $tourNights;
		public $tourDays;
		public $tourType;
		public $adults;
		public $child;
		public $infants;
		public $selectedLocation;
		public $selectedTourType;
		public $date;
		public $adultPrice;
		public $childPrice;
		public $infantPrice;
		public $urlVars;
		public $error;
		public $errorCode;
		public $tax_type;
		public $tax_value;
		public $deposit = 0;
		public $taxamount;
		public $guestCount;
		public $langdef;


		function __construct() {
//get the CI instance
				$this->ci = & get_instance();
				$this->db = $this->ci->db;
				$this->appSettings = $this->ci->settings_model->get_settings_data();
				$lang = $this->ci->session->userdata('set_lang');
				$defaultlang = pt_get_default_language();
				$this->ci->load->model('tours/tours_model');
				$this->ci->load->helper('tours/tours_front');
				if (empty ($lang)) {
						$this->lang = $defaultlang;
				}
				else {
						$this->lang = $lang;
				}

				$this->error = false;
				$this->errorCode = "";

				$this->date = $this->ci->input->get('date');
				$typeid = $this->ci->input->get('type');
				$this->selectedTourType = $this->selectedTourType($typeid);

				$selectedAdults = $this->ci->input->get('adults');
				$selecteChildren = $this->ci->input->get('child');
				$selectedInfants = $this->ci->input->get('infant');
				$loc = $this->ci->input->get('location');
				if(!empty($selectedAdults)){

					$this->adults = $selectedAdults;
				
				}else{

					$this->adults = 1;
				}

				if(!empty($selecteChildren)){

					$this->child = $selecteChildren;
				
				}else{

					$this->child = 0;
				}

				if(!empty($selectedInfants)){

					$this->infants = $selectedInfants;
				
				}else{

					$this->infants = 0;
				}

				if(!empty($loc)){

					$this->selectedLocation = $loc;
				
				}else{

					$this->selectedLocation = "";
				}

				if(empty($this->date)){
                  
                  $this->date = date($this->appSettings[0]->date_f,strtotime('+'.CHECKIN_SPAN.' day', time()));
               		
               	}

               	$this->guestCount = $this->adults + $this->child + $this->infants;

               	$this->urlVars = "?date=".$this->date."&adults=".$this->adults;
			    
				$this->langdef = DEFLANG;
		}

		function set_tourid($tourslug) {
				$this->db->select('tour_id');
				$this->db->where('tour_slug', $tourslug);
				$r = $this->db->get('pt_tours')->result();
				$this->tourid = $r[0]->tour_id;
		}

        function set_lang($lang){
                 if (empty ($lang)) {
                        $defaultlang = pt_get_default_language(); 
						$this->lang = $defaultlang;
				}
				else {
						$this->lang = $lang;
				}
        }

//set tour id by id
		function set_id($id, $currsign = null, $currcode = null) {
				$this->tourid = $id;
				$this->currencysign = $currsign;
				$this->currencycode = $currcode;
		}

		function get_id() {
				return $this->tourid;
		}

		function settings() {
				return $this->ci->settings_model->get_front_settings('tours');
		}

		function wishListInfo($id) {
			   $this->db->select('tour_title,tour_slug,thumbnail_image,tour_location,tour_stars');
			   $this->db->where('tour_id',$id);
			   $result = $this->db->get('pt_tours')->result();
			   $title = $this->get_title($result[0]->tour_title);
			   $slug = "tours/".$result[0]->tour_slug;
			   $thumbnail = PT_TOURS_SLIDER_THUMB.$result[0]->thumbnail_image;
			   $location = pt_LocationsInfo($result[0]->tour_location, $this->lang);

			   $stars = pt_create_stars($result[0]->tour_stars);
			   $res = array(
			   	"title" => $title, 
			   	"slug" => $slug,
			   	"thumbnail" => $thumbnail,
			   	"location" => $location->city,
			   	"stars" => $stars,

			   	);
			   return $res;
		
		}

		function selectedTourType($id){
			$option = "";
			if(!empty($id)){
			
			$res = $this->tourTypeSettings($id);
			if(!empty($res->name)){
			$option = "<option value=".$res->id." selected >".$res->name."</option>";	
			}
			
			
			}
			
			return $option;

		}

		function show_tours($offset = null) {
				$this->ci->load->library('bootpagination');
				$data = array();
				$settings = $this->settings();
				$perpage = $settings[0]->front_listings;
				$sortby = $this->ci->input->get('sortby');
				if (!empty ($sortby)) {
						$orderby = $sortby;
				}
				else {
						$orderby = $settings[0]->front_listings_order;
				}
				$priceRange = $this->priceRange($this->ci->input->get('price'));
				$rh = $this->ci->tours_model->list_tours_front($priceRange);
				$tours = $this->ci->tours_model->list_tours_front($priceRange,$perpage, $offset, $orderby);
                $data['all_tours'] = $this->getResultObject($tours['all']);
                $data['paginationinfo'] = array('base' => 'tours/listing', 'totalrows' => $rh['rows'], 'perpage' => $perpage);
				$data['plinks2'] = $this->ci->bootpagination->dopagination2('tours/listing', $rh['rows'], $perpage);
				return $data;
			
             
		}

		function search_tours($location, $offset = null) {
				$data = array();
				$settings = $this->settings();
				$perpage = $settings[0]->front_search;
				$orderby = $settings[0]->front_search_order;
				$totalSegments = $this->ci->uri->total_segments();
				if($totalSegments < 5){
					$location = "";
					$urisegment = 3;
				}else{
					$urisegment = 6;
				}

				$priceRange = $this->priceRange($this->ci->input->get('price'));
				$rh = $this->ci->tours_model->search_tours_front($location,$priceRange);
				$tours = $this->ci->tours_model->search_tours_front($location,$priceRange,$perpage, $offset, $orderby);

				$data['all_tours'] = $this->getResultObject($tours['all']);
				$data['paginationinfo'] = array('base' => 'tours/search', 'totalrows' => $rh['rows'], 'perpage' => $perpage, 'urisegment' => $urisegment);
				
				return $data;
		}

	

		function tour_details($tourid = null, $date = null){
			if(empty($tourid)){
				$tourid = $this->tourid;
			}else{
				$tourid = $tourid;
			}
		$this->ci->load->library('currconverter');
        $curr = $this->ci->currconverter;

        if(!empty($date)){
        	$this->date = $date;
        }

			
				$this->db->where('tour_id', $tourid);
				$details = $this->db->get('pt_tours')->result();
     			$title = $this->get_title($details[0]->tour_title,$details[0]->tour_id);
				$slug = $details[0]->tour_slug.$this->urlVars;
				$stars = $details[0]->tour_stars;
				$desc = $this->get_description($details[0]->tour_desc,$details[0]->tour_id);
				$policy = $this->get_policy($details[0]->tour_privacy,$details[0]->tour_id);

				$keywords = $this->get_keywords($details[0]->tour_meta_keywords,$details[0]->tour_id);
				$metadesc = $this->get_metaDesc($details[0]->tour_meta_desc,$details[0]->tour_id);
				$tourDays = $details[0]->tour_days;
				$tourNights = $details[0]->tour_nights;

				if(!empty($details[0]->tour_amenities)){
				
				  $tourAmenities = explode(",",$details[0]->tour_amenities);

                foreach($tourAmenities as $tm){
                 $amts[] = $this->tourTypeSettings($tm);
                }

				}else{

				$amts = array();
				
				}
              

                $inclusions = $amts;

                if(!empty($details[0]->tour_exclusions)){
				
				  $tourExclusions = explode(",",$details[0]->tour_exclusions);

                foreach($tourExclusions as $exc){
                 $excs[] = $this->tourTypeSettings($exc);
                }

				}else{

				$excs = array();
				
				}
              

                $exclusions = $excs;

                if(!empty($details[0]->tour_payment_opt)){
                	$tourPaymentOpts = explode(",",$details[0]->tour_payment_opt);
                foreach($tourPaymentOpts as $p){
                 $payopts[] = $this->tourTypeSettings($p);
                }
                }else{
                	$payopts = array();
                }
                
                $paymentOptions = $payopts;
                
                if(!empty($details[0]->tour_related)){
                
                $rtours = explode(",",$details[0]->tour_related);	
           		
           		}else{
            	
            	$rtours = "";
            	
            	}
                
                $relatedTours = $this->getRelatedTours($rtours);

				$thumbnail = PT_TOURS_SLIDER_THUMB.$details[0]->thumbnail_image;

				$city = pt_LocationsInfo($details[0]->tour_location, $this->lang);

				$location = $city->city; // $details[0]->tour_location;
			   //	$isfeatured = $this->is_featured();
				$website = $details[0]->tour_website;
                $phone = $details[0]->tour_phone;
                $email = $details[0]->tour_email;
				$taxcom = $this->tour_tax_commision();
				$comm_type = $taxcom['commtype'];
				$comm_value = $taxcom['commval'];
				$tax_type = $taxcom['taxtype'];
				$tax_value = $taxcom['taxval'];
                $latitude = $details[0]->tour_latitude;
                $longitude = $details[0]->tour_longitude;

                $totalAdutlsPrice = $details[0]->tour_adult_price * $this->adults;
                $totalChildPrice = $details[0]->tour_child_price * $this->child;
                $totalInfantsPrice = $details[0]->tour_infant_price * $this->infants;

                $adultPrice = $curr->convertPrice($totalAdutlsPrice,0);
                $childPrice = $curr->convertPrice($totalChildPrice,0);
                $infantPrice = $curr->convertPrice($totalInfantsPrice,0);

                $perAdultPrice = $curr->convertPrice($details[0]->tour_adult_price,0);
                $perChildPrice = $curr->convertPrice($details[0]->tour_child_price,0);
                $perInfantPrice = $curr->convertPrice($details[0]->tour_infant_price,0);

                $maxAdults = $details[0]->tour_max_adults;
                $maxChild = $details[0]->tour_max_child;
                $maxInfant = $details[0]->tour_max_infant;

                $this->checkErrors($maxAdults, $maxChild, $maxInfant);

                $adultStatus = $details[0]->adult_status;
                $childStatus = $details[0]->child_status;
                $infantStatus = $details[0]->infant_status;

                $sliderImages = $this->tourImages($details[0]->tour_id);

                $totalCost = $totalAdutlsPrice + $totalChildPrice + $totalInfantsPrice;

                $taxcom = $this->tour_tax_commision($details[0]->tour_id);
				$this->comm_type = $taxcom['commtype'];
				$this->comm_value = $taxcom['commval'];

				$this->tax_type = $taxcom['taxtype'];
				$this->tax_value = $taxcom['taxval'];

				$this->setDeposit($curr->convertPriceFloat($totalCost, 0));
				$depositAmount = $this->deposit;



                $detailResults = (object)array('id' => $details[0]->tour_id, 'title' => $title, 'slug' => $slug,'thumbnail' => $thumbnail,
           		 'stars' => pt_create_stars($stars), 'starsCount' => $stars, 'location' => $location,'desc' => $desc,'inclusions' => $inclusions,'exclusions' => $exclusions,
           		 'latitude' => $latitude,'longitude' => $longitude,'sliderImages' => $sliderImages,'relatedTours' => $relatedTours,'paymentOptions' => $paymentOptions,
          		  'metadesc' => $metadesc,'keywords' => $keywords,'policy' => $policy,'website' => $website,'email' => $email,'phone' => $phone,'maxAdults' => $maxAdults, 'maxChild' => $maxChild,
          		  'maxInfant' => $maxInfant,'adultStatus' => $adultStatus,'childStatus' => $childStatus,'infantStatus' => $infantStatus,'adultPrice' => $adultPrice,'childPrice' => $childPrice,'infantPrice' => $infantPrice,
          		  'perAdultPrice' => $perAdultPrice,'perChildPrice' => $perChildPrice,'perInfantPrice' => $perInfantPrice,'currCode' => $curr->code,'currSymbol' => $curr->symbol,'date' => $this->date,'totalCost' => $curr->convertPrice($totalCost,0),
          		  'comType' => $comm_type, 'comValue' => $comm_value, 'taxType' => $tax_type, 'taxValue' => $tax_value,'tourDays' => $tourDays,
                  'tourNights' => $tourNights,'totalDeposit' => $depositAmount);

                return $detailResults;
				
		}

		function tour_short_details($tourid) {
			if(empty($tourid)){
				$tourid = $this->tourid;
			}

				$this->db->select('tour_title,tour_stars,tour_slug,tour_desc,tour_privacy,tour_max_adults,tour_max_child,
   tour_max_infant,tour_basic_price,tour_basic_discount,tour_adult_price,tour_child_price,tour_infant_price,tour_amenities,tour_exclusions,tour_days,tour_nights,thumbnail_image,tour_location,tour_latitude,tour_longitude,tour_type');
				$this->db->where('tour_id', $tourid);
				$details = $this->db->get('pt_tours')->result();
				$this->slug = $details[0]->tour_slug.$this->urlVars;
				$this->stars = $details[0]->tour_stars;
				$this->title = $this->get_title($details[0]->tour_title);
				$this->desc = $this->get_description($details[0]->tour_desc);
				$this->policy = $this->get_policy($details[0]->tour_privacy);
				$this->tourDays = $details[0]->tour_days;
				$this->tourNights = $details[0]->tour_nights;

                $maxAdults = $details[0]->tour_max_adults;
                $maxChild = $details[0]->tour_max_child;
                $maxInfant = $details[0]->tour_max_infant;

                $this->checkErrors($maxAdults, $maxChild, $maxInfant);

				$city = pt_LocationsInfo($details[0]->tour_location, $this->lang);

				$this->location = $city->city;//$details[0]->tour_location;
				$this->latitude = $details[0]->tour_latitude;
				$this->longitude = $details[0]->tour_longitude;
				$this->thumbnail = PT_TOURS_SLIDER_THUMB.$details[0]->thumbnail_image;
				$type = $this->tourTypeSettings($details[0]->tour_type);
				$this->tourType = $type->name;

				$taxcom = $this->tour_tax_commision();
				$this->comm_type = $taxcom['commtype'];
				$this->comm_value = $taxcom['commval'];

				$this->tax_type = $taxcom['taxtype'];
				$this->tax_value = $taxcom['taxval'];

                $this->adultPrice = $details[0]->tour_adult_price;
                $this->childPrice = $details[0]->tour_child_price;
                $this->infantPrice = $details[0]->tour_infant_price;
				
				$this->isfeatured = $this->is_featured();
				
				return $details;

		}

		function tour_tax_commision($tourid = null) {
			if(empty($tourid)){
				$tourid = $this->tourid;
			}

				$res = array();
				$this->db->select('tour_comm_fixed,tour_comm_percentage,tour_tax_fixed,tour_tax_percentage');
				$this->db->where('tour_id', $tourid);
				$result = $this->db->get('pt_tours')->result();
				$commfixed = $result[0]->tour_comm_fixed;
				$commper = $result[0]->tour_comm_percentage;
				$taxfixed = $result[0]->tour_tax_fixed;
				$taxper = $result[0]->tour_tax_percentage;
				$res['commtype'] = "percentage";
				$res['commval'] = $commper;
				$res['taxtype'] = "percentage";
				$res['taxval'] = $taxper;
				if ($commfixed > 0) {
						$res['commtype'] = "fixed";
						$res['commval'] = $commfixed;
				}
				if ($taxfixed > 0) {
						$res['taxtype'] = "fixed";
						$res['taxval'] = $taxfixed;
				}
				return $res;
		}

		// get tour images
		function tourImages($tourid){
		  if(empty($tourid)){
		    $tourid = $this->tourid;
		  }
			  	$this->db->where('timg_tour_id', $tourid);
			  	$this->db->where('timg_approved', '1');
				$this->db->order_by('timg_order', 'asc');
				$res = $this->db->get('pt_tour_images')->result();
				if(empty($res)){

					$result[] = array("fullImage" => PT_TOURS_SLIDER_THUMB.PT_BLANK_IMG,"thumbImage" => PT_TOURS_SLIDER_THUMB.PT_BLANK_IMG);
                
				}else{

				foreach($res as $r){
                  $result[] = array("fullImage" => PT_TOURS_SLIDER.$r->timg_image,"thumbImage" => PT_TOURS_SLIDER_THUMB.$r->timg_image);
                }
                	
				}
                
                return $result;
		}

		function getFeaturedTours(){
          $tours = $this->featured_tours_list();
          $result = $this->getResultObject($tours);
          return $result;
        }

          function getTopRatedTours(){
          $tours = $this->ci->tours_model->popular_tours_front();
          $result = $this->getResultObject($tours);
          return $result;
        }

		 function getRelatedTours($tours){
       $resulttours = array();
       $result = array();
       if(!empty($tours)){
       	foreach($tours as $t){
            $resulttours[] = (object)array('tour_id' => $t);
       		   }
         
       }
        $result = $this->getLimitedResultObject($resulttours);
        	

        return $result;
        
        }

   // Get Tour updated Price on changing adults, child and infant count.

function updatedPrice($tourid, $adults = 1, $child = 0, $infant = 0){

		$this->ci->load->library('currconverter');
        $curr = $this->ci->currconverter;

			
				$this->db->select('tour_adult_price,tour_child_price,tour_infant_price');
				$this->db->where('tour_id', $tourid);
				$details = $this->db->get('pt_tours')->result();
     			
     			$totalAdutlsPrice = $details[0]->tour_adult_price * $adults;
                $totalChildPrice = $details[0]->tour_child_price * $child;
                $totalInfantsPrice = $details[0]->tour_infant_price * $infant;

                $adultPrice = $curr->convertPrice($totalAdutlsPrice,0);
                $childPrice = $curr->convertPrice($totalChildPrice,0);
                $infantPrice = $curr->convertPrice($totalInfantsPrice,0);

                $totalCost = $totalAdutlsPrice + $totalChildPrice + $totalInfantsPrice;
                $taxcom = $this->tour_tax_commision($tourid);
				$this->comm_type = $taxcom['commtype'];
				$this->comm_value = $taxcom['commval'];

				$this->tax_type = $taxcom['taxtype'];
				$this->tax_value = $taxcom['taxval'];

                $this->setDeposit($totalCost);
			
				$depositAmount = $this->deposit;

                if(!empty($curr->symbol)){
                	$currSymbol = $curr->symbol;
                }else{
        			$currSymbol = "";        	
                }
                

                $detailResults = array('id' => $tourid, 'adultPrice' => $adultPrice,'childPrice' => $childPrice,'infantPrice' => $infantPrice,
          		  'currCode' => $curr->code,'currSymbol' => $currSymbol,'totalDeposit' => $curr->convertPrice($depositAmount,0),'totalCost' => $curr->convertPrice($totalCost,0));

                return json_encode($detailResults);
				
		}

		function get_thumbnail() {
				$res = $this->ci->tours_model->default_tour_img($this->tourid);
				if (!empty ($res)) {
						return PT_TOURS_SLIDER_THUMB . $res;
				}
				else {
						return PT_BLANK;
				}
		}

		function get_title($deftitle,$tourid) {
	   	if(empty($tourid)){
            $tourid = $this->tourid;
		  }
				if ($this->lang == $this->langdef) {
						$title = $deftitle;
				}
				else {
						$this->db->where('item_id', $tourid);
						$this->db->where('trans_lang', $this->lang);
						$res = $this->db->get('pt_tours_translation')->result();
						$title = $res[0]->trans_title;
						if (empty ($title)) {
								$title = $deftitle;
						}
				}
				return $title;
		}

		function get_description($defdesc,$tourid) {
		 if(empty($tourid)){
            $tourid = $this->tourid;
		  }
				if ($this->lang == $this->langdef) {
						$desc = $defdesc;
				}
				else {
						$this->db->where('item_id', $tourid);
						$this->db->where('trans_lang', $this->lang);
						$res = $this->db->get('pt_tours_translation')->result();
						$desc = $res[0]->trans_desc;
						if (empty ($desc)) {
								$desc = $defdesc;
						}
				}
				return $desc;
		}

		function get_policy($defpolicy,$tourid) {

		  if(empty($tourid)){
            $tourid = $this->tourid;
		  }
				if ($this->lang == $this->langdef) {
						$policy = $defpolicy;
				}
				else {
						$this->db->where('item_id', $tourid);
						$this->db->where('trans_lang', $this->lang);
						$res = $this->db->get('pt_tours_translation')->result();
						$policy = $res[0]->trans_policy;
						if (empty ($policy)) {
								$policy = $defpolicy;
						}
				}
				return $policy;
		}

		function get_keywords($defkeywords,$tourid = null) {
		   if(empty($tourid)){
            $tourid = $this->tourid;
		  }
				if ($this->lang == $this->langdef) {
						$keywords = $defkeywords;
				}
				else {
						$this->db->where('item_id', $tourid);
						$this->db->where('trans_lang', $this->lang);
						$res = $this->db->get('pt_tours_translation')->result();
						$keywords = $res[0]->metakeywords;
						if (empty ($keywords)) {
								$keywords = $defkeywords;
						}
				}
				return $keywords;
		}

        function get_metaDesc($defmeta,$tourid = null) {
		   if(empty($tourid)){
            $tourid = $this->tourid;
		  }
				if ($this->lang == $this->langdef) {
						$meta = $defmeta;
				}
				else {
						$this->db->where('item_id', $tourid);
						$this->db->where('trans_lang', $this->lang);
						$res = $this->db->get('pt_tours_translation')->result();
						$meta = $res[0]->metadesc;
						if (empty ($meta)) {
								$meta = $defmeta;
						}
				}
				return $meta;
		}

		function tourExtras($tourid = null) {
		   if(empty($tourid)){
            $tourid = $this->tourid;
		  }
				$today = time();
                $result = array();
		   //	$this->db->where('extras_from  <=', $today);
			//	$this->db->where('extras_to >=', $today);
				$this->db->where('extras_module', 'tours');
//  $this->db->or_where('extras_forever','forever');
				$this->db->order_by('extras_id', 'desc');
				$this->db->like('extras_for', $tourid, 'both');
				$this->db->having('extras_status', 'Yes');
				$ext = $this->db->get('pt_extras')->result();
				$this->ci->load->library('currconverter');
                $curr = $this->ci->currconverter;
                if(!empty($ext)){
                foreach($ext as $e){
                  $trans = $this->extrasTranslation($e->extras_id,$e->extras_title,$e->extras_desc);
                  $price = $curr->convertPrice($e->extras_basic_price,0);
                  $result[] = (object)array("id" => $e->extras_id,"extraTitle" => $trans['title'],"extraDesc" => $trans['desc'],'extraPrice' => $price,'thumbnail' => PT_TOURS_EXTRAS_IMAGES.$e->extras_image);
                }

                }

                return $result;

		}

		function getLocationsList(){

			$resultLocations = array();
			$this->db->select('location_id');
			$this->db->group_by('location_id');
			$locations = $this->db->get('pt_tour_locations')->result();
			foreach($locations as $loc){
				$locInfo = pt_LocationsInfo($loc->location_id, $this->lang);
				if(!empty($locInfo->city)){
				$resultLocations[] = (object)array('id' => $locInfo->id,'name' => $locInfo->city);	
				}
				

			}
			return $resultLocations;

		}

		


		function extras_translation($id) {
				$language = $this->lang;
				$result = array();
				$this->db->select('extras_title,extras_desc');
				$this->db->where('extras_id', $id);
				$re = $this->db->get('pt_extras')->result();
				if ($language == $this->langdef) {
						$result['title'] = $re[0]->extras_title;
						$result['desc'] = $re[0]->extras_desc;
				}
				else {
						$this->db->select('trans_title,trans_desc');
						$this->db->where('trans_extras_id', $id);
						$this->db->where('trans_lang', $language);
						$r = $this->db->get('pt_extras_translation')->result();
						if (empty ($r[0]->trans_title)) {
								$result['title'] = $re[0]->extras_title;
						}
						else {
								$result['title'] = $r[0]->trans_title;
						}
						if (empty ($r[0]->trans_desc)) {
								$result['desc'] = $re[0]->extras_desc;
						}
						else {
								$result['desc'] = $r[0]->trans_desc;
						}
				}
				return $result;
		}

// tour Reviews
		function tour_reviews($tourid) {
			if(empty($tourid)){
				$tourid = $this->tourid;
			}
				$this->db->where('review_status', 'Yes');
				$this->db->where('review_module', 'tours');
				$this->db->where('review_itemid', $tourid);
				$this->db->order_by('review_id', 'desc');
				return $this->db->get('pt_reviews')->result();
		}

		// tour Reviews for API
		function tour_reviews_for_api($tourid) {
			if(empty($tourid)){
                  $tourid = $this->tourid;
                }
				$result = array();
				$this->db->select('review_overall as rating,review_name as review_by,review_comment,review_date');
				$this->db->where('review_status', 'Yes');
				$this->db->where('review_module', 'tours');
				$this->db->where('review_itemid', $tourid);
				$this->db->order_by('review_id', 'desc');
				$rs = $this->db->get('pt_reviews')->result();
				foreach ($rs as $r) {
						$result[] = array("rating" => $r->rating, "review_by" => $r->review_by, "review_comment" => $r->review_comment, "review_date" => pt_show_date_php($r->review_date));
				}
				return $result;
		}

// tour  Reviews Averages
		function tourReviewsAvg($tourid) {
                if(empty($tourid)){
                  $tourid = $this->tourid;
                }
				$this->db->select("COUNT(*) AS totalreviews");
				$this->db->select_avg('review_overall', 'overall');
				$this->db->select_avg('review_clean', 'clean');
				$this->db->select_avg('review_facilities', 'facilities');
				$this->db->select_avg('review_staff', 'staff');
				$this->db->select_avg('review_comfort', 'comfort');
				$this->db->select_avg('review_location', 'location');
				$this->db->where('review_status', 'Yes');
				$this->db->where('review_module', 'tours');
				$this->db->where('review_itemid', $tourid);
				$res = $this->db->get('pt_reviews')->result();
                $clean = round($res[0]->clean, 1);
                $comfort = round($res[0]->comfort, 1);
                $location = round($res[0]->location, 1);
                $facilities = round($res[0]->facilities, 1);
                $staff = round($res[0]->staff, 1);
                $totalreviews = $res[0]->totalreviews;
                $overall = round($res[0]->overall,1);
                $result = (object)array('clean' => $clean,'comfort' => $comfort,'location' => $location,'facilities' => $facilities,'staff' => $staff,'totalReviews' => $totalreviews,'overall' => $overall );
                return $result;
		}

// Tour visiting Cities
		function tour_visiting_cities() {
				$this->db->select('map_city_name');
				$this->db->where('map_city_type', 'visit');
				$this->db->where('map_tour_id', $this->tourid);
				return $this->db->get('pt_tours_maps')->result();
		}

	

		function translated_data($lang) {
				$this->db->where('item_id', $this->tourid);
				$this->db->where('trans_lang', $lang);
				return $this->db->get('pt_tours_translation')->result();
		}

		function is_featured() {
				$this->db->select('tour_id');
				$this->db->where('tour_is_featured', 'yes');
				$this->db->where('tour_featured_from <', time());
				$this->db->where('tour_featured_to >', time());
				$this->db->where('tour_id', $this->tourid);
				return $this->db->get('pt_tours')->num_rows();
		}

		function featured_tours_list() {
				$settings = $this->settings();
				$limit = $settings[0]->front_homepage;
				$orderby = $settings[0]->front_homepage_order;
				$this->db->select('tour_id,tour_order,tour_title,tour_status');
				$this->db->where('tour_is_featured', 'yes');
			 	$this->db->where('tour_featured_from <', time());
			 	$this->db->where('tour_featured_to >', time());
				$this->db->or_where('tour_featured_forever', 'forever');
				$this->db->having('tour_status', 'Yes');
				$this->db->limit($limit);
				if ($orderby == "za") {
						$this->db->order_by('pt_tours.tour_title', 'desc');
				}
				elseif ($orderby == "az") {
						$this->db->order_by('pt_tours.tour_title', 'asc');
				}
				elseif ($orderby == "oldf") {
						$this->db->order_by('pt_tours.tour_id', 'asc');
				}
				elseif ($orderby == "newf") {
						$this->db->order_by('pt_tours.tour_id', 'desc');
				}
				elseif ($orderby == "ol") {
						$this->db->order_by('pt_tours.tour_order', 'asc');
				}
				return $this->db->get('pt_tours')->result();
		}

		// tour Reviews
		function tourReviews($tourid = null) {
				if(empty($tourid)){
                  $tourid = $this->tourid;
                }
				$this->db->where('review_status', 'Yes');
				$this->db->where('review_module', 'tours');
				$this->db->where('review_itemid', $tourid);
				$this->db->order_by('review_id', 'desc');
				return $this->db->get('pt_reviews')->result();
		}

		function extrasTranslation($id,$title,$desc) {
						$language = $this->lang;
						$this->db->select('trans_title,trans_desc');
						$this->db->where('trans_extras_id', $id);
						$this->db->where('trans_lang', $language);
						$r = $this->db->get('pt_extras_translation')->result();
						if (empty ($r[0]->trans_title)) {
								$result['title'] = $title;

						}
						else {
								$result['title'] = $r[0]->trans_title;
						}
						if (empty ($r[0]->trans_desc)) {
								$result['desc'] = $desc;
						}
						else {
								$result['desc'] = $r[0]->trans_desc;
						}

				return $result;
		}

	
		

		function tourTypes(){

			$tourtypes = array();

			$this->db->select('sett_name,sett_id');
			$this->db->where('sett_type', 'ttypes');
			$types = $this->db->get('pt_tours_types_settings')->result();

			foreach($types as $t){
				$tname = $this->tourTypeSettings($t->sett_id);
				$tourtypes[] = (object)array( 'id' => $t->sett_id, 'name' => $tname->name);

			}

			return $tourtypes;


		}

		// Tour Type
         function tourTypeSettings($id){
				$language = $this->lang;
                $result = new stdClass;

				$this->db->select('sett_name,sett_img');
				$this->db->where('sett_id', $id);
				$this->db->where('sett_status', 'Yes');
				$re = $this->db->get('pt_tours_types_settings')->result();
               	$result->icon = PT_TOURS_ICONS.$re[0]->sett_img;
               	$result->id = $id;
				if ($language == $this->langdef) {
							$result->name = $re[0]->sett_name;
			 }else {
						$this->db->select('trans_name');
						$this->db->where('sett_id', $id);
						$this->db->where('trans_lang', $language);
						$r = $this->db->get('pt_tours_types_settings_translation')->result();
						if (empty ($r[0]->trans_name)) {
									$result->name = $re[0]->sett_name;
						}
						else {
								$result->name = $r[0]->trans_name;
						}

				}

				return $result;
		}

		//Populate Tour Types according to the location selected

		function getTourTypesLocationBased($location){
		
			$result = new stdClass;
			$result->hasResult = FALSE;
			$result->optionsList = "";
			$tourTypes = array();
			$tourIDs = array();

			$this->db->where('location_id',$location);
			$this->db->group_by('tour_id');
			$tours = $this->db->get('pt_tour_locations')->result();

			if(!empty($tours)){
				foreach($tours as $t){
					$tourIDs[] = $t->tour_id;
				}
			}
		


			$this->db->select('tour_type');
			//$this->db->where('tour_location',$location);
			if(!empty($tourIDs)){
			$this->db->where_in('tour_id',$tourIDs);	
		}else{
			$this->db->where('tour_id','0');
		}
			
			$this->db->group_by('tour_type');
			$res = $this->db->get('pt_tours')->result();
			if(!empty($res)){
				foreach($res as $r){
					$tourTypes[] = $r->tour_type;
				}
				$result->hasResult = TRUE;
				foreach($tourTypes as $type){
					$typeDetails = $this->tourTypeSettings($type);
					$result->optionsList .= "<option value='".$typeDetails->id."' selected>".$typeDetails->name."</option>";	
					$result->types[] = array("id" => $typeDetails->id, "name" => $typeDetails->name);
				}

			}else{
				$result->hasResult = FALSE;
				$result->optionsList = "<option value='' selected> Select </option>";

			}
			return $result;
		}

		function tourLocations($id = null){
			$result = new stdClass;

			if(empty($id)){
				$id = $this->tourid;
			}

			$this->db->where('tour_id',$id);
			$locs = $this->db->get('pt_tour_locations')->result();

			foreach($locs as $l){

				$locInfo = pt_LocationsInfo($l->location_id, $this->lang);

				if(!empty($locInfo->city)){
				$result->locations[] = (object)array('id' => $locInfo->id,'name' => $locInfo->city, 'lat' => $locInfo->latitude, 'long' => $locInfo->longitude);	
				}
			
			}

			return $result;



		}


		 //make a result object all data of tours array
         function getResultObject($tours){
          $this->ci->load->library('currconverter');
          $result = array();
          $curr = $this->ci->currconverter;

          foreach($tours as $t){
            $this->set_id($t->tour_id);
           	$this->tour_short_details();
             $adultprice = $this->adultPrice * $this->adults;
             $childprice = $this->childPrice;
             $infantprice = $this->infantPrice;

            $price = $curr->convertPrice($adultprice,0);
            $avgReviews = $this->tourReviewsAvg();
            $result[] = (object)array('id' => $this->tourid, 'title' => $this->title, 'slug' => base_url().'tours/'.$this->slug,'thumbnail' => $this->thumbnail,
            'stars' => pt_create_stars($this->stars),'starsCount' => $this->stars, 'location' => $this->location,'desc' => strip_tags($this->desc),
            'price' => $price,'currCode' => $curr->code,'currSymbol' => $curr->symbol,'inclusions' => $this->inclusions,
            'avgReviews' => $avgReviews, 'latitude' => $this->latitude,'longitude' => $this->longitude,'tourDays' => $this->tourDays, 'tourNights' => $this->tourNights,'tourType' => $this->tourType);
            }

            $this->currencycode = $curr->code;
            $this->currencysign = $curr->symbol;
            return $result;
        }

         //make a result object limited data of tours array
         function getLimitedResultObject($tours){
          $this->ci->load->library('currconverter');
          $result = array();
          $curr = $this->ci->currconverter;
          if(!empty($tours)){
          	foreach($tours as $t){
            $this->set_id($t->tour_id);
           	$this->tour_short_details();
			$adultprice = $this->adultPrice * $this->adults;
			$childprice = $this->childPrice;
			$infantprice = $this->infantPrice;
			$avgReviews = $this->tourReviewsAvg();

			$price = $curr->convertPrice($adultprice,0);
        
            if(!empty($this->title)){
            	
            	$result[] = (object)array('id' => $this->tourid, 'title' => $this->title, 'slug' => base_url().'tours/'.$this->slug,'thumbnail' => $this->thumbnail,
            'stars' => pt_create_stars($this->stars), 'location' => $this->location,'price' => $price,'currCode' => $curr->code,'currSymbol' => $curr->symbol,'latitude' => $this->latitude, 'longitude' => $this->longitude,'avgReviews' => $avgReviews,);
            }
            
            }
          }
          
            return $result;
        }


         //make a result object of booking info
         function getBookResultObject($tourid,$date = null, $adults = null, $child = null, $infants = null){
			if(empty($date)){
				$date = $this->date;
			}

	
			$extrasCheckUrl = base_url().'tours/tourajaxcalls/tourExtrasBooking';
			$this->ci->load->library('currconverter');
			$result = array();
			$curr = $this->ci->currconverter;

			//tour details for booking page
            $this->set_id($tourid);
           	$this->tour_short_details();
            $extras = $this->tourExtras();

            if(empty($adults)){
            	$adults = $this->adults;

            }

            if(empty($child)){
            	$child = $this->child;

            }

            if(empty($infants)){
            	$infants = $this->infants;

            }

			$adultPrice = $this->adultPrice * $adults;
			$childPrice = $this->childPrice * $child;
			$infantPrice = $this->infantPrice * $infants;

            $totalSum = $adultPrice + $childPrice + $infantPrice;
            $subTotal = $curr->convertPriceFloat($adultPrice,0) + $curr->convertPriceFloat($childPrice,0) + $curr->convertPriceFloat($infantPrice,0);
           // $subTotal = $childPrice;

			$this->setTax($subTotal);
			$taxAmount = $curr->addComma($this->taxamount,0);
			$totalPrice = $subTotal + $this->taxamount;

			$price = $curr->addComma($totalPrice,0);

			$this->setDeposit($totalPrice);
			
			$depositAmount = $curr->addComma($this->deposit,0);

       
            $result["tour"] = (object)array('id' => $this->tourid, 'title' => $this->title, 'slug' => base_url().'tours/'.$this->slug,'thumbnail' => $this->thumbnail,
            'stars' => pt_create_stars($this->stars),'starsCount' => $this->stars, 'location' => $this->location,'date' => $date,
            'metadesc' => $this->metadesc,'keywords' => $this->keywords,'extras' => $extras,'taxAmount' => $taxAmount,'depositAmount' => $depositAmount,
            'policy' => $this->policy,'extraChkUrl' => $extrasCheckUrl,'adults' => $adults,'children' => $child,'infants' => $infants,'tourDays' => $this->tourDays,
            'tourNights' => $this->tourNights,'currCode' => $curr->code,'currSymbol' => $curr->symbol,'price' => $price,
            'adultprice' => $curr->convertPrice($adultPrice,0), 'childprice' => $curr->convertPrice($childPrice,0),'infantprice' => $curr->convertPrice($infantPrice,0),'subTotal' => $subTotal);

        //end tour details for booking page
          return $result;

        }

          function setDeposit($total){
          if($this->comm_type == "fixed"){
                $this->deposit = $this->comm_value;
                }else{
                 $this->deposit = round(($total * $this->comm_value)/100,2);
                }
        }

        function setTax($amount){
          if($this->tax_type == "fixed"){
                $this->taxamount = $this->tax_value;
                }else{
                 $this->taxamount = round(($amount * $this->tax_value)/100,2);
                }
        }


        function extrasFee($exts){
          $extFee = 0;
          $this->ci->load->library('currconverter');
          $curr = $this->ci->currconverter;
          foreach($exts as $ext){
             $this->db->select('extras_title,extras_desc,extras_discount,extras_basic_price');
             $this->db->where('extras_id',$ext);
             $rs = $this->db->get('pt_extras')->result();
             $amount = $rs[0]->extras_basic_price;
             $price = $curr->convertPriceFloat($amount,0);
             $extFee += $amount;
             $info = $this->extrasTranslation($ext,$rs[0]->extras_title,$rs[0]->extras_desc);

             $result['extrasIndividualFee'][] = array("id" => $ext, "price" => $price);
             $result['extrasInfo'][] = array("title" => $info['title'], "price" => $price);
          }
          $result['extrasTotalFee'] = $extFee;

          return $result;

        }


        //get updated values of booking data after extras and payment method updates
         function getUpdatedDataBookResultObject($tourid,$adults = 1,$child = 0,$infant = 0,$extras){
          $this->ci->load->library('currconverter');
          $result = array();
          $curr = $this->ci->currconverter;

          $extratotal = $this->extrasFee($extras);
          $extTotal =  $extratotal['extrasTotalFee'];
          $paymethodTotal = 0; //$this->paymethodFee($this->ci->input->post('paymethod'),$total);

          $this->set_id($tourid);
          $this->tour_short_details();

          $adultPrice = $this->adultPrice * $adults;
		  $childPrice = $this->childPrice * $child;
		  $infantPrice = $this->infantPrice * $infant;

          $totalSum = $adultPrice + $childPrice + $infantPrice;
          $total = $curr->convertPriceFloat($extTotal,0) + $curr->convertPriceFloat($adultPrice,0) + $curr->convertPriceFloat($childPrice,0) + $curr->convertPriceFloat($infantPrice,0);

          $this->setTax($total);
         
          $taxAmount = $curr->addComma($this->taxamount,0);
          $grandTotal = $total + $paymethodTotal + $this->taxamount;	
          $this->setDeposit($grandTotal);

          $depositAmount = $this->deposit;

          
          $price = $grandTotal;
          //$perNight = $curr->convertPrice($roomprice['perNight'],0);
          $extrasHtml = "";
          foreach($extratotal['extrasInfo'] as $einfo){
          	$extrasHtml .= "<tr class='allextras'><td>".$einfo['title']."</td>
          					<td class='text-right'>".$curr->code." ".$curr->symbol.$curr->addComma($einfo['price'], 0)."</td></tr>";
          }

          $adultsSubitem = array("price" => $curr->convertPriceFloat($this->adultPrice), "count" => $adults);
          if($child > 0){ $childSubitem = array("price" => $curr->convertPriceFloat($this->childPrice), "count" => $child); }else{ $childSubitem = ""; }
          if($infant > 0){ $infantSubitem = array("price" => $curr->convertPriceFloat($this->infantPrice), "count" => $infant); }else{ $infantSubitem = ""; }
          $subitem = array("adults" => $adultsSubitem, "child" => $childSubitem,"infant" => $infantSubitem);
            
          $result = (object)array('grandTotal' => $price,'taxAmount' => $taxAmount, 
            	'depositAmount' => $depositAmount,'extrashtml' => $extrasHtml,
            	'bookingType' => "tours",'currCode' => $curr->code, 'stay' => 1,
            	'currSymbol' => $curr->symbol,'subitem' => $subitem,'extrasInfo' => $extratotal);

          //end tour details for booking page
          return json_encode($result);

        }

        public function checkErrors($maxAdults,$maxChild,$maxInfant ){

            if($maxAdults < $this->adults){
            $this->error = true;
            $this->errorCode = "0455";
            }elseif($maxChild < $this->child){
            $this->error = true;
            $this->errorCode = "0456";
            }elseif($maxInfant < $this->infants){
            $this->error = true;
            $this->errorCode = "0457";
            }
        }

        //convert price
        public function convertAmount($price){

          $this->ci->load->library('currconverter');
          $curr = $this->ci->currconverter;
          return $curr->convertPrice($price,0);

        }

         public function convertPriceRange($price){

			$this->ci->load->library('currconverter');
			$curr = $this->ci->currconverter;
			return $curr->convertPriceRange($price,0);

        }

        public function priceRange($sprice){
        				$result = "";
        				
        				if(!empty($sprice)){

						$sprice = str_replace(";", ",", $sprice);
						$sprice = explode(",", $sprice);

						$minprice = $this->convertPriceRange($sprice[0]);
						$maxprice = $this->convertPriceRange($sprice[1]);
						$result = $minprice."-".$maxprice;
					    }
						

						return $result;

        }

}