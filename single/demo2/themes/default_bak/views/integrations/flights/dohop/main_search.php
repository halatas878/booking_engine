<?php  if(pt_main_module_available('flightsdohop')){ ?>
<style>
  .autosuggest {
  margin-left: -1px;
  position: absolute;
  z-index: 10003;
  cursor: pointer;
  color: rgba(99, 99, 99, 0.83);
  width: 92.5%;
  margin-top: -1px;
  padding-right: 0px !important;
  padding-left: 0px !important;
  border-radius: 0px 0px 4px 4px;
  }
  .autosuggest ul {
  list-style: none;
  padding: 0;
  margin-bottom: 0;
  background-color: #3D51B4;
  color: #fff;
  }
  .autosuggest ul li {
  padding: 5px 10px;
  border-bottom: 1px solid;
  }
  .autosuggest ul li:hover {
  color: #fff;
  background: #3875d7;
  }
  .autosuggest ul li:last-child {
  border-bottom: none;
  }
  .highlight {
  background: white;
  color: #595959;
  }
</style>
<form action="//whitelabel.dohop.com/w/<?php echo $dohopusername;?>/" method="GET" target="_blank">
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right">
    <div class="form-group">
      <span class="opensans size13 go-right"><b><i class="icon-plane"></i> <?php echo trans('0119');?></b></span>
      <input required id="a1" name="a1" type="text" class="form-control input-lg RTL search-location form-control-icon sterm" placeholder="<?php echo trans('0273');?>" autocomplete="off" required />
      <div id="a1resp" class="autosuggest col-md-11 col-sm-11"></div>
    </div>
  </div>
  <br>
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right">
    <span class="opensans size13 go-right"><b><i style="position:absolute; -webkit-transform:  rotate(181deg);-moz-transform:  rotate(181deg);-o-transform:  rotate(181deg);writing-mode: lr-tb;" class="icon-plane"></i> <span style="margin-left:20px"><?php echo trans('0120');?></span></b></span>
    <input required id="a2" name="a2" type="text" class="form-control RTL input-lg search-location form-control-icon sterm" placeholder="<?php echo trans('0274');?>" autocomplete="off" required />
    <div id="a2resp" class="autosuggest col-md-11 col-sm-11"></div>
  </div>
  <br>
  <div class="clearfix"></div>
  <br/>
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
    <div class="w50percent">
      <div class="wh90percent textleft">
        <span class="opensans size13  go-right"><b><?php echo trans('0472');?></b></span>
        <input type="text" class="form-control mySelectCalendar go-text-left checkinsearch RTL dpfd1" name="d1" value="" placeholder="<?php echo trans('08');?>" required />
      </div>
    </div>
    <div class="w50percentlast">
      <div class="wh90percent textleft right">
        <span class="opensans size13  go-right"><b><?php echo trans('0473');?></b></span>
        <input type="text" class="form-control mySelectCalendar checkinsearch RTL dpfd2 go-text-left" name="d2" value="" placeholder="<?php echo trans('08');?>" />
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right">
    <div class="form-group">
      <div class="clearfix"></div>
      <label class="control-label">&nbsp;</label>
      <br><br>
      <div class="clearfix"></div>
      <input type="submit" value="<?php echo trans('012');?>" class="btn btn-primary btn-lg btn-block">
    </div>
  </div>
</form>
<div class="clearfix"></div>
<?php } ?>