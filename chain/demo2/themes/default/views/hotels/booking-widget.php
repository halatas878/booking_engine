<?php
$uri2 = (explode('/',$_SERVER['REQUEST_URI']));
$uri2 = $uri2[1];
?>
<div class="booking-widget" <?=(isset($uri2) && !empty($uri2))?'style="position:unset;"':'';?>> 
  <div class="box">
  	<?php $listhotels = getHotels(); ?>
      <div role="tabpanel" class="tab-pane fade active in" id="HOTELS" aria-labelledby="home-tab">
	      <form action="<?=BASE_URL();?>hotels/" method="GET" role="search" >	   
		      <div class="destinasi-search">
		          <div class="size13 go-right"><b>Select A Hotel</b></div> 
		          <select name="searching" class="chosen-select RTL" id="hotelicon" value="<?php if(!empty($_GET['searching'])){ echo $_GET['searching']; } ?>" required >
			        <option value=""><?=isset($_GET['searching'])?str_replace('-', ' ', $_GET['searching']):trans('0447');?></option>
			        <?php foreach($listhotels as $ke=>$locations): 
					echo '<optgroup label="'.$ke.'">';
			        	foreach($locations as $k=>$v):?>
			        <option value="<?php echo $v->hotel_slug;?>" <?=($_GET['searching']==$v->hotel_slug)?'selected="selected"':'';?>><?php echo $v->title;?></option>
			        <?php endforeach;
						echo '</optiongroup>';
					 endforeach; ?>
			      </select>
		        </div>
		        <div class="checkin-search">
		          <label class="control-label go-right">Check in</label>
		          <input type="text" placeholder=" <?php echo trans('07');?> " name="checkin" class="form-control mySelectCalendar dpd1 go-text-left" value="<?=(isset($checkin))?$checkin:urldecode($_GET['checkin']);?>" required >

		        </div>
		        
		        <div class="checkout-search">
		          <label class="control-label go-right">Check out</label>
		          <input placeholder=" Check out " name="checkout" class="form-control mySelectCalendar dpd2 go-text-left" value="<?=(isset($checkout))?$checkout:urldecode($_GET['checkout']);?>" required type="text">
		        </div>
		        
		        <div class="room-search">
		          <div class="size13 go-right"><b>Rooms</b></div>
		          <select class="form-control selectx" name="Rooms">
		            <option <?=($_GET['Rooms']==1)?'selected':'';?>>1</option>
		            <option <?=($_GET['Rooms']==2)?'selected':'';?>>2</option>
		            <option <?=($_GET['Rooms']==3)?'selected':'';?>>3</option>
		            <option <?=($_GET['Rooms']==4)?'selected':'';?>>4</option>
		            <option <?=($_GET['Rooms']==5)?'selected':'';?>>5</option>
		          </select>
		        </div>
		        
		        <!-- <div class="person-search">
		          <div class="size13 go-right"><b>Person</b></div>
		          <select class="form-control selectx" name="Person">
		            <option selected="">0</option>
		            <option>1</option>
		            <option>2</option>
		            <option>3</option>
		            <option>4</option>
		            <option>5</option>
		          </select>
		        </div> -->
		        <div class="promo-search">
		          <div class="size13 go-right"><b>Promo Code</b></div>
		          <input class="form-control selectx" name="Promocode" value="<?=$_GET['Promocode'];?>">
		      </input>
		        </div>
		        <div class="form-group">
		        	<label class="control-label">&nbsp;</label>
					<button type="submit" class="btn btn-primary btn-lg btn-block btn-widget w20"><?=(isset($uri2) && !empty($uri2))?'UPDATE':'BOOK';?></button>
		        </div>
			</form>
		</div>
	</div>
</div>