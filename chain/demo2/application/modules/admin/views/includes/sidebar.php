<style>
	.social-sidebar .menu-content > ul > li .collapse.in, .social-sidebar .menu-content > ul > li .collapsing
</style>
<!-- BEGIN SIDEBAR-->
<aside class="social-sidebar">
  <div class="social-sidebar-content">
   
    <div class="clearfix"></div>
    <!-- <div class="user">
      <i class="fa-1x glyphicon glyphicon-user"></i>
      <span><?php echo $this->session->userdata('fullName');?></span>
    </div> -->
    <div class="menu">
      <div class="menu-content">
        <ul id="social-sidebar-menu">
        	
          <?php if($isadmin){ ?>
          <!-- <li class="active">
            <a href="<?php echo base_url();?>" target="_blank">
              <!-- icon--><!--i class="fa fa-laptop"></i>
              <span><?php echo trans('02');?></span>
            </a>
          </li> -->
          <!-- END ELEMENT MENU-->
          <!-- BEGIN ELEMENT MENU-->
          <?php $chkupdates = checkUpdatesCount(); if($chkupdates->showUpdates){ if($isSuperAdmin){ ?>
          <li class="open">
            <a href="<?php echo base_url(); ?>admin/updates/"><i class="fa fa-refresh"></i>
            <span>Updates</span><span class="pull-right label label-danger" id="updatescount"><?php if($chkupdates->count > 0){ echo $chkupdates->count; }; ?></span>
            </a>
          </li>
          <?php } } ?>
          <?php if($isSuperAdmin){?>
          <li class="open">
            <a  data-parent="#social-sidebar-menu" href="#ACCOUNTS"><i class="glyphicon glyphicon-user"></i>
            <span><?php echo trans('017');?></span><!--i class="fa arrow"></i-->	
            </a>
            <ul id="<?php echo trans('017');?>" class="collapse wow fadeIn in animated">
              <?php if($role != "admin"){ ?>
              <li><a href="<?php echo base_url();?>admin/accounts/admins/"><?php echo trans('021');?></a></li>
              <?php } ?>
              <li><a href="<?php echo base_url();?>admin/accounts/suppliers/"><?php echo trans('023');?></a></li>
              <li><a href="<?php echo base_url();?>admin/accounts/customers/"><?php echo trans('025');?></a></li>
              <li><a href="<?php echo base_url();?>admin/accounts/guest/"><?php echo trans('027');?> <?php echo trans('025');?></a></li>
            </ul>
          </li>
          <?php } if($isSuperAdmin){ ?>
          <li class="open">
            <a href="javascrip:void(0)"  data-parent="#social-sidebar-menu">
              <!-- icon--><i class="fa fa-cogs"></i>
              <span><?php echo trans('03');?></span>
              <!-- arrow--><!--i class="fa arrow"></i-->	
            </a>
            <!-- BEGIN SUB-ELEMENT MENU-->
            <ul id="menu-ui" class="collapse wow fadeIn in animated">
              <li> <a href="<?php echo base_url();?>admin/settings/"><?php echo trans('04');?></a> </li>
              <!-- <li>
                <a href="<?php echo base_url();?>admin/settings/api/"><?php echo trans('036');?></a>
                </li> -->
              <li>
                <a href="<?php echo base_url();?>admin/settings/modules/"><?php echo trans('08');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/currencies/">Currencies</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/paymentgateways/"><?php echo trans('05');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/social/"><?php echo trans('07');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/widgets/"><?php echo trans('010');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/sliders/"><?php echo trans('011');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/templates/email/"><?php echo trans('012');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/backup/">BackUp</a>
              </li>
            </ul>
            <!-- END SUB-ELEMENT MENU-->
          </li>
          <?php } ?>
          <!-- END ELEMENT MENU-->
          <!-- BEGIN ELEMENT MENU-->
          <!-- <li class="open">
            <a href="#CMS"  data-parent="#social-sidebar-menu">
              <!-- icon--><!--i class="fa fa-list-alt"></i>
              <span><?php echo trans('013');?></span>
              <!-- arrow--><!--i class="fa arrow"></i-->	
            <!--/a>
            <!-- BEGIN SUB-ELEMENT MENU-->
            <!--ul id="CMS" class="collapse wow fadeIn in animated">
              <li>
                <a href="<?php echo base_url();?>admin/cms"><?php echo trans('015');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/cms/menus/manage"><?php echo trans('016');?></a>
              </li>
            </ul>
          </li> -->
          <?php } ?>
          <?php if(pt_permissions('booking',@$userloggedin)){ ?>
           
          <li class="open">
            <a href="<?php echo base_url().$this->uri->segment(1);?>/"  data-parent="#social-sidebar-menu">
            <i class="fa fa-list"></i>
            <span>Reservation </span>
            <!--i class="fa arrow"></i-->		
            </a>
            <ul id="reservation" class="wow fadeIn in animated collapse">
             <li><a href="<?php echo base_url().$this->uri->segment(1);?>/bookings/">
            <span><?php echo "Lists";#trans('034');?></span><span class="pull-right label label-danger" id=""></span>
            </a></li>
            <li><a href="<?=$base;?>/quickbooking/?applytax=no&service=hotels">
            <span>Call Center</span><span class="pull-right label label-danger" id=""></span>
            </a></li>
            </ul>
          </li>
          <?php } ?>
          <?php if(empty($supplier)){  ?>
          <?php $moduleslist = $this->ptmodules->read_config();
            $baseurl = base_url();
            @$urisegment = $this->uri->segment(1);
			
            foreach($moduleslist as $modl){
            $isenabled = $this->ptmodules->is_main_module_enabled(strtolower($modl['Name']));
            if($isenabled){
            if($urisegment == "admin"){ $submenu = $modl['AdminMenu'];}else{ $submenu = $modl['SupplierMenu']; }
            if(pt_permissions($modl['Name'],@$userloggedin)){
             if($modl['isIntegration'] != "Yes"){
             	(strtolower($modl['DisplayName'])=="hotels")?$displayName="Setup":$displayName=$modl['DisplayName'];
            ?>
          
          <!--custom Menu-->
          <?php
          $uri2 = $this->uri->segment(1);
		  $base = base_url().$uri2;
          ?>
           <li class="open">
            <a href="<?php echo base_url().$this->uri->segment(1);?>/"  data-parent="#social-sidebar-menu">
            <i class="fa fa-calendar"></i>
            <span>Rates & Allotments </span>
            <!--i class="fa arrow"></i-->		
            </a>
            <ul id="rates" class="wow fadeIn in animated collapse">
             <li><a href="<?=$base;?>/hotels/setuprates?type=setup">Setup Rate</a></li>
             <li><a href="<?=$base;?>/hotels/updaterates">Update Rate</a></li>
            </ul>
          </li>
          
          <li class="open">
            <a href="<?php echo base_url().$this->uri->segment(1);?>/">
            <i class="fa fa-bullhorn"></i>
            <span>Promotions</span>
            <!--i class="fa arrow"></i-->		
            </a>
            <ul id="promotion" class="wow fadeIn animated in collapse">
            	<li><a href="<?=$base;?>/hotels/promotions/hot-deals">Hot Deals</a></li>
            	<li><a href="<?=$base;?>/hotels/promotions/last-minute">Last Minute</a></li>
            	<li><a href="<?=$base;?>/hotels/promotions/early-bird">Early Bird</a></li>
            	<li><a href="<?=$base;?>/hotels/promotions/minimum-stay">Minimum Stay</a></li>
            	<li><a href="<?=$base;?>/hotels/promotions/bonus-night">Bonus Night</a></li>
              <?php if(pt_is_module_enabled('coupons')){?><li><a href="<?php echo base_url();?>admin/coupons/">Coupons</a></li><?php } ?>
            	<?php  if(pt_is_module_enabled('newsletter')){  ?>
		          <!-- <li><a href="<?php echo base_url();?>admin/newsletter/"><?php echo trans('031');?></a></li> -->
         		 <?php } ?>
            </ul>
          </li>
          
          	
          <li class="open">
            <a href="<?php echo base_url().$this->uri->segment(1);?>/">
            <i class="fa fa-bar-chart"></i>
            <span>Report</span>	
            </a>
            <ul id="promotion" class="wow fadeIn animated in collapse">
              <li><a href="<?=$base;?>?chart">Chart</a></li>
              <li><a href="<?=$base;?>?statistics">Statistics</a></li>
            </ul>
          </li>
         
          <li class="open">
            <!-- <a href="#<?php echo $modl['DisplayName']; ?>"  data-parent="#social-sidebar-menu"> -->
            <a href="<?php echo base_url().$this->uri->segment(1);?>"  data-parent="#social-sidebar-menu">
            <?php echo $modl['Icon']; ?>
            <span><?=(strtolower($modl['DisplayName'])=="bookings")?"Reservation":$displayName;?></span>
            <!--i class="fa arrow"></i-->	
            </a>
           
            <ul id="<?php echo $modl['DisplayName']; ?>" class="collapse in wow animated">
              <?php echo str_replace('<li><a href="http://demo.klik2set.com/admin/hotels/reviews/"> Reviews</a></li>','',str_replace("Hotels Settings","Settings",str_replace("%baseurl%","$baseurl",$submenu)));?>
              <li><a href="<?=$base;?>/hotels/cancelations">Cancellation Policy</a></li>
            </ul>
          </li>
          <li class="open">
            <a href="<?php echo base_url().$this->uri->segment(1);?>/">
            <i class="fa fa-globe"></i>
            <span>CMS</span>	
            </a>
            <ul id="cms" class="wow fadeIn animated in collapse">
              <li><a href="<?=$base;?>/cms/">Page</a></li>
              <li><a href="<?=$base;?>/hotels/contact/">Contact</a></li>
              <li><a href="<?=$base;?>/hotels/settings/?general">Home Page</a></li>
              <li><a href="<?=$base;?>/hotels/gallery/<?=(empty($this->session->userdata('hotel_slug')))?"sofyan-inn-tebet":$this->session->userdata('hotel_slug');?>">Gallery</a></li>
              <li><a href="<?=$base;?>/blog/">News/Press Release</a></li>
              <li><a href="<?=$base;?>/hotels/youtube/">Youtube</a></li>
               <li><a href="<?=$base;?>/settings/social/">Social Media</a></li>
                <li><a href="<?=$base;?>/settings/sliders/">Slideshow</a></li>
                 <li><a href="<?=$base;?>/hotels/reviews/">Reviews</a></li>
                 <li><a href="<?=$base;?>/hotels/analytics/">Google Analytics</a></li>
            </ul>
          </li>
          <!--end custom Menu-->
          <?php } } } } } ?>
          <?php if($isadmin && $role != "admin"){ if(pt_is_module_enabled('offers')){  ?>
          <li>
            <a  data-parent="#social-sidebar-menu" href="#SPECIAL_OFFERS"><i class="fa fa-gift"></i>
            <span>Offers</span><!--i class="fa arrow"></i-->	
            </a>
            <ul id="SPECIAL_OFFERS" class="collapse  wow fadeIn animated">
              <li><a href="<?php echo base_url();?>admin/offers/"><?php echo trans('029');?> <?php echo trans('030');?></a></li>
              <li><a href="<?php echo base_url();?>admin/offers/settings/"><?php echo trans('030');?> <?php echo trans('04');?></a></li>
            </ul>
          </li>
          <?php } } ?>
          <?php if(pt_permissions('locations',@$userloggedin)){ ?>
          <li>
          <a href="<?php echo base_url().$this->uri->segment(1);?>/locations"><i class="fa fa-map-marker"></i>
          <span>Locations</span><span class="pull-right label label-danger" id=""></span>
          </a>
          </li>
          <?php } ?>
          
          
          <!-- <li>
            <a href="#manual"  data-parent="#social-sidebar-menu">
            <i class="fa fa-info-circle"></i>
            <span>Manual & Help</span>
            <!--i class="fa arrow"></i-->		
            <!--/a>
            <ul id="manual" class="wow fadeIn animated collapse">
             <li><a href="#">Manual</a></li>
            </ul>
          </li> -->
        </ul>
      </div>
    </div>
    <!-- END MENU SECTION-->
  </div>
</aside>
<!-- END SIDEBAR-->