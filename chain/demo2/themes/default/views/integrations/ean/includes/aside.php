<div class="col-md-5 go-right">
  <div class="col-xs-5 col-sm-3 col-md-5 row col-lg-4 go-right">
    <div class="reviews text-center"><?php echo $HotelSummary['tripAdvisorReviewCount']; ?> <?php echo trans('042');?></div>
    <div class="c100 p<?php echo $hrating * 10;?>" style="margin-top:10px">
      <span><strong><?php echo $hrating;?> </strong>/<small>10</small></span>
      <div class="slice">
        <div class="bar"></div>
        <div class="fill"></div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>

    <div class="clearfix"></div>
        <span class="go-right RTL"><?php echo character_limiter(html_entity_decode(str_replace("Property Location","",$HotelDetails['propertyDescription'])),1000);?></span>
        <div class="clearfix"></div>

</div>
