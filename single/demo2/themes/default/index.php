<?php
//error_reporting(0);
include('header.php');
//include('functions.php');

echo $this->content();

include('footer.php');
exit();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="KLIK2SET">
    <title>Bidakara Hotel</title>
    <link rel="shortcut icon" href="http://demo.klik2set.com/santoso/images/favicon.png?786978433">
    <!-- facebook -->
    <meta property="og:title" content="Sofyan Hotel"/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content="http://demo.klik2set.com/uploads/global/favicon.png"/>
    <meta property="og:url" content="klik2set.bindola.com/"/>
    <meta property="og:publisher" content="https://www.facebook.com/"/>
    <script type="application/ld+json">
      { "@context": "http://schema.org/",
        "@type": "Organization",
        "name": "",
        "url":"klik2set.bindola.com/",
        "logo":"http://demo.klik2set.com/uploads/global/favicon.png",
        "sameAs":"https://www.facebook.com/",
        "sameAs":"https://twitter.com/",
        "sameAs":"https://www.pinterest.com//",
        "sameAs":"https://plus.google.com/u/0//posts",
        "contactPoint":{
        "@type":"ContactPoint",
        "telephone":"+62 21 3905011",
        "contactType":"Customer Service" } } {
        "@context" : "http://schema.org",
        "@type" : "WebSite",
        "name" : "",
        "url" : "klik2set.bindola.com" }
    </script>
    <!-- facebook -->
    <link href="http://demo.klik2set.com/themes/default/assets/css/bootstrap.css?1456369137" rel="stylesheet" media="screen">
    <link href="http://demo.klik2set.com/themes/default/assets/css/custom.css?1456369137" rel="stylesheet" media="screen">
    <link href="http://demo.klik2set.com/themes/default/assets/css/animate.min.css" rel="stylesheet" media="screen">
    <link href="http://demo.klik2set.com/themes/default/style.css" rel="stylesheet">
    <style> @import "http://demo.klik2set.com/themes/default/childtheme/childstyle.css"; </style>
    <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script src="http://demo.klik2set.com/themes/default/assets/js/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://demo.klik2set.com/themes/default/assets/css/font-awesome.css" media="screen" />
    
    <link rel="stylesheet" href="http://demo.klik2set.com/themes/default/assets/css/jquery-ui.css" />
    
    <link href="assets/css/custom-single.css?" rel="stylesheet" media="screen">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,300' rel='stylesheet' type='text/css'>
    
    <script>
    	var baseURL = "http://demo.klik2set.com/";
    </script>
  </head>
  <body id="top">
    <!-- Top wrapper -->
    <div class="navbar navbar-fixed-top navbar-default ">
      <div class="container shaddow">
        <div class="navbar">
            <!-- Navigation-->
            <div class="navbar-header go-right">
              <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
              <a href="http://demo.klik2set.com/" class="navbar-brand"><img src="http://demo.klik2set.com/santoso/images/logo-bidakarahotel.png" alt="" class="moto"/></a>
            </div>
            <div class="navbar-collapse collapse">
              <div class="navbar-right go-left">
              	<div class="right-top text-right">
              		<!--<i class="fa fa-phone-square"></i> <span class="go-right">+62 21 3905011</span>              		<a href="https://www.facebook.com/travelbusiness" target="_blank"><img src="http://phptravels.net/uploads/images/social/slufm6otpasooc.png" class="go-right social-icons-footer"></a>
                    <a href="https://twitter.com/phptravels" target="_blank"><img src="http://phptravels.net/uploads/images/social/9ztbr148kh4o8c8.png" class="go-right social-icons-footer"></a>
                    <a href="https://plus.google.com/+Phptravels/" target="_blank"><img src="http://phptravels.net/uploads/images/social/2wz814aq9mgw04k.png" class="go-right social-icons-footer"></a>
              		--> &nbsp;
              	</div>
              <ul class="nav navbar-nav">
                <li class="dropdown active go-right">
                  <a class="dropdown-toggle" href="http://demo.klik2set.com/"> HOME </a>
                </li>
                                <li class="go-right  ">
                  <a href="http://demo.klik2set.com/hotels" class=""   target="_self" >
                    <!--<i class='fa fa-building'></i>--> ROOM                       </a>
                                  </li>
                                  <li class="go-right  ">
                  <a href="http://demo.klik2set.com/hotels" class=""   target="_self" >
                    <!--<i class='fa fa-building'></i>--> BANQUET & MEETING                       </a>
                                  </li>
                                  <li class="go-right  ">
                  <a href="http://demo.klik2set.com/hotels" class=""   target="_self" >
                    <!--<i class='fa fa-building'></i>--> DINING                       </a>
                                  </li>
                                  <li class="go-right  ">
                  <a href="http://demo.klik2set.com/hotels" class=""   target="_self" >
                    <!--<i class='fa fa-building'></i>--> FACILITIES                       </a>
                                  </li>
                                <li class="go-right  ">
                  <a href="http://demo.klik2set.com/contact-us" class=""   target="" >
                    <!--<i class='glyphicon glyphicon-phone-alt'></i>--> PROMO                    </a>
                                  </li>
                                <li class="go-right  ">
                  <a href="http://demo.klik2set.com/blog" class=""   target="_self" >
                    <!--<i class='fa fa-building'></i>--> EVENT                         </a>
                                  </li>
                                                <li class="dropdown pull-right">
                  <a href="javascript:void(0);" class="show-submenu">MY ACCOUNT <b class="lightcaret mt-2"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="http://demo.klik2set.com/login">  Login</a></li>
                    <li><a href="http://demo.klik2set.com/register">  Sign Up</a></li>
                  </ul>
                </li>
                              </ul>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="hidden-xs"><div style="margin-top:80px"></div></div>
    <div class="visible-xs"><div style="margin-top:60px"></div></div>
    <div class="mtslide2 sliderbg2"></div>
