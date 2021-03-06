<?php

?>
<!DOCTYPE html>
<?php $CI = &get_instance(); $ishome = $CI->uri->segment(1); $currenturl = uri_string(); $allowreg = $app_settings[0]->allow_registration; $allowsupplierreg = $app_settings[0]->allow_supplier_registration; if(!empty($metadesc)){ $metadescription = $metadesc; }else{ if(!empty($ishome)){ $metadescription = $app_settings[0]->meta_description; } } if(!empty($metakey)){ $metakeywords = $metakey; }else{ if(!empty($ishome)){ $metakeywords =  $app_settings[0]->keywords; } } $lang_set = $CI->theme->_data['lang_set']; $langname = $CI->session->userdata('lang_name'); $isRTL = isRTL($lang_set); if(empty($langname)){ $langname = languageName($lang_set); }else{ $langname = $langname; } ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php if($app_settings[0]->seo_status == "1"){echo @$metadescription;}?>">
    <meta name="keywords" content="<?php if($app_settings[0]->seo_status == "1"){echo @$metakeywords;}?>">
    <meta name="author" content="KLIK2SET">
    <title><?php if(empty($ishome)){ echo $app_settings[0]->home_title; }else{ echo $CI->theme->_data['page_title']; } ?></title>
    <link rel="shortcut icon" href="<?php echo PT_GLOBAL_IMAGES_FOLDER.'favicon.png';?>?<?=time();?>">
    <!-- facebook -->
    <meta property="og:title" content="<?php $ishome = $CI->uri->segment(1); if(empty($ishome)){ echo $app_settings[0]->home_title; }else{ echo $CI->theme->_data['page_title']; } ?>"/>
    <meta property="og:site_name" content="<?php echo $app_settings[0]->site_title;?>"/>
    <meta property="og:description" content="<?php if($app_settings[0]->seo_status == "1"){echo $metadescription;}?>"/>
    <meta property="og:image" content="<?php echo base_url(); ?>uploads/global/favicon.png"/>
    <meta property="og:url" content="<?php echo $app_settings[0]->site_url;?>/"/>
    <meta property="og:publisher" content="https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>"/>
    <script type="application/ld+json">
      { "@context": "http://schema.org/",
        "@type": "Organization",
        "name": "<?php echo $app_settings[0]->site_title;?>",
        "url":"<?php echo $app_settings[0]->site_url;?>/",
        "logo":"<?php echo base_url(); ?>uploads/global/favicon.png",
        "sameAs":"https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>",
        "sameAs":"https://twitter.com/<?php echo $app_settings[0]->site_title;?>",
        "sameAs":"https://www.pinterest.com/<?php echo $app_settings[0]->site_title;?>/",
        "sameAs":"https://plus.google.com/u/0/<?php echo $app_settings[0]->site_title;?>/posts",
        "contactPoint":{
        "@type":"ContactPoint",
        "telephone":"+<?php echo $phone; ?>",
        "contactType":"Customer Service" } } {
        "@context" : "http://schema.org",
        "@type" : "WebSite",
        "name" : "<?php echo $app_settings[0]->site_title;?>",
        "url" : "<?php echo $app_settings[0]->site_url;?>" }
    </script>
    <!-- facebook -->
    <link href="<?php echo $theme_url; ?>assets/css/bootstrap.css?<?=time();?>" rel="stylesheet" media="screen">
    <link href="<?php echo $theme_url; ?>assets/css/custom.css?<?=time();?>" rel="stylesheet" media="screen">
    <link href="<?php echo $theme_url; ?>assets/css/animate.min.css" rel="stylesheet" media="screen">
   
    <link href="<?php echo $theme_url; ?>style.css" rel="stylesheet">
    <style> @import "<?php echo $theme_url; ?>childtheme/childstyle.css"; </style>
   
    <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
  
    <script src="<?php echo $theme_url; ?>assets/js/jquery-1.11.2.min.js"></script>
    
    <?php if($isRTL == "RTL"){ ?>
    <link href="<?php echo $theme_url; ?>RTL.css" rel="stylesheet">
    <?php } ?>
   
    <?php if($app_settings[0]->mobile_redirect_status == "Yes"){ if($ishome != "invoice"){ ?>
    <script>if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){ window.location ="<?php echo $app_settings[0]->mobile_redirect_url ?>";}</script>
    <?php } } ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>assets/css/font-awesome.css" media="screen" />
    
    <link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/jquery-ui.css" />
    <link href="<?php echo base_url(); ?>assets/css/custom.css?<?=time();?>" rel="stylesheet" media="screen">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,300' rel='stylesheet' type='text/css'>
    <style>
    	body{
    		font-family: 'Open Sans', sans-serif;
    	}.navbar-right {
		    margin: 7px 15px -1px;
		}.shaddow {
			-webkit-box-shadow:  0px 0px 5px rgba(192, 192, 192, 0.5);
			-moz-box-shadow: 0px 0px 5px rgba(192, 192, 192, 0.5);
			-o-box-shadow: 0px 0px 5px rgba(192, 192, 192, 0.5);
		    box-shadow: 0px 0px 5px rgba(192, 192, 192, 0.5);
		}.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > .active > a:focus {
		    text-decoration: none;
		    border-bottom: 3px solid #AAA;
		}.navbar-nav > li > a {
		    padding-top: 0px;
		    padding-bottom: 0px;
		}.navbar-right > .right-top{
			display: block;
			padding:0 25px 0 0 ;
		}.navbar-default {
		    height: 80px;
		}.navbar {
		    min-height: 80px;
		}.moto {
			max-height:80px;
		}
    </style>
    <script>
    	var baseURL = "<?=base_url();?>";
    </script>
  </head>
  <body id="top">
    <!-- Top wrapper -->
    <div class="navbar navbar-fixed-top navbar-default <?php echo @$hidden; ?>">
      <div class="container shaddow">
        <div class="navbar">
            <!-- Navigation-->
            <div class="navbar-header go-right">
              <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
              <a href="<?php echo base_url(); ?>" class="navbar-brand"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" alt="<?php echo $app_settings[0]->site_title;?>" class="moto"/></a>
            </div>
            <div class="navbar-collapse collapse">
              <div class="navbar-right go-left">
              	<div class="right-top text-right">
              		<!--<i class="fa fa-phone-square"></i> <?php if(!empty($phone)){ ?><span class="go-right">+<?php echo $phone; ?></span><?php } ?>
              		<a href="https://www.facebook.com/travelbusiness" target="_blank"><img src="http://phptravels.net/uploads/images/social/slufm6otpasooc.png" class="go-right social-icons-footer"></a>
                    <a href="https://twitter.com/phptravels" target="_blank"><img src="http://phptravels.net/uploads/images/social/9ztbr148kh4o8c8.png" class="go-right social-icons-footer"></a>
                    <a href="https://plus.google.com/+Phptravels/" target="_blank"><img src="http://phptravels.net/uploads/images/social/2wz814aq9mgw04k.png" class="go-right social-icons-footer"></a>
              		--> &nbsp;
              	</div>
              <ul class="nav navbar-nav">
                <li class="dropdown <?php pt_active_link();?> go-right">
                  <a class="dropdown-toggle" href="<?php echo base_url(); ?>"> <?php echo trans('01');?> </a>
                </li>
                <?php  $hmenu = get_header_menu();
                  if(!empty($hmenu)){
                  $menuitems = json_decode($hmenu[0]->menu_items);
                  if(!empty($menuitems)){
                  $icons = TRUE;
                  foreach($menuitems as $hm){
                  $pinfo =  get_page_details($hm->id);
                  foreach($pinfo as $pagesinfo){
                  $parent = parent_info($pagesinfo,$icons,$lang_set);
                  $ischildactive = child_page_active($hm->children);
                  if(!empty($hm->children) && $ischildactive){
                  $dropdownmenu = "dropdown-menu";
                  $dropdown = "dropdown";
                  $dropdowntoggle = "dropdown-toggle";
                  $datatoggle = "data-toggle='dropdown'";
                  $caret = "<span class='caret'></span>";
                  }else{
                   $dropdownmenu = "";
                  $dropdown = "";
                  $dropdowntoggle = "";
                  $datatoggle = "";
                  $caret = "";
                  }
                  ?>
                <li class="go-right <?php echo $dropdown." ".pt_active_link($pagesinfo->page_slug);?>">
                  <a href="<?php echo $parent['hreflink'];?>" class="<?php pt_active_link($pagesinfo->page_slug).' '.$dropdowntoggle;?>" <?php echo $datatoggle;?>  target="<?php echo $parent['target'];?>" >
                    <!--<i class='<?php  echo $parent['icons'];?>'></i>--> <?=($parent['pagetitle']=="Blog")?'News':$parent['pagetitle'];?>  <?php echo $caret;?>
                  </a>
                  <?php if(!empty($hm->children)){  ?>
                  <ul class="<?php echo $dropdownmenu;?>">
                    <?php foreach($hm->children as $ch){
                      $children =  get_page_details($ch->id);
                      foreach($children as $childinfo){
                      $child = child_info($childinfo,$icons,$lang_set);
                      ?>
                    <li>
                      <a href="<?php  echo $child['hrefchild'];?>" target="<?php echo $child['childtarget'];?>" ><i class='<?php echo $child['icons'];?>'></i> <?php echo $child['childtitle'];?> </a>
                    </li>
                    <?php } } ?>
                  </ul>
                  <?php } ?>
                </li>
                <?php } } } } ?>
                <?php  if(!empty($customerloggedin)){ ?>
                <li class="dropdown pull-right">
                  <a href="javascript:void(0);" class="show-submenu"><?php echo $firstname; ?> <b class="lightcaret mt-2"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url()?>account/">  <?php echo trans('02');?></a></li>
                    <li><a href="<?php echo base_url()?>account/logout/">  <?php echo trans('03');?></a></li>
                  </ul>
                </li>
                <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ if($allowreg == "1"){ ?>
                <li class="dropdown pull-right">
                  <a href="javascript:void(0);" class="show-submenu"><?php echo trans('0146');?> <b class="lightcaret mt-2"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url(); ?>login">  <?php echo trans('04');?></a></li>
                    <li><a href="<?php echo base_url(); ?>register">  <?php echo trans('0115');?></a></li>
                  </ul>
                </li>
                <?php } } } ?>
              </ul>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="hidden-xs"><div style="margin-top:80px"></div></div>
    <div class="visible-xs"><div style="margin-top:60px"></div></div>
    <div class="mtslide2 sliderbg2"></div>
