<section  id="ROOMS" style="background-color:none">
  <br><br>
  <div class="container" style="background-color:#F7F7F7;margin-top: -40px;">
        <div class="rooms-update">
        	
      		<?php  require $themeurl.'views/hotels/booking-widget.php'; ?>
	      <div class="clearfix"></div>
	    </div>
    
    <?php if(!empty($hotelslib->stayerror)){ ?>
    <div class="panel-body">
      <div class="alert alert-danger go-text-right">
        <?php echo trans("0420"); ?>
      </div>
    </div>
    <?php } ?>
    <?php if(empty($rooms)){ ?>
	      <div class="">
		      <div class="alert alert-danger go-text-right">
		        <?php echo '<div class="no-result">'; if(isset($_GET['Promocode'])) echo 'No result promocode'; else echo trans("066"); echo '</div>' ;?>
		      </div>
		  </div>
		  <?php } ?>
    <?php if(!empty($rooms)){
    	if(!empty($_GET['Promocode'])){
    		?>
    		<div class="">
		    	<div class="couponmsg"> <div class="alert alert-success"><a id="popoverData" href="javascript:void(0);" data-content="A promo code is your key to redeeming special discounts. To redeem, enter your promo code and we'll apply the discount to the total cost on your invoice page when you pay. Promo codes can only be used once with each booking, and they're good only up to the total amount of your booking (including service fee and taxes) or promo code amount, whichever is less" rel="popover" data-placement="top" data-original-title="What is a promo code?" data-trigger="hover"><strong>What is a promo code?</strong></a><br/><strong> 10%  </strong> coupon discount has been applied to your booking! please continue by clicking book now to see the discounted price on invoice page.</div>
		    	</div>
		  </div>
    		<?php
    	}
		 
    #echo "<pre>";print_r($rooms);echo "<pre/>";	
    ?>
    <?php foreach($rooms as $r){ if($r->maxQuantity > 0){ ?>
   
      <div class="rooms-update" style="margin-top:0px;margin-bottom:0px">
      	
        <div class="col-lg-4 col-md-4 col-sm-4 offset-0 go-right">
          <div class="img_list">
          <div class="zoom-gallery<?php echo $r->id; ?>">
           <a href="<?php echo $r->thumbnail;?>" data-source="<?php echo $r->thumbnail;?>" title="<?php echo $r->title;?>">
            <img src="<?php echo $r->thumbnail;?>">
            </a>
           </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 offset-0">
        	<style>
        		.roomrates{
        			padding:0 15px;
        		}.roomrates > h4{
        			margin-top: 0;
        			font-weight:bold;
        		}.roomrates > p{
        			display: block;
        		}.itemlabel3:hover{
        			background-color:transparent;
        		}.roomrates  span.crt{
        			display:block;
        			padding: 0px;
					margin: 0px;
					color: #888;
					text-decoration: line-through;
					font-size: 12px;
					font-weight: normal;
					font-style: italic;
					height: 15px;
					line-height: 1;
        		}.roomrates > .ratetiers{
        			border-bottom: thin dotted rgb(234, 234, 234);
					padding-bottom: 5px;
					margin-bottom: 5px;border-bottom: thin dotted rgb(234, 234, 234);
        		}.itemlabel3{
        			height:auto;
        		}.borderless td, .borderless th, .borderless > thead > tr > th, .borderless > tbody > tr > td{
				    border: 0px;
				    border-bottom:thin solid #f3f3f3;
				    padding:0;
				    vertical-align: middle;
				}.block {
					display: block
				}
        	</style>
          <div class="itemlabel3">
          	 <div class="col-lg-12 col-md-12 roomrates">
        		<h4><?php echo $r->title;?></h4>
        		<button data-toggle="collapse" data-parent="#accordion" class="btn  btn-danger btn-xs"  href="#details<?php echo $r->id;?>"><?php echo trans('052');?></button>
                <button data-toggle="collapse" data-parent="#accordion" href="#availability<?php echo $r->id;?>" class="btn btn-info btn-xs"><?php echo trans('0251');?></button>
                <!-- <p class="grey RTL"><?php echo character_limiter($r->desc, 280);?></p> -->
        	 	
      			<table class="table borderless">
      				<thead>
      					<tr>
      						<th>Rate Type</th>
          					<th>No.Rooms</th>
          					<th>Average/Night</th>
          					<th>&nbsp;</th>
      					</tr>
      				</thead>
      				<tbody>
      					<?php if(count($r->Info['promotions'])>0 && empty($_GET['Promocode'])): foreach($r->Info['promotions'] as $k=>$v){?>
          					<tr>
          						<td>
          							<form action="<?php echo base_url();?>hotels/book/<?php echo $hotel->slug;?>" method="GET">
          							<span class="title block"><i class="fa fa-bullhorn"></i> <?=ucwords(str_replace("-"," ",$v['type']));?></span>
          							<?php if($v['discount']>0) echo '<span class="block"><i class="fa fa-money"></i> Save '.$v['discount'].'%</span>';?>
          							<i class="fa fa-info-circle"></i> <a href="#" title="Term & Condition">Terms and conditions</a>
          						</td>
          						<td>
          							<select class="form-control selectx input-sm" name="roomscount" style="width:60px">
				                      <?php  for($q = 1; $q <= $r->maxQuantity; $q++){ ?>
				                      <option value="<?php echo $q;?>"><?php echo $q;?></option>
				                      <?php } ?>
				                    </select>
          						</td>
          						<td>
          							
          							<span class="crt">IDR <?=number_format($r->masterRate);?></span>
	              					<span class="green size18"><b>
				              			<small><?php echo $r->currCode;?>  </small> <?php echo $r->currSymbol; ?><?php echo number_format($v['curency']); ?>
				              		</b></span>
				              		<span class="size11 grey"><?php echo trans('0245');?></span>
					     	        <br/>
	     	         			</td>
          						<td>
          							 
								      <input type="hidden" name="adults" value="<?php  echo $hotelslib->adults; ?>" />
								      <input type="hidden" name="child" value="<?php  echo $hotelslib->children; ?>" />
								      <input type="hidden" name="checkin" value="<?php  echo $hotelslib->checkin; ?>" />
								      <input type="hidden" name="checkout" value="<?php  echo $hotelslib->checkout; ?>" />
								      <input type="hidden" name="roomid" value="<?php echo $r->id; ?>" />
          							<button style="margin-bottom:5px" type="submit" name="promotions" value="<?=$v['id'];?>" class="btn btn-primary btn-block chk"><?php echo trans('0142A');?></button>
          							</form>	
          						</td>
          					</tr>
      					<?php } endif;?>
      					<tr>
          						<td>
          							 <form action="<?php echo base_url();?>hotels/book/<?php echo $hotel->slug;?>" method="GET">
          							<span class="title block">Available Rate</span>
          							<i class="fa fa-info-circle"></i> <a href="#" title="Term & Condition">Terms and conditions</a>
          						</td>
          						<td class="">
          							<select class="form-control selectx input-sm" name="roomscount" style="width:60px">
				                      <?php for($q = 1; $q <= $r->maxQuantity; $q++){ ?>
				                      <option value="<?php echo $q;?>"><?php echo $q;?></option>
				                      <?php } ?>
				                    </select>
          						</td>
          						<td>
          							<span class="crt">IDR <?=number_format($r->masterRate);?></span>
	              					<span class="green size18"><b>
				              			<small><?php echo $r->currCode;?>  </small> <?php echo $r->currSymbol; ?><?php echo number_format($r->Info['perNight']); ?>
				              		</b></span>
				              		<span class="size11 grey"><?php echo trans('0245');?></span>
					     	        <br/>
	     	         			</td>
          						<td>
          							<?php
          							if(!empty($_GET['Promocode'])) echo '<input type="hidden" name="Promocode" value="'.$_GET['Promocode'].'"/>';?>
								      <input type="hidden" name="adults" value="<?php  echo $hotelslib->adults; ?>" />
								      <input type="hidden" name="child" value="<?php  echo $hotelslib->children; ?>" />
								      <input type="hidden" name="checkin" value="<?php  echo $hotelslib->checkin; ?>" />
								      <input type="hidden" name="checkout" value="<?php  echo $hotelslib->checkout; ?>" />
								      <input type="hidden" name="roomid" value="<?php echo $r->id; ?>" />
          							  <button style="margin-bottom:5px" type="submit" class="btn btn-primary btn-block chk"><?php echo trans('0142A');?></button>
          							</form>
          						</td>
          					</tr>
      				</tbody>
      			</table>
        	 </div>
           
            <div class="labelleft2 rtl_title_home go-text-right RTL">
              <br/>
              <ul class="hotelpreferences go-right hidden-xs">
                <?php $cnt = 0; foreach($item->amenities as $amt){ $cnt++; if($cnt <= 10){ if(!empty($amt['name'])){ ?>
                <img title="<?php echo $amt['name'];?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt['icon'];?>" alt="<?php echo $amt['name'];?>" />
                <?php } } } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>

    <div class="clearfix"></div>
    <div id="availability<?php echo $r->id;?>" class="alert alert-info panel-collapse collapse">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-6">
            <div class="form-group">
              <select id="<?php echo $r->id;?>" class="form-control form showcalendar">
                <option value="0"><?php echo trans('0232');?></option>
                <option value="<?php echo $first;?>"> <?php echo $from1;?> - <?php echo $to1;?></option>
                <option value="<?php echo $second;?>"> <?php echo $from2;?> - <?php echo $to2;?></option>
                <option value="<?php echo $third;?>"> <?php echo $from3;?> - <?php echo $to3;?></option>
                <option value="<?php echo $fourth;?>"> <?php echo $from4;?> - <?php echo $to4;?></option>
              </select>
            </div>
          </div>
          <div id="roomcalendar<?php echo $r->id;?>"></div>
        </div>
      </div>
    </div>
    <div id="details<?php echo $r->id;?>" class="alert alert-danger panel-collapse collapse">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="carousel magnific-gallery row">
            <?php foreach($r->Images as $Img){ ?>
            <div class="col-md-3">
            <div class="zoom-gallery<?php echo $r->id; ?>">
            <a href="<?php echo $Img['thumbImage'];?>" data-source="<?php echo $Img['thumbImage'];?>" title="<?php echo $r->title;?>">
            <img class="img-responsive" src="<?php echo $Img['thumbImage'];?>">
            </a>
            </div>
            </div>

<script type="text/javascript">

        $('.zoom-gallery<?php echo $r->id; ?>').magnificPopup({
          delegate: 'a',
          type: 'image',	
          closeOnContentClick: false,
          closeBtnInside: false,
          mainClass: 'mfp-with-zoom mfp-img-mobile',
          image: {
            verticalFit: true,
            titleSrc: function(item) {
              return item.el.attr('title') + ' ';
            }
          },
          gallery: {
            enabled: true
          },
          zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function(element) {
              return element.find('img');
            }
          }

        });
     
      </script>
            <?php } ?>
          </div>
          <div class="clearfix"></div>
          <p><strong><?php echo trans('046');?> : </strong> <?php echo $r->desc;?></p>
          <hr>
          <p><strong><?php echo trans('055');?> : </strong></p>
          <?php foreach($r->Amenities as $roomAmenity){ if(!empty($roomAmenity['name'])){ ?>
          <div class="col-md-4">
            <ul class="list_ok">
              <li><?php echo $roomAmenity['name'];?></li>
            </ul>
          </div>
          <?php } } ?>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="offset-2">
      <hr style="margin-top: 10px; margin-bottom: 10px;">
    </div>
    <?php } ?>
    <?php } }?>
  </div>
  <br><br>
</section>