<link rel="stylesheet" href="http://demo.klik2set.com/themes/default/assets/css/home.css" />
    <!-- WRAP -->
<div class="wrap ctup">
<div style="width: 100%;" class="slideup">
  <div class="container z-index100" style="background-color:#fff; width:100%;">
    <div class="slidercontainer">
      <div class="row" style="background-color:#fff">
        
        <div class="col-md-12 scolright go-left visible-lg visible-md">
        <div class="row">

        <div id="Carousel" class="carousel slide carousel-fade">


        <div class="carousel-inner fadeIn animated">
        
            <div class="item active">
            <div class="slider">
                <img class="sizewh" src="http://demo.klik2set.com/santoso/images/HOME1.jpg">
                </div>
                <div class="container">
            <div class="carousel-caption" align="center">
              <h5 style="font-size:40px" class="fadeInUp animated"></h5>
              <h1 style="font-size:40px;" class="zoomIn animated"><strong style="background-color: rgba(0, 0, 0, 0.35);padding:10px"></strong></h1>
              <p style="font-size:20px;color:yellow" class="slim uppercase fadeInDown animated" style="text-shadow: 0 5px 7px rgba(9, 9, 15, 0.6); color:#FFFF00"></p><br/>

              <p></p>
            </div>
          </div>

            </div>
             
            <div class="item ">
            <div class="slider">
                <img class="sizewh" src="http://demo.klik2set.com/santoso/images/HOME2.jpg">
                </div>
                <div class="container">
            <div class="carousel-caption" align="center">
              <h5 style="font-size:40px" class="fadeInUp animated"></h5>
              <h1 style="font-size:40px;" class="zoomIn animated"><strong style="background-color: rgba(0, 0, 0, 0.35);padding:10px"></strong></h1>
              <p style="font-size:20px;color:yellow" class="slim uppercase fadeInDown animated" style="text-shadow: 0 5px 7px rgba(9, 9, 15, 0.6); color:#FFFF00"></p><br/>

              <p></p>
            </div>
          </div>

            </div>
             


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
      	<div class="booking-widget" > 
  <div class="box">
  	      <div role="tabpanel" class="tab-pane fade active in" id="HOTELS" aria-labelledby="home-tab">
	      <form action="http://demo.klik2set.com/hotels/" method="GET" role="search" >	   
		      <!--
		      <div class="destinasi-search">
		          <div class="size13 go-right"><b>Select A Hotel</b></div> 
		          <select name="searching" class="chosen-select RTL" id="hotelicon" value="" required >
			        <option value="">Select Hotel</option>
			        <optgroup label="Pandeglang">			        <option value="Sofyan-Inn-Altama" >Sofyan Inn Altama</option>
			        </optiongroup><optgroup label="Padang">			        <option value="Sofyan-Inn-Rangkayo-Basa" >Sofyan Inn Rangkayo Basa</option>
			        </optiongroup><optgroup label="Bogor">			        <option value="Sofyan-Inn-Srigunting" >Sofyan Inn Srigunting</option>
			        </optiongroup><optgroup label="Bandung">			        <option value="Sofyan-Inn-Specia" >Sofyan Inn Specia</option>
			        </optiongroup><optgroup label="Jakarta">			        <option value="Sofyan-Hotel-Betawi" >Sofyan Hotel Betawi</option>
			        			        <option value="Sofyan-Inn-Tebet" >Sofyan Inn Tebet</option>
			        </optiongroup><optgroup label="Medan">			        <option value="Sofyan-Saka" >Sofyan Saka</option>
			        </optiongroup>			      </select>
		        </div> -->
		        
		        <div class="checkin-search">
		          <label style="color:#fff" class="control-label go-right">Check in</label>
		          <input type="text" placeholder=" Check in " name="checkin" class="form-control mySelectCalendar dpd1 go-text-left" value="25/02/2016" required >

		        </div>
		        
		        <div class="checkout-search">
		          <label style="color:#fff" class="control-label go-right">Check out</label>
		          <input placeholder=" Check out " name="checkout" class="form-control mySelectCalendar dpd2 go-text-left" value="26/02/2016" required type="text">
		        </div>
		        <!--
		        <div class="room-search">
		          <div class="size13 go-right"><b>Rooms</b></div>
		          <select class="form-control selectx" name="Rooms">
		            <option >1</option>
		            <option >2</option>
		            <option >3</option>
		            <option >4</option>
		            <option >5</option>
		          </select>
		        </div> -->
		        
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
		        <!--<div class="promo-search">
		          <div class="size13 go-right"><b>Promo Code</b></div>
		          <input class="form-control selectx" name="Promocode" value="">
		      </input>
		        </div>-->
		        <div class="form-group">
		        	<label class="control-label">&nbsp;</label>
					<button type="submit" class="btn btn-primary btn-lg btn-block btn-widget w20">BOOK</button>
		        </div>
			</form>
		</div>
	</div>
