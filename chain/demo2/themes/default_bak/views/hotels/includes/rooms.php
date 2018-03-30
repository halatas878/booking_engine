<section  id="ROOMS" style="background-color:#FFFFFF">
  <br><br>
  <div class="container" style="background-color:#F7F7F7">
    <div class="rooms-update">
      <form  method="GET">
        <div class="col-md-2 col-sm-2 go-right">
          <div class="form-group">
            <label class="size13 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
            <input type="text" placeholder="<?php echo trans('07');?>" name="checkin" class="form-control dpd1" value="<?php echo $hotelslib->checkin;?>" required>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 go-right">
          <div class="form-group">
            <label class="size13 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
            <input type="text" placeholder="<?php echo trans('09');?>" name="checkout" class="form-control dpd2" value="<?php echo $hotelslib->checkout;?>" required>
          </div>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-1 go-right">
          <div class="form-group">
            <label class="size13 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
            <select class="mySelectBoxClass form-control" name="adults" id="adults" value="<?php echo $hotelslib->adults;?>">
              <option value="0">0</option>
              <option value="1">1</option>
              <option selected value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-1 go-right">
          <div class="form-group">
            <label class="size13 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
            <select class="mySelectBoxClass form-control" name="child" id="child" value="<?php echo $hotelslib->children;?>">
              <option selected value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
        </div>
        <div class="col-md-2 col-lg-3 col-sm-2 go-right">
          <label>&nbsp;</label>
          <button class="btn btn-block btn-update textupper"><?php echo trans('0106');?></button>
          <input type="hidden" id="loggedin" value="<?php echo $usersession;?>" />
          <input type="hidden" id="itemid" value="<?php echo $hotel->id; ?>" />
          <input type="hidden" id="module" value="hotels" />
          <input type="hidden" id="addtxt" value="<?php echo trans('029');?>" />
          <input type="hidden" id="removetxt" value="<?php echo trans('028');?>" />
        </div>
        <div class="col-md-2 col-lg-3 col-sm-2">
          <?php if(!empty($rooms)){ ?>
          <h4 style="margin-top: 30px;" class="text-center  size20"><strong><i class="icon_set_1_icon-83"></i><?php echo trans('0122');?></strong> <?php echo $hotelslib->stay; ?> </h4>
          <?php } ?>
        </div>
      </form>
      <div class="clearfix"></div>
    </div>
    <?php if(!empty($hotelslib->stayerror)){ ?>
    <div class="panel-body">
      <div class="alert alert-danger go-text-right">
        <?php echo trans("0420"); ?>
      </div>
    </div>
    <?php } ?>
    <?php if(!empty($rooms)){ ?>
    <?php foreach($rooms as $r){ if($r->maxQuantity > 0){ ?>
    <form action="<?php echo base_url();?>hotels/book/<?php echo $hotel->slug;?>" method="GET">
      <input type="hidden" name="adults" value="<?php  echo $hotelslib->adults; ?>" />
      <input type="hidden" name="child" value="<?php  echo $hotelslib->children; ?>" />
      <input type="hidden" name="checkin" value="<?php  echo $hotelslib->checkin; ?>" />
      <input type="hidden" name="checkout" value="<?php  echo $hotelslib->checkout; ?>" />
      <input type="hidden" name="roomid" value="<?php echo $r->id; ?>" />
      <div class="rooms-update" style="margin-top:0px;margin-bottom:0px">
        <div class="col-lg-3 col-md-4 col-sm-4 offset-0 go-right">
          <div class="img_list">
          <div class="zoom-gallery<?php echo $r->id; ?>">
           <a href="<?php echo $r->thumbnail;?>" data-source="<?php echo $r->thumbnail;?>" title="<?php echo $r->title;?>">
            <img src="<?php echo $r->thumbnail;?>">
            </a>
           </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-8 offset-0">
          <div class="itemlabel3">
            <div class="labelright go-left" style="min-width:180px;margin-left:5px">
              <br/>
              <span class="green size18">
              <?php  if($r->price > 0){ ?>
              <b>
              <small><?php echo $r->currCode;?>  </small> <?php echo $r->currSymbol; ?><?php echo $r->price; ?>
              </b></span><br/>
              <span class="size11 grey"><?php echo trans('0245');?></span>
              <br/>
              <div class="clearfix"></div>
              <hr>
              <?php } ?>
              <?php  if($r->price > 0){ ?>
              <button style="margin-bottom:5px" type="submit" class="btn btn-primary btn-block chk"><?php echo trans('0142');?></button>
              <?php } ?>
              <div class="row">
                <div class="col-md-6">
                  <h5 class="size12"><?php echo trans('0374');?></h5>
                </div>
                <div class="col-md-6">
                  <div class="">
                    <select class="form-control mySelectBoxClass input-sm" name="roomscount" >
                      <?php for($q = 1; $q <= $r->maxQuantity; $q++){ ?>
                      <option value="<?php echo $q;?>"><?php echo $q;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="clearfix"></div>
                <?php if($r->extraBeds > 0){ ?>
                <div class="col-md-6">
                  <h5 class="size12"><?php echo trans('0428');?></h5>
                </div>
                <div class="col-md-6">
                  <div class="">
                    <select name="extrabeds" class="form-control mySelectBoxClass input-sm" id="">
                      <option value="0">0</option>
                      <?php for($i = 1; $i <= $r->extraBeds; $i++){ ?>
                      <option value="<?php echo $i;?>"> <?php echo $i;?> <?php echo $r->currCode." ".$r->currSymbol.$i * $r->extrabedCharges;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="labelleft2 rtl_title_home go-text-right RTL">
              <h4 class="mtb0 RTL go-text-right"><b><?php echo $r->title;?></b></h4>
              <h5 style="color:#8A8A8A"><?php echo trans('010');?> <?php echo $r->Info['maxAdults'];?> <?php echo trans('011');?> <?php echo $r->Info['maxChild'];?></h5>
              <div class="col-md-3 visible-lg visible-md go-right" id="accordion" style="margin-top: 0px;">
                <div class="row">
                  <button data-toggle="collapse" data-parent="#accordion" class="hidden-xs btn btn-block btn-danger btn-xs"  href="#details<?php echo $r->id;?>"><?php echo trans('052');?></button>
                  <button data-toggle="collapse" data-parent="#accordion" href="#availability<?php echo $r->id;?>" class="hidden-xs btn-block btn btn-info btn-xs"><?php echo trans('0251');?></button>
                </div>
              </div>
              <br><br><br>
              <p class="grey RTL"><?php echo character_limiter($r->desc, 280);?></p>
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
    </form>
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
    <?php } }else{ echo trans("066"); }?>
  </div>
  <br><br>
</section>
