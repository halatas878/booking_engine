<!-- WRAP -->
<div style="margin-top:450px;" class="wrap cstyle03">
  <div class="container mt-200 z-index100">
    <div class="row">
      <div class="col-md-12">
        <div class="bs-example bs-example-tabs cstyle04">
          <form action="" class="row" method="POST">
            <div class="tab-content">
              <br>
              <div class="container">
                <?php if(isset($successmsg)){ ?>
                <div style="margin-bottom: 0px;" class="alert alert-success">
                  <i class="fa fa-check-square-o"></i>
                  <?php echo @$successmsg; ?>
                </div>
                <?php } if(!empty($validationerrors)){ ?>
                <div style="margin-bottom: 0px;" class="alert alert-danger">
                  <i class="fa fa-times-circle"></i>
                  <?php echo $validationerrors; ?>
                </div>
                <?php } ?>
              </div>
              <br>
              <div id="message-contact"></div>
              <div class="col-md-4 go-right">
                <span class="opensans size24 slim go-right"><?php echo trans('0439');?></span>
                <input placeholder="<?php echo trans('0350');?>" class="form-control logpadding margtop10" type="text" name="contact_name" value="" required />
                <input placeholder="<?php echo trans('094');?>" class="form-control logpadding margtop10" type="email" name="contact_email" value="" required />
                <input placeholder="<?php echo trans('0261');?>" class="form-control logpadding margtop10" type="text" name="contact_subject" value="" required />
              </div>
              <div class="col-md-4 go-right">
                <textarea name="contact_message" placeholder="<?php echo trans('0262');?>" rows="8" class="form-control margtop10"></textarea>
              </div>
              <div class="col-md-4 opensans grey go-right RTL">
                <?php if(!empty($res2[0]->contact_address)){ ?>
                <?php echo trans('0255');?>:<br/>
                <span class="dark">
                <?php echo $res2[0]->contact_address; ?>
                </span>
                <?php } ?>
                <br/><br>
                <?php if(!empty($res2[0]->contact_phone)){ ?>
                <?php echo trans('061');?><br/>
                <p class="opensans size30 lblue xslim"><?php echo $res2[0]->contact_phone;?></p>
                <?php } ?>
                <?php if(!empty($res2[0]->contact_email)){ ?>
                <?php echo trans('094');?><br/>
                <a href="<?php echo $res2[0]->contact_email;?>" class="green2"><?php echo $res2[0]->contact_email;?></a>
                <?php } ?>
              </div>
            </div>
            <div class="well" style="margin-top:-50px;border-radius:0px">
              <input class="btn btn-primary btn-lg go-right" type="submit" name="submit_contact" value="<?php echo trans('086');?>">
              <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END OF WRAP -->
<section style="max-height:200px !important" class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $theme_url; ?>assets/img/login.jpg" data-natural-width="200" data-natural-height="100">
  <div class="parallax-content-1">
    <div class="animated fadeInDown">
      <h1 style="margin-top: -216px;"><?php echo trans('0270');?></h1>
    </div>
  </div>
</section>
<!-- End Section -->
<div class="container margin_60">
  <div class="row">
    <div class="col-md-8 col-sm-8">
      <div class="form_title">
        <h3><strong><i class="icon-pencil"></i></strong><?php echo trans('0270');?></h3>
        <p><?php echo trans('0260');?></p>
      </div>
    </div>
  </div>
  <!-- End row -->
</div>
<!-- End container -->
<!--<div id="map_contact"></div>-->
<div class="clearfix"></div>
<!--
  <?php if(!empty($res2[0]->contact_address)){ ?>
  <address>
  <?php echo $res2[0]->contact_address; ?>
  </address>
  <?php } ?>

  <script>
    $(document).ready(function(){
    $("address").each(function(){
    var embed ="<iframe width='100%' height='315' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='//maps.google.com/maps?&amp;q="+ encodeURIComponent( $(this).text() ) +"&amp;output=embed'></iframe>";
    $(this).html(embed);
    }); });
  </script>-->