</div>          
        </div>
      
      </div>
    </div>
  </div> 
</div>

			<div class="container">
              
				<div class="row">
                     <div class="form-group">
  <!--<h2 style="font-weight: bold;" class="main-title go-right"><img style="margin-right:10px;" src="http://demo.klik2set.com/themes/default/images/icon-ourhotels.png" height="30px"><span style="vertical-align:bottom;">OUR HOTELS</span></h2>-->
  <!-- <div class="clearfix new"></div> -->
  <i class="tiltle-line go-right"></i>
</div>
<div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated">
  <div class="row">
    <div class="img_list">
      <a href="http://demo.klik2set.com/hotels/Sofyan-Inn-Tebet?&checkin=25/02/2016&checkout=26/02/2016&adults=1&child=0">
        <img class="dealthumb go-right" src="http://demo.klik2set.com/santoso/images/deluxeroom2.jpg" alt="Sofyan Inn Tebet">
        <img class="overlay" src="http://demo.klik2set.com/themes/default/assets/img/overlay.png" style="z-index: ">
        <div class="short_info"></div>
      </a>
    </div>
    <div class="custom">
      <div class="dealtitle go-right">
        <p><a href="http://demo.klik2set.com/hotels/Sofyan-Inn-Tebet?&checkin=25/02/2016&checkout=26/02/2016&adults=1&child=0" class="dark go-text-right go-right rtl_title_home shadow">Deluxe Room</a></p>
        </div>
      <div class="dealprice go-left mt0">
      	         <p class="size12 white lh2">IDR          <span class="white shadow rate">
          643,802                    </span>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated">
  <div class="row">
    <div class="img_list">
      <a href="http://demo.klik2set.com/hotels/Sofyan-Saka?&checkin=25/02/2016&checkout=26/02/2016&adults=1&child=0">
        <img class="dealthumb go-right" src="http://demo.klik2set.com/santoso/images/executiveroom2.jpg" alt="Sofyan Saka">
        <img class="overlay" src="http://demo.klik2set.com/themes/default/assets/img/overlay.png" style="z-index: ">
        <div class="short_info"></div>
      </a>
    </div>
    <div class="custom">
      <div class="dealtitle go-right">
        <p><a href="http://demo.klik2set.com/hotels/Sofyan-Saka?&checkin=25/02/2016&checkout=26/02/2016&adults=1&child=0" class="dark go-text-right go-right rtl_title_home shadow">Executive Room</a></p>
        </div>
      <div class="dealprice go-left mt0">
      	         <p class="size12 white lh2">IDR          <span class="white shadow rate">
          902,893                    </span>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated">
  <div class="row">
    <div class="img_list">
      <a href="http://demo.klik2set.com/hotels/Sofyan-Hotel-Betawi?&checkin=25/02/2016&checkout=26/02/2016&adults=1&child=0">
        <img class="dealthumb go-right" src="http://demo.klik2set.com/santoso/images/juniorroom2.jpg" alt="Sofyan Hotel Betawi">
        <img class="overlay" src="http://demo.klik2set.com/themes/default/assets/img/overlay.png" style="z-index: ">
        <div class="short_info"></div>
      </a>
    </div>
    <div class="custom">
      <div class="dealtitle go-right">
        <p><a href="http://demo.klik2set.com/hotels/Sofyan-Hotel-Betawi?&checkin=25/02/2016&checkout=26/02/2016&adults=1&child=0" class="dark go-text-right go-right rtl_title_home shadow">Junior Suite</a></p>
        </div>
      <div class="dealprice go-left mt0">
      	         <p class="size12 white lh2">IDR          <span class="white shadow rate">
          1,216,942                    </span>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>

                     <!--Gak dipake -->
                     


                                                                <!--END Gak dipake -->
                     <!-- <div class="clearfix new"></div> -->

	<!-- <div class="clearfix new"></div> -->
 <!--TESTIMONI
