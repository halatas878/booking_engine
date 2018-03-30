<?php  if(pt_main_module_available('hotels')){ ?>
<div class="form-group">
  <h2 style="font-weight: bold;" class="main-title go-right"><?php #echo trans('056');?><img style="margin-right:10px;" src="images/icon-ourhotels.png" height="30px"><span style="vertical-align:bottom;">OUR HOTELS</span></h2>
  <!-- <div class="clearfix new"></div> -->
  <i class="tiltle-line go-right"></i>
</div>
<?php $a=1; foreach($featuredHotels as $item){ if($a>3) break;$a++;?>
<div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated">
  <div class="row">
    <div class="img_list">
      <a href="<?php echo $item->slug;?>">
        <img class="dealthumb go-right" src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,35);?>">
        <img class="overlay" src="<?php echo $theme_url; ?>assets/img/overlay.png" style="z-index: ">
        <div class="short_info"></div>
      </a>
    </div>
    <div class="custom">
      <div class="dealtitle go-right">
        <p><a href="<?php echo $item->slug;?>" class="dark go-text-right go-right rtl_title_home shadow"><?php echo character_limiter($item->title,20);?></a></p>
        <span class="size13 white mt-9 go-right"><?php echo $item->stars;?> <br><span class="go-right"><?php echo $item->location;?>&nbsp;</span></span>
      </div>
      <div class="dealprice go-left mt0">
      	<?php  if($item->price > 0){ ?>
         <p class="size12 white lh2"><?php echo $item->currCode;?>
          <span class="white shadow rate">
          <?php echo $item->currSymbol; ?><?php echo $item->price;?>
          <?php } ?>
          </span>
        </p>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<div class="clearfix"></div>

<?php } ?>