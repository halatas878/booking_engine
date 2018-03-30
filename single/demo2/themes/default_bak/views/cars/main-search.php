<?php  if(pt_main_module_available('cars')){ ?>

<form style="margin-top:-20px" method="GET" action="<?php echo base_url();?>cars/search">
   <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 go-right">
      <div class="form-group">
            <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0210');?></label>
         <select name="pickupLocation" class="chosen-select RTL" required >
        <option><?php echo trans('0447');?></option>
        <?php foreach($carspickuplocationsList as $locations): ?>
        <option value="<?php echo $locations->id;?>"><?php echo $locations->name;?></option>
        <?php endforeach; ?>
      </select>
      </div>
   </div>

   <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
      <div class="form-group">
            <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0211');?></label>
          <select name="dropoffLocation" class="chosen-select RTL" required >
        <option><?php echo trans('0447');?></option>
        <?php foreach($carsdropofflocationsList as $locations): ?>
        <option value="<?php echo $locations->id;?>"><?php echo $locations->name;?></option>
        <?php endforeach; ?>
      </select>
      </div>
   </div>

   <div class="col-md-6 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
         <div class="clearfix"></div>
         <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('08');?></label>
      <input type="text" class="form-control RTL" id="carchkin" name="pickupDate" placeholder="<?php echo trans('08');?>" value="<?php echo $checkin; ?>" required>
      </div>
   </div>

    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
         <div class="clearfix"></div>
         <label class="control-label go-right"><i class="icon_set_1_icon-38"></i> <?php echo trans('0259');?></label>
         <select class="form-control" name="pickupTime">
        <?php foreach($carModTiming as $time){ ?>
        <option value="<?php echo $time; ?>" <?php makeSelected('10:00',$time); ?> ><?php echo $time; ?></option>
        <?php } ?>
        </select>
      </div>

   </div>


  <div class="col-md-6 col-sm-6 col-xs-6 go-right">
    <div class="form-group">
      <label class="go-right"><i class="icon-thumbs-up-4"></i> <?php echo trans('0214');?></label>
      <select class="form-control selectx" name="type" id="cartype" >
        <option value=""> <?php echo trans('0158');?></option>
        <?php foreach($cartypes as $ctype){ ?>
        <option value="<?php echo $ctype->id; ?>"><?php echo $ctype->name; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>

    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
    <div class="form-group">
      <label class="go-right"><i class="icon-paper-plane-2"></i> <?php echo trans('0207');?></label>
      <select  name="pickup" class="form-control selectx">
      <option value=""><?php echo trans('0158');?></option>
       <option value="yes"><?php echo trans('0363');?></option>
       <option value="no"><?php echo trans('0364');?></option>
      </select>
    </div>
  </div>


    <div class="clearfix"></div>
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
    <div class="form-group">
      <button type="submit" id="searchform" class="btn btn-primary btn-block btn-lg"><?php echo trans('012');?></button>
    </div>
  </div>
   <div class="clearfix"></div>
   </form>

<?php } ?>