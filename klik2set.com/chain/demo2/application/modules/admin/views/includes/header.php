<!DOCTYPE html>

<!--
Product:        KLIK2SET
Copyright:      2016 @ klik2set.com
-->

<!-- Pace -->
<script src="<?php echo base_url(); ?>assets/include/pace/pace.min.js"></script>
<link href="<?php echo base_url(); ?>assets/include/pace/dataurl.css" rel="stylesheet" />
<!-- Pace -->

<head>
<meta charset="utf-8">
<title><?php echo $page_title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<base href="<?php echo base_url(); ?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/global/favicon.png?<?=time();?>">
<!--link href="<?php echo base_url(); ?>assets/include/loading/loading.css" rel="stylesheet"-->
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/themes/facebook.css?<?=time();?>" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/fa.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
<?php if(empty($dontload)){ ?>
<script src="<?php echo base_url(); ?>assets/include/ckeditor/ckeditor.js"></script><?php } ?>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.js"></script>
<link href="<?php echo base_url(); ?>assets/include/alert/css/alert.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/include/alert/themes/default/theme.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/include/alert/js/alert.js"></script>

<!---Jquery Form--->
<script src="<?php echo base_url();?>assets/include/jquery-form/jquery.form.min.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
<!--[if lte IE 8]>
<script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
<script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/excanvas.min.js"></script>
<![endif]-->
<link href="<?php echo base_url(); ?>assets/css/custom-admin.css?<?=time();?>" rel="stylesheet">
</head>
  <body>
	<?php
		$uri2 = $this->uri->segment(1);
		$base = base_url().$uri2;
		define(__CUURENT_URL__, base_url()."".ltrim($_SERVER['REQUEST_URI'],'/'));
		define(__URL__, $base)	;
		if(!empty($this->session->userdata('hotel_slug')))
	?>
    <div class="wrapper">
    	<?php
		  $uri = explode("/",$_SERVER['REQUEST_URI']); 
			  $hotellists = getHotels($this->session->userdata('pt_logged_id'));
		  ?>
      <?php include 'sidebar.php'; ?>
      <?php include 'headbar.php'; ?>
     <div class="main">
     <div class="container" id="content">
     	<?php
 	 	if(empty($this->session->userdata('hotel'))):
 	 	?>
     	 <div id="light" class="white_content">
     	 	
     	 	<form action="<?=__CUURENT_URL__;?>" method="get">
		 	<div class="input-group" id="adv-search">
                <select name="hotel" class="form-control">
		       	<option value="">Choose Hotel</option>
		       	<?php 
		       	foreach($hotellists as $k=>$v):
					echo '<optgroup label="'.$k.'">';
						foreach($v as $key=>$val):
							$extra="";
							if($this->session->userdata('hotel')==$val->id)$extra.="selected";
							echo '<option value="'.$val->id.'" '.$extra.'>'.$val->title.'</option>';	
						endforeach;
					echo '</optgroup>';
				endforeach;
		       	?>
		       </select>
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-refresh" aria-hidden="true"> Switch</span></button>
                    </div>
                </div>
         	</div> 
         </form>
		    </div>
		    <div id="fade" class="black_overlay"></div>
		  <?php endif;?>  
		  
     
    <script>document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';</script>
<div class="col-xs-12 col-sm-12 col-md-12 days">
	<div class="panel panel-default">
		<div class="panel-body holiday">
			<h2><em>Wednesday,</em> 9 <span class="date">Mar 2016</span></h2>
			
		</div>
		<div class="panel-heading">Next Holiday : Day of Silence (Saka New Year 1938)<a href="javascript:void(0);" class="btn btn-warning">Create a Promotion NOW!</a></div>
	</div>	
</div>
            
		  
		  
