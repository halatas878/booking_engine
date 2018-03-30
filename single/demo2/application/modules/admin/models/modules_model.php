<?php

class Modules_model extends CI_Model {

		function __construct() {
// Call the Model constructor
				parent :: __construct();
		}

		function get_all_modules() {
				$this->db->where('module_front !=', '2');
				return $this->db->get('pt_modules')->result();
		}

		function get_all_enabled_modules() {
				$this->db->where('module_status', '1');
				return $this->db->get('pt_modules')->result();
		}

// Get Enabled front end modules
		function get_front_modules() {
				$this->db->where('module_status', '1');
				$this->db->where('module_front', '1');
				$rs = $this->db->get('pt_modules')->result();
				return $rs;
		}

// check availability of module
		function check_module($module) {
				$this->db->where('module_name', $module);
				$this->db->where('module_status', '1');
				$num = $this->db->get('pt_modules')->num_rows();
				if ($num > 0) {
						return true;
				}
				else {
						return false;
				}
		}

		function disable_module($name) {
				$data = array('module_status' => '0');
				$this->db->where('module_name', $name);
				$this->db->update('pt_modules', $data);
				$data2 = array('page_status' => 'No');
				$this->db->where('page_slug', $name);
				$this->db->update('pt_cms', $data2);
		}

		function enable_module($name) {
				$data = array('module_status' => '1');
				$this->db->where('module_name', $name);
				$this->db->update('pt_modules', $data);
				$data2 = array('page_status' => 'Yes');
				$this->db->where('page_slug', $name);
				$this->db->update('pt_cms', $data2);
		}

		function enable_main_module($menutitle) {
				$notallowed = array("tripadvisor");
				$this->db->select("page_id");
				$this->db->where("page_slug", $menutitle);
				$rs = $this->db->get('pt_cms')->result();
				$pageid = $rs[0]->page_id;
				$data1 = array('page_status' => 'Yes');
				$this->db->where("page_slug", $menutitle);
				$this->db->update("pt_cms", $data1);
				if (!in_array($menutitle, $notallowed)) {
						$this->db->where('coltype', 'header');
						$menudetail = $this->db->get('pt_menus')->result();
						$menuitems = json_decode($menudetail[0]->menu_items);
						$p = array();
						$c = array();
						foreach ($menuitems as $mmm) {
								$p[] = $mmm->id;
								if (!empty ($mmm->children)) {
										foreach ($mmm->children as $mc) {
												$c[] = $mc->id;
										}
								}
						}
						$d = array_merge($p, $c);
						if (!in_array($pageid, $d)) {
								$addItem = new stdClass();
								$addItem->id = $pageid;
								$menuitems[] = $addItem;
								$string = json_encode($menuitems);
								$this->menus_model->update_menu($string, $menudetail[0]->menu_id);
						}
				}
		}

