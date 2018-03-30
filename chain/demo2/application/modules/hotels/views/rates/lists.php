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
	}
</style>
<h4>Setup Rates</h4>
<div class="panel panel-default">
  <div class="panel-heading">Search Room</div>
 	 <div class="panel-body">
 	 	
	  <form action="" method="GET">
		  <div class="row form-group">
		    <label class="col-md-1 control-label text-left"  style="position: relative;top:10px">Room</label>
		    <div class="col-md-4 selectRooms">
		        <select name="room" class="form-control">
		        	<option value=""/>Choose Room
		        	<?php $hotelid = $this->session->userdata('hotel'); if(count(getHotelRooms($this->session->userdata('hotel')))>0): foreach(getHotelRooms($hotelid) as $k=>$v):?>
		        		<option value="<?=$v->room_id;?>" <?=($_GET['room']==$v->room_id)?"selected":"";?>/><?=$v->room_title;?>
		        	<?php endforeach; endif;?>
		        </select>
		    </div>
		    
 	<?php var_dump(getShortRoom());?>asas
		    <div class="col-md-2">
		    	<input type="hidden" type="hidden" value="<?=$_GET['type'];?>" name="type"/>
		  		<button class="btn btn-info" type="submit">Search</button>
		    </div>
		  </div>
	</form>
    <div class="clearfix"></div>  
   </div>
 </div> 
  <style>
  	span.block{
  		display: block
  	}span.block  em{
  		width:20px;
  		text-decoration:none;
  		font-style:normal
  	}
  </style>
 <?php if(isset($_GET['room'])):
 	$roomdetail = getShortRoom($_GET['room'])[0];?> 
<div class="panel panel-default formadd"  style="display:none">
  <div class="panel-heading">Add New Rates</div>
  <div class="panel-body">
  	<form class="form-horizontal" method="post" action="<?=base_url()?>admin/ajaxcalls/postPrice?<?=time();?>">
  	<div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Master Rate</label>
		    <div class="col-sm-2">
		     	<input type="hidden" name="master_rate" readonly="" class="form-control" value="<?=$roomdetail->room_basic_price;?>"/><label class="control-label label label-primary">IDR <?=number_format($roomdetail->room_basic_price);?></label>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">From</label>
		    <div class="col-sm-2">
		        <input type="text" placeholder="From" name="fromdate" class="form-control input-sm dpd1" value="<?=$datashort->date_from;?>"/>
		    </div>
		    <label for="inputEmail3" class="col-sm-1 control-label">To</label>
		    <div class="col-sm-2">
		        <input type="text" placeholder="To" name="todate" class="form-control input-sm dpd2" value="<?=$datashort->date_to;?>"/>
		    </div>
		  </div>
		 
		  
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">BAR Rate</label>
	     	 <div class="col-sm-2" class="bar-rate">
			      <select name="cur[bar]" class="form-control cure">
			      	<option value="percentage" <?=(isset($Mcur->bar->type) && $Mcur->bar->type=="percentage")?"selected":"";?>/>%
			      	<option value="fixed" <?=(isset($Mcur->bar->type) && $Mcur->bar->type=="fixed")?"selected":"";?>/>idr
			      </select>
	    	 </div>
		     <div class="col-sm-3 val">
		      <input type="number" name="value[bar]" class="form-control valuefix Mbar" data-type="bar" value="<?=(isset($Mcur->bar->value))?$Mcur->bar->value:"";?>"/>
		     </div>
		     <div class="col-sm-3 val">
		      <input type="text" readonly=""  class="form-control Vbar values" name="master[bar]" value="<?=isset($Pmaster->bar)?$Pmaster->bar:"";?>"/>
		     </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Mobile Rate</label>
	     	 <div class="col-sm-2" class="bar-rate">
			      <select name="cur[mobile]" class="form-control cure">
			      	<option value="percentage" <?=(isset($Mcur->mob->type) && $Mcur->mob->type=="percentage")?"selected":"";?>/>%
			      	<option value="fixed" <?=(isset($Mcur->mob->type) && $Mcur->mob->type=="fixed")?"selected":"";?>/>idr
			      </select>
	    	 </div>
		     <div class="col-sm-3 val">
		      <input type="number" name="value[mobile]" class="form-control valuefix Mmobile" data-type="mobile" value="<?=(isset($Mcur->mob->value))?$Mcur->mob->value:"";?>"/>
		     </div>
		     <div class="col-sm-3 val">
		      <input type="text" readonly=""  class="form-control Vmob values" name="master[mob]" value="<?=isset($Pmaster->bar)?$Pmaster->mob:"";?>"/>
		     </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">B2B Rate</label>
	     	 <div class="col-sm-2" class="bar-rate">
			      <select name="cur[b2b]" class="form-control cure">
			      	<option value="percentage" <?=(isset($Mcur->b2b->type) && $Mcur->b2b->type=="percentage")?"selected":"";?>/>%
			      	<option value="fixed" <?=(isset($Mcur->b2b->type) && $Mcur->b2b->type=="fixed")?"selected":"";?>/>idr
			      </select>
	    	 </div>
		     <div class="col-sm-3 val">
		      <input type="number" name="value[b2b]" class="form-control valuefix Mbtwob" data-type="btwob" value="<?=(isset($Mcur->b2b->value))?$Mcur->b2b->value:"";?>"/>
		     </div>
		     <div class="col-sm-3 val">
		      <input type="text" readonly="" value="<?=isset($Pmaster->bar)?$Pmaster->b2b:"";?>" class="form-control Vb2b values" name="master[b2b]"/>
		     </div>
		  </div>
		
  </div>
  <div class="panel-footer">
    <span class="btn btn-danger canceladd">Cancel</span><button type="submit" class="btn btn-success">Save</button>
    </form>
  </div>
