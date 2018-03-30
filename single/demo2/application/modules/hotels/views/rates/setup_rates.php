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
<h1 class="title"><i class="fa fa-cog"></i> Setup Rates</h1>
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
 <?php if(isset($_GET['room'])):
 	$roomdetail = getShortRoom($_GET['room'])[0];?> 
<div class="panel panel-default formadd" >
  <h2 class="head">Rate Tiers</h2>
  <div class="panel-body">
  	<form class="form-horizontal" method="post" action="<?=base_url()?>admin/ajaxcalls/postPrice?<?=time();?>">
  		<input type="hidden" name="roomID" value="<?=$rooms[0]->room_id;?>" />
  	<div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Master Rate</label>
		    <div class="col-sm-2">
		     	<input type="hidden" name="master_rate" readonly="" class="form-control" value="<?=$rooms[0]->room_basic_price;?>"/><label class="control-label label label-primary">IDR <?=number_format($rooms[0]->room_basic_price);?></label>
		    </div>
		  </div>
		  
		  <div class="form-group information">
		  	
		    <label for="inputPassword3" class="col-sm-2 control-label">&nbsp;</label>
	     	 <div class="col-sm-2" class="bar-rate">
			 Less from Master rate
	    	 </div>
		     <div class="col-sm-3 val">
		     	 Value
			</div>
		     <div class="col-sm-3 val">
		      	Result
		     </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">BAR Rate</label>
	     	 <div class="col-sm-2" class="bar-rate">
			      <select name="barPerc" class="form-control cure">
			      	<option value="percentage" <?=(isset($rooms[0]->barPerc) && $rooms[0]->barPerc=="percentage")?"selected":"";?>/>%
			      	<option value="fixed" <?=(isset($rooms[0]->barPerc) && $rooms[0]->barPerc=="fixed")?"selected":"";?>/>idr
			      </select>
	    	 </div>
		     <div class="col-sm-3 val">
		      <input type="text" name="barCur" class="form-control valuefix Mbar tonumber" data-type="bar" value="<?=(isset($rooms[0]->barCur))?number_format($rooms[0]->barCur):"";?>"/>
		     </div>
		     <div class="col-sm-3 val">
		      <input type="text" readonly=""  class="form-control Vbar values" name="bar" value="<?=isset($rooms[0]->bar)?number_format($rooms[0]->bar):"";?>"/>
		     </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Mobile Rate</label>
	     	 <div class="col-sm-2" class="bar-rate">
			      <select name="mobPerc" class="form-control cure">
			      	<option value="percentage" <?=(isset($rooms[0]->mobPerc) && $rooms[0]->mobPerc=="percentage")?"selected":"";?>/>%
			      	<option value="fixed" <?=(isset($rooms[0]->mobPerc) && $rooms[0]->mobPerc=="fixed")?"selected":"";?>/>idr
			      </select>
	    	 </div>
		     <div class="col-sm-3 val">
		      <input type="text" name="mobCur" class="form-control valuefix Mmobile" data-type="mobile" value="<?=(isset($rooms[0]->mobCur))?number_format($rooms[0]->mobCur):"";?>"/>
		     </div>
		     <div class="col-sm-3 val">
		      <input type="text" readonly=""  class="form-control Vmob values" name="mob" value="<?=isset($rooms[0]->mob)?number_format($rooms[0]->mob):"";?>"/>
		     </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">B2B Rate</label>
	     	 <div class="col-sm-2" class="bar-rate">
			      <select name="b2bPerc" class="form-control cure">
			      	<option value="percentage" <?=(isset($rooms[0]->b2bPerc) && $rooms[0]->b2bPerc=="percentage")?"selected":"";?>/>%
			      	<option value="fixed" <?=(isset($rooms[0]->b2bPerc) && $rooms[0]->b2bPerc=="fixed")?"selected":"";?>/>idr
			      </select>
	    	 </div>
		     <div class="col-sm-3 val">
		      <input type="text" name="b2bCur" class="form-control valuefix Mbtwob" data-type="btwob" value="<?=(isset($rooms[0]->b2bCur))?number_format($rooms[0]->b2bCur):"";?>"/>
		     </div>
		     <div class="col-sm-3 val">
		      <input type="text" readonly="" value="<?=isset($rooms[0]->b2b)?number_format($rooms[0]->b2b):"";?>" class="form-control Vb2b values" name="b2b"/>
		     </div>
		  </div>
		
  </div>
  <div class="panel-footer">
    <span class="btn btn-danger canceladd">Cancel</span><button type="submit" class="btn btn-success">Save</button>
    </form>
  </div>
</div>
<?php endif;?>
<script>
function copyPrices(id){
  var mainprice = $("#"+id+"_mon").val();
  $("#"+id+"_tue").val(mainprice);
  $("#"+id+"_wed").val(mainprice);
  $("#"+id+"_thu").val(mainprice);
  $("#"+id+"_fri").val(mainprice);
  $("#"+id+"_sat").val(mainprice);
  $("#"+id+"_sun").val(mainprice);
}
$(".bar").bind("keyup change", function(e){
	genPrice(this,"td");
})
$(".valuefix").bind("keyup change", function(e){
	genPrice(this,"");
})
$(".cure").bind("keyup change", function(e){
	genPrice(this,"");
})
function genPrice(datas,table){ 
	var master	= $('input[name="master_rate"]').val();
	if(table!=''){
		var input	= $(datas).closest('tr'),
			val		= input.find('input.bar').val(),
			percentageMobile = $('input.Mmobile').val().replace(",",""),
			master	= input.find('input.bar').val().replace(",","");
			percentageB2b = $('input.Mbtwob').val().replace(",","");
			
			MASTER_BAR	= $('input.Vbar').val().replace(",","");
			cek_P		= ((MASTER_BAR-val)/MASTER_BAR)*100;
			MASTER_MOB	= $('input.Vmob').val().replace(",","");
			MASTER_B2B	= $('input.Vb2b').val().replace(",","");
			hasilMobile	= Math.round(MASTER_MOB-(MASTER_MOB/100*cek_P));
			hasilBtwob	= Math.round(MASTER_B2B-(MASTER_B2B/100*cek_P));
			
			
		input.find('input.mobile').val(numberformat(hasilMobile));
		input.find('input.btwob').val(numberformat(hasilBtwob));
	}else{
		
		var input	= $(datas).closest('.form-group'),
			val		= input.find('input.valuefix').val().replace(",",""),
			type	= input.find('input.valuefix').attr('data-type').replace(",",""),
			cat		= input.find('select').val();
			
			if(type!='bar'){
				var master = $('input[name="bar"]').val().replace(",","");
			}
			if(cat=="percentage"){
				var hasil = master-(master*val/100);
			}else{
				var hasil = master-val;
			}
			input.find('input.values').val(numberformat(hasil));
			$('input.'+type).val(numberformat(hasil));
	}
	
}
function addSeparatorsNF(nStr, inD, outD, sep)
{
	nStr += '';
	var dpos = nStr.indexOf(inD);
	var nStrEnd = '';
	if (dpos != -1) {
		nStrEnd = outD + nStr.substring(dpos + 1, nStr.length);
		nStr = nStr.substring(0, dpos);
	}
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(nStr)) {
		nStr = nStr.replace(rgx, '$1' + sep + '$2');
	}
	return nStr + nStrEnd;
}
function addCommas(nStr)
{
	nStr += '';
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