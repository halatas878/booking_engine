</div>
</div>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<button type="button" class="calculator" data-toggle="modal" data-target="#calculator"><i class="fa fa-calculator"></i></button>
<a href="<?=base_url()?><?=$this->uri->segment(1);?>/quickbooking/?applytax=no&service=hotels" type="button" class="phone-fixed" ><i class="fa fa-phone"></i></a>

<div id="calculator" class="modal fade" role="dialog">
    <div class="modal-dialog">
    	<button type="button" class="close" data-dismiss="modal">&times;</button>
	    <div class="plugin-calculator">
			<script src="<?=base_url();?>/assets/js/plugin/calculator/jquery-2.1.4.min.js"> </script>
			<!-- Plugin -->
			<link rel="stylesheet" href="<?=base_url();?>/assets/css/plugin/calculator/SimpleCalculadorajQuery.css">
			<script src="<?=base_url();?>/assets/js/plugin/calculator/SimpleCalculadorajQuery.js"></script>
		    <div id="micalc"> </div>
		</div>
	</div>
</div>

<?php $settings = $this->settings_model->get_settings_data(); ?>
<!-- Bootstrap JS-->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sidebar.js"></script>
<script src="<?php echo base_url(); ?>assets/js/panels.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/t/dt/dt-1.10.11/datatables.min.js"></script>

<!-- ckeditor -->


<!-- icheck -->
<script src="<?php echo base_url(); ?>assets/include/icheck/icheck.min.js"></script>
<link href="<?php echo base_url(); ?>assets/include/icheck/square/grey.css" rel="stylesheet">
<script>
var cb, optionSet1;

$(function () {
    var checkAll = $('input.all');
    var checkboxes = $('input.checkboxcls');

    $('input').iCheck({
      checkboxClass: "icheckbox_square-grey",
    });

    checkAll.on('ifChecked ifUnchecked', function(event) {
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });
});
$("#idCalculadora").Calculadora();
$("#micalc").Calculadora({'EtiquetaBorrar':'Clear'});
$(".radio").iCheck({
checkboxClass: "icheckbox_square-grey",
radioClass: "iradio_square-grey"
});
</script>

<!-- datepicker -->
<script src="<?php echo base_url(); ?>assets/include/datepicker/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/include/datepicker/datepicker.css" />

<script>
var fmt = "<?php echo @$settings[0]->date_f_js;?>";
if (top.location != location) { top.location.href = document.location.href ; }
$(function(){ window.prettyPrint && prettyPrint(); $('.dob').datepicker({format: fmt,autoclose: true}).on('changeDate', function (ev) {
$(this).datepicker('hide'); });
$('#dp1').datepicker();
$('#dp2').datepicker();

// disabling dates
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
var checkin = $('.dpd1').datepicker({format: fmt, onRender: function(date) { return date.valueOf() < now.valueOf() ? 'disabled' : ''; } }).on('changeDate', function(ev) {
if (ev.date.valueOf() > checkout.date.valueOf()) {
var newDate = new Date(ev.date)
newDate.setDate(newDate.getDate() + 1); checkout.setValue(newDate); } checkin.hide();
$('.dpd2')[0].focus(); }).data('datepicker'); var checkout = $('.dpd2').datepicker({format: fmt,
onRender: function(date) { return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : ''; }
}).on('changeDate', function(ev) { checkout.hide(); }).data('datepicker'); });
</script>

<!-- timepicker -->
<script src="<?php echo base_url(); ?>assets/include/timepicker/timepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/include/timepicker/timepicker.css" />
<script>
$(function(){
$('.timepicker').clockface(); });
</script>
<script src="<?=base_url();?>assets/js/plugin/calendar/zabuto.min.js"></script>
<!-- dronzone -->
<link href="<?php echo base_url(); ?>assets/include/dropzone/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/include/dropzone/dropzone.min.js"></script>

<!----Custom functions file---->
<script src="<?php echo base_url(); ?>assets/js/funcs.js?<?=time();?>"></script>
<!----Custom functions file---->

<!-- pnotify -->
<script src="<?php echo base_url(); ?>assets/include/pnotify/pnotify.custom.min.js"></script>
<link href="<?php echo base_url(); ?>assets/include/pnotify/pnotify.custom.css" rel="stylesheet">

<?php NotifyMsg($this->session->flashdata('flashmsgs')); ?>

<!-- select2 -->
<link href="<?php echo base_url(); ?>assets/include/select2/select2.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/include/select2/select2-default.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/include/select2/select2.min.js"></script>

<script>
$(function() {
$('.chosen-select').select2( { width:'100%', maximumSelectionSize: 1 } );
$(document).ready(function() {
$(".chosen-multi-select").select2( { width:'100%', } ); }); }); function slideout(){ setTimeout(function(){
$(".alert-success").fadeOut("slow", function () { });
$(".alert-danger").fadeOut("slow", function () { }); }, 4000);}
</script>

<!-- smothwhell starts-->
<script src="<?php echo base_url(); ?>assets/include/smoothwheel/smoothwheel.js"></script>
<!-- smothwhell ends-->

<!-- jQuery slimScroll-->
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
<script>
window.jQuery.ui || document.write('<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"><\/script>')
</script>
<script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/numeral.min.js"></script>
<script>

/*<![CDATA[*/
$(function() {
$(".social-sidebar").socialSidebar();
$('.main').panels();
});
/*]]>*/
$('select[name="hotel"]').change(function(){
	var id = $(this).val();
	$('.selectRooms').find('select').remove();
	$.getJSON( "<?=base_url();?>admin/ajaxcalls/getRoom?id="+id, function( data ) {
		  var items = [];
		 items.push('<option value="">Choose Room</option>');
		  $.each( data, function( key, val ) {
		    items.push('<option value="'+val.room_id+'">'+val.room_title+'</option>');
		  });
		 
		  $( "<select/>", {
		    "name": "room",
		    "class":"form-control",
		    html: items.join( "" )
		  }).appendTo( ".selectRooms" );
		  /*location.reload();*/
	});
});
  $(document).ready(function () {
  	$('.ratiers').DataTable({
          "bLengthChange": false ,
           "bSort": false,
           "iDisplayLength": 30,
           "info":     false,
           "filter": false
  	});
       $("#my-calendar").zabuto_calendar({
	      cell_border: true,
	      today: true,
	      show_days: true,
	      weekstartson: 0,
	      nav_icon: {
	        prev: '<i class="fa fa-chevron-circle-left"></i>',
	        next: '<i class="fa fa-chevron-circle-right"></i>'
	      }
	    });
	    $('input.tonumber').bind("keyup change", function(e){
	    	var val 	= $(this).val(),
	    		elval	= numberformat(val);
	    	$(this).val(elval);
		});

	    
    });
     function numberformat(nStr){
	  nStr += '';
	  var comma = /,/g;
	  nStr = nStr.replace(comma,'');
	  x = nStr.split('.');
	  x1 = x[0];
	  x2 = x.length > 1 ? '.' + x[1] : '';
	  var rgx = /(\d+)(\d{3})/;
	  while (rgx.test(x1)) {
	    x1 = x1.replace(rgx, '$1' + ',' + '$2');
	  }
	  return x1 + x2;
	}
</script>
   

</body>
</html>