		function disable_main_module($menutitle) {
				$this->db->select("page_id");
				$this->db->where("page_slug", $menutitle);
				$rs = $this->db->get('pt_cms')->result();
				$pageid = $rs[0]->page_id;
				$data1 = array('page_status' => 'No');
				$this->db->where("page_slug", $menutitle);
				$this->db->update("pt_cms", $data1);
/*
$this->db->where('coltype','header');
$menudetail = $this->db->get('pt_menus')->result();
$mm = json_decode($menudetail[0]->menu_items);
foreach($mm as $k => $v){
if($v->id == $pageid){
unset($mm[$k]->id);
}
if(!empty($v->children)){

foreach($v->children as $kk => $vv){
if($vv->id == $pageid){
unset($v->children[$kk]->id);
}
}

}

}


$string = json_encode($mm);

$this->menus_model->update_menu($string,$menudetail[0]->menu_id); */
		}

// get modules names
		function get_module_names() {
				$this->load->library('ptmodules');
				$mod1 = $this->ptmodules->moduleslist;
				$mod2 = $this->ptmodules->integratedmoduleslist;
				$mergedmods = array_merge($mod1, $mod2);
				return $mergedmods;
/*   $this->db->select('module_name');
$this->db->where('module_front','1');
$this->db->where('module_status','1');

return $this->db->get('pt_modules')->result();*/
		}

// check availability of main module
		function check_main_module($module) {
				$this->load->library('ptmodules');
				return $this->ptmodules->is_main_module_enabled($module);
		}

//get selected module all items
		function get_module_items_all($module) {
				$rslt;
				if ($module == "hotels") {
						$this->db->select('hotel_id AS id,hotel_title AS title');
						$rslt = $this->db->get('pt_hotels')->result();
				}
				elseif ($module == "tours") {
						$this->db->select('tour_id AS id,tour_title AS title');
						$rslt = $this->db->get('pt_tours')->result();
				}
				elseif ($module == "cruises") {
						$this->db->select('cruise_id AS id,cruise_title AS title');
						$rslt = $this->db->get('pt_cruises')->result();
				}
				return $rslt;
		}

//get selected module all items of a user
		function get_supplier_module_items_all($module, $user) {
				$rslt;
				if ($module == "hotels") {
						$this->db->select('hotel_id AS id,hotel_title AS title');
						$this->db->where('hotel_owned_by', $user);
						$rslt = $this->db->get('pt_hotels')->result();
				}
				elseif ($module == "tours") {
						$this->db->select('tour_id AS id,tour_title AS title');
						$this->db->where('tour_owned_by', $user);
						$rslt = $this->db->get('pt_tours')->result();
				}
				elseif ($module == "cruises") {
						$this->db->select('cruise_id AS id,cruise_title AS title');
						$this->db->where('cruise_owned_by', $user);
						$rslt = $this->db->get('pt_cruises')->result();
				}
				return $rslt;
		}

//get selected module items
		function get_module_items($module) {
				$HTML = "";
				if ($module == "hotels") {
						$this->db->select('hotel_id AS id,hotel_title AS title');
						$this->db->order_by('hotel_id', 'desc');
						$rslt = $this->db->get('pt_hotels')->result();
						foreach ($rslt as $r) {
								$HTML .= "<option value='" . $r->id . "'>" . $r->title . "</option>";
						}
				}
				elseif ($module == "tours") {
						$this->db->select('tour_id AS id,tour_title AS title');
						$this->db->order_by('tour_id', 'desc');
						$rslt = $this->db->get('pt_tours')->result();
						foreach ($rslt as $r) {
								$HTML .= "<option value='" . $r->id . "'>" . $r->title . "</option>";
						}
				}
				elseif ($module == "cruises") {
						$this->db->select('cruise_id AS id,cruise_title AS title');
						$this->db->order_by('cruise_id', 'desc');
						$rslt = $this->db->get('pt_cruises')->result();
						foreach ($rslt as $r) {
								$HTML .= "<option value='" . $r->id . "'>" . $r->title . "</option>";
						}
				}
				return $HTML;
		}

//get selected module items for specific user
		function get_supplier_module_items($module, $id) {
				$HTML = "";
				if ($module == "hotels") {
						$this->db->select('hotel_id AS id,hotel_title AS title');
						$this->db->where('hotel_owned_by', $id);
						$this->db->order_by('hotel_id', 'desc');
						$rslt = $this->db->get('pt_hotels')->result();
						foreach ($rslt as $r) {
								$HTML .= "<option value='" . $r->id . "'>" . $r->title . "</option>";
						}
				}
				elseif ($module == "tours") {
						$this->db->select('tour_id AS id,tour_title AS title');
						$this->db->where('tour_owned_by', $id);
						$this->db->order_by('tour_id', 'desc');
						$rslt = $this->db->get('pt_tours')->result();
						foreach ($rslt as $r) {
								$HTML .= "<option value='" . $r->id . "'>" . $r->title . "</option>";
						}
				}
				elseif ($module == "cruises") {
						$this->db->select('cruise_id AS id,cruise_title AS title');
						$this->db->where('cruise_owned_by', $id);
						$this->db->order_by('cruise_id', 'desc');
						$rslt = $this->db->get('pt_cruises')->result();
						foreach ($rslt as $r) {
								$HTML .= "<option value='" . $r->id . "'>" . $r->title . "</option>";
						}
				}
				return $HTML;
		}

//get details of item of a given module
		function get_for_details($module, $id) {
				if ($module == "hotels") {
						$this->db->select('hotel_id,hotel_title,hotel_slug');
						$this->db->where('hotel_id', $id);
						$this->db->order_by('hotel_id', 'desc');
						$rslt = $this->db->get('pt_hotels')->result();
						$result['id'] = $rslt[0]->hotel_id;
						$result['title'] = $rslt[0]->hotel_title;
						$result['slug'] = "hotels/".$rslt[0]->hotel_slug;
				}
				elseif ($module == "tours") {
						$this->db->select('tour_id,tour_title,tour_slug');
						$this->db->where('tour_id', $id);
						$this->db->order_by('tour_id', 'desc');
						$rslt = $this->db->get('pt_tours')->result();
						$result['id'] = $rslt[0]->tour_id;
						$result['title'] = $rslt[0]->tour_title;
						$result['slug'] = "tours/".$rslt[0]->tour_slug;
				}
				elseif ($module == "cars") {
						$this->db->select('car_id,car_title,car_slug');
						$this->db->where('car_id', $id);
						$this->db->order_by('car_id', 'desc');
						$rslt = $this->db->get('pt_cars')->result();
						$result['id'] = $rslt[0]->car_id;
						$result['title'] = $rslt[0]->car_title;
						$result['slug'] = "cars/".$rslt[0]->car_slug;
				}
				elseif ($module == "cruises") {
						$this->db->select('cruise_id,cruise_title,cruise_slug');
						$this->db->where('cruise_id', $id);
						$this->db->order_by('cruise_id', 'desc');
						$rslt = $this->db->get('pt_cruises')->result();
						$result['id'] = $rslt[0]->cruise_id;
						$result['title'] = $rslt[0]->cruise_title;
						$result['slug'] = "cruises/".$rslt[0]->cruise_slug;
				}
				return $result;
		}
	
