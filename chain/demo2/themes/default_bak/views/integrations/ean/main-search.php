 <?php  if(pt_main_module_available('ean')){ ?>

     <form action="<?php echo base_url();?>ean/search" method="GET">
  <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
    <div class="form-group">
          <label class="control-label go-right"><i class="icon-location-6"></i> <?php echo trans('0254');?></label>
        <input required id="HotelsPlacesEan" name="city" type="text" class="form-control input-lg RTL search-location form-control-icon" placeholder="<?php echo trans('026');?>" required />
    </div>
  </div>
  <br>
  <div class="col-md-6 col-sm-6 col-xs-6">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
                    <input type="text" class="form-control-icon form-control checkinsearch RTL icon-calendar dpean1" name="checkIn" value="<?php echo $eancheckin;?>" placeholder="<?php echo trans('08');?>" required />
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-6">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
                    <input type="text" class="form-control-icon form-control checkinsearch RTL icon-calendar dpean2" name="checkOut" value="<?php echo $eancheckout;?>" placeholder="<?php echo trans('08');?>" required />
    </div>
  </div>
  <br>
  <div class="clearfix"></div>

  <div class="col-md-6 col-sm-6 col-xs-6">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label go-right"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
      <div class="clearfix"></div>
      <select  class="form-control selectx" placeholder=" <?php echo trans('010');?> " name="adults" id="">
        <option value="">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>


    </div>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-6">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label go-right"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
      <select  class="form-control selectx childcount" placeholder=" <?php echo trans('011');?> " name="child" id="child">
        <option value="">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
    </div>
  </div>
   <div class="clearfix"></div>
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label">&nbsp;</label>
      <input type="hidden" name="childages" id="childages" value="">
      <input type="hidden" name="search" value="search" >

      <button type="submit" class="btn btn-block btn-primary btn-lg"><?php echo trans('012');?></button>
   </div>
  </div>
</form>



<script>
 $(function() {
    google.maps.event.addDomListener(window,"load",function(){new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan"))});
});
</script>

<style>
.modal-backdrop {
    z-index: 99;
}
</style>

<div class="clearfix"></div>
         <?php } ?>

         <?php include 'ages.php'; ?>