<link href="<?php echo $theme_url; ?>assets/include/select2/select2.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/include/select2/select2.min.js"></script>
<!-- This page JS -->
<!-- Custom functions -->
<script src="<?php echo $theme_url; ?>assets/js/functions.js?time=<?=time();?>"></script>
<!-- Picker UI-->
<script src="<?php echo $theme_url; ?>assets/js/jquery-ui.js"></script>
<!-- Easing -->
<script src="<?php echo $theme_url; ?>assets/js/jquery.easing.js"></script>
<!-- Nicescroll  -->
<script src="<?php echo $theme_url; ?>assets/js/jquery.nicescroll.min.js"></script>
<!-- CarouFredSel -->
<script src="<?php echo $theme_url; ?>assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/helper-plugins/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/helper-plugins/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/helper-plugins/jquery.transit.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>
<!-- Custom Select -->
<script type='text/javascript' src='<?php echo $theme_url; ?>assets/js/jquery.customSelect.js'></script>
<script src="<?php echo $theme_url; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/datepicker/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/include/datepicker/datepicker.css" />
<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/include/datepicker/dp2.css" />
<script>
  $('#popoverData').popover();
  $('#popoverOption').popover({ trigger: "hover" });
</script>
<script>
  var fmt = "<?php echo $app_settings[0]->date_f_js;?>";
  var baseURL = "<?php echo base_url(); ?>";

  $(function() {

   /* Wish list global function */
   $(".wishlistcheck").on("click",function(){
     var id = $(this).prop('id');
     var module = $(this).data('module');
     var userid = "<?php echo $usersession; ?>";
     var action = "add";
     var thisdiv = $(this);
     if($(this).hasClass('fav')){
         action = "remove";
     }


  $.post(baseURL+'account/wishlist/'+action,{module: module, itemid: id, loggedin: userid},function(resp){
    var response = $.parseJSON(resp);

    if(response.isloggedIn){

      if(action == "remove"){
      $("."+module+"wishsign"+id).html("+");
      //$("."+module+"wishtext"+id).html("Add to Wishlist");
      $("."+module+"wishtext"+id).tooltip('hide').attr('data-original-title', "Add to Wishlist").tooltip('fixTitle').tooltip('show');
      $("."+module+"wishsign"+id).removeClass("fav");
      thisdiv.removeClass('fav');

     }else{

      thisdiv.addClass('fav');
      $("."+module+"wishsign"+id).addClass("fav");
      $("."+module+"wishsign"+id).html("-");
      //$("."+module+"wishtext"+id).html("Remove From Wishlist");
      $("."+module+"wishtext"+id).tooltip('hide').attr('data-original-title', "Remove From Wishlist").tooltip('fixTitle').tooltip('show');

     }

     }else{
      alert("<?php echo trans('0482');?>");
     }
     console.log(response);
   });

   })
   /* End Wish list global function */

  /* select2 */
  $('.chosen-select').select2({ width: '100%', maximumSelectionSize: 1  });

  /* homepage main search auto detector */
  $('.nav-tabs li:first-child').addClass('active');  var t  = $('.nav-tabs li:first-child').data('title'); $("#"+t).addClass("active in"); $('.feat li:first-child').addClass('active'); var t  = $('.feat li:first-child').data('title'); $("#"+t).addClass("active in");

  /* tours ajax categories loader */
  <?php  if(pt_main_module_available('tours')){ ?>
  $('#location').on('change',function(){ var location = $(this).val(); $.post(baseURL+'tours/tourajaxcalls/onChangeLocation',{location: location},function(resp){ var response = $.parseJSON(resp); console.log(response); if(response.hasResult){ $("#tourtype").html(response.optionsList); }else{ $("#tourtype").html(response.optionsList); } mySelectUpdate(); }) });
  <?php } ?>

   /* cars ajax types loader */
  <?php  if(pt_main_module_available('cars')){ ?>
  $('#carlocations').on('change',function(){ var location = $(this).val(); $.post(baseURL+'cars/carajaxcalls/onChangeLocation',{location: location},function(resp){ var response = $.parseJSON(resp); if(response.hasResult){ $("#cartype").html(response.optionsList).select2({ width:'100%', maximumSelectionSize: 1 }); } }) });
  $('#pickuplocation').on('change',function(){ var location = $(this).val(); var carid = $("#itemid").val(); $.post(baseURL+'cars/carajaxcalls/getDropoffLocations',{location: location, carid: carid},function(resp){ var response = $.parseJSON(resp); console.log(response); if(response.hasResult){ $("#droplocation").html(response.optionsList).select2({ width:'100%', maximumSelectionSize: 1 }); } }) });
  
  <?php } ?>


   /* tooltip */
  $('[data-toggle=tooltip]').tooltip();

  /* datepicker */
  window.prettyPrint&&prettyPrint(),$(".dob").datepicker({format:fmt,autoclose:!0}).on("changeDate",function(){$(this).datepicker("hide")}),$("#dp1").datepicker(),$("#dp2").datepicker();

  /* disabling dates */
      var nowTemp = new Date();
      var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
      var checkin = $('.dpd1').datepicker({
          format: fmt,
          onRender: function(date) {
              return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
      }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
              var newDate = new Date(ev.date)
              newDate.setDate(newDate.getDate() + 1);
              checkout.setValue(newDate);
          }
          checkin.hide();
          $('.dpd2')[0].focus();
      }).data('datepicker');
      var checkout = $('.dpd2').datepicker({
          format: fmt,
          onRender: function(date) {
              return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
      }).on('changeDate', function(ev) {
          checkout.hide();

      }).data('datepicker');

  /* Expedia datepicker */
  <?php  if(pt_main_module_available('ean')){ ?>
  var nowTemp2=new Date,now2=new Date(nowTemp2.getFullYear(),nowTemp2.getMonth(),nowTemp2.getDate(),0,0,0,0),checkin2=$(".dpean1").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<now2.valueOf()?"disabled":""}}).on("changeDate",function(e){if(e.date.valueOf()>checkout2.date.valueOf()){var a=new Date(e.date);a.setDate(a.getDate()+1),checkout2.setValue(a)}checkin2.hide(),$(".dpean2")[0].focus()}).data("datepicker"),checkout2=$(".dpean2").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<=checkin2.date.valueOf()?"disabled":""}}).on("changeDate",function(){checkout2.hide()}).data("datepicker");
  <?php } ?>
  /* End Expedia Datepicker*/

   /* Dohop datepicker */
  <?php  if(pt_main_module_available('flightsdohop')){ ?>
  var nowTemp3=new Date,now3=new Date(nowTemp3.getFullYear(),nowTemp3.getMonth(),nowTemp3.getDate(),0,0,0,0),checkin3=$(".dpfd1").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<now3.valueOf()?"disabled":""}}).on("changeDate",function(e){if(e.date.valueOf()>checkout3.date.valueOf()){var a=new Date(e.date);a.setDate(a.getDate()+1),checkout3.setValue(a)}checkin3.hide(),$(".dpfd2")[0].focus()}).data("datepicker"),checkout3=$(".dpfd2").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<=checkin3.date.valueOf()?"disabled":""}}).on("changeDate",function(){checkout3.hide()}).data("datepicker");
  <?php } ?>
  /* End Dohop Datepicker*/



  <?php  if(pt_main_module_available('tours')){ ?>
    // Tours checkin - disabling Single date
  var nowTemp4 = new Date();
  var now4 = new Date(nowTemp4.getFullYear(), nowTemp4.getMonth(), nowTemp4.getDate(), 0, 0, 0, 0);
  var checkin4 = $('#tchkin').datepicker({format: fmt, onRender: function(date) {
  return date.valueOf() < now4.valueOf() ? 'disabled' : ''; } }).on('changeDate', function(ev) {
  $('#tchkin').datepicker('hide');
  });
  <?php } ?>

  <?php  if(pt_main_module_available('cars')){ ?>
    // Cars checkin - disabling Single date
  var nowTemp5 = new Date();
  var now5 = new Date(nowTemp5.getFullYear(), nowTemp5.getMonth(), nowTemp5.getDate(), 0, 0, 0, 0);
  var checkin5 = $('#carchkin').datepicker({format: fmt, onRender: function(date) {
  return date.valueOf() < now5.valueOf() ? 'disabled' : ''; } }).on('changeDate', function(ev) {
  $('#carchkin').datepicker('hide');
  });
  <?php } ?>

    /* Cartrawler datepicker */
  <?php  if(pt_main_module_available('cartrawler')){ ?>
  var nowTemp6=new Date,now6=new Date(nowTemp6.getFullYear(),nowTemp6.getMonth(),nowTemp6.getDate(),0,0,0,0),checkin6=$(".dpcd1").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<now6.valueOf()?"disabled":""}}).on("changeDate",function(e){if(e.date.valueOf()>checkout6.date.valueOf()){var a=new Date(e.date);a.setDate(a.getDate()+1),checkout6.setValue(a)}checkin6.hide(),$(".dpcd2")[0].focus()}).data("datepicker"),checkout6=$(".dpcd2").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()< checkin6.date.valueOf()?"disabled":""}}).on("changeDate",function(){checkout6.hide()}).data("datepicker");
  <?php } ?>
  /* End Cartrawler Datepicker*/

  /* Newsletter subscription */
  $(".sub_newsletter").on("click",function(){var e=$(".sub_email").val();$.post("<?php echo base_url();?>home/subscribe",{email:e},function(e){$(".subscriberesponse").html(e).fadeIn("slow"),setTimeout(function(){$(".subscriberesponse").fadeOut("slow")},2000)})});

  /* dropdown on hover */
  $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(200).fadeIn(200)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(200).fadeOut(200)}); });

  /* start change currency functionality */
  function change_currency(c){$("#loadingbg").css("display","block"),$.post("<?php echo base_url();?>admin/ajaxcalls/changeCurrency",{id:c},function(){location.reload()})}

  /* map iframe modal */
  function showMap(a,o){"modal"==o?($("#mapModal").modal("show"),$("#mapModal").on("shown.bs.modal",function(){$("#mapModal .mapContent").html('<iframe src="'+a+'" width="100%" height="450" frameborder="0" style="border:0"></iframe>')})):$("#"+o).html('<iframe src="'+a+'" width="100%" height="450" frameborder="0" style="border:0"></iframe>')}
