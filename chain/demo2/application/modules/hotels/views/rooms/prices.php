<?php echo $errormsg;?>

<?php
$day = array("Monday","Tuesday","Wednesday","Thuesday","Friday","Saturday","Sunday");
if(isset($_GET['dataid']) || isset($_GET['edit'])){
	?>
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
		}
	</style>
	<div class="panel panel-default">
	  <div class="panel-heading">Rates & Allotments</div>
	  <div class="panel-body">
	  	<?php
	  	$roomid = $this->uri->segment(5);
		if(isset($_GET['dataid'])){
			$dataid=$_GET['dataid'];
			$datashort = getShortPrices($dataid)[0];
			$datadetails= getDetailPrices($dataid)[0];
		}else{
			$dataid="";
		}
		$roomdetail = getShortRoom($roomid)[0];
	  	?>
	  	<form class="form-horizontal" method="post" action="<?=base_url()?>admin/ajaxcalls/postPrice?<?=time();?>">
		  <?php if(!$_GET['dataid']):?>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Hotel</label>
		    <div class="col-sm-5">
		      <select name="hotel" class="form-control">
		       	<option value="">Choose Hotel</option>
		       	<?php
	  			$hotellist = getHotels("","yes");
		       	foreach($hotellist as $k=>$v):
					echo '<optgroup label="'.$k.'">';
					foreach($v as $key=>$val):
						echo '<option value="'.$val->id.'"/>'.$val->title;	
					endforeach;
					echo '</optgroup>';
				endforeach;
		       	?>
		       </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Room</label>
		    <div class="col-sm-5 selectRooms">
		    </div>
		  </div>
		  <?php else:
		  $Mcur = json_decode($datadetails->Mcur);
		  $Pmaster = json_decode($datadetails->Pmaster);
		  ?>
		  <!-- <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Hotel</label>
		    <div class="col-sm-5 selectRooms">
		    	<label class="control-label label label-primary"><?=$datashort->hotelname;?></label>
		    	<input name="hotel" value="<?=$datashort->roomhotel;?>" type="hidden"/>
		    </div>
		  </div> -->
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Room</label>
		    <div class="col-sm-5 selectRooms">
		    	<label class="control-label label label-primary"><?=$roomdetail->room_title;?></label>
		    	<input name="room" value="<?=$datashort->roomid;?>" type="hidden"/>
		    </div>
		  </div>
		  <input type="hidden" name="id" value="<?=dataid;?>"/>
		  <?php endif;?>
		  
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
		  
		   <div class="separator" data-title="Weekday rates"></div>
		   <label for="inputPassword3" class="col-sm-1 control-label">&nbsp;</label>
	     	 <div class="col-sm-11">
			   <table class="table table-borderd">
			   	<thead>
			   		<tr>
			   			<th>Day</th>
			   			<th>BAR</th>
			   			<th>Mobile</th>
			   			<th>B2B</th>
			   		</tr>
			   	</thead>
			   	<?php
			   	for($a=0;$a<4;$a++):
					$ahari	= "A".strtolower(substr($day[$a],0,3));
					if(isset($datadetails->$ahari))
						$Alist=json_decode($datadetails->$ahari);
					$phari	= "P".strtolower(substr($day[$a],0,3));
					if(isset($datadetails->$phari))
						$Plist=json_decode($datadetails->$phari);
					
			   	?>
			   		<tr>
			   			<td>
			   				<label for="inputPassword3" class="col-sm-2 control-label"><?=$day[$a];?></label></td>
			   			<td>
			   				<div class="form-group">
			   					<div class="col-md-12"><input type="number" class="form-control col-md-10 bar" name="price[<?=$day[$a]?>][bar]" value="<?=isset($Plist->bar)?$Plist->bar:"";?>"/></div>
			   					<div class="col-md-12">
			   						<div class="form-group">
			   							<label for="inputPassword3" class="control-label">Allotments</label>
			   							<div class="col-md-6"><input type="number" name="allotments[<?=$day[$a]?>][bar]" class="form-control" value="<?=isset($Alist->bar)?$Alist->bar:"";?>"/></div>
			   						</div>			
			   					</div>
			   				</div>
			   			</td>
			   			<td>
							<div class="form-group">
			   					<div class="col-md-12"><input type="number" class="form-control col-md-10 mobile" name="price[<?=$day[$a]?>][mob]" readonly=""  value="<?=isset($Plist->mob)?$Plist->mob:"";?>"/></div>
			   					<div class="col-md-12">
			   						<div class="form-group">
			   							<label for="inputPassword3" class="control-label" >Allotments</label>
			   							<div class="col-md-6"><input type="number" name="allotments[<?=$day[$a]?>][mob]" class="form-control"  value="<?=isset($Alist->mob)?$Alist->mob:"";?>"/></div>
			   							
			   						</div>			
			   					</div>
			   				</div></td>
			   			<td><div class="form-group">
			   					<div class="col-md-12"><input type="number" class="form-control col-md-10 btwob" name="price[<?=$day[$a]?>][b2b]" readonly=""  value="<?=isset($Plist->b2b)?$Plist->b2b:"";?>"/></div>
			   					<div class="col-md-12">
			   						<div class="form-group">
			   							<label for="inputPassword3" class="control-label" >Allotments</label>
			   							<div class="col-md-6"><input type="number" name="allotments[<?=$day[$a]?>][b2b]" class="form-control"  value="<?=isset($Alist->b2b)?$Alist->b2b:"";?>"/></div>
			   							
			   						</div>			
			   					</div>
			   				</div></td>
			   		</tr>
			   		<?php
					endfor;
			   		?>   	
			   </table>
		   	  </div>
		  		<div class="separator" data-title="Weekday rates"></div>
		   <label for="inputPassword3" class="col-sm-1 control-label">&nbsp;</label>
	     	 <div class="col-sm-11">
			   <table class="table table-borderd">
			   	<thead>
			   		<tr>
			   			<th>Day</th>
			   			<th>BAR</th>
			   			<th>Mobile</th>
			   			<th>B2B</th>
			   		</tr>
			   	</thead>
			   	<?php
			   	for($a=4;$a<7;$a++):
					$ahari	= "A".strtolower(substr($day[$a],0,3));
					if(isset($datadetails->$ahari))
						$Alist=json_decode($datadetails->$ahari);
					$phari	= "P".strtolower(substr($day[$a],0,3));
					if(isset($datadetails->$phari))
						$Plist=json_decode($datadetails->$phari);
			   	?>
			   		<tr>
			   			<td>
			   				<label for="inputPassword3" class="col-sm-2 control-label"><?=$day[$a];?></label></td>
			   			<td>
			   				<div class="form-group">
			   					<div class="col-md-12"><input type="number" name="price[<?=$day[$a]?>][bar]" class="form-control col-md-10 bar"  value="<?=isset($Plist->bar)?$Plist->bar:"";?>"/></div>
			   					<div class="col-md-12">
			   						<div class="form-group">
			   							<label for="inputPassword3" class="control-label">Allotments</label>
			   							<div class="col-md-6"><input type="number" name="allotments[<?=$day[$a]?>][bar]"  class="form-control"  value="<?=isset($Alist->bar)?$Alist->bar:"";?>"/></div>
			   						</div>			
			   					</div>
			   				</div>
			   			</td>
			   			<td>
							<div class="form-group">
			   					<div class="col-md-12"><input type="number" name="price[<?=$day[$a]?>][mob]" class="form-control col-md-10 mobile" readonly=""  value="<?=isset($Plist->mob)?$Plist->mob:"";?>"/></div>
			   					<div class="col-md-12">
			   						<div class="form-group">
			   							<label for="inputPassword3" class="control-label" >Allotments</label>
			   							<div class="col-md-6"><input type="number" name="allotments[<?=$day[$a]?>][mob]" class="form-control"  value="<?=isset($Alist->mob)?$Alist->mob:"";?>"/></div>
			   							
			   						</div>			
			   					</div>
			   				</div></td>
			   			<td><div class="form-group">
			   					<div class="col-md-12"><input type="number" name="price[<?=$day[$a]?>][b2b]" class="form-control col-md-10 btwob" readonly=""  value="<?=isset($Plist->b2b)?$Plist->b2b:"";?>"/></div>
			   					<div class="col-md-12">
			   						<div class="form-group">
			   							<label for="inputPassword3" class="control-label" >Allotments</label>
			   							<div class="col-md-6"><input type="number" name="allotments[<?=$day[$a]?>][b2b]" class="form-control"  value="<?=isset($Alist->b2b)?$Alist->b2b:"";?>"/></div>		
			   						</div>			
			   					</div>
			   				</div></td>
			   		</tr>
			   		<?php
					endfor;
			   		?>   	
			   </table>
		   	  </div> 
		  

		  <div class="separator" data-title="Details"></div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Adult</label>
		    <div class="col-sm-2">
		      <input type="number" name="adult" placeholder="" value="<?=$datadetails->adults;?>" class="form-control"  min="0"/>
		    </div>
		    <label for="inputPassword3" class="col-sm-1 control-label">Children</label>
		    <div class="col-sm-2">
		      <input type="number" name="children" placeholder="" value="<?=$datadetails->children;?>" class="form-control" min="0"/>
		    </div>
		  </div>
		  


  
		 <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Policy</label>
		    <div class="col-sm-6">
		    	<input type="hidden" name="cancellationPolicy" value="<?=$datashort->policy;?>"/>&nbsp
			  <a  class="getCancellation" data-toggle="modal" data-target="#myModal" style="line-height: 38px;">+ Choose Cancellation Policy</a>
			  <textarea class="form-control" name="policy" readonly=""><?=$datashort->cacncellation;?></textarea>
		      
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
	    <div class="clearfix"></div>  
	   </div>
	     <div class="panel-footer">
		    <input type="hidden" name="action" value="update" />
		    <button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		 
	  </div>
	  
	  <div class="panel panel-default">
	  	<div class="panel-heading">Price List</div>
	  	<div class="panel-body">
			    <table class="table table-striped form-horizontal">
			      <thead>
			        <tr>
			          <th>Date From - To</th>
			          <th>BAR Rate (IDR)</th>
			          <th>Mobile Rate (IDR)</th>
			          <th>B2B Rate (IDR)</th>
			          <th>Cancellation</th>
			          <th></th>
			        </tr>
			      </thead>
			      <tbody>
			      <?php if(count(getListPrice($roomid))>0): foreach(getListPrice($roomid) as $p): 
			      	if(!empty($p->Pmaster))
			      		$rates = json_decode($p->Pmaster);
			      	
			      	?>
			        <tr id="tr_<?php echo $p->id;?>">
			          <th><?php echo formatFullDate($p->date_from, $appSettings->dateFormat); ?> - <?php echo formatFullDate($p->date_to, $appSettings->dateFormat); ?></th>
			          <td><?=isset($rates->bar)?number_format($rates->bar):"";?></td>
			          <td><?=isset($rates->mob)?number_format($rates->mob):"";?></td>
			          <td><?=isset($rates->b2b)?number_format($rates->b2b):"";?></td>
			          <td><?=$p->cacncellation;?></td>
			          <td>
			          	<span class="btn-group"><a class="btn btn-sm btn-warning" href="<?=$base;?>/hotels/rooms/prices/<?=$dataid;?>?dataid=<?=$p->id;?>" title="Edit" target="_self"><i class="fa fa-edit"></i>&nbsp;Edit</a></span>
			          	<span class="btn btn-sm btn-danger delete" id="<?php echo $p->id;?>"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</span></td>
			        </tr>
			       <?php endforeach; endif; ?>
			
			
			      </tbody>
			    </table>
			
			  </div>
	  	</div>
	  </div>
	  
	  
	<?php
}else{
?>


<div class="panel panel-default">
  <div class="panel-heading">Room Allotments</div>
  <div class="panel-body">
  
  <div class="row form-group">
  	<form id="addallotment">
    <label class="col-md-2 control-label text-left">Allotment</label>
        <div class="col-md-2">
           <input type="number" name="allotments" placeholder="" value="<?=GetRoomQuantity($roomid);?>" class="form-control"/>
           <input type="hidden" name="roomid" value="<?php echo $roomid;?>" />
        </div>
        <div class="col-md-2">
      		<button class="btn btn-primary allotment" type="button">Save</button>
        </div>
     </form>
  </div>
    <div class="clearfix"></div>  
   </div>
  </div>
   
<div class="panel panel-default">
  <div class="panel-heading">Room Rates</div>
  <div class="panel-body">
  
  <form action="" method="POST" >
    <div class="col-md-2">
      <div class="form-group">
        <label class="required">From Date</label>
        <input type="text" placeholder="From" name="fromdate" class="form-control input-sm dpd1" value="<?php echo set_value('fromdate'); ?>"/>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="required">To Date</label>
        <input type="text" placeholder="To" name="todate" class="form-control input-sm dpd2" value="<?php echo set_value('todate'); ?>"/>
      </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
          <label class="required">Adults</label>
          <select name="adult" class="form-control input input-sm" id="">
            <?php for($adults = 1; $adults <= $room[0]->room_adults; $adults++){ ?>
              <option value="<?php echo $adults; ?>" ><?php echo $adults; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Children </label>
          <select name="child" class="form-control input input-sm" id="">
            <?php for($child = 0; $child <= $room[0]->room_children; $child++){ ?>
              <option value="<?php echo $child; ?>" ><?php echo $child; ?></option>
              <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="required">Extra Bed </label>
          <input type="number" placeholder="" name="bedcharges" class="form-control input  input-sm" value="<?php echo $room[0]->extra_bed_charges;?>" <?php if($room[0]->extra_bed < 1){ echo "readonly"; } ?> />
        </div>
      </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="required">Policy</label>
        	<textarea class="form-control" name="policy"></textarea>
		</div>
    </div>
    <div class="clearfix"></div>
    <div class="well well-sm">
      
      <div class="col-md-2">
        <label class="required">Mon</label>
      <div class="input-group" >

      <input type="number" step="any" name="mon" id="new_mon" class="form-control input" placeholder="<?php echo $appSettings->currencysign;?>" ><span class="input-group-addon pointer"  onclick="copyPrices('new')"><i class="fa fa-angle-double-right"></i></span>
      </div>
      </div>
	
      <div class="col-md-2">
        <div class="form-group">
          <label class="required">Tue</label>
          <input type="number" step="any" id="new_tue" name="tue" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control "/>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="required">Wed</label>
          <input type="number" step="any" id="new_wed" name="wed" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control "/>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="required">Thu</label>
          <input type="number" step="any" id="new_thu" name="thu" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control "/>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="required">Fri</label>
          <input type="number" step="any" id="new_fri" name="fri" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control "/>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="required">Sat</label>
          <input type="number" step="any" id="new_sat" name="sat" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control "/>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="required">Sun</label>
          <input type="number" step="any" id="new_sun" name="sun" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <div>&nbsp;</div>
          <input type="hidden" name="action" value="add" />
          <input type="hidden" name="roomid" value="<?php echo $roomid;?>" />
          <input type="hidden" name="dateformat" value="<?php echo $appSettings->dateFormat;?>" />
          <button class="btn btn-primary" type="submit">Add</button>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    </form>
    <div class="clearfix"></div>
    <hr>
    <form action="" method="POST">
    <table class="table table-striped form-horizontal">
      <thead>
        <tr>
          <th>Date From - To</th>
          <th>Adults</th>
          <th>Children</th>
          <th>Extra Beds</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>Mon</th>
          <th>Tue</th>
          <th>Wed</th>
          <th>Thu</th>
          <th>Fri</th>
          <th>Sat</th>
          <th>Sun</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($prices as $p): ?>
        <tr id="tr_<?php echo $p->id;?>">
          <th><?php echo formatFullDate($p->date_from, $appSettings->dateFormat); ?> - <?php echo formatFullDate($p->date_to, $appSettings->dateFormat); ?></th>
          <td>
            <select name='<?php echo "pricesdata[$p->id][adults]"; ?>' class="form-control input input-sm" id="">
              <?php for($adults = 1; $adults <= $room[0]->room_adults; $adults++){ ?>
              <option value="<?php echo $adults; ?>" <?php if($adults == $p->adults){ echo "selected"; }?> ><?php echo $adults; ?></option>
              <?php } ?>
            </select>
          </td>
          <td>
            <select name='<?php echo "pricesdata[$p->id][child]"; ?>' class="form-control input input-sm" id="">
             <?php for($child = 0; $child <= $room[0]->room_children; $child++){ ?>
              <option value="<?php echo $child; ?>" <?php if($child == $p->children){ echo "selected"; }?> ><?php echo $child; ?></option>
              <?php } ?>
            </select>
          </td>
          <td><input type="number" name='<?php echo "pricesdata[$p->id][extra_bed_charges]"; ?>' placeholder="" class="form-control input input-sm" value="<?php echo $p->extra_bed_charge;?>" <?php if($room[0]->extra_bed < 1){ echo "readonly"; } ?> /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="width:120px;"><div class="input-group" >
          <input type="number" step="any" name='<?php echo "pricesdata[$p->id][mon]"; ?>' id="<?php echo $p->id;?>_mon" class="form-control input input-sm" placeholder="<?php echo $appSettings->currencysign;?>" value="<?php echo $p->mon;?>" ><span class="input-group-addon pointer"  onclick="copyPrices('<?php echo $p->id;?>')"><i class="fa fa-angle-double-right"></i></span>
          </div>
          </td>
          <td><input type="number" step="any" name='<?php echo "pricesdata[$p->id][tue]"; ?>' id="<?php echo $p->id;?>_tue" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control input input-sm" value="<?php echo $p->tue;?>" /></td>
          <td><input type="number" step="any" name='<?php echo "pricesdata[$p->id][wed]"; ?>' id="<?php echo $p->id;?>_wed" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control input input-sm" value="<?php echo $p->wed;?>" /></td>
          <td><input type="number" step="any" name='<?php echo "pricesdata[$p->id][thu]"; ?>' id="<?php echo $p->id;?>_thu" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control input input-sm" value="<?php echo $p->thu;?>" /></td>
          <td><input type="number" step="any" name='<?php echo "pricesdata[$p->id][fri]"; ?>' id="<?php echo $p->id;?>_fri" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control input input-sm" value="<?php echo $p->fri;?>" /></td>
          <td><input type="number" step="any" name='<?php echo "pricesdata[$p->id][sat]"; ?>' id="<?php echo $p->id;?>_sat" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control input input-sm" value="<?php echo $p->sat;?>"/></td>
          <td><input type="number" step="any" name='<?php echo "pricesdata[$p->id][sun]"; ?>' id="<?php echo $p->id;?>_sun" placeholder="<?php echo $appSettings->currencysign;?>" class="form-control input input-sm" value="<?php echo $p->sun;?>" /></td>
          <td><span class="btn btn-sm btn-danger delete" id="<?php echo $p->id;?>"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</span></td>
        </tr>
       <?php endforeach; ?>


      </tbody>
    </table>

  </div>
  <div class="panel-footer">
    <input type="hidden" name="action" value="update" />
    <button class="btn btn-primary" type="submit"> Update </button>
  </div>
  </form>
</div>
<?php
}
?>
<style>
  .input {
  width:60px;
  }
</style>
<script type="text/javascript">
$(function(){
  $(".delete").click(function(){
      var id =  $(this).attr('id');
      $.alert.open('confirm', 'Are you sure you want to delete', function(answer) {
         if (answer == 'yes'){
            $.post("<?php echo $delurl;?>", { id: id }, function(theResponse){
            $("#tr_"+id).fadeOut('slow');
         });
       }
        });
    });
   $("button.allotment").click(function(){
   		$.post( "<?=base_url();?>/admin/hotelajaxcalls/changeAllotments", $( "#addallotment" ).serialize())
   		.done(function() {
		    alert( "second success" );
		  })
		  .fail(function() {
		    alert( "error" );
		  });
   });
   
  });
/*$('.getCancellation').click(function(){*/
	$(this).find(".contentC").remove();
	$.getJSON( "<?=base_url();?>admin/ajaxcalls/getCancellation", function( data ) {
	  var ul = $('<ul/>').addClass('contentC').appendTo('.modal-body');
		  $.each( data, function( key, val ) {
		   var li = $('<li><strong>'+val.title+'</strong><p>'+val.description+' <br/>From '+val.start_date+' to '+val.end_date+'</p> <a class="">Asign</a></li>').appendTo(ul);
		   li.click(function(){
		   	$('input[name="cancellationPolicy"]').val(val.id);
		   	$('textarea[name="policy"]').text(val.title+', '+val.description+' ,From '+val.start_date+' to '+val.end_date);
		  	$('#myModal').modal('hide')
		  });
	  });
	});
/*})*/
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
$('select[name="hotel"]').change(function(){
	var id = $(this).val();
	$('.selectRooms').find('select').remove();
	$.getJSON( "<?=base_url();?>admin/ajaxcalls/getRoom?id="+id, function( data ) {
		  var items = [];
		  $.each( data, function( key, val ) {
		    items.push('<option value="'+val.room_id+'">'+val.room_title+'</option>');
		  });
		 
		  $( "<select/>", {
		    "name": "room",
		    "class":"form-control",
		    html: items.join( "" )
		  }).appendTo( ".selectRooms" );
	});
})
function genPrice(datas,table){ 
	var master	= $('input[name="master_rate"]').val();
	if(table!=''){
		var input	= $(datas).closest('tr'),
			val		= input.find('input.bar').val(),
			percentageMobile = $('input.Mmobile').val(),
			master	= input.find('input.bar').val();
			percentageB2b = $('input.Mbtwob').val();
			
			MASTER_BAR	= $('input.Vbar').val();
			cek_P		= ((MASTER_BAR-val)/MASTER_BAR)*100;
			MASTER_MOB	= $('input.Vmob').val();
			MASTER_B2B	= $('input.Vb2b').val();
			hasilMobile	= Math.round(MASTER_MOB-(MASTER_MOB/100*cek_P));
			hasilBtwob	= Math.round(MASTER_B2B-(MASTER_B2B/100*cek_P));
			
			
		input.find('input.mobile').val(hasilMobile);
		input.find('input.btwob').val(hasilBtwob);
	}else{
		var input	= $(datas).closest('.form-group'),
			val		= input.find('input.valuefix').val(),
			type	= input.find('input.valuefix').attr('data-type'),
			cat		= input.find('select').val();
			if(cat=="percentage"){
				var hasil = master-(master*val/100);
			}else{
				var hasil = master-val;
			}
			input.find('input.values').val((hasil));
			$('input.'+type).val(hasil);
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