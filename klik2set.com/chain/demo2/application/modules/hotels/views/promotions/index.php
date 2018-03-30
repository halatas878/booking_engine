<style>
	.bold{
		font-weight:bold !important;
	}.panel-body {
	    padding: 15px 0 15px 0;
	}
</style>

<h1 class="title"><i class="fa fa-bullhorn"></i> <?=$page_title;?></h1>
<div class="panel panel-default">
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
  </div>
</div>	

<?php if(isset($_GET['temp']) && isset($_GET['room'])):?>
<div class="panel panel-default formadd" >
  <h2 class="head">Create/ Overwrite Promotion</h2>
  <div class="panel-body">
  	<form class="form-horizontal" method="post" action="">
  		<input type="hidden" name="room_id" value="<?=$_GET['room'];?>"/>
  		<?php
  		if(isset($_GET['data'])){
  			echo '<input type="hidden" name="id" value="'.$_GET['data'].'"/>';
  		}
  		?>
  		
 		<div class="form-group m0">
		    <label for="inputPassword3" class="col-sm-2 control-label">Bare Rate</label>
		    <div class="col-sm-2">
		     	<input type="hidden" name="master_rate" readonly="" class="form-control" value="<?=$room[0]->baseBAR;?>"/><label class="control-label">: IDR <?=number_format($room[0]->baseBAR);?></label>
		    </div>
		    
		  </div>
		  <?php
		  if($slug!="bonus-night"):
		  ?>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Discount</label>
		     <div class="col-sm-2 val">
		     	<div class="input-group">
			     	<input type="text" name="discount" class="form-control valuefix" data-type="discount" value="<?=$promote->discount;?>"/><span class="input-group-addon">%</span>
			  	</div>
		     </div>
		     <div class="col-sm-3 val">
		      <input type="text" readonly=""  class="form-control Vbar values" name="curency" value="<?=isset($promote->curency)?$promote->curency:$room[0]->baseBAR;?>"/>
		     </div>
		  </div>
		  <?php
		  else:
			  ?>
			  <input type="hidden" class="form-control Vbar values" name="curency" value="<?=isset($promote->curency)?$promote->curency:$room[0]->baseBAR;?>"/>
			  <?php
		  endif;
		  ?>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Booking Period</label>
		    <div class="col-sm-10">	
		    	<span class="labe">From</span>
		        <input type="text" placeholder="From" name="start_booking_period" class="form-control input-sm dpd1" value="<?=isset($promote->start_booking_period)?date("m/d/Y",strtotime($promote->start_booking_period)):date("d/m/Y");?>" style="width: 100px; display: inline-block;"/>
		    	<span class="labe">To</span>
		        <input type="text" placeholder="To" name="finish_booking_period" class="form-control input-sm dpd1" value="<?=isset($promote->finish_booking_period)?date("d/m/Y",strtotime($promote->finish_booking_period)):date('d/m/Y');?>" style="width: 100px; display: inline-block;"/>
		        
		        <?php if($slug!="bonus-night"): $day = array("mon","tue","wed","thu","fri","sat","sun");?>
		        <span class="p20" style="padding-right:20px;">&nbsp;</span>
		    	<?php foreach ($day as $k => $v) { ?>
		    	<label class="second <?php if($v=="fri") echo 'text-success bold'; else if($v=="sun") echo 'text-danger bold';?>" for="book-<?=$v;?>"><input type="checkbox" class="form-control" name="book-<?=$v;?>" value="1" id="book-<?=$v;?>" <?=($promote->book-$v==1)?'checked':'';?>/> <?=strtoupper($v);?></label>
		    	<?php } endif; ?>
		        
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Stay Period</label>
		    <div class="col-sm-10">	
		    	<span class="labe">From</span>
		        <input type="text" placeholder="From" name="start_stay_period" class="form-control input-sm dpd1" value="<?=isset($promote->start_stay_period)?date("m/d/Y",strtotime($promote->start_stay_period)):date("d/m/Y");?>" style="width: 100px; display: inline-block;"/>
		    	<span class="labe">To</span>
		        <input type="text" placeholder="To" name="finish_stay_period" class="form-control input-sm dpd1" value="<?=isset($promote->finish_stay_period)?date("d/m/Y",strtotime($promote->finish_stay_period)):date('d/m/Y');?>" style="width: 100px; display: inline-block;"/>
		        
		         <?php if($slug!="bonus-night"): $day = array("mon","tue","wed","thu","fri","sat","sun");?>
		        <span class="p20" style="padding-right:20px;">&nbsp;</span>
		    	<?php foreach ($day as $k => $v) { ?>
		    	<label class="second <?php if($v=="fri") echo 'text-success bold'; else if($v=="sun") echo 'text-danger bold';?>" for="stay-<?=$v;?>"><input type="checkbox" class="form-control" name="stay-<?=$v;?>" value="1" id="stay-<?=$v;?>" <?=($promote->$v==1)?'checked':'';?>/> <?=strtoupper($v);?></label>
		    	<?php } endif; ?>
		   
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Booking Conditions</label>
		    <div class="col-sm-10">	
		    	<table class="form">
		    		<?=$tr;?>
		    	</table>
		    </div>
		  </div>
		 
		  
		  
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Policy</label>
		    <div class="col-sm-6">
		    	<input type="hidden" name="cancellationPolicy" value="<?=$promote->cancellation;?>"/>&nbsp
			  <a  class="getCancellation" data-toggle="modal" data-target="#myModal" style="line-height: 38px;">+ Choose Cancellation Policy</a>
			  <textarea class="form-control" name="policy" readonly=""><?=$promote->description;?></textarea>
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
	    <a href="<?=base_url().$this->uri->segment(1)?>/hotels/promotions/<?=$slug;?>?room=<?=$_GET['room'];?>" class="btn btn-danger canceladd">Cancel</a><button type="submit" class="btn btn-success">Save</button>
	  </div>
	</form>
  </div>
