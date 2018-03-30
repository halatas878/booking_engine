<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/dt-1.10.11/datatables.min.css"/>

<style>
	.separator{
		border-bottom: thin solid #CCC;
	    margin: 0 0 10px 0;
	}.separator:after{
		content:attr(data-title);
		color:#929292;
		padding:0 10px;
	}.label-primary{
		font-size: 16px;
		position: absolute;
		margin-top: 3px;
		border-radius: 2px;
	}.Mbar::after{
		content:"-";
	}.canceladd{
		margin-right:20px;
	}.m0{
		margin:0;
	}table.ratiers th,table.ratiers td{
		vertical-align: top !important;
	}input.th-block{
		display: block;
		margin:0 auto;
	}table .icheckbox_square-grey{
		display:block;
		margin:0 auto;
	}
</style>
<h1 class="title"><i class="fa fa-cog"></i> Update Rates</h1>

  <style>
  	span.block{
  		display: block
  	}span.block  em{
  		width:20px;
  		text-decoration:none;
  		font-style:normal
  	}.information{
  		position: relative;
		margin-bottom: 0px;
  	}
  </style>
 <?php if(isset($_GET['room'])) $roomdetail = getShortRoom($_GET['room'])[0];?> 
<?php if(isset($_GET['action']) || isset($_GET['actionid'])){?>
<div class="panel panel-default formadd" >
  <div class="panel-body">
  	<!--form class="form-horizontal" method="post" action="<?=base_url()?>admin/ajaxcalls/postPrice?action=update_rates"-->
  	<form class="form-horizontal" method="post" action="">
  		<input type="hidden" name="room_id" value="<?=$_GET['room'];?>"/>
  		<?php
  		if(isset($_GET['data'])){
  			echo '<input type="hidden" name="priccesid" value="'.$_GET['data'].'"/>';
  		}
  		?>
  		
 		<div class="form-group m0">
		    <label for="inputPassword3" class="col-sm-2 control-label">Master Rate</label>
		    <div class="col-sm-2">
		     	<input type="hidden" name="master_rate" readonly="" class="form-control" value="<?=$room[0]->room_basic_price;?>"/><label class="control-label">: IDR <?=number_format($room[0]->room_basic_price);?></label>
		    </div>
		  </div>
		  
		  <div class="form-group m0">
		    <label for="inputPassword3" class="col-sm-2 control-label">BAR Rate</label>
		    <div class="col-sm-8">
		     	<input type="hidden" name="bar" readonly="" class="form-control" value="<?=$room[0]->bar;?>"/><label class="control-label">: IDR <?=number_format($room[0]->bar);?></label> <span class="text-danger">(minus <?=($room[0]->barPerc=="fixed")?" IDR ".number_format($room[0]->barCur):" ".$room[0]->barCur."%";?> from Master Rates)</span>
		    </div>
		  </div>
		  <div class="form-group m0">
		    <label for="inputPassword3" class="col-sm-2 control-label">Mobile Rate</label>
		    <div class="col-sm-8">
		     	<input type="hidden" name="mob" readonly="" class="form-control" value="<?=$room[0]->mob;?>"/><label class="control-label">: IDR <?=number_format($room[0]->mob);?></label> <span class="text-danger">(Minus <?=($room[0]->mobPerc=="fixed")?" IDR -".number_format($room[0]->mobCur):" ".$room[0]->mobCur."%";?> from BAR Rates)</span>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">B2B Rate</label>
		    <div class="col-sm-8">
		     	<input type="hidden" name="b2b" readonly="" class="form-control" value="<?=$room[0]->b2b;?>"/><label class="control-label">: IDR <?=number_format($room[0]->b2b);?></label> <span class="text-danger">(Less <?=($room[0]->b2bPerc=="fixed")?" IDR -".number_format($room[0]->b2bCur):" ".$room[0]->b2bCur."%";?> from BAR Rates)</span>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">From</label>
		    <div class="col-sm-2">	
		        <input type="text" placeholder="From" data-date-format="DD-MM-YYYY" name="fromdate" class="form-control input-sm dpd1" value="<?=isset($post->date_from)?date("d-m-Y",strtotime($post->date_from)):date("d-m-Y");?>"/>
		    </div>
		    <label for="inputEmail3" class="col-sm-1 control-label">To</label>
		    <div class="col-sm-2">
		        <input type="text"  data-date-format="DD-MM-YYYY" placeholder="To" name="todate" class="form-control input-sm dpd2" value="<?=isset($post->date_to)?date("d-m-Y",strtotime($post->date_to)):date("d-m-Y");?>"/>
		    </div>
		  </div>
		  <!-- <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Base Allotments</label>
		    <div class="col-sm-6">
			    <div class="input-group col-sm-2">
					<input step="any" name="baseallotments"  class="form-control input" placeholder="" type="text" value="<?=$post->allotments;?>"><span class="input-group-addon pointer" onclick="copyAlt('new')"><i class="fa fa-angle-double-right"></i></span>
			    </div>
		   </div>
		  </div> -->
		
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Policy</label>
		    <div class="col-sm-6">
		    	<input type="hidden" name="cancellationPolicy" value="<?=$post->policy;?>"/>&nbsp
			  <a  class="getCancellation" data-toggle="modal" data-target="#myModal" style="line-height: 38px;">+ Choose Cancellation Policy</a>
			  <textarea class="form-control" name="policy" readonly=""><?=$post->cacncellation;?></textarea>
		    </div>
		  </div>
			
		 <?php $day=array("Monday","Tuesday","Wednesday","Thuesday","Friday","Saturday","Sunday");?>
		 <!--div class="form-group">
		  <table class="table table-bordered rates" width="100%">
		  	<tr>
		  	<?php foreach ($day as $key => $value) :?>
		  		<th colspan="2"><span <?php if($value=="Friday") echo 'class="text-danger"';elseif($value=="Saturday" || $value="Sunday") echo 'class="text-success"';?>><?=$value;?></span></th>
		  	<?php endforeach;?>
		  	</tr>
		  	<tr>
		  	<?php foreach ($day as $key => $value) :?>
		  		<th>Rate</th>
		  		<th>Alt</th>
		  	<?php endforeach;?>
		  	</tr>
		  	<tr>
		  	<?php foreach ($day as $key => $value) : $lowday=strtolower(substr($value,0,3));
			$plow = "P".$lowday;
		  		$json = json_decode($post->$plow);
		  		?>
		  		<td><input type="text" class="tonumber" size="7" name="day-<?=$key;?>" value="<?=isset($post->$lowday)?number_format(round($post->$lowday)):'';?>"/></td>
		  		<td><input type="text" class="alt" size="2" name="alt-<?=$key;?>" value="<?=$json->allotments;?>"/></td>
		  	<?php endforeach;?>
		  	</tr>
		  </table>
		  <span class="text-warning">*note<br/> alt = Allotments for this room</span>
		 </div-->
		   
		    <!-- Modal -->
		  <div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Choose Cancellation Policy</h4>
		        </div>
		        <div class="modal-body">  
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>
		    </div>
		  </div>
	  </div>
	  <?php if(!isset($_POST['fromdate'])){ ?>
	  <div class="panel-footer">
	    <a href="<?=base_url().$this->uri->segment(1)?>/hotels/updaterates?room=<?=$_GET['room'];?>" class="btn btn-danger canceladd">Cancel</a><button type="submit" class="btn btn-warning">Next</button>
	  </div>
	  <?php } ?>
	</form>	  
	<?php  if(isset($_POST['fromdate'])){
		$period = $this->hotels_lib->intervalDate($_POST['fromdate'],$_POST['todate']);
	?>
	<div class="panel-body">
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">&nbsp;</label>
		    <div class="col-sm-9">
				 <table class="table table-bordered table-hover ratiers">
				 	<thead>
				 		<tr>
				 			<th>No</th>
				 			<th>Date</th>
				 			<th class="text-center">Rate
				 				<input type="text" name="rate" size="7" class="th-block"/>
				 			</th>
				 			<th class="text-center">Allotment
				 				<input type="text" name="alt" size="3"  class="th-block"/>	
				 			</th>
				 			<th class="text-center">Close
				 				<!--input type="checkbox" name="close" value="1" class="th-block check-close"/-->		
				 			</th>
				 		</tr>
				 		
				 	</thead>
				 	<tbody>
				 		<?php
				 		foreach($period as $k=>$dt):?>
				 		<tr>
				 			<td><?=$k+1;?></td>
				 			<td><?= $dt->format( "l, d-m-Y" );?></td>
				 			<td><input type="text" name="listrate[<?=$dt->format("d-m-Y");?>]" value="<?=number_format($_POST['bar']);?>" size="7" class="th-block checkclose tonumber"/></td>
				 			<td><input type="text" name="listalt[<?=$dt->format("d-m-Y");?>]" size="3"  class="th-block allotment"/></td>
				 			<td><input type="checkbox" name="listclose[<?=$dt->format("d-m-Y");?>]" value="1" class="th-block" <?=(strtotime($dt->format("Y-m-d"))<strtotime(date("Y-m-d")))?'checked':'';?>/></td>
				 		</tr>
				 		<?php
						endforeach;
				 		?>
				 	</tbody>
				 </table>
			</div>
		</div>
	</div>
	<?php
	} ?>
</div>
<?php } else{?>
<div class="panel panel-default">
  <h2 class="head">Select Room</h2>
 	 <div class="panel-body">
 	 	
	  <form action="" method="GET">
		  <div class="row form-group">
		    <label class="col-md-2 control-label text-right"  style="position: relative;top:10px">Room</label>
		    <div class="col-md-4 selectRooms">
		        <select name="room" class="form-control">
		        	<option value=""/>Choose Room
		        	<?php $hotelid = $this->session->userdata('hotel'); if(count(getHotelRooms($this->session->userdata('hotel')))>0): foreach(getHotelRooms($hotelid) as $k=>$v):?>
		        		<option value="<?=$v->room_id;?>" <?=($_GET['room']==$v->room_id)?"selected":"";?>/><?=$v->room_title;?>
		        	<?php endforeach; endif;?>
		        </select>
		    </div>
		    <div class="col-md-2">
		    	<input type="hidden" type="hidden" value="<?=$_GET['type'];?>" name="type"/>
		  		<button class="btn btn-info" type="submit">View</button>
		    </div>
		  </div>
	</form>
    <div class="clearfix"></div>  
   </div>
 </div> 
 <?php if(isset($_GET['room'])):?>
<div class="panel panel-default formadd" >
	<h2 class="head">List Rates</h2>
  <a href="<?=base_url();?><?=$this->uri->segment(1);?>/hotels/updaterates?room=<?=$_GET['room'];?>&type=&action=add" class="btn btn-success addnew">+Add New</a>
 	 <div class="panel-body">
	 
	  <table class="xcrud-list table table-striped table-hover">
		    <thead>
		    	<tr>
			  		<th>Period</th>
			  		<th>Bar Rate</th>
			    	<th>Roles</th>
			    	<th>Action</th>
		    	</tr>
		    </thead>
		    <?php 
		    if(count($lists>0)) foreach ($lists as $key => $value):
		    ?>
		    <tbody>
		    	<tr id="tr_<?=$value->id;?>">
			    	<td><?=date('d-m-Y',strtotime($value->date_from))." to ".date('d-m-Y',strtotime($value->date_to));?></td>
			    	<td>IDR <?=number_format($value->baseBAR);?></td>
			    	<td><?=$value->cacncellation;?></td>
			    	<td ><span class="btn-group"><a class="btn btn-warning" href="<?=base_url().$this->uri->segment(1)."/hotels/updaterates?room=".$_GET['room']."&type=&action=edit&data=".$value->id?>" title="Edit" target="_self"><i class="fa fa-edit"></i></a></span>
			    		<span class="btn-group btn btn-danger delete" id="<?=$value->id;?>" ><i class="fa fa-trash-o"></i></span>
			    	</td>	
		    	</tr>
		    </tbody>
		    <?php endforeach;?>
		  </table>
	  
	</div>
    <div class="clearfix"></div> 
</div>
<?php endif; } ?>
<script>
	$(this).find(".contentC").remove();
	$.getJSON( "<?=base_url();?>admin/ajaxcalls/getCancellation", function( data ) {
	  var ul = $('<ul/>').addClass('contentC').appendTo('.modal-body');
		  $.each( data, function( key, val ) {
		   var li = $('<li><strong>'+val.title+'</strong><p>'+val.description+' <br/>From '+val.start_date+' to '+val.end_date+'</p> <a class="">Asign</a></li>').appendTo(ul);
		   li.click(function(){
		   	$('input[name="cancellationPolicy"]').val(val.id);
		   	$('textarea[name="policy"]').text(val.title+', '+val.description+' ,From '+val.start_date+' to '+val.end_date);
		  	$('#myModal').modal('hide');
		  	
		  });
	  });
	});
	function copyAlt(data){
		var baseAlt	= $('input[name="baseallotments"]').val();
		$('.alt').val(baseAlt);
	}
	$(".delete").click(function(){
      var id =  $(this).attr('id');
      $.alert.open('confirm', 'Are you sure you want to delete', function(answer) {
         if (answer == 'yes'){
            $.post("<?=base_url().$this->uri->segment(1);?>/hotelajaxcalls/deleteRoomPrice", { id: id }, 	function(theResponse){
            $("#tr_"+id).fadeOut('slow');
         });
       }
        });
    });
    $('.check-close').change(function(){
    	 if($(this).is(":checked")) {
    	 	alert("asa");
    	 }
	  	alert('asd');
	});
    
	$('.dpd1').datepicker({format : "DD-MM-YYYY"});
</script>