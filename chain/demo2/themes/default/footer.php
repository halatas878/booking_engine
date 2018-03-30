<?php  $CI = &get_instance(); $app_settings = $CI->settings_model->get_settings_data(); $lang_set = $CI->theme->_data['lang_set']; ?>
<?php if($app_settings[0]->mobile_pic_status == "Yes"){  ?>
<div class="hidden-xs" style="position: fixed;width: 99px;height: 171px;right: 0;z-index: 9999;left: 0;top: 50%;margin-top: -85px;">
  <a href="<?php echo $app_settings[0]->mobile_pic_url; ?>" target="_blank"><img src="<?php echo $theme_url; ?>assets/img/app.png"  alt="phone application" /></a>
</div>
<?php } ?>
<div id="footer" class=" footerbg">

  <div style="padding-right: 0px;padding-left: 0px;" class="container orange">
  	 	<div class="new-orange"></div> 
    
    <div style="font-weight:bold; padding-top: 30px;color:#fff;" class="col-md-3 go-right margin20">
      <h2 style="color:#fff" class="ftitle go-text-right"><strong>OFFICE</strong></h2>
      <div style="font-weight:normal;">Jl. Cut Mutia No.9, Menteng<br>
Jakarta, Indonesia<br>
Telp : (021) 3905011<br>
Fax : (021) 3902747</div>
      <div class="scont">
        <div class="clearfix"></div>
        <div style="padding-top:20px;color:#fff">LETS CONNECT</div>
        <div id="social_footer go-right">
        
                    <a href="https://www.facebook.com/travelbusiness" target="_blank"><img src="http://phptravels.net/uploads/images/social/slufm6otpasooc.png" class="go-right social-icons-footer"></a>
                    <a href="https://twitter.com/phptravels" target="_blank"><img src="http://phptravels.net/uploads/images/social/9ztbr148kh4o8c8.png" class="go-right social-icons-footer"></a>
                    <a href="https://plus.google.com/+Phptravels/" target="_blank"><img src="http://phptravels.net/uploads/images/social/2wz814aq9mgw04k.png" class="go-right social-icons-footer"></a>
                  </div>
               
                
      </div>
    </div>
    <!-- End of column 1-->
                <div style="font-weight:bold; padding-top: 30px;color:#fff" class="col-md-3 go-right margin20">
              <h2 style="color:#fff" class="ftitle go-text-right"><strong>MENU</strong></h2>
              <ul class="footerlist go-right go-text-right">
                                <li><a href="#" target="" title="">HOME</a></li>
                                <li><a href="#" target="" title="">OUR HOTELS</a></li>
                                <li><a href="#" target="" title="">NEWS</a></li>
                                <li><a href="#" target="" title="">CONTACT US</a></li>

                              </ul>
            </div>
                <div style="font-weight:bold; padding-top: 30px;color:#fff" class="col-md-3 go-right margin20">
              <h2 style="color:#fff" class="ftitle go-text-right"><strong>AWARD &amp; CERTIFICATION</strong></h2>
        <div id="social_footer go-right">
        
                    <a href="https://www.facebook.com/travelbusiness" target="_blank"><img class="award-img" src="images/award.png"></a>
                    
                  </div>
            </div>
    
 <!--   <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="clearfix"></div>
      <hr style="border-top: 1px solid #FFFFFF;">
      <div class="clearfix"></div>
      <center>              <a href="http://phptravels.net/"><img src="images/logo-sofyanhotels.png" alt="PHPTRAVELS" class="moto"></a></center>
      <p class="text-center">© All Rights Reserved by Sofyan Hotel</p>
    </div>
  </div>
</div>
<div class="footerbg3 hidden-xs">
  <div class="container center grey">
    <a href="#top" class="gotop scroll"><img src="<?php echo $theme_url; ?>images/spacer.png" /></a>
  </div>
</div>-->
<?php include 'scripts.php'; ?>

<?php echo $app_settings[0]->google; ?>
</body>
</html>