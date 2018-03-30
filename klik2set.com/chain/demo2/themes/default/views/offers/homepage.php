<?php if($offersCount > 0){ ?>
<div class="lastminute4">
<div class="container cstyle04">
<div class="row anim3">
  <div class="col-md-3 visible-lg visible-md go-right">
    <h2 class="go-right"><b><?php echo trans('0341');?></b><br/><?php echo trans('Offers');?></h2>
    <div class="clearfix"></div>
    <hr>
    <a href="<?php echo base_url(); ?>offers" class="btn iosbtn go-right"><?php echo trans('0297');?></a>
    <div class="clearfix"></div>
  </div>
  <div class="col-md-9 col-sm-12 go-left">
    <!-- Carousel -->
    <div class="wrapper">
      <div class="list_carousel">
        <ul id="foo2">
          <?php foreach($specialoffers as $offer){ ?>
          <li>
            <a href="<?php echo $offer->slug;?>"><img class="img-responsive" src="<?php echo $offer->thumbnail;?>" alt="<?php echo character_limiter($offer->title,15);?>"/></a>
            <div class="m1">
              <h6 class="lh1 dark go-right"><b> <?php echo character_limiter($offer->title,35);?> &nbsp;&nbsp;</b></h6>

              <h6 class="lh1 green go-right">
                <!--<?php echo character_limiter($offer->desc,120);?>-->
                <?php  if($offer->price > 0){ ?>
                <?php echo $offer->currCode;?> <b><?php echo $offer->currSymbol; ?><?php echo $offer->price;?></b>
                <?php } ?>&nbsp;&nbsp;
              </h6>
            </div>
          </li>
          <?php }  ?>
        </ul>
        <div class="clearfix"></div>
        <a id="prev_btn2" class="prev offers" href="#"><img src="<?php echo $theme_url; ?>images/spacer.png" alt=""/></a>
        <a id="next_btn2" class="next offers" href="#"><img src="<?php echo $theme_url; ?>images/spacer.png" alt=""/></a>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<?php }  ?>