	function getCancellation($id){
		$this->db->select('*');
		if($id!="")
			$this->db->where('car_id', $id);
		$this->db->order_by('start_date', 'desc');
		$rslt = $this->db->get('pt_cancellation_policy')->result();
		return $rslt;
	}
	function getRooms($id){
		$this->db->select('room_id,room_hotel,room_title');
		if($id!="")
			$this->db->where('room_hotel', $id);
		$this->db->order_by('room_id', 'asc');
		$rslt = $this->db->get('pt_rooms')->result();
		return $rslt;
	}
	
	function getHotel($id){
		$this->db->select('hotel_slug,hotel_title');
		if($id!="")
			$this->db->where('hotel_id', $id);
		$rslt = $this->db->get('pt_hotels')->result();
		return $rslt;
	}
	
	function genPrices($args){
		$Mcur	= array("bar"=>array("type"=>$args['cur']['bar'],"value"=>$args['value']['bar']),
						"mob"=>array("type"=>$args['cur']['mobile'],"value"=>$args['value']['mobile']),
						"b2b"=>array("type"=>$args['cur']['b2b'],"value"=>$args['value']['b2b'])
						);
		$Mcur	= json_encode($Mcur);
		$Pmaster= json_encode($args['master']);
		$Amaster= isset($args['master_allotments'])?json_encode($args['master_allotments']):0;
		
		$Pmon	= json_encode($args['price']['Monday']);
		$Ptue	= json_encode($args['price']['Tuesday']);
		$Pwed	= json_encode($args['price']['Wednesday']);
		$Pthu	= json_encode($args['price']['Thuesday']);
		$Pfri	= json_encode($args['price']['Friday']);
		$Psat	= json_encode($args['price']['Saturday']);
		$Psun	= json_encode($args['price']['Sunday']);
		
		$Amon	= json_encode($args['allotments']['Monday']);
		$Atue	= json_encode($args['allotments']['Tuesday']);
		$Awed	= json_encode($args['allotments']['Wednesday']);
		$Athu	= json_encode($args['allotments']['Thuesday']);
		$Afri	= json_encode($args['allotments']['Friday']);
		$Asat	= json_encode($args['allotments']['Saturday']);
		$Asun	= json_encode($args['allotments']['Sunday']);
		
		$mon	= $args['price']['Monday']['bar'];
		$tue	= $args['price']['Tuesday']['bar'];
		$wed	= $args['price']['Wednesday']['bar'];
		$thu	= $args['price']['Thuesday']['bar'];
		$fri	= $args['price']['Friday']['bar'];
		$sat	= $args['price']['Saturday']['bar'];
		$sun	= $args['price']['Sunday']['bar'];
		
		$cancellationPolicy= $args['cancellationPolicy'];
		
		$room_id = $args['room'];
		$hotel_id= $args['hotel'];
		
		$master_rate	= $args['master_rate'];
		$date_from		= date("Y-m-d", strtotime(str_replace("/","-",$args['fromdate'])));
		$date_to		= date("Y-m-d", strtotime(str_replace("/","-",$args['todate'])));
		$adults			= $args['adult'];
		$children		= $args['children'];
		
		$fields	= array(
			"room_id"=>$room_id,
			"date_from"=>$date_from,
			"date_to"=>$date_to,
			"adults"=>$adults,
			"children"=>$children,
			"mon"=>$mon,
			"tue"=>$tue,
			"wed"=>$wed,
			"thu"=>$thu,
			"fri"=>$fri,
			"sat"=>$sat,
			"sun"=>$sun,
			"policy"=>$cancellationPolicy,
			"allotments"=>$Amaster,
			"Pmon"=>$Pmon,
			"Ptue"=>$Ptue,
			"Pwed"=>$Pwed,
			"Pthu"=>$Pthu,
			"Pfri"=>$Pfri,
			"Psat"=>$Psat,
			"Psun"=>$Psun,
			"Amon"=>$Amon,
			"Atue"=>$Atue,
			"Awed"=>$Awed,
			"Athu"=>$Athu,
			"Afri"=>$Afri,
			"Asat"=>$Asat,
			"Asun"=>$Asun,
			"Pmaster"=>$Pmaster,
			"Amaster"=>$Amaster,
			"Mcur"=>$Mcur
		);
		if(!isset($args['id']) || empty($args[id])){
			$id = $this->db->insert("pt_rooms_prices",$fields);
			
		}else{
			$this->db->where("id",$args['id']);
			$id = $this->db->update("pt_rooms_prices",$fields);
		}
		
		return $fields;
		
	}
	
