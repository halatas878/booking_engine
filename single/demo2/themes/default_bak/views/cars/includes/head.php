<div class="container">
<div class="row">
  <div class="col-md-7 go-right">
    <h2 class="go-right"><strong><?php echo character_limiter($car->title, 28);?></strong></h2>
    <div class="clearfix"></div>
    <h4 class="go-right RTL"><i class="icon-location-6"></i> <?php echo $car->location; ?> <?php echo $car->stars;?></h4>
  </div>
  <div class="col-md-5">
    <div class="row">
      <div class="visible-lg visible-md col-md-6 go-right" style="margin-top:10px">
<!--        <h3><small class="go-text-right"><?php echo trans('070');?></small> $220 <small class="go-text-left"><?php echo trans('0141');?></small></h3>
-->      </div>
      <div class="col-md-6 go-left" style="margin-top:20px">
        <a class="btn btn-primary pull-right btn-block" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><?php echo trans('067');?></a>
      </div>
    </div>
  </div>
</div>
</div>