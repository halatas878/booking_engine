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
	}.rates{
		display:none;
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

  
 <?php if(isset($_GET['room'])) $roomdetail = getShortRoom($_GET['room'])[0];?> 
<?php if(isset($_GET['action']) || isset($_GET['actionid']) || isset($_GET['room'])){?>
<div class="panel panel-default formadd" >
	<h2 class="head">Show Rates</h2>
  <div class="panel-body">
  	<!--form class="form-horizontal" method="post" action="<?=base_url()?>admin/ajaxcalls/postPrice?action=update_rates"-->
  	<form class="form-horizontal" method="get" action="">
  		<input type="hidden" name="room_id" value="<?=$_GET['room'];?>"/>
  		<input type="hidden" name="room" value="<?=$_GET['room'];?>"/>
  		<input type="hidden" name="type" value="<?=$_GET['type'];?>"/>
  		<input type="hidden" name="action" value="<?=$_GET['action'];?>"/>
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
		        <input type="text" placeholder="From" data-date-format="DD-MM-YYYY" name="fromdate" class="form-control input-sm dpd1" value="<?php if(isset($post->date_from)) echo date("d/m/Y",strtotime($post->date_from)); else if(isset($_GET['fromdate'])) echo urldecode($_GET['fromdate']); else echo date("d/m/Y");?>"/>
		    </div>
		    <label for="inputEmail3" class="col-sm-1 control-label">To</label>
		    <div class="col-sm-2">
		        <input type="text"  data-date-format="DD-MM-YYYY" placeholder="To" name="todate" class="form-control input-sm dpd2" value="<?php if(isset($post->date_to)) echo date("d/m/Y",strtotime($post->date_to)); else if(isset($_GET['todate'])) echo urldecode($_GET['todate']); else echo date("d/m/Y");?>"/>
		    </div>
		    <div class="col-sm-2"><input type="submit" class="btn btn-warning show-rates" value="Show"></div>
		  </div>
		  <!-- <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Base Allotments</label>
		    <div class="col-sm-6">
			    <div class="input-group col-sm-2">
					<input step="any" name="baseallotments"  class="form-control input" placeholder="" type="text" value="<?=$post->allotments;?>"><span class="input-group-addon pointer" onclick="copyAlt('new')"><i class="fa fa-angle-double-right"></i></span>
			    </div>
		   </div>
		  </div> -->
		</form>
		<form class="form-horizontal" method="post" action="<?=base_url()?>admin/ajaxcalls/newpostPrice?action=update_rates">
			<input type="hidden" name="room_id" value="<?=$_GET['room'];?>"/>
	  		<input type="hidden" name="room" value="<?=$_GET['room'];?>"/>
	  		<input type="hidden" name="type" value="<?=$_GET['type'];?>"/>
	  		<input type="hidden" name="action" value="<?=$_GET['action'];?>"/>
		<?php  
		if(isset($_GET['fromdate'])){
		$period = $this->hotels_lib->intervalDate(urldecode($_GET['fromdate']),urldecode($_GET['todate']));
	?>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">&nbsp;</label>
		    <div class="col-sm-9">
				 <table class="table table-bordered table-hover ratiers">
				 	<thead>
				 		<tr>
				 			<th>No</th>
				 			<th>Date</th>
				 			<th class="text-center">Rate
				 				<!-- <input type="text" name="rate" size="7" class="th-block tonumber"/> -->
				 			</th>
				 			<th class="text-center">Allotment
				 				<div class="input-group col-sm-2" style="margin: 0 auto;">
				 				<input step="any" name="baseallotments"  class=" th-block" style="width:60px" placeholder="" type="text" value="<?=$post->allotments;?>"><span class="input-group-addon pointer" style="padding-top:0;padding-bottom:0;" onclick="copyAlt('new')"><i class="fa fa-angle-double-right"></i></span>
				 				</div>
				 			</th>
				 			<th class="text-center">Close
				 				<!--input type="checkbox" name="close" value="1" class="th-block check-close"/-->		
				 			</th>
				 			<th class="text-center">Status</th>
				 		</tr>
				 		
				 	</thead>
				 	<tbody>
				 		<?php
				 		
				 		foreach($period as $k=>$dt):?>
				 		<tr>
				 			<td><?=$k+1;?></td>
				 			<td><?= $dt->format( "l, d-m-Y" );?></td>
				 			<td><input type="text" name="listrate[<?=$dt->format("d-m-Y");?>]" value="<?=isset($listrate[$dt->format( "Y-m-d")])?number_format($listrate[$dt->format( "Y-m-d")]->rate_bar):number_format($room[0]->bar);?>" size="7" class="th-block checkclose tonumber"/></td>
				 			<td><input type="text" name="listalt[<?=$dt->format("d-m-Y");?>]" size="3"  class="th-block alt" value="<?=$listrate[$dt->format( "Y-m-d")]->allotments;?>"/></td>
				 			<td><input type="checkbox" name="listclose[<?=$dt->format("d-m-Y");?>]" value="1" class="th-block" <?=(strtotime($dt->format("Y-m-d"))<strtotime(date("Y-m-d")) || (isset( $listrate[$dt->format( "Y-m-d")]->in_active) && $listrate[$dt->format( "Y-m-d")]->in_active==0))?'checked':'';?>/></td>
				 			<td class="text-center"><?=isset($listrate[$dt->format( "Y-m-d")])?'<span class="label label-success">Set</span>':'<span class="label label-danger">Not Set</span>';?></td>
				 		</tr>
				 		<?php
						endforeach;
				 		?>
				 	</tbody>
				 </table>
			</div>
		</div>
	<?php
	} ?>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Policy</label>
		    <div class="col-sm-6">
		    	<input type="hidden" name="cancellationPolicy" value="<?=isset($listrate)?$listrate[$dt->format( "Y-m-d")]->role_id:'';?>"/>&nbsp
			  <a  class="getCancellation" data-toggle="modal" data-target="#myModal" style="line-height: 38px;">+ Choose Cancellation Policy</a>
			  <textarea class="form-control" name="policy" readonly=""><?=isset($listrate)?$listrate[$dt->format( "Y-m-d")]->cancel_title.", ".$listrate[$dt->format( "Y-m-d")]->cancel_desc:'';?></textarea>
		    </div>
		  </div>
		 
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
	  
	 <div class="panel-footer">
	    <a href="<?=base_url().$this->uri->segment(1)?>/hotels/updaterates" class="btn btn-danger canceladd">Cancel</a><button type="submit" class="btn btn-success">Submit</button>
	  </div>
</div>
<?php } ?>
<script>
	$(this).find(".contentC").remove();
	$.getJSON( "<?=base_url();?>admin/ajaxcalls/getCancellation", function( data ) {
	  var ul = $('<ul/>').addClass('contentC').appendTo('.modal-body');
		  $.each( data, function( key, val ) {
		   var li = $('<li><strong>'+val.title+'</strong><p>'+val.description+' <br/>From '+val.start_date+' to '+val.end_date+'</p> <a class="">Asign</a></li>').appendTo(ul);
		   li.click(function(){
		   	$('input[name="cancellationPolicy"]').val(val.id);
		   	$('textarea[name="policy"]').text(val.title+', '+val.description);
		  	$('#myModal').modal('hide');
		  	
		  });
	  });
	});
	
	$('.dpd1').datepicker({format : "DD-MM-YYYY"});
</script>