	function generatePrice($price,$type,$cur){
		if($type=="fixed"){
			return $price-$cur;
		}else if($type=="percentage"){
			return round($cur/100*$price);
		}else{
			return 0;
		}
	}
	
	function getRoomPricess($room_id){
		$this->db->select('bar,mob,b2b,barCur,mobCur,b2bCur,barPerc,mobPerc,b2bPerc');
		$this->db->where('room_id', $room_id);
		$rslt = $this->db->get('pt_rooms')->result();
		return $rslt;
	}
	
	function newUpdateRates($args){
		$hari = array("mon","tue","wed","thu","fri","sat","sun");
		$p=array();
		$master	= $this->getRoomPricess($args['room_id'])[0];
		foreach($hari as $k=>$v){
			$p[$v] 	= array(
				"bar"=> str_replace(",","",$args['day-'.$k]),	
				"mob"=> $this->generatePrice(str_replace(",","",$args['day-'.$k]),$master->mobPerc,$master->mobCur),
				"b2b"=> $this->generatePrice(str_replace(",","",$args['day-'.$k]),$master->b2bPerc,$master->b2bCur),
				"allotments"=>$args['alt-'.$k]
			);
			
		}
			
		$fields	= array(
					"room_id"=>$args['room_id'],
					"date_from"=>date("Y-d-m",strtotime($args['fromdate'])),
					"date_to"=> date("Y-m-d", strtotime(str_replace("/","-",$args['todate']))),
					"adults"=>isset($args['person'])?$args['person']:2,
					"mon"=>str_replace(",","",$args['day-0']),
					"tue"=>str_replace(",","",$args['day-1']),
					"wed"=>str_replace(",","",$args['day-2']),
					"thu"=>str_replace(",","",$args['day-3']),
					"fri"=>str_replace(",","",$args['day-4']),
					"sat"=>str_replace(",","",$args['day-5']),
					"sun"=>str_replace(",","",$args['day-6']),
					"policy"=>$args['cancellationPolicy'],
					"allotments"=>$args['baseallotments'],
					"Pmon"=>json_encode($p['mon']),
					"Ptue"=>json_encode($p['tue']),
					"Pwed"=>json_encode($p['wed']),
					"Pthu"=>json_encode($p['thu']),
					"Pfri"=>json_encode($p['fri']),
					"Psat"=>json_encode($p['sat']),
					"Psun"=>json_encode($p['sun'])
				);
				
		#echo "<pre/>";print_r($this->db);exit();
		return $this->db->insert('pt_rooms_prices',$fields);
	}

