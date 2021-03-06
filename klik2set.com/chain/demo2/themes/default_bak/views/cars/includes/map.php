


<!-- End section -->
<div class="collapse" id="collapseMap">
  <div id="map" class="map">
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
        'marker': [
        {
          name: '<?php echo character_limiter($car->title, 80);?>',
          location_latitude: <?php echo $car->latitude;?>,
          location_longitude: <?php echo $car->longitude;?>,
          map_image_url: '<?php echo $car->thumbnail;?>',
          name_point: '<?php echo character_limiter($car->title, 80);?>',
          description_point: '<?php echo character_limiter($car->desc, 100);?><br>',
          url_point: '<?php echo $car->slug;?>'
        },
        <?php foreach($car->relatedCars as $item): ?>
        {
          name: 'car name',
          location_latitude: "<?php echo $item->latitude;?>",
          location_longitude: "<?php echo $item->longitude;?>",
          map_image_url: "<?php echo $item->thumbnail;?>",
          name_point: "<?php echo $item->title;?>",
          description_point: '<?php echo character_limiter($item->desc, 100);?><br>',
          url_point: "<?php echo $item->slug;?>"
        },
        <?php endforeach; ?>
        ]
      };
        var mapOptions = {
          zoom: 14,
          center: new google.maps.LatLng(<?php echo $car->latitude;?>, <?php echo $car->longitude;?>),
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
              icon: '<?php echo base_url(); ?>uploads/global/default/' + key + '.png',
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
          '<img style="width:280px;height:140px" src="' + item.map_image_url + '" alt="<?php echo character_limiter($car->title, 80);?>"/>' +
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
        });


      };

       });
  </script>
  <script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
</div>
<!-- End Map -->