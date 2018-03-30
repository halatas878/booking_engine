<style>
  .panel { border: solid 1px #D6D6D6; box-shadow: none !important; }
  #countdown span {
  color: #4A4A4A;
  font-size: 13px;
  margin-left: 2px;
  margin-right: 2px;
  text-align: center;
  }
  .btn-arrival {
  color: #FF3333;
  background-color: #FFFFFF;
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.428571429;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid #FF3333;
  border-radius: 4px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
  }
  .btn-arrival:hover,
  .btn-arrival:focus,
  .btn-arrival:active,
  .btn-arrival.active,
  .open .dropdown-toggle.btn-arrival {
  color: #FFFFFF;
  background-color: #FF3333;
  border-color: #FF3333;
  }
  .btn-arrival:active,
  .btn-arrival.active,
  .open .dropdown-toggle.btn-arrival {
  background-image: none;
  }
  .btn-arrival.disabled,
  .btn-arrival[disabled],
  fieldset[disabled] .btn-arrival,
  .btn-arrival.disabled:hover,
  .btn-arrival[disabled]:hover,
  fieldset[disabled] .btn-arrival:hover,
  .btn-arrival.disabled:focus,
  .btn-arrival[disabled]:focus,
  fieldset[disabled] .btn-arrival:focus,
  .btn-arrival.disabled:active,
  .btn-arrival[disabled]:active,
  fieldset[disabled] .btn-arrival:active,
  .btn-arrival.disabled.active,
  .btn-arrival[disabled].active,
  fieldset[disabled] .btn-arrival.active {
  background-color: #FFFFFF;
  border-color: #175BD1;
  }
  .btn-arrival .badge {
  color: #FFFFFF;
  background-color: #1E65DD;
  }
</style>


<div class="clearfix"></div>
<div class="panel panel-default  hidden-xs">
  <div class="panel-heading  hidden-xs">
    <span><strong><?php echo trans('076');?> <?php echo trans('08');?> </strong>: <?php echo $invoice->bookingDate;?></span>
    <span><strong><?php echo trans('079');?> </strong>: <?php echo $invoice->expiry;?></span>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-2 col-md-4 col-sm-4">
        <img src="<?php echo $invoice->thumbnail;?>" class="img-responsive">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <h3 style="margin-top: 0px;margin-bottom: 0px"><strong><?php echo $invoice->title;?></strong></h3>
        <h4><a href="javascript:void(0);"><i class="icon-location-6"></i> <?php echo $invoice->location;?> </a> <?php echo $invoice->stars;?> </h4>
      </div>
    </div>
  </div>
</div>
<?php if(!empty($invoice->bookingExtras)){ ?>
<div class="panel panel-default hidden-xs">
  <div class="panel-heading strong"><?php echo trans('0156');?></div>
  <div class="panel-body">
    <?php foreach($invoice->bookingExtras as $extra){ ?>
    <div class="row">
      <div class="col-lg-2 col-md-4 col-sm-4">
        <img src="<?php echo PT_EXTRAS_IMAGES.$extra->thumbnail;?>" class="img-responsive">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <h3 style="margin-top: 0px;margin-bottom: 0px"><strong><?php echo $extra->title;?></strong></h3>
        <h4><a href="javascript:void(0);"><i class="icon-shop-1"></i> <?php echo $invoice->currCode." ".$invoice->currSymbol.$extra->price;?> </a> </h4>
      </div>
    </div>
    <br>
    <?php } ?>
  </div>
</div>
<?php } ?>
<?php if(!empty($invoice->additionaNotes)){ ?>
<div class="panel panel-default hidden-xs">
  <div class="panel-heading"><?php echo trans('0178');?></div>
  <div class="panel-body">
    <p><?php echo $invoice->additionaNotes;?></p>
  </div>
</div>
<?php } ?>
<div class="panel panel-default  hidden-xs">
  <div class="panel-heading  hidden-xs">
    <strong><?php echo trans('076');?> <?php echo trans('0434');?></strong> : <span class="weak"> <?php echo $invoice->id; ?> </span> <strong><?php echo trans('0398');?></strong> <?php echo $invoice->code; ?>
  </div>
</div>
<div class="col-md-8 hidden-xs">
  <p><strong><?php echo trans('07');?> : </strong> <?php echo $invoice->checkin; ?> <strong><?php echo trans('09');?> : </strong> <?php echo $invoice->checkout; ?> </p>
  <p><span class="strong"> <?php echo trans('0435');?> </span> : <?php echo $invoice->subItem->title;?>  <span class="text-primary strong"><?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->price;?></span><br>
    <span class="strong"> <?php echo trans('0123');?> ( <?php echo $invoice->subItem->quantity;?> )   </span> <span class="text-primary strong"><?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->total;?></span><br>
    <?php if($invoice->extraBeds > 0){ ?>
    <span class="strong"> <?php echo trans('0428');?> ( <?php echo $invoice->extraBeds; ?> )</span> <span class="text-primary strong"><?php echo $invoice->currSymbol; ?><?php echo $invoice->extraBedsCharges; ?></span><br>
    <?php } ?>
    <strong><?php echo trans('0122');?> ( <?php echo $invoice->nights;?> )</strong> <span class="text-primary strong"><?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->totalNightsPrice;?> </span>
  </p>
</div>
<div class="col-md-4">
  <aside class="sidebar-right">

     <!-- discount alert -->
     <?php if($invoice->couponRate > 0){ ?>
    <div style="margin-bottom:0px;padding: 5px;" class="alert alert-success"><i class="text-success fa fa-check"></i> <?php echo trans('0518');?> <?php echo $invoice->couponRate; ?>%</div>
     <?php } ?> <!-- discount alert -->

    <strong><?php echo trans('0153');?> </strong> : <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo number_format($invoice->tax, 0);?>
    <h3 style="margin:0px"><strong><?php echo trans('0124');?> </strong> : <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo number_format($invoice->checkoutTotal, 0);?></h3>
    <span style="color:#d4d4d4" >--------------------------------------- </span>
    <br>
    <strong class="text-success"><?php echo trans('0126');?> </strong> : <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo number_format($invoice->checkoutAmount,0); ?>
  </aside>
</div>
<div class="clearfix"></div>
<!-- /.modal-content -->