	function editUpdateRates($args){
		$hari = array("mon","tue","wed","thu","fri","sat","sun");
		$p=array();
		$master	= $this->getRoomPricess($args['room_id'])[0];
		foreach($hari as $k=>$v){
			$p[$v] 	= array(
				"bar"=> $args['day-'.$k],	
				"mob"=> $this->generatePrice(str_replace(",","",$args['day-'.$k]),$master->mobPerc,$master->mobCur),
				"b2b"=> $this->generatePrice(str_replace(",","",$args['day-'.$k]),$master->b2bPerc,$master->b2bCur),
				"allotments"=>$args['alt-'.$k]
			);
			
		}
			
		$fields	= array(
					"room_id"=>$args['room_id'],
					"date_from"=>date("Y-m-d",strtotime($args['fromdate'])),
					"date_to"=> date("Y-m-d", strtotime(str_replace("/","-",$args['todate']))),
					"adults"=>$args['person'],
					"mon"=>str_replace(",","",$args['day-0']),
					"tue"=>str_replace(",","",$args['day-1']),
					"wed"=>str_replace(",","",$args['day-2']),
					"thu"=>str_replace(",","",$args['day-3']),
					"fri"=>str_replace(",","",$args['day-4']),
					"sat"=>str_replace(",","",$args['day-5']),
					"sun"=>str_replace(",","",$args['day-6']),
					"policy"=>$args['cancellationPolicy'],
					"allotments"=>$args['baseallotments'],
					"Pmon"=>json_encode($p['mon']),
					"Ptue"=>json_encode($p['tue']),
					"Pwed"=>json_encode($p['wed']),
					"Pthu"=>json_encode($p['thu']),
					"Pfri"=>json_encode($p['fri']),
					"Psat"=>json_encode($p['sat']),
					"Psun"=>json_encode($p['sun'])
				);
		#echo "<pre/>";print_r($fields);exit();
		$this->db->where('id',$args['priccesid']);
		return $this->db->update('pt_rooms_prices',$fields);
	}
	
	function updateRates($args){
		$bar 		= str_replace(",","",$args['bar']);
		$mob	 	= str_replace(",","",$args['mob']);
		$b2b	 	= str_replace(",","",$args['b2b']);
		$barPerc 	= str_replace(",","",$args['barPerc']);
		$mobPerc 	= str_replace(",","",$args['mobPerc']);
		$b2bPerc	= str_replace(",","",$args['b2bPerc']);
		$barCur		= str_replace(",","",$args['barCur']);
		$mobCur		= str_replace(",","",$args['mobCur']);
		$b2bCur		= str_replace(",","",$args['b2bCur']);
		
		$fields	= array(
			"bar"=>$bar,
			"mob"=>$mob,
			"b2b"=>$b2b,
			"barCur"=>$barCur,
			"mobCur"=>$mobCur,
			"b2bCur"=>$b2bCur,
			"barPerc"=>$barPerc,
			"mobPerc"=>$mobPerc,
			"b2bPerc"=>$b2bPerc
		);
		$this->db->where("room_id",$args['roomID']);
		$id = $this->db->update("pt_rooms",$fields);
	}
}