<div class="testimony-wrap-box">
	<div class="w-title"><img src="http://demo.klik2set.com/themes/default/images/icon-testimony.png"><span data-title="TESTIMONY"></span></div>
 	<div class="clearfix new"></div>
 	 	<div class="box-content">
 		<div class="testimony-foto"><img src="http://demo.klik2set.com//themes/default/images/foto-default-testimony.jpg"></div>
		<div class="testimony-text-name">Terry<div class="testimony-text-content">Absolutely brilliant! Hotel is undergoing re modernisation so will bve even better&#8230;</div>
		</div>
		<div class="clearfix new"></div>
	</div>
	
	 	<div class="box-content">
 		<div class="testimony-foto"><img src="http://demo.klik2set.com//themes/default/images/foto-default-testimony.jpg"></div>
		<div class="testimony-text-name">Zak John<div class="testimony-text-content">Fantastic hotel for families as lots to keep kids and parents happy. Very relaxing.</div>
		</div>
		<div class="clearfix new"></div>
	</div>
	
	 	<div class="box-content">
 		<div class="testimony-foto"><img src="http://demo.klik2set.com//themes/default/images/foto-default-testimony.jpg"></div>
		<div class="testimony-text-name">Amanda<div class="testimony-text-content">The hotel was under maintenance, and it had a strong paint smell in lobby and on&#8230;</div>
		</div>
		<div class="clearfix new"></div>
	</div>
	
	</div>
TESTIMONI-->

 <!--TESTIMONI-->
