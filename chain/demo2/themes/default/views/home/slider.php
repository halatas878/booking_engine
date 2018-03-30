<!-- WRAP -->
<div class="wrap ctup">
<div class="slideup">
  <div class="container z-index100" style="background-color:#fff">
    <div class="slidercontainer">
      <div class="row" style="background-color:#fff">
        
        <div class="col-md-12 scolright go-left visible-lg visible-md">
        <div class="row">

        <div id="Carousel" class="carousel slide carousel-fade">


        <div class="carousel-inner fadeIn animated">
        <?php
                $mulcur = "";
                $mainslides = pt_get_main_slides();
                $scount = 0;
                foreach($mainslides as $ms){
                $sliderlib->set_id($ms->slide_id);
                $sliderlib->slide_details();
                $scount++;
                $sactive = "";
                if($scount == 1){
                $sactive = "active";
                }else{
                $sactive = "";
                }
                ?>

            <div class="item <?php echo $sactive; ?>">
            <div class="slider">
                <img src="<?php echo PT_SLIDER_IMAGES.$ms->slide_image;?>">
                </div>
                <div class="container">
            <div class="carousel-caption" align="center">
              <h5 style="font-size:40px" class="fadeInUp animated"><?php echo $sliderlib->title;?></h5>
              <h1 style="font-size:40px;" class="zoomIn animated"><strong style="background-color: rgba(0, 0, 0, 0.35);padding:10px"><?php echo $sliderlib->desc;?></strong></h1>
              <p style="font-size:20px;color:yellow" class="slim uppercase fadeInDown animated" style="text-shadow: 0 5px 7px rgba(9, 9, 15, 0.6); color:#FFFF00"><?php echo $ms->slide_optional_text;?></p><br/>

              <p></p>
            </div>
          </div>

            </div>
             <?php } ?>



        </div>

        <a class="left carousel-control" href="#Carousel" data-slide="prev">
            <span class="glyphicon-chevron-left fa fa-angle-left"></span>
        </a>
        <a class="right carousel-control" href="#Carousel" data-slide="next">
            <span class="glyphicon-chevron-right fa fa-angle-right"></span>
        </a>
</div>



        </div>
        
      </div>
      
      <div class="col-md-12 col-xs-12">
      	<?php require $themeurl.'views/hotels/booking-widget.php'; ?>
          
        </div>
      
      </div>
    </div>
  </div> 
</div>

