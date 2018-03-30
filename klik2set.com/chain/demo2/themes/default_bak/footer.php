<?php  $CI = &get_instance(); $app_settings = $CI->settings_model->get_settings_data(); $lang_set = $CI->theme->_data['lang_set']; ?>
<?php if($app_settings[0]->mobile_pic_status == "Yes"){  ?>
<div class="hidden-xs" style="position: fixed;width: 99px;height: 171px;right: 0;z-index: 9999;left: 0;top: 50%;margin-top: -85px;">
  <a href="<?php echo $app_settings[0]->mobile_pic_url; ?>" target="_blank"><img src="<?php echo $theme_url; ?>assets/img/app.png"  alt="phone application" /></a>
</div>
<?php } ?>
<div id="footer" class="<?php echo @$hidden; ?> footerbg" >
  <div class="container">
    <nav class="navbar" style="position: absolute; z-index: 10; margin-left: -8px;">
      <div class="container">
        <?php if (strpos($currenturl,'book') !== false || !empty($hideLang)) { }else{
          if($app_settings[0]->multi_lang == '1') { $default_lang = $app_settings[0]->default_lang; if(!empty($lang_set)){ $default_lang = $lang_set; } ?>
        <ul class="nav navbar-nav go-right">
          <li class="dropdown mega-dropdown go-right">
            <a style="border-bottom: 0px;" href="javascript: void();" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo PT_LANGUAGE_IMAGES.$default_lang.".png";?>" width="21" height="14" alt="<?php echo $langname;?>"> <b><?php echo $langname;?></b> <b class="caret"></b></a>
            <ul class="dropdown-menu mega-dropdown-menu row go-right">
              <li class="col-sm-3">
              <li class="dropdown-header"><?php echo trans('0158');?></li>
              <li class="divider"></li>
              </li>
              <?php $language_list = pt_get_languages();?>
              <?php foreach($language_list as $ldir => $lname){ $selectedlang = '';
                if(!empty($lang_set) && $lang_set == $ldir){
                $selectedlang = 'selected';
                }elseif(empty($lang_set) && $default_lang == $ldir){ $selectedlang = 'selected'; } ?>
              <li class="col-sm-3">
                <ul>
                  <li><a href="<?php echo pt_set_langurl($langurl,$ldir);?>" data-langname="<?php echo $lname['name'];?>" id="<?php echo $ldir; ?>" class="changelang" ><img src="<?php echo PT_LANGUAGE_IMAGES.$ldir.".png";?>" width="21" height="14" alt="">  <?php echo $lname['name'];?></a></li>
                </ul>
              </li>
              <?php } ?>
            </ul>
          </li>
        </ul>
        <?php } ?>
        <?php  } ?>
      </div>
    </nav>
    <div class="clearfix"></div>
    <div class="col-md-3 go-right">
      <br><br>
      <div class="scont">
        <div class="clearfix"></div>
        <div id="social_footer go-right">
          <?php
            $footersocials = pt_get_footer_socials();
            foreach($footersocials as $fs){
            ?>
          <a href="<?php echo $fs->social_link;?>" target="_blank"><img src="<?php echo PT_SOCIAL_IMAGES; ?><?php echo $fs->social_icon;?>" class="go-right social-icons-footer" /></a>
          <?php } ?>
        </div>
        <?php if(strpos($currenturl,'book') == false && $app_settings[0]->multi_curr == 1 && empty($hideCurr)){ $currencies = ptCurrencies(); ?>
        <form >
          <p>
          <div class="styled-select">
            <select onchange="change_currency(this.value)" class="selectx go-right" style="max-width:232px" name="currency" id="currency">
              <?php foreach($currencies as $c){ ?>
              <option value="<?php echo $c->id;?>" <?php makeSelected($currency,$c->code); ?>><?php echo $c->name;?></option>
              <?php } ?>
            </select>
          </div>
          </p>
          <div class="clearfix"></div>
        </form>
        <?php } ?>
        <img src="<?php echo $theme_url; ?>/assets/img/payments.png" width="233" height="30" data-retina="true" class="img-responsive go-right">
        <strong class="go-right"><?php echo trans('0295');?></strong>
      </div>
    </div>
    <!-- End of column 1-->
    <?php get_footer_menu_items(3,"col-md-3 go-right","ftitle go-text-right","footerlist go-right go-text-right" );?>
    <?php get_footer_menu_items(19,"col-md-3 go-right","ftitle go-text-right","footerlist go-right go-text-right" );?>
    <div class="col-md-3 grey go-left" id="newsletter" style="margin-top:15px">
      <?php if(pt_is_module_enabled('newsletter')){ ?>
      <div id="message-newsletter_2"></div>
      <form role="search" onsubmit="return false;">
      </form>
      <span class="ftitle go-right"><?php echo trans('023');?></span>
      <div class="clearfix"></div>
      <div class="relative">
        <input type="email" class="form-control fccustom2 sub_email" id="exampleInputEmail1" placeholder="<?php echo trans('0403');?>" required>
        <div class="subscriberesponse"></div>
        <button type="submit" class="btn btn-default btncustom sub_newsletter">&nbsp;</button>
      </div>
      <?php } ?>
      <div class="clearfix"></div>
      <br/><br/>
      <span class="ftitle go-right"><?php echo trans('061');?></span><br/>
      <?php if(!empty($phone)){ ?><span class="pnr go-right">+<?php echo $phone; ?></span><?php } ?><br/>
      <a class="go-right" href="mailto:<?php echo $contactemail; ?>" id="email_footer"><?php echo $contactemail; ?></a>
    </div>
    <div class="clearfix"></div>
    
    <!--custom footer-->
    <!--div class="col-md-12">
    	<div class="row" style="background-color:#000;">
    			<div class="col-md-3 col-xs-12">
    				<img src="images/pialasofyanhotel1.png" height="250px"/>
    			</div>
    			<div class="col-md-3 col-xs-12">
    				<img src="images/Halal-Certified1.png" width="100%"/>
    			</div>
    			<div class="col-md-3 col-xs-12">
    				<img src="images/KAN-2-GIF11-300x229.png" width="100%"/>
    			</div>
    			<div class="col-md-3 col-xs-12">
    				<img src="images/SICS2-300x98.png" width="100%"/>
    			</div>
    	</div>  
    </div-->
    <!--end Custom-->
    
    <div class="col-md-12">
      <div class="clearfix"></div>
      <hr style="border-top: 1px solid #FFFFFF;">
      <div class="clearfix"></div>
      <center>              <a href="<?php echo base_url(); ?>"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" style="max-width:200px" class="img-responsive"/></a></center>
      <p class="text-center">&copy; <?php echo $app_settings[0]->copyright;?></p>
    </div>
  </div>
  
</div>
<div class="footerbg3 hidden-xs">
  <div class="container center grey">
    <a href="#top" class="gotop scroll"><img src="<?php echo $theme_url; ?>images/spacer.png" /></a>
  </div>
</div>
<?php include 'scripts.php'; ?>

<?php echo $app_settings[0]->google; ?>
</body>
</html>