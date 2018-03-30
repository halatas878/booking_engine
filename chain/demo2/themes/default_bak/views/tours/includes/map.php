
<div class="collapse" id="collapseMap">
  <div id="map" class="" style="background-color: #C9C9C9;">
  <iframe id="mapframe" width="100%" height="450" style="position: static;" src="width:100%" frameborder="0"></iframe>
  </div>
  <script>
    $('#collapseMap').on('shown.bs.collapse', function(e){
      $("#mapframe").prop("src","<?php echo base_url();?>tours/tourmap/<?php echo $tour->id; ?>");
    });
  </script>

</div>
<!-- End Map -->
<br>