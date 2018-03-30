<!-- CONTENT -->
<div class="container">
  <div class="container mt25 offset-0">
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
              <?php if(!empty($tour->extras)){ ?>
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
                    <?php foreach($tour->extras as $extra){ ?>
                     <?php include $themeurl.'views/booking/extras.php'; ?>
                    <?php } ?>
                  </tbody>
                </table>
                </div>
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
              <input type="hidden" id="itemid" name="itemid" value="<?php echo $tour->id;?>" />
              <input type="hidden" name="subitemid" value="<?php echo $tour->id;?>" />
              <input type="hidden" name="tourscount" value="<?php echo $tour->tourscount;?>" />
              <input type="hidden" name="bedscount" value="<?php echo $tour->extraBedsCount;?>" />
              <input type="hidden" name="checkout" value="<?php echo $tour->checkout;?>" />
              <input type="hidden" name="checkin" value="<?php echo $tour->date;?>" />
              <input type="hidden" name="adults" value="<?php echo $tour->adults;?>" />
              <input type="hidden" name="children" value="<?php echo $tour->children;?>" />
              <input type="hidden" name="infant" value="<?php echo $tour->infants;?>" />
              <input type="hidden" id="couponid" name="couponid" value="" />
              <input type="hidden" id="btype" name="btype" value="tours" />
                <?php include $themeurl.'views/coupon.php'; ?>
                <div class="clearfix"></div>
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo trans('0521');?></div>
                  <div class="panel-body">
                    <div class="form-horizontal">
                      <?php for($i = 1; $i <= $totalGuests;$i++){ ?>
                      <div class="form-group">
                        <div class="col-md-4">
                          <label><?php echo trans('0522');?> <?php echo $i;?> <?php echo trans('0350');?></label>
                          <input type="" name="passport[<?php echo $i;?>][name]" class="form-control" placeholder="Name"/>
                        </div>
                        <div class="col-md-6">
                          <label><?php echo trans('0522');?> <?php echo $i;?> <?php echo trans('0523');?></label>
                          <input type="" name="passport[<?php echo $i;?>][passportnumber]" class="form-control" placeholder="Passport"/>
                        </div>
                        <div class="col-md-2">
                          <label><?php echo trans('0524');?></label>
                          <input type="" name="passport[<?php echo $i;?>][age]" class="form-control" placeholder="Age"/>
                        </div>
                      </div>
                      <hr>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <!-- end passport number fields -->
            </form>
              <?php if(!empty($tour->policy)){ ?>
              <br>
              <div class="alert alert-info">
                <strong class="RTL go-right"><?php echo trans('045');?></strong><br>
                <p class="RTL" style="font-size:12px"><?php echo $tour->policy;?></p>
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
            <img class="img-responsive" src="<?php echo $tour->thumbnail;?>">
            <h5 class="strong go-text-right" style="margin-bottom: 1px;"><strong><?php echo $tour->title;?></strong></h5>
            <p class="go-text-right" style="margin-top: 1px;margin-bottom: 1px;"> <small><i class="fa fa-map-marker go-right"></i> <?php echo $tour->location;?> &nbsp; <?php echo $tour->stars;?></small></p>
          </div>
          <div class="hpadding30">
            <div >
              <div class="row">
                <table class="table table_summary">
                  <tbody>
                    <tr>
                      <td>
                        <strong> <?php echo trans('0275');?></strong> : <?php echo $tour->tourDays;?>
                      </td>
                      <td class="text-right">
                        <strong> <?php echo trans('0122');?></strong> : <?php echo $tour->tourNights;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo trans('08');?>
                      </td>
                      <td class="text-right">
                        <?php echo $tour->date;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong> <?php echo trans('010');?>  (<?php echo $tour->adults;?>)</strong>
                      </td>
                      <td class="text-right">
                        <?php echo $tour->currCode;?> <?php echo $tour->currSymbol;?> <?php echo $tour->adultprice;?>
                      </td>
                    </tr>
                    <?php if($tour->children > 0) { ?>
                    <tr>
                      <td>
                        <strong> <?php echo trans('011');?>  (<?php echo $tour->children;?>)</strong>
                      </td>
                      <td class="text-right">
                        <?php echo $tour->currCode;?> <?php echo $tour->currSymbol;?> <?php echo $tour->childprice;?>
                      </td>
                    </tr>
                    <?php } ?>
                    <?php if($tour->infants > 0) { ?>
                    <tr>
                      <td>
                        <strong> <?php echo trans('0282');?>  (<?php echo $tour->infants;?>)</strong>
                      </td>
                      <td class="text-right">
                        <?php echo $tour->currCode;?> <?php echo $tour->currSymbol;?> <?php echo $tour->infantprice;?>
                      </td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td>
                        <strong> <?php echo trans('0408');?> </strong>
                      </td>
                      <td class="text-right">
                        <?php echo $tour->currCode;?> <?php echo $tour->currSymbol;?> <?php echo $tour->subTotal;?>
                      </td>
                    </tr>
                    <tr class="beforeExtraspanel">
                      <td>
                        <?php echo trans('0153');?>
                      </td>
                      <td class="text-right">
                        <?php echo $tour->currCode;?> <?php echo $tour->currSymbol;?><span id="displaytax"><?php echo $tour->taxAmount;?></span>
                      </td>
                    </tr>
                    <div class="booking-deposit">
                      <tr>
                        <td class="booking-deposit-font">
                          <strong><?php echo trans('0126');?></strong>
                        </td>
                        <td class="text-right">
                          <strong><span class="booking-deposit-font go-left"><?php echo $tour->currCode;?> <?php echo $tour->currSymbol;?><span id="displaydeposit"><?php echo $tour->depositAmount?></span></span></strong>
                        </td>
                      </tr>
                    </div>
                    <tr class="total">
                      <td>
                      </td>
                      <td class="text-right">
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="padding30" style="padding-top:0px">
                  <span class="left size20 dark"><strong><?php echo trans('0124');?></strong> :</span>
                  <span class="right lred2 bold size18">                         <?php echo $tour->currCode;?> <?php echo $tour->currSymbol;?><span id="displaytotal"><?php echo $tour->price;?></span></span>
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
