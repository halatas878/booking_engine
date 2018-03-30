<section class="bg-white">
  <div class="container">
    <div id="DESCRIPTION" class="row">
      <div class="panel-body">
        <h2 class="main-title go-right"><?php echo trans('046');?></h2>
        <div class="clearfix"></div>
        <i class="tiltle-line go-right"></i>
        <span class="go-right RTL"><?php echo $hotel->desc; ?></span>
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
          <p><?php echo $hotel->policy; ?></p>
        </span>
        <p class="RTL"><i class="fa fa-clock-o text-success"></i> <strong> <?php echo trans('07');?> </strong> :   <?php echo $hotel->defcheckin;?> - <i class="fa fa-clock-o text-warning"></i>   <strong> <?php echo trans('09');?> </strong> :  <?php echo $hotel->defcheckout;?> </p>
      </div>
    </div>
  </div>
</section>
<!--<div class="col-md-4">
  <h4><?php echo trans('0265');?></h4>
  <ul class="list_ok">
    <?php if(!empty($hotel->paymentOptions)){ ?>
    <?php foreach($hotel->paymentOptions as $pay){ if(!empty($pay['name'])){ ?>
    <li><?php echo $pay['name'];?></li>
    <?php } } ?>
    <?php } ?>
  </ul>
  </div>-->
<!--<div class="col-md-12">
  <ul class="list list-inline text-small go-text-right ">
    <?php if(!empty($hotel->email)){ ?>
    <li><i class="fa fa-envelope go-right"></i> <a href="mailto:<?php echo $hotel->email; ?>"> &nbsp; <?php echo trans('0392');?> &nbsp; </a></li>
    <?php } ?>
    <?php if(!empty($hotel->website)){ ?>
    <li><i class="fa fa-home go-right"></i> <a href="<?php echo $hotel->website; ?>"> &nbsp; <?php echo trans('0393');?> &nbsp; </a></li>
    <?php } ?>
    <?php if(!empty($hotel->phone)){ ?>
    <li><i class="fa fa-phone go-right"></i> <a href="tel<?php echo $hotel->phone; ?>"> &nbsp; <?php echo $hotel->phone; ?> &nbsp; </a></li>
    <?php } ?>
  </ul>
  </div>-->