<div class="testimony-wrap-box">
	<div class="w-title"><img src="http://demo.klik2set.com/themes/default/images/icon-testimony.png"><span data-title="TESTIMONY"></span></div>
 	<div class="clearfix new"></div>
 	 	<div class="box-content">
 		<div class="testimony-foto">7/10  </div>
		<div class="testimony-text-name">Terry<div class="testimony-text-content">Absolutely brilliant! Hotel is undergoing re modernisation so will bve even better&#8230;</div>
		</div>
		<div class="clearfix new"></div>
	</div>
	
	<div class="box-content">
 		<div class="testimony-foto">8/10  </div>
		<div class="testimony-text-name">Zak John<div class="testimony-text-content">Fantastic hotel for families as lots to keep kids and parents happy. Very relaxing&#8230;</div>
		</div>
		<div class="clearfix new"></div>
	</div>
	
	<div class="box-content">
 		<div class="testimony-foto">9/10  </div>
		<div class="testimony-text-name">Amanda<div class="testimony-text-content">The hotel was under maintenance, and it had a strong paint smell in lobby and on&#8230;</div>
		</div>
		<div class="clearfix new"></div>
	</div>
	
	<div class="box-content">
 		<div class="testimony-foto">8/10  </div>
		<div class="testimony-text-name">Nicole<div class="testimony-text-content">Fantastic hotel for families as lots to keep kids and parents happy. Very relaxing&#8230;</div>
		</div>
		<div class="clearfix new"></div>
	</div>
		 	
	</div>
<!--TESTIMONI-->
 
  
<!--VIDEO--->
<div class="video-wrap-box">
 <div class="w-title"><img src="http://demo.klik2set.com/themes/default/images/icon-video.png"><span data-title="VIDEO"></span></div>
 <div class="clearfix new"></div>
 <div class="vid youtube_check embed-responsive embed-responsive-4by3">
  <iframe class="embed-responsive-item" src="//www.youtube.com/embed/v3zijtuop54?modestbranding=1&autohide=1&showinfo=0&controls=0" allowfullscreen=""></iframe>
  </div>

<div class="video-description-title">Bidakara Hotel</div>
<div class="video-description">Strategically located at the business district in South Jakarta and an international standard four star hotel, Bidakara Hotel Jakarta featured as one of the innovative products and services, which has value added to support business activities and conventions of various government and private institutions whose existence has strong access to the location Bidakara Hotel Jakarta.</div>

 </div>
 

 <!--VIDEO--->
 
 <!--NEWS--->

  <div class="news-wrap-box">
 <div class="w-title"><img src="http://demo.klik2set.com/themes/default/images/icon-news.png"><span data-title="EVENTS"></span></div>
 <div class="clearfix new"></div>
 
