<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/circle.css" />
<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/single.css" />
<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<link href="<?php echo $theme_url; ?>assets/css/magnific-popup.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/js/single.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>

<div class="mtslide2 sliderbg2"></div>

 <?php include 'includes/head.php';?>
 <?php include 'includes/map.php';?>

<div id="OVERVIEW" class="container">
<div class="row" style="height:0px !important">
  <div class="col-md-12">
    <div class="panel with-nav-tabs panel-default">
    <div class="tabsbar">
        <ul class="RTL visible-lg visible-md nav nav-tabs nav-justified">
          <li class="text-center"><a class="tabsBtn" href="#OVERVIEW" data-toggle="tab"><?php echo trans('0248');?></a></li>
          <?php if(!empty($rooms) > 0){ ?> <li class="text-center"><a class="tabsBtn" href="#ROOMS" data-toggle="tab"><?php echo trans('016');?></a></li><?php  } ?>
          <?php if(!empty($hotel->desc)){ ?><li class="text-center"><a class="tabsBtn" href="#DESCRIPTION" data-toggle="tab"><?php echo trans('046');?></a></li><?php  } ?>
          <?php if(!empty($hotel->amenities)){ ?><li class="text-center"><a class="tabsBtn" href="#AMENITIES" data-toggle="tab"><?php echo trans('0249');?></a></li><?php  } ?>
          <?php if(!empty($reviews) > 0){ ?> <li class="text-center"><a class="tabsBtn" href="#REVIEWS" data-toggle="tab"><?php echo trans('0396');?></a></li><?php  } ?>
          <?php if(!empty($hotel->relatedHotels)){ ?><li class="text-center"><a class="tabsBtn" href="#RELATED" data-toggle="tab"><?php echo trans('0290');?></a></li><?php  } ?>
        </ul>
    </div>
      <div style="padding:10px">
        <div class="row">
           <?php include 'includes/slider.php';?>
           <?php include 'includes/aside.php';?>
        </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'includes/review.php';?>
  </div>

<?php if($hasRooms > 0){ include 'includes/rooms.php'; } ?>
<?php include 'includes/overview.php';?>
    <section class="bg-white">
      <div class="container">
      <div class="row">
        <hr>
      <div class="clearfix"></div>
     <?php include 'includes/amenities.php';?>
     <div class="visible-xs"><br></div>
     <?php include 'includes/reviews.php';?>

     </div>
      <br>
     </div>
    </section>
<?php include 'includes/related.php';?>

<script>

//------------------------------
// Write Reviews
//------------------------------

  $(function(){
  $('.reviewscore').change(function(){
  var sum = 0;
  var avg = 0;
  var id = $(this).attr("id");
  $('.reviewscore_'+id+' :selected').each(function() {
  sum += Number($(this).val());
  });
  avg = sum/5;
  $("#avgall_"+id).html(avg);
  $("#overall_"+id).val(avg);
  });

  //submit review
  $(".addreview").on("click",function(){
  var id = $(this).prop("id");
  $.post("<?php echo base_url();?>admin/ajaxcalls/postreview", $("#reviews-form-"+id).serialize(), function(resp){
  var response = $.parseJSON(resp);
  // alert(response.msg);
  $("#review_result"+id).html("<div class='alert "+response.divclass+"'>"+response.msg+"</div>").fadeIn("slow");
  if(response.divclass == "alert-success"){
  setTimeout(function(){
  $("#ADDREVIEW").removeClass('in');
  $("#ADDREVIEW").slideUp();
  }, 5000);
  }
  });
  setTimeout(function(){
  $("#review_result"+id).fadeOut("slow");
  }, 3000);
  });
  })


//------------------------------
// Add to Wishlist
//------------------------------

  $(function(){
  // Add/remove wishlist
  $(".wish").on('click',function(){
  var loggedin = $("#loggedin").val();
  var removelisttxt = $("#removetxt").val();
  var addlisttxt = $("#addt