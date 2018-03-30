<nav class="navbar navbar-top list-nav navbar-static-top">
  <div class="container">
   <div class="row">
    <div class="collapse navbar-collapse" id="header">
      <form action="<?php echo base_url();?>hotels/search" method="GET">
        <div class="col-md-3 col-lg-4 col-sm-12 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon-location-6"></i> <?php echo trans('0254');?></label>
            <select name="searching" class="chosen-select" style="background-color: white;" id="location" value="<?php if(!empty($_GET['searching'])){ echo $_GET['searching']; } ?>" required >
              <option><?php echo trans('0447');?></option>
              <?php foreach($modulelocationsList as $locations): ?>
              <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selectedLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
            <input type="text" placeholder="<?php echo trans('07');?> " name="checkin" class="form-control dpd1" value="<?php echo $checkin; ?>" required >
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
            <input type="text" placeholder="<?php echo trans('09');?> " name="checkout" class="form-control dpd2" value="<?php echo $checkout; ?>" required >
          </div>
        </div>
        <div class="col-md-2 col-lg-1 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
            <select  required class="form-control" placeholder=" <?php echo trans('');?> " name="adults" id="adults">
              <option value="">0</option>
              <?php for($Selectadults = 1; $Selectadults < 11;$Selectadults++){ ?>
              <option value="<?php echo $Selectadults;?>" <?php if($Selectadults == $modulelib->adults){ echo "selected"; } ?> > <?php echo $Selectadults;?> </option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="hidden-md col-lg-1 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
            <select  class="form-control" placeholder=" <?php echo trans('011');?> " name="child" id="child">
              <option value="">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
        </div>
        <div class="col-md-3 col-lg-2 col-xs-12 col-sm-12 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label">&nbsp;</label>
            <button type="submit" class="btn btn-block btn-warning btn-lg"><?php echo trans('012');?></button>
          </div>
        </div>
      </form>
    </div>
  </div>
 </div>
</nav>
<div class="collapse" id="collapseMap">
  <div id="map" class="map"></div>
</div>
<!-- End Map -->
<div  class="container margin_20">
  <div class="row">
    <form  action="<?php echo base_url();?>hotels/search" method="GET" role="search">
      <aside class="col-lg-3 col-md-3">
        <p>
          <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">View on map</a>
        </p>
        <div id="filters_col">
          <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i><?php echo trans('0191');?> <i class="icon-plus-1 pull-right"></i></a>
          <div class="collapse" id="collapseFilters">
            <div class="filter_type">
              <h6><?php echo trans('0478');?></h6>
              <?php @$vartype = $_GET['type'];
                if(empty($vartype)){
                $vartype = array();
                }
                foreach($moduleTypes as $htype){
                ?>
              <input type="checkbox" value="<?php echo $htype['id'];?>" <?php if(in_array($htype['id'],$vartype)){echo "checked";}?> name="type[]" id="<?php echo $htype['name'];?>" class="checkbox go-right" /> <label for="<?php echo $htype['name'];?>" class="css-label">&nbsp;&nbsp;<?php echo $htype['name'];?></label>
              <div class="clearfix"></div>
              <?php } ?>
              <div class="filter_type">
                <h6><?php echo trans('0301');?> <?php echo @$minprice;?> to <?php echo @$maxprice;?></h6>
                <div class="text-center">
                  <?php if(!empty($_GET['price'])){
                    $selectedprice = $_GET['price'];
                    }else{
                    $selectedprice =  $minprice.",".$maxprice;
                    }?>
                  <input type="text" class="col-md-12" value="" data-slider-min="<?php echo @$minprice;?>" data-slider-max="<?php echo @$maxprice;?> " data-slider-step="100" data-slider-value="[<?php echo $selectedprice;?>]" id="sl2" name="price">
                </div>
                <script>
                  $(function(){
                  $('#sl1').slider({
                  formater: function(value) {
                  return 'Current value: '+value;
                  }
                  });
                  $('#sl2').slider();
                  });
                </script>
                <script src="<?php echo $theme_url; ?>assets/js/bootstrap-slider.js"></script>
                <div class="filter_type">
                  <h6><?php echo trans('0137');?> <?php echo trans('069');?></h6>
                  <?php $star = '<i class="star text-warning fa fa-star icon-star voted"></i>'; ?>
                  <?php $stars = '<i class="icon-star-empty"></i>'; ?>
                  <div  class="rating" style="font-size: 14px;">
                    <div><input id="1" type="radio" name="stars" class="radio" value="1" <?php if(@$_GET['stars'] == "1"){echo "checked";}?>>&nbsp;&nbsp;<label for="1"><?php echo $star; ?><?php for($i=1;$i<=6;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div><input id="2" type="radio" name="stars" class="radio" value="2" <?php if(@$_GET['stars'] == "2"){echo "checked";}?>>&nbsp;&nbsp;<label for="2"><?php for($i=1;$i<=2;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=5;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div><input id="3" type="radio" name="stars" class="radio" value="3" <?php if(@$_GET['stars'] == "3"){echo "checked";}?>>&nbsp;&nbsp;<label for="3"><?php for($i=1;$i<=3;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=4;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div><input id="4" type="radio" name="stars" class="radio" value="4" <?php if(@$_GET['stars'] == "4"){echo "checked";}?>>&nbsp;&nbsp;<label for="4"><?php for($i=1;$i<=4;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=3;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div><input id="5" type="radio" name="stars" class="radio" value="5" <?php if(@$_GET['stars'] == "5"){echo "checked";}?>>&nbsp;&nbsp;<label for="5"><?php for($i=1;$i<=5;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=2;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div><input id="7" type="radio" name="stars" class="radio" value="7" <?php if(@$_GET['stars'] == "7"){echo "checked";}?>>&nbsp;&nbsp;<label for="7"><?php for($i=1;$i<=7;$i++){ ?> <?php echo $star; ?> <?php } ?></label></div>
                  </div>
                </div>
                <h6><?php echo trans('0249');?></h6>
                <?php @$varAmt = $_GET['amenities'];
                  if(empty($varAmt)){
                  $varAmt = array();
                  }
                  foreach($moduleAmenities as $hamt){
                  ?>
                <input type="checkbox" value="<?php echo $hamt['id'];?>" <?php if(in_array($hamt['id'],$varAmt)){echo "checked";}?> name="amenities[]" id="<?php echo $hamt['name'];?>" class="checkbox" /><label for="<?php echo $hamt['name'];?>" class="css-label"> <img style="height: 22px;margin-right:5px;margin-left:5px" src="<?php echo $hamt['icon'];?>">  <?php echo $hamt['name'];?></label>
                <div class="clearfix"></div>
                <?php } ?>
              </div>
            </div>
            <hr>
            <input type="hidden" name="searching" value="<?php echo $selectedLocation;?>">
            <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
            <button type="submit" class="btn btn-primary btn-lg btn-block" id="searchform"><?php echo trans('012');?></button>
          </div>
          <!--End collapse -->
        </div>
        <!--End filters col-->
        <?php if(!empty($phone)){ ?>
        <div class="box_style_2">
          <i class="icon_set_1_icon-57"></i>
          <h4><span><?php echo trans('061');?></span></h4>
          <a href="tel://<?php echo $phone; ?>" class="phone">+<?php echo $phone; ?></a>
          <!--<small>Monday to Friday 9.00am - 7.30pm</small>-->
        </div>
        <?php } ?>
      </aside>
      <!--End aside -->
    </form>
    <div class="col-lg-9 col-md-9">
      <?php if(!empty($module)){ foreach($module as $item){ ?>
      <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4">
          <?php echo wishListInfo($currentModule, $item->id); ?>
          <div class="img_list">
              <a href="<?php echo $item->slug;?>">
                <!--<div class="ribbon popular" ></div>-->
                <img src="<?php echo $item->thumbnail;?>" alt="">
                <div class="short_info"></div>
              </a>
            </div>
          </div>
          <div class="clearfix visible-xs-block"></div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="tour_list_desc">
              <?php if(pt_is_module_enabled('reviews')){ ?>
              <div id="score"><i class="icon-thumbs-up-4"></i> <?php echo $item->avgReviews->totalReviews; ?><span><?php echo $item->avgReviews->overall; ?></span></div>
              <?php } ?>
              <h3><strong><?php echo character_limiter($item->title,15);?></strong></h3>
              <div class="rating"><a href="javascript:void(0);" onclick="showMap('<?php echo base_url();?>home/maps/<?php echo $item->latitude; ?>/<?php echo $item->longitude; ?>/hotel/<?php echo $item->id;?>','modal');"><i class="icon-location-6"></i> <?php echo $item->location;?> </a> <?php echo $item->stars;?></div>
              <p class="hidden-xs"><?php echo character_limiter($item->desc,220);?></p>
              <ul class="add_info hidden-sm hidden-xs">
                <?php $cnt = 0; foreach($item->amenities as $amt){ $cnt++; if($cnt <= 10){ if(!empty($amt['name'])){ ?>
                <img title="<?php echo $amt['name'];?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt['icon'];?>" alt="<?php echo $amt['name'];?>" />
                <?php } } } ?>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="price_list">
              <div><?php  if($item->price > 0){ ?>
                <sup><!--<?php echo $item->currCode;?>--> <?php echo $item->currSymbol; ?></sup>
                <?php echo $item->price;?><small><br><?php echo trans('0299');?></small><?php } ?>
                <p><a href="<?php echo $item->slug;?>" class="btn btn-primary btn-lg btn-block"><?php echo trans('0177');?></a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

      <div class="clearfix"></div>
      <hr class="row" style="border-top: 1px solid #D9D9D9 !important;margin:0px 0px 0px 0px !important">
      <div class="clearfix"></div>
      <div class="pull-left"><?php echo createPagination($info);?></div>
      <div class="pull-right">
        <?php }else{  echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
      </div>
      <!-- End col lg-9 -->
    </div>
    <!-- End row -->
  </div>
</div>
<!-- End container -->
<script src="<?php echo $theme_url; ?>/assets/js/icheck.js"></script>
<script>
  $('input').iCheck({
     checkboxClass: 'icheckbox_square-grey',
     radioClass: 'iradio_square-grey'
   });

</script>
<!-- Map -->
<script src="<?php echo $theme_url; ?>/assets/js/map_hotels.js"></script>
<!-- PHPtravels Modal Starting-->
<div class="modal fade" id="datepicker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-calendar text-primary"></i> <?php echo trans('0232');?></h4>
      </div>
      <form method="GET" id="frm" action="" class="my-form">
        <div class="modal-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="checkIn" class="control-label"><?php echo trans('07');?></label>
              <input class="form-control" type="text" id="dpd5" placeholder="From" value="" name="checkin" required >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="checkIn" class="control-label"><?php echo trans('09');?></label>
              <input class="form-control" id="dpd6" type="text" placeholder="To" value="" name="checkout" required >
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="adults" class="control-label"><?php echo trans('010');?></label>
              <select  required class="form-control" placeholder="<?php echo trans('010');?>" name="adults" id="adults">
                <option value=""><?php echo trans('010');?></option>
                <?php for($Selectadults = 1; $Selectadults < 11;$Selectadults++){ ?>
                <option value="<?php echo $Selectadults;?>" <?php if($Selectadults == $modulelib->adults){ echo "selected"; } ?> > <?php echo $Selectadults;?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="child" class="control-label"><?php echo trans('011');?></label>
              <select  class="form-control" placeholder="<?php echo trans('011');?>" name="child" id="child">
                <option value="">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="btn" class="control-label">&nbsp;</label>
              <button type="submit" class="btn btn-block btn-success"><?php echo trans('0419');?></button>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- PHPtravels Modal Ending-->
<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="height:400px">
      <div class="mapContent">
      </div>
    </div>
  </div>
</div>

 <script>
    $('#collapseMap').on('shown.bs.collapse', function(e){
    (function(A) {

    if (!Array.prototype.forEach)
    	A.forEach = A.forEach || function(action, that) {
    		for (var i = 0, l = this.length; i < l; i++)
    			if (i in this)
    				action.call(that, this[i], i, this);
    		};

    	})(Array.prototype);

    	var
    	mapObject,
    	markers = [],
    	markersData = {

    		'map-red': [
        <?php foreach($module as $item): ?>
    		{
    			name: 'hotel name',
    			location_latitude: "<?php echo $item->latitude;?>",
    			location_longitude: "<?php echo $item->longitude;?>",
    			map_image_url: "<?php echo $item->thumbnail;?>",
    			name_point: "<?php echo $item->title;?>",
    			description_point: "<?php echo character_limiter($item->desc,75);?><br>",
    			url_point: "<?php echo $item->slug;?>"
    		},
        <?php endforeach; ?>
        
    		],


    	};


    		var mapOptions = {
          <?php if(empty($_GET)){ ?>
    			zoom: 2,
          <?php }else{ ?>
           zoom: 12,          
          <?php } ?>
    			center: new google.maps.LatLng(<?php echo $item->latitude;?>, <?php echo $item->longitude;?>),
    			mapTypeId: google.maps.MapTypeId.ROADMAP,

    			mapTypeControl: false,
    			mapTypeControlOptions: {
    				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
    				position: google.maps.ControlPosition.LEFT_CENTER
    			},
    			panControl: false,
    			panControlOptions: {
    				position: google.maps.ControlPosition.TOP_RIGHT
    			},
    			zoomControl: true,
    			zoomControlOptions: {
    				style: google.maps.ZoomControlStyle.LARGE,
    				position: google.maps.ControlPosition.TOP_RIGHT
    			},
    			scrollwheel: false,
    			scaleControl: false,
    			scaleControlOptions: {
    				position: google.maps.ControlPosition.TOP_LEFT
    			},
    			streetViewControl: true,
    			streetViewControlOptions: {
    				position: google.maps.ControlPosition.LEFT_TOP
    			},
    			styles: [/*map styles*/]
    		};
    		var
    		marker;
    		mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
    		for (var key in markersData)
    			markersData[key].forEach(function (item) {
    				marker = new google.maps.Marker({
    					position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
    					map: mapObject,
    					icon: '<?php echo base_url(); ?>assets/img/' + key + '.png',
    				});

    				if ('undefined' === typeof markers[key])
    					markers[key] = [];
    				markers[key].push(marker);
    				google.maps.event.addListener(marker, 'click', (function () {
         closeInfoBox();
         getInfoBox(item).open(mapObject, this);
         mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
        }));

    });

    	function hideAllMarkers () {
    		for (var key in markers)
    			markers[key].forEach(function (marker) {
    				marker.setMap(null);
    			});
    	};

    	function closeInfoBox() {
    		$('div.infoBox').remove();
    	};

    	function getInfoBox(item) {
    		return new InfoBox({
    			content:
    			'<div class="marker_info" id="marker_info">' +
    			'<img style="width:280px;height:140px" src="' + item.map_image_url + '" alt="<?php echo character_limiter($module->title, 80);?>"/>' +
    			'<h3>'+ item.name_point +'</h3>' +
    			'<span>'+ item.description_point +'</span>' +
    			'<a href="'+ item.url_point + '" class="btn_1"><?php echo trans('0177');?></a>' +
    			'</div>',
    			disableAutoPan: true,
    			maxWidth: 0,
    			pixelOffset: new google.maps.Size(40, -190),
    			closeBoxMargin: '0px -20px 2px 2px',
    			closeBoxURL: "<?php echo $theme_url; ?>assets/img/close.png",
    			isHidden: false,
    			pane: 'floatPane',
    			enableEventPropagation: true
    		}); };  });
  </script>
  <script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>

<!-- End Map Modal -->
<script src="<?php echo $theme_url; ?>assets/include/icheck/icheck.min.js"></script>
<link href="<?php echo $theme_url; ?>assets/include/icheck/square/grey.css" rel="stylesheet">
<script>
  var cb, optionSet1;
      $(".checkbox").iCheck({
        checkboxClass: "icheckbox_square-grey",
        radioClass: "iradio_square-grey"
      });

      $(".radio").iCheck({
        checkboxClass: "icheckbox_square-grey",
        radioClass: "iradio_square-grey"
      });
</script>
<style>

label {
    cursor: pointer;
}

.list-nav {
    margin-top: -0px;
    margin-bottom: -0px;
    padding-top: 15px;
    background-color: #333;
    color:#fff;
    z-index: 0;
}

  /* Price Range Slider */
  .slider {
  display: inline-block;
  vertical-align: middle;
  position: relative;
  }
  .slider.slider-horizontal {
  width: 85% !important;
  height: 20px;
  padding-right :5px;
  }
  .slider.slider-horizontal .slider-track {
  height: 5px;
  width: 100%;
  margin-top: -5px;
  top: 50%;
  left: 0;
  }
  .slider.slider-horizontal .slider-selection {
  height: 100%;
  top: 0;
  bottom: 0;
  }
  .slider.slider-horizontal .slider-handle {
  margin-left: -10px;
  margin-top: -9px;
  }
  .slider.slider-horizontal .slider-handle.triangle {
  border-width: 0 10px 10px 10px;
  width: 0;
  height: 0;
  border-bottom-color: #0480be;
  margin-top: 0;
  }
  .slider.slider-vertical {
  height: 210px;
  width: 20px;
  }
  .slider.slider-vertical .slider-track {
  width: 5px;
  height: 100%;
  margin-left: -5px;
  left: 50%;
  top: 0;
  }
  .slider.slider-vertical .slider-selection {
  width: 100%;
  left: 0;
  top: 0;
  bottom: 0;
  }
  .slider.slider-vertical .slider-handle {
  margin-left: -5px;
  margin-top: -10px;
  }
  .slider.slider-vertical .slider-handle.triangle {
  border-width: 10px 0 10px 10px;
  width: 1px;
  height: 1px;
  border-left-color: #0480be;
  margin-left: 0;
  }
  .slider input {
  display: none;
  }
  .slider .tooltip-inner {
  white-space: nowrap;
  }
  .slider-track {
  position: absolute;
  cursor: pointer;
  background-color: #f7f7f7;
  background-image: -moz-linear-gradient(top, #f5f5f5, #f9f9f9);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f5f5f5), to(#f9f9f9));
  background-image: -webkit-linear-gradient(top, #f5f5f5, #f9f9f9);
  background-image: -o-linear-gradient(top, #f5f5f5, #f9f9f9);
  background-image: linear-gradient(to bottom, #f5f5f5, #f9f9f9);
  background-repeat: repeat-x;
  filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#fff5f5f5', endColorstr='#fff9f9f9', GradientType=0);
  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  }
  .slider-selection {
  position: absolute;
  background-color: #EF3E3A;
  background-repeat: repeat-x;
  filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#fff9f9f9', endColorstr='#fff5f5f5', GradientType=0);
  -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
  -moz-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
  box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  }
  .slider-handle {
  position: absolute;
  width: 22px;
  height: 22px;
  background-color: #FFF;
  background-repeat: repeat-x;
  border: 1px solid #CCC;
  box-shadow: 0 1px 2px rgba(0,0,0,.2);
  outline: 0;
  }
  .slider-handle.round {
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
  }
  .slider-handle.triangle {
  background: transparent none;
  }
  /* Price Range Slider */
</style>