</div>
<div class="panel panel-default listrate">
  <div class="panel-heading"><span class="btn btn-success addnew">+Add New Rates</span></div>
  <div class="panel-body">
  	
  	<h2></h2>
 	 	<div class="xcrud-list-container">
 	 		<?php
 	 		#echo "<pre>";print_r($rooms);echo "<pre/>";
 	 		?>
		  <table class="xcrud-list table table-striped table-hover">
		    <thead>
		    	<th>Period</th>
		    	<!-- <th>Hotel</th>
		    	<th>Room</th> -->
		    	<th>BAR Rates (IDR)</th>
		    	<th>Policy</th>
		    	<th>Action</th>
		    </thead>
		    <?php 
		    $uri2 = $this->uri->segment(1);
		    $base = base_url().$uri2;
			
		    if(count($rooms>0)) foreach (getListPrice($_GET['room']) as $key => $value):
		    	if(!empty($value->Pmaster))
			      		$rates = json_decode($value->Pmaster);
				
		    ?>
		    
		    
		    <tbody>
		    	<td><?=$value->date_from." to ".$value->date_to;?></td>
		    	<!-- <td><?=($value->hotelname);?></td>
		    	<td><?=$value->room_title;?></td> -->
		    	<td><?=number_format($rates->bar);?></td>
		    	<td><?=$value->cacncellation;?></td>
		    	<td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a class="btn btn-default btn-xcrud btn btn-warning" href="<?=$base;?>/hotels/rooms/prices/<?=$value->room_id;?>?dataid=<?=$value->id;?>" title="Edit" target="_self"><i class="fa fa-edit"></i></a></span></td>	
		    </tbody>
		    <?php endforeach;?>
		  </table>
		</div>
  </div>
</div>
<?php endif;?>
<script>
$('.addnew').click(function(){
	$('.formadd').show();
	$('.listrate').hide();
})
$('.canceladd').click(function(){
	$('.formadd').hide();
	$('.listrate').show();
})
/*$('select[name="hotel"]').change(function(){
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
	});
})*/
  </script>