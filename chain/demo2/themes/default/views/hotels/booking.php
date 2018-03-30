
<div class="container">
  <div class="mt25 offset-0">
    <div class="loadinvoice">
      <div class="acc_section">
        <div class="col-md-8 pagecontainer2 offset-0 go-right" style="margin-bottom:50px;">
          <div class="panel-body">
            <br>
            <div class="result"></div>
            <?php if(!empty($error)){ ?>
            <h1 class="text-center strong"><?php echo trans('0432');?></h1>
            <h3 class="text-center"><?php echo trans('0431');?></h3>
            <?php }else{ ?>



            <?php include $themeurl.'views/booking/profile.php'; ?>

            <form id="bookingdetails" class="hidden-xs hidden-sm" action="" onsubmit="return false">
              <?php if(!empty($hotel->extras)){ ?>
              <div class="clearfix"></div>
              <div class="panel panel-default">
                <div class="panel-heading go-text-right"><?php echo trans('001');?> <?php echo trans('0156');?></div>
                <script>
                  //Incrementer
                  $(function () {
                  	"use strict";
                      $(".numbers-row").append('<div class="inc button_inc">+</div><div class="dec button_inc">-</div>');
                      $(".button_inc").on("click", function () {

                          var $button = $(this);
                          var oldValue = $button.parent().find("input").val();

                          if ($button.text() == "+") {
                              var newVal = parseFloat(oldValue) + 1;
                          } else {
                              // Don't allow decrementing below zero
                              if (oldValue > 1) {
                                  var newVal = parseFloat(oldValue) - 1;
                              } else {
                                  newVal = 1;
                              }
                          }
                          $button.parent().find("input").val(newVal);
                      });
                  });

                </script>
                <!-- Carousel -->
                <table class="table table-striped cart-list add_bottom_30">
                  <thead>
                    <tr>
                      <th><?php echo trans('0376');?></th>
                      <th><?php echo trans('077');?></th>
                      <th><?php echo trans('070');?></th>
                      <th class="text-center"><?php echo trans('0399');?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($hotel->extras as $extra){ ?>
                     <?php include $themeurl.'views/booking/extras.php'; ?>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!--End step -->
              <?php } ?>
              <script type="text/javascript">
                $(function(){
                $('.popz').popover({ trigger: "hover" });
                });
              </script>
              <!-- Complete This booking button only starting -->
              <div class="panel panel-default btn_section" style="display:none;">
                <div class="panel-body">
                  <center>
                </div>
              </div>
              <!-- End Complete This booking button only -->
              <input type="hidden" id="itemid" name="itemid" value="<?php echo $hotel->id;?>" />
              <input type="hidden" name="subitemid" value="<?php echo $room->id;?>" />
              <input type="hidden" name="roomscount" value="<?php echo $room->roomscount;?>" />
              <input type="hidden" name="bedscount" value="<?php echo $room->extraBedsCount;?>" />
              <input type="hidden" name="checkout" value="<?php echo $hotel->checkout;?>" />
              <input type="hidden" name="checkin" value="<?php echo $hotel->checkin;?>" />
              <input type="hidden" name="adults" value="<?php echo $hotel->adults;?>" />
              <input type="hidden" name="children" value="<?php echo $hotel->children;?>" />
              <input type="hidden" id="btype" name="btype" value="hotels" />
            <?php
            if($couponcode):
            ?>
            <div class="">
		    	<div class="couponmsg"> <div class="alert alert-success"><a id="popoverData" href="javascript:void(0);" data-content="A promo code is your key to redeeming special discounts. To redeem, enter your promo code and we'll apply the discount to the total cost on your invoice page when you pay. Promo codes can only be used once with each booking, and they're good only up to the total amount of your booking (including service fee and taxes) or promo code amount, whichever is less" rel="popover" data-placement="top" data-original-title="What is a promo code?" data-trigger="hover"><strong>What is a promo code?</strong></a><br/><strong> <?=number_format($couponcode->value);?>%  </strong> coupon discount has been applied to your booking! please continue by clicking book now to see the discounted price on invoice page.</div>
		    	</div>
		  </div>
		  <input type="hidden" id="couponid" name="couponid" value="<?=$couponcode->id;?>" />
		  <?php else:?>
		  <input type="hidden" id="couponid" name="couponid" value="" />	
		  <?php endif;?>
		  </form>
            <?php #include $themeurl.'views/coupon.php'; ?>
            <div class="clearfix"></div>
            <div class="line3"></div>
            <?php if(!empty($hotel->policy)){ ?>
            <br>
            <div class="alert alert-info">
              <strong class="RTL go-right"><?php echo trans('045');?></strong><br>
              <p class="RTL" style="font-size:12px"><?php echo $hotel->policy;?></p>
            </div>
            <?php } ?>
            <p class="RTL"><?php echo trans('0416');?></p>
            <div class="form-group">
              <span id="waiting"></span>
              <button type="submit" class="btn btn-primary btn-lg btn-block completebook" name="<?php if(empty($usersession)){ echo "guest";}else{ echo "logged"; } ?>"  onclick="return completebook('<?php echo base_url();?>','<?php echo trans('0159')?>');"><?php echo trans('0306');?></button>
            </div>
          </div>
        </div>
      </div>
      <!-- Booking Final Starting -->
      <div class="col-md-8 offset-0 final_section go-right"  style="display:none;">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="step-pane" id="step4">
              <div id="rotatingDiv" class="show"></div>
              <h2 class="text-center"><?php echo trans('0179');?></h2>
              <p class="text-center"><?php echo trans('0180');?></p>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- Booking Final Ending -->
      <!-- END OF LEFT CONTENT -->
      <!-- RIGHT CONTENT -->
      <div class="col-md-4 go-left">
        <div class="pagecontainer2 paymentbox grey">
          <div class="panel-body">
            <img class="img-responsive" src="<?php echo $hotel->thumbnail;?>" alt="<?php echo $hotel->title;?>" />
            <div class="opensans size18 dark bold RTL go-right"><?php echo $hotel->title;?></div>
            <div class="clearfix"></div>
            <div class="opensans size13 grey RTL go-right"><i class="fa fa-map-marker RTL"></i> <?php echo $hotel->location;?></div>
            <div class="clearfix"></div>
            <span class="go-right RTL"><?php echo $hotel->stars;?></span>
          </div>
          <div class="hpadding30">
            <div >
              <div class="row">
                <table class="table table_summary">
                  <tbody>
                    <tr>
                      <td class="go-right">
                        <strong> <?php echo trans('07');?></strong> <br> <?php echo $hotel->checkin;?>
                      </td>
                      <td class="go-left">
                        <strong> <?php echo trans('09');?></strong> <br> <?php echo $hotel->checkout;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo trans('060');?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->stay;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo $room->title;?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->roomscount;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo trans('0412');?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->currCode;?> <?php echo $room->currSymbol;?> <?php echo number_format($room->perNight);?>
                      </td>
                    </tr>
                    <?php if($room->extraBedsCount > 0){ ?>
                    <tr>
                      <td>
                        <?php echo trans('0429');?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->currCode;?> <?php echo $room->currSymbol;?><?php echo number_format($room->extraBedCharges); ?>
                      </td>
                    </tr>
                    <?php } ?>
                    <tr class="beforeExtraspanel">
                      <td>
                        <?php echo trans('0153');?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->currCode;?> <?php echo $room->currSymbol;?><span id="displaytax"><?php echo number_format($hotel->taxAmount);?></span>
                      </td>
                    </tr>
                    <div class="booking-deposit">
                      <tr>
                        <td class="booking-deposit-font">
                          <strong><?php echo trans('0126');?></strong>
                        </td>
                        <td class="text-right">
                          <strong><span class="booking-deposit-font go-left"><?php echo $room->currCode;?> <?php echo $room->currSymbol;?><span id="displaydeposit"><?php echo number_format($hotel->depositAmount)?></span></span></strong>
                        </td>
                      </tr>
                    </div>
                    <tr>
                      <td>
                      </td>
                      <td >
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="padding30" style="padding-top:0px">
                  <span class="left size20 dark"><strong><?php echo trans('0124');?></strong> :</span>
                  <span class="right lred2 bold size18">                        <?php echo $room->currCode;?> <?php echo $room->currSymbol;?><span id="displaytotal"><?php echo number_format($room->price);?></span></span>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="row">
                <div class="panel-footer row" style="background: #E6EDF7;font-size:12px">
                  <p><?php echo trans('0461');?></p>
                </div>
                <?php if(!empty($phone)){ ?>
                <div class="panel-body">
                  <h4 class="opensans text-center"><i class="icon_set_1_icon-57"></i><?php echo trans('061');?></h4>
                  <p class="opensans size30 lblue xslim text-center"><?php echo $phone; ?></p>
                </div>
                <?php } ?>
                <br>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <br/>
      </div>
      <!-- END OF RIGHT CONTENT -->
    </div>
  </div>
</div>
<!-- END OF CONTENT -->
<style>
  #rotatingImg {
  display: none;
  }
  .booking-bg {
  padding: 10px 0 5px 0;
  width: 100%;
  background-image: url('<?php echo $theme_url; ?>assets/images/step-bg.png');
  background-color: #222;
  text-align: center;
  }
  .bookingFlow__message {
  color: white;
  font-size: 18px;
  margin-top: 5px;
  margin-bottom: 15px;
  letter-spacing: 1px;
  }
</style>
<script src="<?php echo base_url(); ?>assets/js/booking.js"></script>
<div class="clearfix"></div>
