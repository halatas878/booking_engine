<section class="bg-white">
  <div class="container">
    <div id="DESCRIPTION" class="row">
      <div class="panel-body">
        <h2 class="main-title go-right"><?php echo trans('046');?></h2>
        <div class="clearfix"></div>
        <i class="tiltle-line go-right"></i>
        <span class="go-right RTL"><?php echo $tour->desc; ?></span>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <h4 id="terms" class="main-title  go-right"><?php echo trans('0148');?></h4>
        <div class="clearfix"></div>
        <i class="tiltle-line  go-right"></i>
        <div class="clearfix"></div>
        <span class="RTL">
          <p><?php echo $tour->policy; ?></p>
        </span>
        <p class="go-text-left"><i class="fa fa-sun-o text-success"></i> <strong> <?php echo trans('0275');?> </strong> :   <?php echo $tour->tourDays;?> | <i class="fa fa-moon-o text-warning"></i>   <strong> <?php echo trans('0276');?> </strong> :  <?php echo $tour->tourNights;?> </p>
        <div class="row">
          <div class="clearfix"></div>
          <hr>
          <div id="INCLUSIONS" class="col-md-12">
            <h4 class="main-title go-right"><?php echo trans('0280');?></h4>
            <div class="clearfix"></div>
            <i class="tiltle-line go-right"></i>
            <div class="clearfix"></div>
            <br>
            <?php foreach($tour->inclusions as $inclusion){ if(!empty($inclusion->name)){  ?>
            <ul class="list_ok col-md-4 RTL" style="margin: 0 0 5px 0;">
              <li class="go-right"><?php echo $inclusion->name; ?></li>
            </ul>
            <?php } } ?>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <hr>
          <div id="EXCLUSIONS"class="col-md-12">
            <h4 class="main-title go-right"><?php echo trans('0281');?></h4>
            <div class="clearfix"></div>
            <i class="tiltle-line go-right"></i>
            <div class="clearfix"></div>
            <br>
            <?php foreach($tour->exclusions as $exclusion){ if(!empty($exclusion->name)){  ?>
            <ul class="col-md-4" style="margin: 0 0 5px 0;list-style:none;">
              <li class="go-right"><i style="font-size: 13px; color: #E25A70; margin-left: -16px;" class="icon-cancel-5 go-right"></i> &nbsp;&nbsp;&nbsp; <?php echo $exclusion->name; ?> &nbsp;&nbsp;&nbsp;</li>
            </ul>
            <?php } } ?>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>