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

      <form id="bookingdetails" action="" onsubmit="return false">
        <?php if(!empty($car->extras)){ ?>
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
              <?php foreach($car->extras as $extra){ ?>
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
          <!-- End Complete This booking button only -->

          <input type="hidden" id="itemid" name="itemid" value="<?php echo $car->id;?>" />
          <input type="hidden" name="subitemid" value="" />
          <input type="hidden" name="pickuplocation" value="<?php echo $car->pickupLocation;?>" />
          <input type="hidden" name="dropofflocation" value="<?php echo $car->dropoffLocation;?>" />
          <input type="hidden" name="pickupDate" value="<?php echo $car->pickupDate;?>" />
          <input type="hidden" name="pickupTime" value="<?php echo $car->pickupTime;?>" />
          <input type="hidden" id="couponid" name="couponid" value="" />
          <input type="hidden" id="btype" name="btype" value="cars" />
      </form>

    <?php include $themeurl.'views/coupon.php'; ?>


             <?php if(!empty($car->policy)){ ?>
              <br>
              <div class="alert alert-info">
                <strong class="RTL go-right"><?php echo trans('045');?></strong><br>
                <p class="RTL" style="font-size:12px"><?php echo $car->policy;?></p>
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
    </div>


         <!-- Booking Final Starting -->
           <div class="col-md-8 final_section"  style="display:none;">
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

    <!-- End col-md-8 -->
    <aside class="col-md-4 go-left">
      <div class="pagecontainer2 paymentbox grey">
        <div class="panel-body">
          <img class="img-responsive" src="<?php echo $car->thumbnail;?>">
          <h5 class="strong go-text-right" style="margin-bottom: 1px;"><strong><?php echo $car->title;?></strong></h5>
          <p class="go-text-right" style="margin-top: 1px;margin-bottom: 1px;"> <small><i class="fa fa-map-marker go-right"></i> <?php echo $car->location;?> &nbsp; <?php echo $car->stars;?></small></p>
          <table class="table table_summary">
            <tbody>
              <tr>
                <td>
                  <?php echo trans('08');?>
                </td>
                <td class="text-right">
                 <?php echo $car->date;?>
                </td>
              </tr>
              <tr>
                <td>
                  <strong> <?php echo trans('0408');?> </strong>
                </td>
                <td class="text-right">
                <?php echo $car->currCode;?> <?php echo $car->currSymbol;?> <?php echo $car->subTotal;?>
                </td>
              </tr>
                        

              <tr class="beforeExtraspanel">
                <td>
                  <?php echo trans('0153');?>
                </td>
                <td class="text-right">
                  <?php echo $car->currCode;?> <?php echo $car->currSymbol;?><span id="displaytax"><?php echo $car->taxAmount;?></span>
                </td>
              </tr>

              <div class="booking-deposit">
                <tr>
                  <td class="booking-deposit-font">
                    <strong><?php echo trans('0126');?></strong>
                  </td>
                  <td class="text-right">
                    <strong><span class="booking-deposit-font go-left"><?php echo $car->currCode;?> <?php echo $car->currSymbol;?><span id="displaydeposit"><?php echo $car->depositAmount?></span></span></strong>
                  </td>
                </tr>
                <tr class="total">
                      <td>
                      </td>
                      <td class="text-right">
                      </td>
                    </tr>
              </div>
            </tbody>
          </table>
      

        <div class="padding30" style="padding-top:0px">
                  <span class="left size20 dark"><strong><?php echo trans('0124');?></strong> :</span>
                  <span class="right lred2 bold size18">
                  <?php echo $car->currCode;?> <?php echo $car->currSymbol;?><span id="displaytotal"><?php echo $car->price;?></span></span>
                  <div class="clearfix"></div>
                </div>
              </div>
                <div class="panel-footer" style="background: #E6EDF7;font-size:12px">
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
            <?php } ?>


    </aside>
  </div>
  </div>


<!-- end start new design -->

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