<div class="col-md-12 go-right p0 m0">
                    <div class="col-md-4 go-right minp10">
            <div class="row">
              <a href=""><img src="http://demo.klik2set.com/santoso/images/news1.jpg" alt="Syukuran & Peresmian Renovasi Birawa Assembly" class="img-responsive"></a>
            </div>
          </div>
          <div class="ctn">
            <a href="">
              <h3 class="go-right RTL mtb0">Syukuran & Peresmian Renovasi Birawa Assembly</h3>
            </a>
            <div class="post_info">
              <div class="post-left go-left">
                <ul class="go-left">
                  <li><i class="icon-calendar-empty"></i>On <span class="">16/12/2014</span></li>
                </ul>
              </div>
            </div>
            <!--p class="RTL"> Gubernur NTB Dr. TGH. M. Zainul Majdi mengajak seluruh komponen masyarakat termasuk para pelaku industri pariwisata&#8230; <a href="http://demo.klik2set.com/blog/Gubernur-Dengan-wisata-syariah-potret-NTB-akan-semakin-beragam">[more]</a></p-->
         </div>
          <div class="clearfix"></div>
          <hr>
                    <div class="col-md-4 go-right minp10">
            <div class="row">
              <a href=""><img src="http://demo.klik2set.com/santoso/images/news2.jpg" alt="Indonesia Tourism & Creative Economy Fair (ITCEF) 2013" class="img-responsive"></a>
            </div>
          </div>
          <div class="ctn">
            <a href="">
              <h3 class="go-right RTL mtb0">Indonesia Tourism & Creative Economy Fair (ITCEF) 2013</h3>
            </a>
            <div class="post_info">
              <div class="post-left go-left">
                <ul class="go-left">
                  <li><i class="icon-calendar-empty"></i>On <span class="">16/12/2014</span></li>
                </ul>
              </div>
            </div>
            <!--p class="RTL"> MES (Masyarakat Ekonomi Syariah) menyelenggarakan seri FGD (Focus Group Discussion) dengan tema sentral &ldquo;Indonesia&#8230; <a href="http://demo.klik2set.com/blog/Menuju-Road-Map-Peningkatan-Halal-Tourism-and-Lifestyle-Indonesia">[more]</a></p-->
         </div>
          <div class="clearfix"></div>
          <hr>
                    <div class="col-md-4 go-right minp10">
            <div class="row">
              <a href=""><img src="http://demo.klik2set.com/santoso/images/news4.jpg" alt="Bidakara Hotel Jakarta’s Employee Gathering" class="img-responsive"></a>
            </div>
          </div>
          <div class="ctn">
            <a href="">
              <h3 class="go-right RTL mtb0">Bidakara Hotel Jakarta’s Employee Gathering</h3>
            </a>
            <div class="post_info">
              <div class="post-left go-left">
                <ul class="go-left">
                  <li><i class="icon-calendar-empty"></i>On <span class="">16/12/2014</span></li>
                </ul>
              </div>
            </div>
            <!--p class="RTL"> JAKARTA, bisniswisata.co.id: Sekretaris Jenderal Masyarakat Ekonomi Syariah (MES), Syakir Sula mengatakan langkah&#8230; <a href="http://demo.klik2set.com/blog/FGD-putuskan-implementasi-Halal-Tourism-Lifestyle-Industry-sudah-sangat-mendesak">[more]</a></p-->
         </div>
          <div class="clearfix"></div>
          <hr>
              </div>
</div>
 
 
 <!--NEWS--->
  </div>				</div>
			</div>
       </div>
       <div id="footer" class="container-full footerbg" style="background: #333 none repeat scroll 0% 0%;padding-top: 0px;padding-bottom: 54px;">

  <div style="padding-right: 0px;padding-left: 0px;" class="container orange">
  	 	<div class="new-orange"></div> 
    
    <div style="font-weight:bold; padding-top: 30px;color:#fff;" class="col-md-3 go-right margin20">
      <h2 style="color:#fff" class="ftitle go-text-right"><strong>OFFICE</strong></h2>
      <div style="font-weight:normal;">Hotel Bidakara Jakarta<br>
