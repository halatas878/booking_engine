<style>
.panel { border: solid 1px #D6D6D6; box-shadow: none !important; }
 aside.sidebar-right { padding-left: 30px; border-left: 1px solid #d4d4d4; }
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
      <div class="panel-body hidden-xs">
        <div class="row">
          <div class="col-md-2">
            <img class="img-responsive" src="<?php echo $invoice->thumbnail;?>" alt="" />
          </div>
          <div class="col-md-10">
            <p class="strong"> <?php echo $invoice->title;?></p>
            <p> <?php echo $invoice->location;?> </p>
            <h5><?php echo $invoice->stars;?></h5>
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
      <div class="col-md-2">
        <img class="img-responsive" src="<?php echo PT_CARS_EXTRAS_IMAGES.$extra->thumbnail;?>" alt="">
      </div>
      <div class="col-md-10">
        <p class="strong"><?php echo $extra->title;?></p>
        <p> <?php echo $invoice->currCode." ".$invoice->currSymbol.$extra->price;?> </p>
      </div>     
    </div>
    <hr>
     <?php } ?>
  </div>
</div>
<?php } ?>

    <?php if(!empty($invoice->additionaNotes)){ ?>
       <div class="panel panel-default">
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

       <p><strong><?php echo trans('08');?> : </strong> <?php echo $invoice->bookedItemInfo->pickupDate; ?> </p>
       <p><strong><?php echo trans('0210');?> : </strong> <?php echo $invoice->bookedItemInfo->pickupLocation; ?><br>
       <strong><?php echo trans('0211');?> : </strong> <?php echo $invoice->bookedItemInfo->dropoffLocation; ?><br>
       <strong><?php echo trans('0210');?> <?php echo trans('0259'); ?> : </strong> <?php echo $invoice->bookedItemInfo->pickupTime; ?><br>

      </div>
      <div class="col-md-4">
      <aside class="sidebar-right">
       <!-- discount alert -->
     <?php if($invoice->couponRate > 0){ ?>
    <div style="margin-bottom:0px;padding: 5px;" class="alert alert-success"><i class="text-success fa fa-check"></i> <?php echo trans('0518');?> <?php echo $invoice->couponRate; ?>%</div>
     <?php } ?> <!-- discount alert -->

      <?php if($invoice->tax > 0){ ?>  <p><strong><?php echo trans('0153');?> </strong> : <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo number_format($invoice->tax, 0);?></p> <?php } ?>
      <h3 style="margin:0px"><strong><?php echo trans('0124');?> </strong> : <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo number_format($invoice->checkoutTotal, 0);?></h3>
      <span style="color:#d4d4d4" >--------------------------------------- </span>
      <br>
      <strong class="text-success"><?php echo trans('0126');?> </strong> : <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo number_format($invoice->checkoutAmount, 0); ?>
    </aside>
    </div>

      <div class="clearfix"></div>




 <!-- /.modal-content -->
