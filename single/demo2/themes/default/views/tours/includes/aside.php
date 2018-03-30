<div class="col-md-5 go-right">
  <div class="col-xs-5 col-sm-3 col-md-5 row col-lg-4 go-right">
    <div class="reviews text-center"><?php echo $avgReviews->totalReviews; ?> <?php echo trans('042');?></div>
    <div class="c100 p<?php echo $avgReviews->overall * 10;?>" style="margin-top:10px">
      <span><strong><?php echo $avgReviews->overall;?> </strong>/<small>10</small></span>
      <div class="slice">
        <div class="bar"></div>
        <div class="fill"></div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <br>
  <div class="col-xs-5 col-sm-3 col-md-7 row col-lg-6 go-right pull-right go-left">
    <form action="" method="GET" >
      <div class="form-group">
        <input id="tchkin" name="date" value="<?php echo $tour->date; ?>" placeholder="date" type="text" class="form-control" placeholder="<?php echo trans('012');?>">
      </div>
      <button type="submit" class="btn btn-block btn-primary pull-right"><?php echo trans('0454');?></button>
    </form>
  </div>
  <div>
    <form  action="<?php echo base_url();?>tours/book/<?php echo $tour->slug;?>" method="GET" role="search">
      <input type="hidden" name="date" value="<?php echo $tour->date;?>">
      <table class="table table-bordered">
        <?php if(!empty($tourslib->error)){ ?>
        <div class="alert alert-danger go-text-right">
          <?php echo trans($tourslib->errorCode); ?>
        </div>
        <?php } ?>
        <thead>
          <tr>
            <th  style="line-height: 1.428571;"><?php echo trans('068');?></th>
            <th style="line-height: 1.428571;"><?php echo trans('0450');?></th>
            <th  style="line-height: 1.428571;" class="text-center"><?php echo trans('070');?></th>
          </tr>
        </thead>
        <tbody>
          <?php if($tour->adultStatus){ ?>
          <tr>
            <th scope="row"><?php echo trans('010');?> <span class="weak"><?php echo $tour->currSymbol;?><?php echo $tour->perAdultPrice;?></span></th>
            <td>
              <select name="adults" class="selectx changeInfo input-sm" id="selectedAdults">
                <?php for($adults = 1; $adults <= $tour->maxAdults; $adults++){ ?>
                <option value="<?php echo $adults;?>" <?php echo makeSelected($selectedAdults, $adults); ?>><?php echo $adults;?></option>
                <?php } ?>
              </select>
            </td>
            <td class="text-center adultPrice"><?php echo $tour->currSymbol;?><?php echo $tour->adultPrice;?></td>
          </tr>
          <?php } if($tour->childStatus){ ?>
          <tr>
            <th scope="row"><?php echo trans('011');?> <span class="weak"><?php echo $tour->currSymbol;?><?php echo $tour->perChildPrice;?></span></th>
            <td>
              <select name="child" class="selectx changeInfo input-sm" id="selectedChild">
                <option value="0">0</option>
                <?php for($child = 1; $child <= $tour->maxChild; $child++){ ?>
                <option value="<?php echo $child;?>" <?php echo makeSelected($selectedChild, $child); ?> ><?php echo $child;?></option>
                <?php } ?>
              </select>
            </td>
            <td class="text-center childPrice"><?php echo $tour->currSymbol;?><?php echo $tour->childPrice;?></td>
          </tr>
          <?php } if($tour->infantStatus){  ?>
          <tr>
            <th scope="row"><?php echo trans('0282');?> <span class="weak"><?php echo $tour->currSymbol;?><?php echo $tour->perInfantPrice;?></span></th>
            <td>
              <select name="infant" class="selectx changeInfo input-sm" id="selectedInfants">
                <option value="0">0</option>
                <?php for($infant = 1; $infant <= $tour->maxInfant; $infant++){ ?>
                <option value="<?php echo $infant;?>" <?php echo makeSelected($selectedInfants, $infant); ?> ><?php echo $infant;?></option>
                <?php } ?>
              </select>
            </td>
            <td class="text-center infantPrice"><?php echo $tour->currSymbol;?><?php echo $tour->infantPrice;?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="row">
        <h4 class="text-center size20" style="margin-top: 4px; margin-bottom: 14px;"><span style="color:#333333;" class="totalCost"><?php echo $tour->currCode;?> <?php echo $tour->currSymbol;?><strong><?php echo $tour->totalCost;?></strong></span>
          <small> <?php echo trans('0126');?> <span class="totaldeposit"> <?php echo $tour->currCode;?> <?php echo $tour->currSymbol;?><?php echo $tour->totalDeposit;?></span> </small>
        </h4>
        <div class="col-md-12">
          <button type="submit" class="btn btn-block btn-primary btn-lg"><?php echo trans('0142');?></button>
        </div>
      </div>
    </form>
    <input type="hidden" id="loggedin" value="<?php echo $customerloggedin;?>" />
    <input type="hidden" id="itemid" value="<?php echo $tour->id; ?>" />
    <input type="hidden" id="module" value="tours" />
    <input type="hidden" id="addtxt" value="<i class='fa fa-star'></i> <?php echo trans('029');?>" />
    <input type="hidden" id="removetxt" value="<i class='fa fa-remove'></i> <?php echo trans('028');?>" />
    <div class="form-group"></div>
    <?php $currenturl = current_url(); $wishlist = pt_check_wishlist($customerloggedin,$tour->id,"tours"); if($allowreg){ if($wishlist){ ?>
    <span class="btn wish btn-danger btn-outline btn-block removewishlist"><span class="wishtext"><i class=" icon_set_1_icon-82"></i> <?php echo trans('028');?></span></span>
    <br>
    <p class="text-center"><a style="color:#666666" href="#terms"><?php echo trans('0271');?> <?php echo trans('057');?></a></p>
    <?php }else{ ?>
    <span class="btn wish btn-block addwishlist btn-danger btn-outline"><span class="wishtext"><i class=" icon_set_1_icon-82"></i> <?php echo trans('029');?></span></span>
    <?php } } ?>
    <button data-toggle="collapse" data-parent="#accordion" class="hidden-xs btn-block btn btn-default" href="#ADDREVIEW"><i class="icon_set_1_icon-68"></i> <?php echo trans('083');?></button>
  </div>


  <script>
    $(function(){

      $(".changeInfo").on("change",function(){

        var tourid = "<?php echo $tour->id; ?>";
        var adults = $("#selectedAdults").val();
        var child = $("#selectedChild").val();
        var infants = $("#selectedInfants").val();

        $.post("<?php echo base_url()?>tours/tourajaxcalls/changeInfo",{tourid: tourid, adults: adults, child: child, infants: infants},function(resp){

          var result = $.parseJSON(resp);
          $(".adultPrice").html(result.currSymbol+result.adultPrice);
          $(".childPrice").html(result.currSymbol+result.childPrice);
          $(".infantPrice").html(result.currSymbol+result.infantPrice);
          $(".totalCost").html(result.currCode+" "+result.currSymbol+result.totalCost);
          $(".totaldeposit").html(result.currCode+" "+result.currSymbol+result.totalDeposit);
          console.log(result);

        })

      }); //end of change info

      // Add/remove wishlist
    $(".wish").on('click',function(){
    var loggedin = $("#loggedin").val();
    var removelisttxt = $("#removetxt").val();
    var addlisttxt = $("#addtxt").val();
    var title = $("#itemid").val();
    var module = $("#module").val();
    if(loggedin > 0){ if($(this).hasClass('addwishlist')){
     var confirm1 = confirm("<?php echo trans('0437');?>");
     if(confirm1){
       $(".wish").removeClass('addwishlist btn-primary');
    $(".wish").addClass('removewishlist btn-warning');
    $(".wishtext").html(removelisttxt);
    $.post("<?php echo base_url();?>account/wishlist/add", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){ });

     }
     return false;

    }else if($(this).hasClass('removewishlist')){
    var confirm2 = confirm("<?php echo trans('0436');?>");
    if(confirm2){
     $(".wish").addClass('addwishlist btn-primary'); $(".wish").removeClass('removewishlist btn-warning');
    $(".wishtext").html(addlisttxt);
    $.post("<?php echo base_url();?>account/wishlist/remove", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){
    });
    }
    return false;

    } }else{ alert("<?php echo trans('0482');?>"); } });
    // End Add/remove wishlist

     //submit review
    $(".addreview").on("click",function(){
    var id = $(this).prop("id");
    $.post("<?php echo base_url();?>admin/ajaxcalls/postreview", $("#reviews-form-"+id).serialize(), function(resp){
      var response = $.parseJSON(resp);
     // alert(response.msg);
      $("#review_result"+id).html("<div class='alert "+response.divclass+"'>"+response.msg+"</div>").fadeIn("slow");
    });

    setTimeout(function(){

    $("#review_result"+id).fadeOut("slow");

    }, 3000);

    });
    //end submite review


    })// end of document ready

  </script>
</div>
