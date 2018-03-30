<div class="panel panel-default">
     <h1 class="title"><i class="fa fa-phone-square"></i> Call Center</h1>
    
     <input type="hidden" id="currenturl" value="<?php echo current_url();?>" />
      <input type="hidden" id="baseurl" value="<?php echo base_url().$this->uri->segment(1);?>" />
      
    <div class="panel-body">

    <div class="col-md-8">
      <form class="form-horizontal" action="" method="POST" id="bookingform" enctype="multipart/form-data" >
      <input type="hidden" name="itemtitle" id="itemtitle" value="" />
                <input type="hidden" name="itemid" id="itemid" value="" />
                <input type="hidden" name="subitem" id="subitem" value="" />
                <input type="hidden" name="btype" id="btype" value="<?php echo $service;?>" />
               <input type="hidden" name="currencysign" id="currencysign" value="<?php echo $app_settings[0]->currency_sign;?>" />
               <input type="hidden" name="currencycode" id="" value="<?php echo $app_settings[0]->currency_code;?>" />
                <input type="hidden" name="commission" id="commission" class="percentage" value="0" />
               <input type="hidden" id="tax" class="percentage" value="0" />
               <input type="hidden" name="totalsupamount" id="totalsupamount" value="0" />
               <?php if($service == "hotels"){ ?>
                  <input type="hidden" name="totalamount" id="totalroomamount" value="0" />
              <?php  } ?>

                
                  <input type="hidden" name="grandtotal" id="alltotals"  value="0" />
                 
                <input type="hidden" name="paymethodfee" id="paymethodfee"  value="0" />

                <input type="hidden" name="checkin" id="cin"  value="" />
                <input type="hidden" name="checkout" id="cout"  value="" />
                 <input type="hidden" name="commissiontype" id="comtype" value="" />
                 <input type="hidden" id="apptax" value="<?php echo $applytax;?>" />
				<input type="hidden" id="apply"  name="" value="yes"/>
				<input type="hidden" name="title" data-placeholder="Select" class="form-control" id="servicetype" value="hotels"/>
    <?php if(!empty($service)){  ?>

    <div class="panel panel-default">
      <h4 class="head">Guest</h4>
      <div class="panel-body">


                        <div class="form-group">

                         	   <label class="col-md-3 control-label">Customer</label>
								 <div class="col-md-3">
								 <select data-placeholder="Select" class="form-control" name="usertype" id="selusertype" tabindex="1">
                                 <option value="registered">Registered</option>
                                 <option value="guest">Guest</option>
                                 </select>
								  </div>

                        </div>

                         <div class="form-group" id="regcust">
								   <label class="col-md-3 control-label">Customer Name</label>
									 <div class="col-md-8">

								 <select data-placeholder="Select" name="customer" class="chosen-select" >
                                  <?php foreach($customers as $cust){ ?>
                                  <option value="<?php echo $cust->accounts_id;?>"><?php echo $cust->ai_first_name." ".$cust->ai_last_name;?> - <?php echo $cust->accounts_email;?></option>
                                 <?php } ?>

                                 </select>
									</div>
								 </div>

							<fieldset id="guestacc">
                                 <div class="form-group">
								   <label class="col-md-3 control-label">First Name </label>
									 <div class="col-md-8">
					 	<input class="form-control" type="text" placeholder="First name" name="firstname" id="fname"  value="" >
									</div>
								 </div>

                                 <div class="form-group">
								   <label class="col-md-3 control-label">Last Name</label>
									 <div class="col-md-8">
											<input class="form-control" type="text" placeholder="Last name" id="lname" name="lastname" value="" >
									</div>
								 </div>

                                 <div class="form-group">
								   <label class="col-md-3 control-label">Mobile</label>
									 <div class="col-md-8">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-phone"></i></span>
											<input class="form-control" type="text" placeholder="Mobile Number" id="mobile" name="phone" value="" >
										</div>
									</div>
								 </div>

                                 <div class="form-group">
								   <label class="col-md-3 control-label">Email </label>
									 <div class="col-md-8">
										<div class="input-group">
											<span class="input-group-addon">@</span>
											<input class="form-control" type="email" placeholder="Email address" id="email" name="email" value="" >
										</div>
									</div>
								 </div>

                        	</fieldset>

      </div>
    </div>

     <div class="panel panel-default">
      <h2 class="head">Item</h2>
      <div class="panel-body">
        <div class="form-group checkinlabel">
        <label class="col-md-3 control-label"><?php echo $checkinlabel;?> </label>
        <div class="col-md-3">
        <input class="form-control dpd1" id="<?php echo $service;?>" type="text" placeholder="Date" name="checkin"  value="" required />
        </div>
        </div>
        <?php if($service != "tours" && $service != "cars"){ ?>
        <div class="form-group">
        <label class="col-md-3 control-label"><?php echo $checkoutlabel;?> </label>
        <div class="col-md-3">
        <input class="form-control dpd2" type="text" placeholder="Date" name="checkout"  value="" />
        </div>
        </div><?php } ?>

        <div>
        <?php if($service != "tours" && $service != "cars"){ ?>
        <div class="form-group">
        <label class="col-md-3 control-label">Total ( Nights )</label>
        <div class="col-md-3">
        <input class="form-control" id="stay" type="text" name="stay"  value="0" readonly="true">
        </div>
        </div>
        <?php } ?>
        </div>

      <!--Hotels-->
      <?php
       $histrue = $chklib->is_mod_available_enabled("hotels");
      if($service == "hotels" && $histrue){ ?>
      	<input type="hidden" data-placeholder="Select" name="item" class="chosen-select hotels" value="<?=$this->session->userdata('hotel');?>"/>
        

        <div class="form-group">
        <label class="col-md-3 control-label">Room Name</label>
        <div class="col-md-8">
        <select data-placeholder="Select" name="subitemid" id="poprooms" class="form-control chosen-select" required >
        	<option value=""/>Select Room
        <?php $hotelid = $this->session->userdata('hotel'); if(count($roomlists)>0): foreach($roomlists as $k=>$v):?>
    		<option value="<?=$v->room_id;?>" <?=($_GET['room']==$v->room_id)?"selected":"";?>/><?=$v->room_title;?>
    	<?php endforeach; endif;?>
        </select>
         <span class="btn bookrslt" style="display:none"></span>
        </div>
        </div>


        <div class="form-group">
        <label class="col-md-3 control-label">Room Quantity</label>
        <div class="col-md-3">
        <select name="roomscount" data-placeholder="Select" class="form-control roomquantity" tabindex="1">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        </select>
        </div>
        </div>

        <div class="form-group">
        <label class="col-md-3 control-label">Total Room Price</label>
        <div class="col-md-3">
        <input class="form-control" id="totalroomprice" type="text" name="totalroomprice"  value="0" readonly="true">
         </div>
        </div>

        <div class="form-group">
        <label class="col-md-3 control-label">Per Night Price</label>
        <div class="col-md-3">
        <input class="form-control" id="roomtotal" type="text" placeholder="Price" name="perNight" value="0" required>
        </div>
        </div>


         <?php if($applytax == "yes"){ ?>
          <div class="form-group">
        <label class="col-md-3 control-label">Total Tax</label>
        <div class="col-md-3">
        <input class="form-control" id="taxamount" type="text" name="taxamount"  value="0" readonly="true">
         </div>

        </div>
        <?php }else{ ?><input id="taxamount" type="hidden" name="taxamount"  value="0"><?php } } ?>

         <!-- Hotels -->
      <!-- Cars -->
      <?php
       $cartrue = $chklib->is_mod_available_enabled("cars");
      if($service == "cars" && $cartrue){ ?>
        <input type="hidden" name="totalamount" id="totalcaramount" value="0" />
        <div class="form-group">
        <label class="col-md-3 control-label">Car Name</label>
        <div class="col-md-8">
        <select data-placeholder="Select" name="item" class="chosen-select cars" onchange="carsprice(this.options[this.selectedIndex].value)" >
        <option value=""> Select </option>
        <?php foreach($cars as $car){ ?>

        <option value="<?php echo $car->car_id;?>"> <?php echo $car->car_title;?> </option>
        <?php  } ?>

        </select>
         <span class="btn bookrslt" style="display:none"></span>
        </div>
        </div>

        <div class="form-group">
        <label class="col-md-3 control-label">Total Car Price</label>
        <div class="col-md-3">
        <input class="form-control" id="totalcarprice" type="text" name="totalcarprice"  value="0" readonly="true">
         </div>
        </div>

         <?php if($applytax == "yes"){ ?>
          <div class="form-group">
        <label class="col-md-3 control-label">Total Tax</label>
        <div class="col-md-3">
        <input class="form-control" id="taxamount" type="text" name="taxamount"  value="0" readonly="true">
         </div>

        </div>
        <?php }else{ ?><input id="taxamount" type="hidden" name="taxamount"  value="0"><?php } } ?>


      <!-- Cars-->

       <!-- Tours -->
      <?php
       $tourtrue = $chklib->is_mod_available_enabled("tours");
      if($service == "tours" && $tourtrue){ ?>
      <input type="hidden" id="priceadult" value="0" />
      <input type="hidden" id="pricechild" value="0" />
      <input type="hidden" id="priceinfant" value="0" />
      <input type="hidden" name="totalamount" id="totaltouramount" value="0" />
      <input type="hidden" name="tourtype" id="tourtype" value="" />
        <div class="form-group">
        <label class="col-md-3 control-label">Tour Name</label>
        <div class="col-md-8">
        <select data-placeholder="Select" name="item" class="chosen-select tours" onchange="toursprice(this.options[this.selectedIndex].value)" required >
        <option value=""> Select </option>
        <?php foreach($tours as $tour){ ?>
        <option value="<?php echo $tour->tour_id;?>"> <?php echo $tour->tour_title;?> </option>
        <?php  } ?>

        </select>
         <span class="btn bookrslt" style="display:none"></span>
        </div>
        </div>

         <div class="form-group adults" style="display:none;">
        <label class="col-md-3 control-label">Adults</label>
        <div class="col-md-3">
      <select class="form-control updateTourPrice" name="adults" id="adults">

      </select>
        </div>
        </div>

         <div class="form-group child" style="display:none;">
        <label class="col-md-3 control-label">Child</label>
        <div class="col-md-3">
      <select class="form-control updateTourPrice" name="children" id="children">

      </select>
        </div>
        </div>

         <div class="form-group infants" style="display:none;">
        <label class="col-md-3 control-label">Infant</label>
        <div class="col-md-3">
      <select class="form-control updateTourPrice" name="infants" id="infants">

      </select>
        </div>
        </div>

        <div class="form-group">
        <label class="col-md-3 control-label">Total Tour Price</label>
        <div class="col-md-3">
        <input class="form-control" id="totaltourprice" type="text" name="totaltourprice"  value="0" readonly="true">
         </div>
        </div>

         <?php if($applytax == "yes"){ ?>
          <div class="form-group">
        <label class="col-md-3 control-label">Total Tax</label>
        <div class="col-md-3">
        <input class="form-control" id="taxamount" type="text" name="taxamount"  value="0" readonly="true">
         </div>

        </div>
        <?php }else{ ?><input id="taxamount" type="hidden" name="taxamount"  value="0"><?php } } ?>


      <!-- Tours-->


      </div>

                       <div class="form-group">
        <label class="col-md-3 control-label">Total Deposit</label>
        <div class="col-md-3">

        <input class="form-control editdeposit" type="text" id="totaltopay"  name="quickDeposit"  value="0">
         </div>

        </div>

    </div>

     <div class="panel panel-default rprice supdiv"  style="display:none;">
          <div class="panel-heading"><strong>Extras</strong></div>
          <div class="panel-body suppcontent">

          </div>
        </div>
<?php if($role != "supplier"){ ?>
        <div class="panel panel-default rprice paytype"  style="display:none;">
          <div class="panel-heading"><strong>Payment Method</strong></div>
          <div class="panel-body">
          <label class="col-md-3 control-label" id="" >Payment Type</label>
				 <div class="col-md-4">
				    <select name="paymethod"  class="form-control" data-placeholder="Select" required>
                 <option value="">Select</option>
                  <?php foreach($paygateways['activeGateways'] as $payt){ ?>
                    <option value="<?php echo $payt['name'];?>"><?php echo  $payt['displayName'];?></option>
                    <?php } ?>
                  </select>
				  </div>
          </div>
        </div>
<?php }else{?> <input type="hidden" name="paymethod" value="" ><?php } ?>


     <div class="form-group">
      <div class="col-md-2">
      <input type="hidden" name="booknow" value="1" />
      <input type="submit" class="btn btn-primary btn-lg" value="Book Now">
      </div>
      </div>

    <?php } ?>

   	</form>

    </div>
   <?php if(!empty($service)){  ?>
    <div class="col-md-4 pull-right">
    <div class="panel panel-default" >
      <div style="font-size:16px" class="panel-heading"><strong>Booking Summary</strong></div>

      <table class="table summary">
       <tr style="background-color:#ffffdf">

       <td><b><span id="itemtitlesum"></span></b></td>
       <td><span id="itempricesum"></span></td>

       </tr>

      </table>
      <table class="table table-bordered">

     <?php if($service == "hotels" || $service == "cruises"){ ?>
      <tr style="background-color:#e7ffda" style="display:none;" id="tr_roomamount">
       <td style="font-size:14px"><b>Total Room Amount</b></td>
       <td style="font-size:14px"><?php echo $app_settings[0]->currency_sign;?><span id="summaryroomtotal">0</span></td>
      </tr><?php }elseif($service == "cars"){  ?>
      <tr style="background-color:#e7ffda" style="display:none;" id="tr_caramount">
       <td style="font-size:14px"><b>Total Car Amount</b></td>
       <td style="font-size:14px"><?php echo $app_settings[0]->currency_sign;?><span id="summarycartotal">0</span></td>
      </tr>
      <?php }elseif($service == "tours"){  ?>
      <tr style="background-color:#e7ffda;display:none;" id="tr_touramount">
       <td style="font-size:14px"><b>Total Tour Amount</b></td>
       <td style="font-size:14px"><?php echo $app_settings[0]->currency_sign;?><span id="summarytourtotal">0</span></td>
      </tr>
      <?php } ?>
        <tr style="background-color:#e7ffda" class="taxesvat">
       <td style="font-size:14px"><b>Tax & VAT </b></td>
       <td style="font-size:14px" id="displaytax"><?php echo $app_settings[0]->currency_sign;?>0</td>

       </tr>
        <!--  <tr style="background-color:#e7ffda">
       <td style="font-size:14px"><b> Payment Method Fee</b></td>
       <td style="font-size:14px" id="pmethod"><?php echo $app_settings[0]->currency_sign;?>0</td>

       </tr> -->

             <tr style="background-color:#ffffdf">
       <td style="font-size:14px"><b>Deposit </b></td>
       <td style="font-size:14px" id="topaytotal"><?php echo $app_settings[0]->currency_sign;?>0</td>

       </tr>

       <tr style="background-color:#e7ffda">
       <td style="font-size:18px"><b>GRAND TOTAL</b></td>
       <td style="font-size:18px" id="grandtotal"><?php echo $app_settings[0]->currency_sign;?>0</td>
       </tr>

      </table>
    </div>
    </div>
    <?php } ?>

    </div>
  </div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/adminbooking.js"></script>
