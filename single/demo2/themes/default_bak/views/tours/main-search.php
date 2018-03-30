<?php  if(pt_main_module_available('tours')){ ?>
<form method="GET" action="<?php echo base_url();?>tours/search">
  <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 go-right">
    <div class="form-group">
      <label class="control-label go-right size13"><?php echo trans('0254');?></label>
      <select name="location" class="chosen-select RTL" id="location" required >
        <option><?php echo trans('0447');?></option>
        <?php foreach($locationsList as $locations): ?>
        <option value="<?php echo $locations->id;?>"><?php echo $locations->name;?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <br>
  <div class="clearfix"></div>
  <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 go-righ">
    <div class="form-group">
      <label class="go-right size13"><?php echo trans('0222');?></label>
      <select class="chosen-select RTL" name="type" id="tourtype" required >
        <option value=""> <?php echo trans('0158');?></option>
      </select>
    </div>
  </div>
  <br>
  <div class="clearfix"></div>
  <div class="col-md-6 col-sm-6 col-xs-6 go-right">
    <div class="form-group">
      <label class="go-right size13"> <?php echo trans('08');?></label>
      <input type="text" class="form-control mySelectCalendar go-text-left" name="date" id="tchkin" name="checkout" placeholder="<?php echo trans('08');?>" value="<?php echo $checkin; ?>" required>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="go-right size13"> <?php echo trans('0446');?></label>
      <select class="form-control" name="adults">
        <option >0</option>
        <option>1</option>
        <option selected>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label">&nbsp;</label>
      <br>
      <div class="clearfix"></div>
      <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo trans('012');?></button>
    </div>
  </div>
</form>
<div class="clearfix"></div>
<?php } ?>