Jl. Jend. Gatot Subroto Kav.71-73 Pancoran Jakarta Selatan 12870<br>
Phone : +62 21 8379 3555<br>
www.bidakarahotel.com</div>
      <div class="scont">
        <div class="clearfix"></div>
        <div style="padding-top:20px;color:#fff">LETS CONNECT</div>
        <div id="social_footer go-right">
        
                    <a href="https://www.facebook.com/travelbusiness" target="_blank"><img src="http://phptravels.net/uploads/images/social/slufm6otpasooc.png" class="go-right social-icons-footer"></a>
                    <a href="https://twitter.com/phptravels" target="_blank"><img src="http://phptravels.net/uploads/images/social/9ztbr148kh4o8c8.png" class="go-right social-icons-footer"></a>
                    <a href="https://plus.google.com/+Phptravels/" target="_blank"><img src="http://phptravels.net/uploads/images/social/2wz814aq9mgw04k.png" class="go-right social-icons-footer"></a>
                  </div>
               
                
      </div>
    </div>
    <!-- End of column 1-->
                <div style="font-weight:bold; padding-top: 30px;color:#fff" class="col-md-3 go-right margin20">
              <h2 style="color:#fff" class="ftitle go-text-right"><strong>MENU</strong></h2>
              <ul class="footerlist go-right go-text-right">
                                <li><a style="color: #FFF;" href="#" target="" title="">HOME</a></li>
                                <li><a style="color: #FFF;" href="#" target="" title="">ROOM</a></li>
                                <li><a style="color: #FFF;" href="#" target="" title="">BANQUET & MEETING</a></li>
                                <li><a style="color: #FFF;" href="#" target="" title="">DINING</a></li>
                                <li><a style="color: #FFF;" href="#" target="" title="">FACILITIES</a></li>
                                <li><a style="color: #FFF;" href="#" target="" title="">PROMO</a></li>
                                <li><a style="color: #FFF;" href="#" target="" title="">EVENT</a></li>
                                
                              </ul>
            </div>
                <div style="font-weight:bold; padding-top: 30px;color:#fff" class="col-md-3 go-right margin20">
              <h2 style="color:#fff" class="ftitle go-text-right"><strong>AWARD &amp; CERTIFICATION</strong></h2>
        <div id="social_footer go-right">
        
                    <a href="https://www.facebook.com/travelbusiness" target="_blank"><img class="award-img" src="http://demo.klik2set.com/themes/default/images/award.png"></a>
                    
                  </div>
            </div>
    
 <!--   <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="clearfix"></div>
      <hr style="border-top: 1px solid #FFFFFF;">
      <div class="clearfix"></div>
      <center>              <a href="http://phptravels.net/"><img src="http://demo.klik2set.com/themes/default/images/logo-sofyanhotels.png" alt="PHPTRAVELS" class="moto"></a></center>
      <p class="text-center">© All Rights Reserved by Sofyan Hotel</p>
    </div>
  </div>
</div>
<div class="footerbg3 hidden-xs">
  <div class="container center grey">
    <a href="#top" class="gotop scroll"><img src="http://demo.klik2set.com/themes/default/images/spacer.png" /></a>
  </div>-->
</div>
<link href="http://demo.klik2set.com/themes/default/assets/include/select2/select2.css" rel="stylesheet" />
<script src="http://demo.klik2set.com/themes/default/assets/include/select2/select2.min.js"></script>
<!-- This page JS -->
<!-- Custom functions -->
<script src="http://demo.klik2set.com/themes/default/assets/js/functions.js?time=1456369137"></script>
<!-- Picker UI-->
<script src="http://demo.klik2set.com/themes/default/assets/js/jquery-ui.js"></script>
<!-- Easing -->
<script src="http://demo.klik2set.com/themes/default/assets/js/jquery.easing.js"></script>
<!-- Nicescroll  -->
<script src="http://demo.klik2set.com/themes/default/assets/js/jquery.nicescroll.min.js"></script>
<!-- CarouFredSel -->
<script src="http://demo.klik2set.com/themes/default/assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script src="http://demo.klik2set.com/themes/default/assets/js/helper-plugins/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="http://demo.klik2set.com/themes/default/assets/js/helper-plugins/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="http://demo.klik2set.com/themes/default/assets/js/helper-plugins/jquery.transit.min.js"></script>
<script type="text/javascript" src="http://demo.klik2set.com/themes/default/assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>
<!-- Custom Select -->
<script type='text/javascript' src='http://demo.klik2set.com/themes/default/assets/js/jquery.customSelect.js'></script>
<script src="http://demo.klik2set.com/themes/default/assets/js/bootstrap.min.js"></script>
<script src="http://demo.klik2set.com/themes/default/assets/include/datepicker/datepicker.js"></script>
<link rel="stylesheet" href="http://demo.klik2set.com/themes/default/assets/include/datepicker/datepicker.css" />
<link rel="stylesheet" href="http://demo.klik2set.com/themes/default/assets/include/datepicker/dp2.css" />
<script>
  $('#popoverData').popover();
  $('#popoverOption').popover({ trigger: "hover" });
