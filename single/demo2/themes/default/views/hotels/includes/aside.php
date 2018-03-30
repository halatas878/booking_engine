<div class="col-md-5 go-right">
  <div class="col-xs-5 col-sm-3 col-md-5 row col-lg-4 go-right">
    <div class="reviews text-center"><?php echo $avgReviews->totalReviews; ?> <?php echo trans('042');?></div>
    <div class="c100 p<?php echo $avgReviews->overall * 10;?>" style="margin-top:10px">
      <span><strong><?php echo $avgReviews->overall;?> </strong>/<small>10</small></span>
      <div class="slice">
        <div class="bar"></div>
        <div class="fill"></div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="row go-lwft">
    <div class="col-xs-7 col-sm-9 col-md-7 col-lg-8">
      <div class="col-xs-2 col-md-3 col-lg-2">
        <label class="text-left"><?php echo trans('030');?> </label>
      </div>
      <div class="col-xs-9 col-md-9 col-lg-10">
        <div class="progress">
          <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
            aria-valuemin="0" aria-valuemax="10" style="width: <?php echo $avgReviews->clean * 10;?>%">
            <span class="sr-only"></span>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-xs-2 col-md-3 col-lg-2">
        <label class="text-left"><?php echo trans('031');?></label>
      </div>
      <div class="col-xs-9 col-md-9 col-lg-10">
        <div class="progress">
          <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
            aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->comfort * 10;?>%">
            <span class="sr-only"></span>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-xs-2 col-md-3 col-lg-2">
        <label class="text-left"><?php echo trans('032');?></label>
      </div>
      <div class="col-xs-9 col-md-9 col-lg-10">
        <div class="progress">
          <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
            aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->location * 10;?>%">
            <span class="sr-only"></span>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-xs-2 col-md-3 col-lg-2">
        <label class="text-left"><?php echo trans('033');?></label>
      </div>
      <div class="col-xs-9 col-md-9 col-lg-10">
        <div class="progress">
          <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
            aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->facilities * 10;?>%">
            <span class="sr-only"></span>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-xs-2 col-md-3 col-lg-2">
        <label class="text-left"><?php echo trans('034');?></label>
      </div>
      <div class="col-xs-9 col-md-9 col-lg-10">
        <div class="progress">
          <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="80"
            aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->staff * 10;?>%">
            <span class="sr-only"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tripadvisor.php';?>
  <div class="clearfix"></div>
  <span class="RTL"><?php echo character_limiter($hotel->desc, 360);?> <a href="#DESCRIPTION" class="tabsBtn text-primary"><strong><?php echo trans('0286');?></strong></a></span>
  <br><br>
  <div class="clearfix"></div>
  <!-- <button data-toggle="collapse" data-parent="#accordion" class="writeReview btn-lg btn btn-default btn-block btn-lgs" href="#ADDREVIEW"><i class="icon_set_1_icon-68"></i> <?php echo trans('083');?></button> -->
  <?php if(!empty($reviews) > 0){ ?> <!--a href="#REVIEWS" class="tabsBtn btn btn-primary btn-lg btn-block btn-lgs"><i class="icon_set_1_icon-93"></i> <?php echo trans('0394');?></a--><?php } ?>
  <?php $currenturl = current_url(); $wishlist = pt_check_wishlist($customerloggedin,$hotel->id); if($allowreg){ if($wishlist){ ?>
  <!--span class="btn wish btn-danger btn-outline btn-lg btn-block removewishlist"><span class="wishtext"><i class=" icon_set_1_icon-82"></i> <?php echo trans('028');?></span></span-->
  <?php }else{ ?>
  <!--span class="btn wish btn-block btn-lg addwishlist btn-danger btn-outline"><span class="wishtext"><i class=" icon_set_1_icon-82"></i> <?php echo trans('029');?></span></span-->
  <?php } } ?>
</div>
