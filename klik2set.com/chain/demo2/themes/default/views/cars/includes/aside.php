<div class="col-md-5 go-right">
   <form  action="<?php echo base_url();?>cars/book/<?php echo $car->slug;?>" method="GET" role="search">
  <div class="row form-group">
    <div class="col-md-4 col-xs-4">
      <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0210');?></label>
    </div>
    <div class="col-md-6 col-xs-4">
      <select name="pickupLocation" class="chosen-select RTL" id="pickuplocation" required>
          <option value=""><?php echo trans('0447');?></option>
          <?php foreach($carspickuplocationsList as $locations): ?>
          <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selectedpickupLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
          <?php endforeach; ?>
        </select>
    </div>
  </div>
  <div class="row form-group">
    <div class="col-md-4 col-xs-4">
      <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0211');?></label>
    </div>
    <div class="col-md-6 col-xs-4">
     <select name="dropoffLocation" class="chosen-select RTL" id="droplocation" required>
          <option value=""><?php echo trans('0447');?></option>
          <?php if(!empty($selecteddropoffLocation)){ foreach($carsdropofflocationsList as $locations): ?>
          <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selecteddropoffLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
          <?php endforeach; } ?>
        </select>
    </div>
  </div>

    <div class="row form-group">
      <div class="col-md-4 col-xs-4">
        <label class="control-label go-right"><i class="icon_set_1_icon-53"></i> <?php echo trans('08');?></label>
      </div>
      <div class="col-md-4 col-xs-4">
        <input id="carchkin" name="pickupDate" value="<?php echo $car->date;?>" placeholder="date" type="text" class="form-control">
      </div>
      <div class="col-md-4 col-xs-4">
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-4 col-xs-4">
        <label class="control-label go-right"><i class="icon_set_1_icon-52"></i> <?php echo trans('0259');?></label>
      </div>
      <div class="col-md-4 col-xs-4">
        <select class="form-control input" name="pickupTime">
          <?php foreach($carModTiming as $time){ ?>
          <option value="<?php echo $time; ?>" <?php makeSelected($pickupTime,$time); ?> ><?php echo $time; ?></option>
          <?php } ?>
        </select>
      </div>

    </div>
  <hr>
    <?php if($car->showTotal){ ?>
    <div class="mtb0 col-md-6  col-xs-6 well well-sm text-center">
      <h4 class="totalCost"><?php echo trans('078');?> <?php echo $car->currCode;?> <?php echo $car->currSymbol;?><Strong><?php echo $car->totalCost;?></Strong></h4>
    </div>
    <div class="col-md-6  col-xs-6 h4">
      <small> <?php echo trans('0153');?> <span class="totaldeposit"> <?php echo $car->currCode;?> <?php echo $car->currSymbol;?><?php echo $car->taxAmount;?></span> </small>
      <div class="clearfix"></div>
      <small> <?php echo trans('0126');?> <span class="totaldeposit"> <?php echo $car->currCode;?> <?php echo $car->currSymbol;?><?php echo $car->totalDeposit;?></span> </small>
    </div>
    <?php } ?>

    <div class="clearfix"></div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <input type="hidden" name="date" value="<?php echo $car->date;?>">
        <button type="submit" class="btn btn-block btn-primary btn-lg"><?php echo trans('0142');?></button>
      </div>
    </div>
  </form>
  <input type="hidden" id="loggedin" value="<?php echo $customerloggedin;?>" />
  <input type="hidden" id="itemid" value="<?php echo $car->id; ?>" />
  <input type="hidden" id="module" value="cars" />
  <input type="hidden" id="addtxt" value="<i class='fa fa-star'></i> <?php echo trans('029');?>" />
  <input type="hidden" id="removetxt" value="<i class='fa fa-remove'></i> <?php echo trans('028');?>" />
  <div class="form-group"></div>
  <?php $currenturl = current_url(); $wishlist = pt_check_wishlist($customerloggedin,$car->id,"cars"); if($allowreg){ if($wishlist){ ?>
  <span class="btn wish btn-danger btn-outline btn-block btn-lg removewishlist"><span class="wishtext"><i class="icon_set_1_icon-82"></i> <?php echo trans('028');?></span></span>
  <br>
  <p class="text-center"><a style="color:#666666" href="#terms"><?php echo trans('007');?> <?php echo trans('057');?></a></p>
  <?php }else{ ?>
  <span class="btn wish btn-block btn-lg addwishlist btn-danger btn-outline"><span class="wishtext"><i class="icon_set_1_icon-82"></i> <?php echo trans('029');?></span></span>
  <?php } } ?>
</div>