</script>
<script>
  var fmt = "dd/mm/yyyy";
  var baseURL = "http://demo.klik2set.com/";

  $(function() {

   /* Wish list global function */
   $(".wishlistcheck").on("click",function(){
     var id = $(this).prop('id');
     var module = $(this).data('module');
     var userid = "";
     var action = "add";
     var thisdiv = $(this);
     if($(this).hasClass('fav')){
         action = "remove";
     }


  $.post(baseURL+'account/wishlist/'+action,{module: module, itemid: id, loggedin: userid},function(resp){
    var response = $.parseJSON(resp);

    if(response.isloggedIn){

      if(action == "remove"){
      $("."+module+"wishsign"+id).html("+");
      //$("."+module+"wishtext"+id).html("Add to Wishlist");
      $("."+module+"wishtext"+id).tooltip('hide').attr('data-original-title', "Add to Wishlist").tooltip('fixTitle').tooltip('show');
      $("."+module+"wishsign"+id).removeClass("fav");
      thisdiv.removeClass('fav');

     }else{

      thisdiv.addClass('fav');
      $("."+module+"wishsign"+id).addClass("fav");
      $("."+module+"wishsign"+id).html("-");
      //$("."+module+"wishtext"+id).html("Remove From Wishlist");
      $("."+module+"wishtext"+id).tooltip('hide').attr('data-original-title', "Remove From Wishlist").tooltip('fixTitle').tooltip('show');

     }

     }else{
      alert("Please Login to add to wishlist.");
     }
     console.log(response);
   });

   })
   /* End Wish list global function */

  /* select2 */
  $('.chosen-select').select2({ width: '100%', maximumSelectionSize: 1  });

  /* homepage main search auto detector */
  $('.nav-tabs li:first-child').addClass('active');  var t  = $('.nav-tabs li:first-child').data('title'); $("#"+t).addClass("active in"); $('.feat li:first-child').addClass('active'); var t  = $('.feat li:first-child').data('title'); $("#"+t).addClass("active in");

  /* tours ajax categories loader */
  
   /* cars ajax types loader */
  

   /* tooltip */
  $('[data-toggle=tooltip]').tooltip();

  /* datepicker */
  window.prettyPrint&&prettyPrint(),$(".dob").datepicker({format:fmt,autoclose:!0}).on("changeDate",function(){$(this).datepicker("hide")}),$("#dp1").datepicker(),$("#dp2").datepicker();

  /* disabling dates */
      var nowTemp = new Date();
      var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
      var checkin = $('.dpd1').datepicker({
          format: fmt,
          onRender: function(date) {
              return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
      }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
              var newDate = new Date(ev.date)
              newDate.setDate(newDate.getDate() + 1);
              checkout.setValue(newDate);
          }
          checkin.hide();
          $('.dpd2')[0].focus();
      }).data('datepicker');
      var checkout = $('.dpd2').datepicker({
          format: fmt,
          onRender: function(date) {
              return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
      }).on('changeDate', function(ev) {
          checkout.hide();

      }).data('datepicker');

  /* Expedia datepicker */
    /* End Expedia Datepicker*/

   /* Dohop datepicker */
    /* End Dohop Datepicker*/



  
  
    /* Cartrawler datepicker */
    /* End Cartrawler Datepicker*/

  /* Newsletter subscription */
  $(".sub_newsletter").on("click",function(){var e=$(".sub_email").val();$.post("http://demo.klik2set.com/home/subscribe",{email:e},function(e){$(".subscriberesponse").html(e).fadeIn("slow"),setTimeout(function(){$(".subscriberesponse").fadeOut("slow")},2000)})});

  /* dropdown on hover */
  $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(200).fadeIn(200)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(200).fadeOut(200)}); });

  /* start change currency functionality */
  function change_currency(c){$("#loadingbg").css("display","block"),$.post("http://demo.klik2set.com/admin/ajaxcalls/changeCurrency",{id:c},function(){location.reload()})}

  /* map iframe modal */
  function showMap(a,o){"modal"==o?($("#mapModal").modal("show"),$("#mapModal").on("shown.bs.modal",function(){$("#mapModal .mapContent").html('<iframe src="'+a+'" width="100%" height="450" frameborder="0" style="border:0"></iframe>')})):$("#"+o).html('<iframe src="'+a+'" width="100%" height="450" frameborder="0" style="border:0"></iframe>')}
</script>

</body>
</html>