<?php endif; if(!isset($_GET['temp']) && isset($_GET['room'])):?>
<div class="panel">
  <h2 class="head"><?=ucwords(str_replace("-"," ",$slug));?> Promotions</h2>
  <a href="<?=base_url();?><?=$this->uri->segment(1);?>/hotels/promotions/<?=$slug;?>?room=<?=$_GET['room'];?>&temp=true&type=&action=add" class="btn btn-success addnew">+Add New</a>
  <div class="panel-body">
  	<table class="table table-bordered">
  		<thead>
  			<tr>
	  			<th>Booking Period</th>
	  			<th>Stay Period</th>
	  			<th>Rate</th>
	  			<th>Rules</th>
	  			<th>Action</th>
  			</tr>
  		</thead>
  		<tbody>
  			<?php if(count($promotions)>0): foreach($promotions as $k=>$v){?>
  			<tr id="tr_<?=$v->id;?>">
	  			<td><?=date("d M Y", strtotime($v->start_booking_period))." to ".date("d M Y", strtotime($v->finish_booking_period));?></td>
	  			<td><?=date("d M Y", strtotime($v->start_stay_period))." to ".date("d M Y", strtotime($v->finish_stay_period));?></td>
	  			<td><?='IDR '.number_format($v->curency).'/Night(s)' ;
	  				if($slug=="bonus-night") echo '<br/><span class="text-success">Pay '.$v->pay.' night(s) Stay '.$v->stay.' night(s)</span>';
					else echo '<br/><span class="text-success">Disc '.$v->discount.'% from BAR Rate</span>';
	  				?></td>
	  			<td><?=$v->title;?></td>
	  			<td ><span class="btn-group"><a class="btn btn-warning" href="<?=base_url().$this->uri->segment(1)."/hotels/promotions/hot-deals?room=".$_GET['room']."&type=&temp=true&action=edit&data=".$v->id?>" title="Edit" target="_self"><i class="fa fa-edit"></i></a></span>
			    		<span class="btn-group btn btn-danger delete" id="<?=$v->id;?>" ><i class="fa fa-trash-o"></i></span></td>
	  		</tr>
	  		<?php } endif;?>
  		</tbody>
  	</table>
  </div>
</div>
<?php endif;?>
<script>
	$(this).find(".contentC").remove();
	$.getJSON( "<?=base_url();?>admin/ajaxcalls/getCancellation", function( data ) {
	  var ul = $('<ul/>').addClass('contentC').appendTo('.modal-body');
		  $.each( data, function( key, val ) {
		   var li = $('<li><strong>'+val.title+'</strong><p>'+val.description+'</p> <a class="">Asign</a></li>').appendTo(ul);
		   li.click(function(){
		   	$('input[name="cancellationPolicy"]').val(val.id);
		   	$('textarea[name="policy"]').text(val.title+', '+val.description);
		  	$('#myModal').modal('hide')
		  });
	  });
	});
	function copyAlt(data){
		var baseAlt	= $('input[name="baseallotments"]').val();
		$('.alt').val(baseAlt);
	}
	
	$('input[name="discount"]').bind("keyup change", function(e){
		var val = $(this).val(),
			bar = <?=$room[0]->baseBAR;?>,
			cur = bar-(Math.round(val/100*bar));
		$('input[name="curency"]').val(cur);
	});
	$(".delete").click(function(){
      var id =  $(this).attr('id');
      $.alert.open('confirm', 'Are you sure you want to delete', function(answer) {
         if (answer == 'yes'){
            $.post("<?=base_url().$this->uri->segment(1);?>/hotelajaxcalls/deletePromotion", { id: id }, function(theResponse){
            $("#tr_"+id).fadeOut('slow');
         });
       }
        });
    });
    
</script>