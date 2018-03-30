<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/tmpl.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/draggable-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.slider.js"></script>
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.round.css" type="text/css">
<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/listing.css" type="text/css">

<!-- CONTENT -->
<div class="container pagecontainer offset-0">
   <!--<form class="panel-body" action="<?php echo base_url();?>hotels/search" method="GET">
      <div class="col-md-3 col-lg-4 col-sm-12 go-right">
         <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right size13"><i class="icon-location-6"></i> <?php echo trans('0254');?></label>
            <div class="clearfix"></div>
            <select name="searching" class="chosen-select" style="background-color: white;" id="location" value="<?php if(!empty($_GET['searching'])){ echo $_GET['searching']; } ?>" >
               <option value=""><?php echo trans('0447');?></option>
               <?php foreach($hotelslocationsList as $locations): ?>
               <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selectedLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
               <?php endforeach; ?>
            </select>
         </div>
      </div>
      <div class="col-md-2 col-sm-6 col-xs-6 go-right">
         <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
            <input type="text" placeholder="<?php echo trans('07');?> " name="checkin" class="form-control dpd1" value="<?php echo $checkin; ?>" required >
         </div>
      </div>
      <div class="col-md-2 col-sm-6 col-xs-6 go-right">
         <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
            <input type="text" placeholder="<?php echo trans('09');?> " name="checkout" class="form-control dpd2" value="<?php echo $checkout; ?>" required >
         </div>
      </div>
      <div class="col-md-2 col-lg-1 col-sm-6 col-xs-6 go-right">
         <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
            <select  required class="form-control" placeholder=" <?php echo trans('');?> " name="adults" id="adults">
               <option value="">0</option>
               <?php for($Selectadults = 1; $Selectadults < 11;$Selectadults++){ ?>
               <option value="<?php echo $Selectadults;?>" <?php if($Selectadults == $hotelslib->adults){ echo "selected"; } ?> > <?php echo $Selectadults;?> </option>
               <?php } ?>
            </select>
         </div>
      </div>
      <div class="hidden-md col-lg-1 col-sm-6 col-xs-6 go-right">
         <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
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
      <div class="visible-sm visible-xs"><div class="clearfix"></div></div>
      <div class="col-md-3 col-lg-2 col-xs-12 col-sm-12 go-right">

         <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label">&nbsp;</label>
            <button type="submit" class="btn btn-block btn-primary"><?php echo trans('012');?></button>
         </div>
      </div>
      <div class="clearfix"></div>
   </form>-->
   <div class="col-md-12 col-xs-12" style="position:relative;margin-top:23px;">
      	<?php require $themeurl.'views/hotels/booking-widget.php'; ?>
         </div>
   <div class="col-md-12"><hr style="margin-top: 0px;"></div>
   <div class="collapse" id="collapseMap">
      <div id="map" class="map"></div>
      <br>
   </div>

   <div class="clearfix"></div>
   <!--form  action="<?php echo base_url();?>hotels/search" method="GET" role="search">

      <div class="col-md-3 filters offset-0 go-right">
         <a class="btn btn-block btn-primary" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><?php echo trans('067');?></a>

         <div class="filtertip">
            <div class="padding20">
               <p class="size13">&nbsp;</p>
               <p class="size24"><i class="icon_set_1_icon-42 go-right"></i><span class="go-right"><?php echo trans('0191');?></span> <span class="countprice"></span></p>
            </div>
            <div class="tip-arrow"></div>
         </div>

      <div class="hidden-xs"><div style="margin-top:65px"></div></div>
         <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
         <?php echo trans('0137');?> <?php echo trans('069');?> <span class="collapsearrow"></span>
         </button>
         <div id="collapse1" class="collapse in">
            <div class="hpadding20">
               <br>
               <?php $star = '<i class="star text-warning fa fa-star voted"></i>'; ?>
               <?php $stars = '<i class="fa fa-star-o"></i>'; ?>
               <div  class="rating" style="font-size: 14px;">
                  <div class="go-right"><input id="1" type="radio" name="stars" class="go-right radio" value="1" <?php if(@$_GET['stars'] == "1"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="1"><?php echo $star; ?><?php for($i=1;$i<=6;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                  <div class="clearfix"></div>
                  <div class="go-right"><input id="2" type="radio" name="stars" class="radio go-right" value="2" <?php if(@$_GET['stars'] == "2"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="2"><?php for($i=1;$i<=2;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=5;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                  <div class="clearfix"></div>
                  <div class="go-right"><input id="3" type="radio" name="stars" class="radio" value="3" <?php if(@$_GET['stars'] == "3"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="3"><?php for($i=1;$i<=3;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=4;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                  <div class="clearfix"></div>
                  <div class="go-right"><input id="4" type="radio" name="stars" class="radio" value="4" <?php if(@$_GET['stars'] == "4"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="4"><?php for($i=1;$i<=4;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=3;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                  <div class="clearfix"></div>
                  <div class="go-right"><input id="5" type="radio" name="stars" class="radio" value="5" <?php if(@$_GET['stars'] == "5"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="5"><?php for($i=1;$i<=5;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=2;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                  <div class="clearfix"></div>
                  <div class="go-right"><input id="7" type="radio" name="stars" class="radio" value="7" <?php if(@$_GET['stars'] == "7"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="7"><?php for($i=1;$i<=7;$i++){ ?> <?php echo $star; ?> <?php } ?></label></div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br>
         </div>
         <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
         <?php echo trans('0301');?> <span class="collapsearrow"></span>
         </button>
         <div id="collapse2" class="collapse in">
          <?php if(!empty($_GET['price'])){
                    $selectedprice = $_GET['price'];
                    }else{
                    $selectedprice =  $minprice.",".$maxprice;
                    } ?>
            <div class="padding20">
               <div class="layout-slider wh100percent">
                  <span class="cstyle09"><input id="Slider1" type="slider" name="price" value="<?php echo $selectedprice; ?>" /></span>
               </div>
               <script type="text/javascript" >
                  jQuery("#Slider1").slider({ from: <?php echo @$minprice;?>, to: <?php echo @$maxprice;?>, step: 5, smooth: true, round: 0, dimension: "&nbsp;<?php echo $currSign; ?>", skin: "round" });
               </script>
            </div>
         </div>
         <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse3">
         <?php echo trans('0478');?> <span class="collapsearrow"></span>
         </button>
         <div id="collapse3" class="collapse in">
            <div class="hpadding20">
               <br>
               <div class="clearfix"></div>
               <?php @$vartype = $_GET['type'];
                  if(empty($vartype)){
                  $vartype = array();
                  }
                  foreach($hotelTypes as $htype){
                  ?>
               <div class="go-right"> <input type="checkbox" value="<?php echo $htype['id'];?>" <?php if(in_array($htype['id'],$vartype)){echo "checked";}?> name="type[]" id="<?php echo $htype['name'];?>" class="checkbox" /> <label for="<?php echo $htype['name'];?>" class="css-label go-left">&nbsp;&nbsp;<?php echo $htype['name'];?></label></div>
               <div class="clearfix"></div>
               <?php } ?>
               <br>
            </div>
            <div class="clearfix"></div>
         </div>
         <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse4">
         <?php echo trans('0249');?> <span class="collapsearrow"></span>
         </button>
         <div id="collapse4" class="collapse in">
            <div class="hpadding20">
               <br>
               <div class="clearfix"></div>
               <?php @$varAmt = $_GET['amenities'];
                  if(empty($varAmt)){
                  $varAmt = array();
                  }
                  foreach($hotelAmenities as $hamt){
                  ?>
               <div class="go-right"><input type="checkbox" value="<?php echo $hamt['id'];?>" <?php if(in_array($hamt['id'],$varAmt)){echo "checked";}?> name="amenities[]" id="<?php echo $hamt['name'];?>" class="checkbox" /><label for="<?php echo $hamt['name'];?>" class="css-label go-left"> <img class="go-right" style="height: 22px;margin-right:5px;margin-left:5px" src="<?php echo $hamt['icon'];?>">  <?php echo $hamt['name'];?></label></div>
               <div class="clearfix"></div>
               <?php } ?>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
         <br/>
         <input type="hidden" name="searching" value="<?php echo $selectedLocation;?>">
         <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
         <button style="border-radius:0px" type="submit" class="btn btn-primary btn-lg btn-block" id="searchform"><?php echo trans('012');?></button>
      </div>
   </form-->
   <div class="visible-xs"><br><br></div>
   <!-- LIST CONTENT-->
   <div class="rightcontent col-md-12 offset-0">
      <div class="itemscontainer offset-1">
         <?php if(!empty($hotels)){ foreach($hotels as $item){ ?>
         <div class="offset-2">

          <div class="col-lg-4 col-md-4 col-sm-4 offset-0 go-right">
              <span  ><?php echo wishListInfo("hotels", $item->id); ?></span>
                <div class="img_list">
              <a href="<?php echo $item->slug;?>">
                <img src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,20);?>">
                <div class="short_info"></div>
              </a>
            </div>
          </div>

            <div class="col-md-8 offset-0">
               <div class="itemlabel3">
                  <div class="labelright go-left" style="min-width:105px;margin-left:5px">
                     <br/>
                     <span class="green size18">
                     <?php  if($item->price > 0){ ?>
                     <b>
                     <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                     </b></span><br/>
                     <span class="size11 grey"><?php echo trans('0299');?></span>
                     <br/>
                     <div class="clearfix"></div>
                     <hr>
                     <?php } ?>

                      <?php if(pt_is_module_enabled('reviews')){ ?>
                      <?php  if($item->avgReviews->overall > 0){ ?>
                      <div class="review text-center size18"><i class="icon-thumbs-up-4"></i><?php echo $item->avgReviews->overall; ?></div>
                      <!--<?php echo $item->avgReviews->totalReviews; ?>-->
                      <div class="clearfix"></div>
                      <hr>
                      <?php } ?>
                       <?php } ?>
                     <a href="<?php echo $item->slug;?>">
                        <button type="submit" class="bookbtn mt1"><?php echo trans('0177');?></button>
                     </a>
                  </div>
                  <div class="labelleft2 rtl_title_home">
                     <h4 class="mtb0 RTL go-text-right"><a href="<?php echo $item->slug;?>"><b><?php echo character_limiter($item->title,20);?></b></a></h4>
                     <a class="go-right" href="javascript:void(0);" onclick="showMap('<?php echo base_url();?>home/maps/<?php echo $item->latitude; ?>/<?php echo $item->longitude; ?>/hotel/<?php echo $item->id;?>','modal');" title="<?php echo $item->location;?>"><i style="margin-left: -3px;" class="icon-location-6 go-right"></i><?php echo character_limiter($item->location,10);?></a> <span class="go-right"><?php echo $item->stars;?></span>
                     <br><br>
                     <p class="grey RTL"><?php echo character_limiter($item->desc,200);?></p>
                     <br/>
                     <ul class="hotelpreferences go-right hidden-xs">
                        <?php $cnt = 0; foreach($item->amenities as $amt){ $cnt++; if($cnt <= 10){ if(!empty($amt['name'])){ ?>
                        <img title="<?php echo $amt['name'];?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt['icon'];?>" alt="<?php echo $amt['name'];?>" />
                        <?php } } } ?>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="offset-2">
            <hr style="margin-top: 10px; margin-bottom: 10px;">
         </div>
         <?php } ?>
         <div class="clearfix"></div>
         <div class="col-md-12 pull-right go-right"><?php echo createPagination($info);?></div>
         <div class="pull-right">
            <?php }else{  echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
         </div>
         <!-- End of offset1-->
      </div>
      <!-- END OF LIST CONTENT-->
   </div>
   <!-- END OF container-->
</div>
<!-- END OF CONTENT -->
<br><br><br>
<!-- End container -->

<!-- Map -->
<!-- PHPtravels Modal Starting-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <option value="<?php echo $Selectadults;?>" <?php if($Selectadults == $hotelslib->adults){ echo "selected"; } ?> > <?php echo $Selectadults;?> </option>
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
<div class="modal fade" id="mapModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div  class="modal-content">
         <div class="mapContent">
         </div>
      </div>
   </div>
</div>
<div class="clearfix"></div>
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
       <?php foreach($hotels as $item): ?>
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
   			'<img style="width:280px;height:140px" src="' + item.map_image_url + '" alt="<?php echo character_limiter($hotel->title, 80);?>"/>' +
   			'<h3>'+ item.name_point +'</h3>' +
   			'<span>'+ item.description_point +'</span>' +
   			'<a href="'+ item.url_point + '" class="btn btn-primary"><?php echo trans('0177');?></a>' +
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

