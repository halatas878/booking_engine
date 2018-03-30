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
  <form class="panel-body" action="<?php echo base_url();?>cars/search" method="GET">
    <div class="col-md-3 col-lg-3 col-sm-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-location-6"></i> <?php echo trans('0210');?></label>
        <div class="clearfix"></div>
        <select name="pickupLocation" class="chosen-select RTL" id="location" required>
          <option value=""><?php echo trans('0447');?></option>
          <?php foreach($carspickuplocationsList as $locations): ?>
          <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selectedpickupLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-location-6"></i> <?php echo trans('0211');?></label>
        <div class="clearfix"></div>
        <select name="dropoffLocation" class="chosen-select RTL" id="location" required>
          <option value=""><?php echo trans('0447');?></option>
          <?php foreach($carsdropofflocationsList as $locations): ?>
          <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selecteddropoffLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="col-md-2 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-paper-plane-2"></i> <?php echo trans('0207');?></label>
        <select class="form-control" name="pickup">
          <option value=""> <?php echo trans('0158');?></option>
          <option value="yes" <?php echo makeSelected($selectedPickup, "yes"); ?>  >Yes</option>
          <option value="no" <?php echo makeSelected($selectedPickup, "no"); ?> >No</option>
        </select>
      </div>
    </div>

    <div class="col-md-2 col-lg-2 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('08');?></label>
        <input type="text" class="form-control RTL"  id="tchkin" name="pickupDate" placeholder="<?php echo trans('08');?>" value="<?php echo @$pickupDate; ?>" required >
      </div>
    </div>


  <!--<div class="col-md-2 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
         <div class="clearfix"></div>
         <label class="control-label go-right"><i class="icon_set_1_icon-38"></i> <?php echo trans('0259');?></label>
         <select class="form-control" name="pickupTime">
        <?php foreach($carModTiming as $time){ ?>
        <option value="<?php echo $time; ?>" <?php makeSelected($pickupTime,$time); ?> ><?php echo $time; ?></option>
        <?php } ?>
        </select>
      </div>

   </div>-->

    <div class="visible-sm visible-xs">
      <div class="clearfix"></div>
    </div>
    <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label">&nbsp;</label>
        <button type="submit" class="btn btn-block btn-primary"><?php echo trans('012');?></button>
      </div>
    </div>
    <div class="clearfix"></div>
  </form>
  <div class="col-md-12">
    <hr style="margin-top: 0px;">
  </div>
  <div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
    <br>
  </div>
  <div class="clearfix"></div>
  <form  action="<?php echo base_url();?>cars/search" method="GET" role="search">
    <!-- FILTERS -->
    <div class="col-md-3 filters offset-0 go-right">
      <a class="btn btn-block btn-primary" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><?php echo trans('067');?></a>
      <!-- TOP TIP -->
      <div class="filtertip">
        <div class="padding20">
          <p class="size13">&nbsp;</p>
          <p class="size24"><i class="icon_set_1_icon-42 go-right"></i><span class="go-right"><?php echo trans('0191');?></span> <span class="countprice"></span></p>
        </div>
        <div class="tip-arrow"></div>
      </div>
      <div class="hidden-xs">
        <div style="margin-top:65px"></div>
      </div>
      <!-- Star ratings -->
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
      <!-- End of Star ratings -->
      <!-- Price range -->
      <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
      <?php echo trans('0301');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse2" class="collapse in">
        <?php if(!empty($_GET['price'])){
          $selectedprice = $_GET['price'];
          }else{
          $selectedprice =  $minprice.",".$maxprice;
          }?>
        <div class="padding20">
          <div class="layout-slider wh100percent">
            <span class="cstyle09"><input id="Slider1" type="slider" name="price" value="<?php echo $selectedprice; ?>" /></span>
          </div>
          <script type="text/javascript" >
            jQuery("#Slider1").slider({ from: <?php echo @$minprice;?>, to: <?php echo @$maxprice;?>, step: 5, smooth: true, round: 0, dimension: "&nbsp;<?php echo $currSign; ?>", skin: "round" });
          </script>
        </div>
      </div>
      <!-- End of Price range -->
      <!-- Acomodations -->
      <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse3">
      <?php echo trans('0214');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse3" class="collapse in">
        <div class="hpadding20">
          <br>
          <div class="clearfix"></div>
          <?php @$vartype = $_GET['type'];
            if(empty($vartype)){
            $vartype = array();
            }
            if(!empty($cartypes)){
            foreach($cartypes as $type){
            ?>
          <div class="go-right"> <input class="radio" type="radio" value="<?php echo $type->id;?>" name="type" id="<?php echo $type->name;?>" class="checkbox go-right" <?php if($type->id == $vartype){echo "checked";}?> /><label for="<?php echo $type->name;?>" class="css-label go-left"> &nbsp;&nbsp; <?php echo $type->name;?> &nbsp;&nbsp;</label></div>
          <div class="clearfix"></div>
          <?php } } ?>
          <br>
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- End of Acomodations -->
      <!-- End of Hotel Preferences -->
      <div class="clearfix"></div>
      <br/>
      <input type="hidden" name="location" value="<?php echo $city; ?>">
      <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
      <button style="border-radius:0px" type="submit" class="btn btn-primary btn-lg btn-block" id="searchform"><?php echo trans('012');?></button>
    </div>
    <!-- END OF FILTERS -->
  </form>
  <div class="visible-xs"><br><br></div>
  <!-- LIST CONTENT-->
  <div class="rightcontent col-md-9 offset-0">
    <div class="itemscontainer offset-1">
      <?php if(!empty($cars)){ foreach($cars as $item){ ?>
      <div class="offset-2">
        <div class="col-lg-4 col-md-4 col-sm-4 offset-0 go-right">
          <span  ><?php echo wishListInfo("cars", $item->id); ?></span>
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
              <span class="size11 grey"><?php echo trans('0368');?></span>
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
             <i style="margin-left: -3px;" class="icon-location-6 go-right"></i><?php echo character_limiter($item->location,10);?> <span class="go-right"><?php echo $item->stars;?></span>
              <br><br>
              <p class="grey RTL"><?php echo character_limiter($item->desc,180);?></p>
              <div class="visible-lg visible-md">
              <table class="table-bordered table-striped">
                <thead>
                  <tr>
                    <td class="text-center"><a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo trans('0446');?>"><i class="icon-user-7"></i><?php echo trans('0446');?></a></td>
                    <td class="text-center"><a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo trans('0213');?>"><i class="icon-print-3"></i><?php echo trans('0213');?></a></td>
                    <td class="text-center"><a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo trans('0201');?>"><i class="icon-params"></i><?php echo trans('0201');?></a></td>
                    <td class="text-center"><a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo trans('0199');?>"><i class="icon-tag-6"></i><?php echo trans('0199');?></a></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center"><?php echo $item->passengers;?></td>
                    <td class="text-center"><?php echo $item->doors;?></td>
                    <td class="text-center"><?php echo $item->transmission;?></td>
                    <td class="text-center"><?php echo $item->baggage;?></td>
                  </tr>
                </tbody>
              </table>
              </div>

               <?php if($item->airportPickup == "yes"){ ?>
                <button style="position: absolute; margin-left: -140px;" class="btn btn-success btn-xs"><i class="icon-paper-plane-2"></i> <?php echo trans('0207');?></button>
                <?php } ?>


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
      <?php foreach($cars as $item): ?>
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
<script type="text/javascript">
  $(function(){
    var baseURL = "<?php echo base_url(); ?>";
          $('#location').on('change',function(){
            var location = $(this).val();
            $.post(baseURL+'cars/carajaxcalls/onChangeLocation',{location: location},function(resp){
              var response = $.parseJSON(resp);
              if(response.hasResult){
                  $("#cartype").html(response.optionsList).select2({
                  width:'100%',
                  maximumSelectionSize: 1
                  });


              }

            })

          });

        })

</script>
<script type="text/javascript">
  $(function(){

  $(".dpick").on("click",function(){

  var data = $(this).data('url');
  $("#frm").prop("action",data);

  })

  })
</script>
<script>
  $('.darkened').hover(function() {

      $(this).find('img').fadeTo(500, 0.5);

  }, function() {

      $(this).find('img').fadeTo(500, 1);

  });

</script>
