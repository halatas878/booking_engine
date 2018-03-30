<?php  if(pt_main_module_available('hotels')){ ?>
<form action="<?php echo base_url();?>hotels/search" method="GET" role="search">
  <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 go-right">
    <div class="form-group">
      <label class="control-label go-right"><?php echo trans('0254');?></label>
      <div class="clearfix"></div>
      <select name="searching" class="chosen-select RTL" style="background-color: white;" id="hotelicon" value="<?php if(!empty($_GET['searching'])){ echo $_GET['searching']; } ?>" required >
        <option value=""><?php echo trans('0447');?></option>
        <?php foreach($hotelslocationsList as $locations): ?>
        <option value="<?php echo $locations->id;?>"><?php echo $locations->name;?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <br>
  <div class="col-md-6 col-sm-6 col-xs-6 go-right">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label go-right"><?php echo trans('07');?></label>
      <input type="text" placeholder=" <?php echo trans('07');?> " name="checkin" class="form-control mySelectCalendar dpd1 go-text-left" value="<?php echo $checkin; ?>" required >
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-6 go-right">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label go-right"><?php echo trans('09');?></label>
      <input type="text" placeholder=" <?php echo trans('09');?> " name="checkout" class="form-control mySelectCalendar dpd2 go-text-left" value="<?php echo $checkout; ?>" required >
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-6 col-xs-6">
    <span class="size13 go-right"><b><?php echo trans('010');?></b></span>
    <select class="form-control selectx" name="adults">
      <option>1</option>
      <option selected>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="col-md-6 col-xs-6">
    <span class="size13 go-right"><b><?php echo trans('011');?></b></span>
    <select class="form-control selectx" name="child">
      <option selected>0</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label">&nbsp;</label>
      <br><br>
      <div class="clearfix"></div>
      <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo trans('012');?></button>
    </div>
  </div>
</form>
<?php } ?>
<div class="clearfix"></div>