</script>
<?php  if(pt_main_module_available('flightsdohop')){ ?>
<script type="text/javascript">
  /* dohop auto suggest */
    function selectValue(l,h){$("#"+h).val(l),$("#"+h+"resp").html("")}$(function(){$(".sterm").on("keyup",function(l){var h=$(this).val(),e=h.length,i=$(this).prop("id"),t=l.keyCode||l.which;if($.trim(e)>1&&38!=t&&40!=t)console.log(t),$("#"+i+"resp").html(""),$.post("<?php echo base_url();?>flightsdohop/getLocationsList",{term:h,inputid:i},function(l){$("#"+i+"resp").html(l)});else if(38!=t&&40!=t)$("#"+i+"resp").html("");else{var s,g,n=$("#"+i+"resp ul li.highlight");40!==t||n.length||$("#"+i+"resp ul li:first").addClass("highlight"),40===t&&n.length?(g=n.next("#"+i+"resp ul li"),g.length&&(n.removeClass("highlight"),g.addClass("highlight"))):38===t&&(s=n.prev("#"+i+"resp ul li"),s.length&&(n.removeClass("highlight"),s.addClass("highlight"))),console.log($(".highlight").innerHTML)}})});
</script>
<?php } ?>
<?php  if(pt_main_module_available('cartrawler')){ ?>
<script type="text/javascript">
  /* cartrawler auto suggest */
    function selectLocationValue(l,h,locname){  $("#"+h).val(locname); if(h == 'ct1'){ $("input[name='pickupLocationId']").val(l); $("input[name='returnLocationId']").val(l); }else if(h == "ct2"){ $("#returnlocation").val(l);   }; $("#"+h+"resp").html("") } $(function(){ $(".ctlocation").on("keyup",function(l){ var h=$(this).val(),e=h.length,i=$(this).prop("id"),t=l.keyCode||l.which;if($.trim(e)>1&&38!=t&&40!=t)$("#"+i+"resp").html(""),$.post("<?php echo base_url();?>cartrawler/getLocations",{term:h,inputid:i},function(l){$("#"+i+"resp").html(l)});else if(38!=t&&40!=t)$("#"+i+"resp").html("");else{var s,g,n=$("#"+i+"resp ul li.highlight");40!==t||n.length||$("#"+i+"resp ul li:first").addClass("highlight"),40===t&&n.length?(g=n.next("#"+i+"resp ul li"),g.length&&(n.removeClass("highlight"),g.addClass("highlight"))):38===t&&(s=n.prev("#"+i+"resp ul li"),s.length&&(n.removeClass("highlight"),s.addClass("highlight"))),console.log($(".highlight").innerHTML)}})});

</script>
<?php } ?>
