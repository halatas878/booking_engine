<style>
	.xcrud-overlay{
		display:none;
	}
</style>
<?php $UriSegment = $this->uri->segment(1);
(isset($_GET['chart']))?$chart=1:$chart=0;
(isset($_GET['statistics']))?$statistics=1:$statistics=0;
if($statistics!=1 && $chart!=1):
 	$uri = explode("/",$_SERVER['REQUEST_URI']); 
	$hotellists = getHotels();
	$uri2 = $this->uri->segment(1);
    $base = base_url().$uri2;
?>

  <!-- BEGIN ICON BUTTONS SET-->
  <?php if($canQuickBook){ ?>
  <!-- <div class="col-xs-6 col-sm-6 col-md-2">
    <button data-toggle="modal" data-target="#quickbook" class="btn btn-danger btn-block">
      <div class="h5"><i class="fa fa-dashboard fa-lg"></i> Call Center</div>
    </button>
  </div> -->
  <?php } ?>
  
  <?php if($isadmin){ ?>
  
  <?php if($blogenabled){ ?>
  	
  <?php } ?>
 

  <?php } ?>
 
  <!-- END ICON BUTTONS SET-->

<?php endif;?>
<!-- Reports section -->
<?php if(!empty($isadmin)){ 
	if($chart>0):
?>
<h1 class="title"><i class="fa fa-line-chart"></i> Chart</h1>
<div class="row">
	
  <div class="col-md-8">
    <div class="panel panel-default">
      <h4 class="head">Revenue Chart</h4>
      <div class="panel-body">
        <style>
          .rev-but { padding: 8px 16px; background-color:#f7f7f7; }
          .rev-bg { background-color:#f9f9f9;border-radius:5px }
          .pad8 { padding: 8px; }
          .pad8 h4 { margin-bottom: 5px; }
          .pad8 p { color: #8e8e8e }
          .mlr0 { padding-right: 0px; padding-left: 0px; }
          .mtb10 { margin-top: 15px;margin-bottom: 15px; }
          .mtb04 { margin-top: 0px;margin-bottom: 5px; }
          .mb0 { margin-bottom: 0px; }
          .tempStatBox {
          width: 120px;
          -webkit-box-sizing: content-box;
          -moz-box-sizing: content-box;
          box-sizing: content-box;
          margin: 0 auto;
          }
          .tempStatBox .tempStat {
          position: relative;
          font-size: 27px;
          line-height: 80px;
          -webkit-border-radius: 50em;
          -moz-border-radius: 50em;
          border-radius: 50em;
          border: 10px solid #FFF;
          background: #f9f9f9;
          height: 80px;
          width: 80px;
          text-align: center;
          margin: 0 auto;
          -webkit-box-sizing: content-box;
          -moz-box-sizing: content-box;
          box-sizing: content-box;
          }
          .tempStatBox .tempStat:before {
          content: "";
          top: -10px;
          left: -10px;
          height: 100px;
          width: 100px;
          position: absolute;
          -webkit-border-radius: 50em;
          -moz-border-radius: 50em;
          border-radius: 50em;
          background: transparent;
          -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.3),0px 1px 0 #fff;
          -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.3),0px 1px 0 #fff;
          box-shadow: inset 0 1px 1px rgba(0,0,0,0.3),0px 1px 0 #fff;
          -webkit-box-sizing: content-box;
          -moz-box-sizing: content-box;
          box-sizing: content-box;
          }
        </style>
        <div class="row">
          <div class="col-md-12">
            <div id="container" style="min-width: 310px; height: 335px; margin: 0 auto"></div>
          </div>
          <!-- Line Chart JS -->
          <script type="text/javascript">
            $(function () {
                $('#container').highcharts({
                    title: {
                        text: 'Last 30 Days Bookings Report',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: <?php echo json_encode($graphReport['days']); ?>
                    },
                    yAxis: {
                        title: {
                            text: 'Booking Amount'
                        },
                     min: 0,
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: ' <?php echo $currCode; ?>'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: <?php echo $resArray;?>
                });
            });
          </script>
          <!-- End Line Chart JS -->
          <div class="col-md-4">
            <div class="block">
              <div class="panel panel-default mb0">
                <div class="pad8">
                  <button class="btn btn-default btn-block rev-but">
                  Today
                  </button>
                  <div class="pad8 text-center">
                    <h4><strong><?php echo $currCode;?> <?php echo $todayPaid->totalPaidAmount + $todayExpedia->totalAmount;?></strong></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="block">
              <div class="panel panel-default mb0">
                <div class="pad8">
                  <button class="btn btn-default btn-block rev-but">
                  Last 30 Days
                  </button>
                  <div class="pad8 text-center">
                    <h4><strong><?php echo $currCode;?> <?php echo $thirtyDaysPaid->totalPaidAmount + $thirtyDaysExpedia->totalAmount;?></strong></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="block">
              <div class="panel panel-default mb0">
                <div class="pad8">
                  <button class="btn btn-default btn-block rev-but">
                  Last 90 Days
                  </button>
                  <div class="pad8 text-center">
                    <h4><strong><?php echo $currCode;?> <?php echo $nintyDaysPaid->totalPaidAmount + $nintyDaysExpedia->totalAmount;?></strong></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <h4 class="head">Booking Summary </h4>
      <div class="panel-body">
        <div class="block">
          <div class="pad8 rev-bg">
            <div class="col-md-5 row col-sm-5">
              <div class="tempStatBox" style="margin-left:-10px;" >
                <div class="tempStat" style="border-color: rgb(0, 204, 51);"><?php echo $today->totalCount + $todayExpedia->totalCount;?></div>
              </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-7">
              <div class="text-left">
                <h4><strong>Today's Booking</strong></h4>
                <p>Yesterday's : <?php echo $yesterday->totalCount + $yesterdayExpedia->totalCount;?></p>
                <hr class="mtb04">
                <span class="text-success"><strong>Paid :</strong> <?php echo $today->paidAmount + $todayExpedia->paidAmount;?></span>
                <div class="clearfix"></div>
                <span class="text-danger"><strong>Unpaid :</strong> <?php echo $today->unpaidAmount;?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="clearfix"></div>
        <hr class="mtb10">
        <div class="clearfix"></div>
        <div class="block">
          <div class="pad8 rev-bg">
            <div class="col-md-5 row col-sm-5">
              <div class="tempStatBox" style="margin-left:-10px;" >
                <div class="tempStat" style="border-color: rgb(255, 153, 51);"><?php echo $thirtyDays->totalCount + $thirtyDaysExpedia->totalCount;;?></div>
              </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-7">
              <div class="text-left">
                <h4><strong>Last 30 Day's</strong></h4>
                <p>Last 60 Day's : <?php echo $sixtyDays->totalCount + $sixtyDaysExpedia->totalCount;?></p>
                <hr class="mtb04">
                <span class="text-success"><strong>Paid :</strong> <?php echo $thirtyDays->paidAmount + $thirtyDaysExpedia->paidAmount;?></span>
                <div class="clearfix"></div>
                <span class="text-danger"><strong>Unpaid :</strong> <?php echo $thirtyDays->unpaidAmount;?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="clearfix"></div>
        <hr class="mtb10">
        <div class="clearfix"></div>
        <div class="block hidden-md hiddin-sm hidden-xs">
          <div class="pad8 rev-bg">
            <div class="col-md-5 row col-sm-5">
              <div class="tempStatBox" style="margin-left:-10px;" >
                <div class="tempStat" style="border-color: rgb(204, 0, 51);"><?php echo $nintyDays->totalCount + $nintyDaysExpedia->totalCount;?></div>
              </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-7">
              <div class="text-left">
                <h4><strong>Last 90 Day's</strong></h4>
                <p>Last 180 Day's : <?php echo $oneEightyDays->totalCount + $oneEightyDaysExpedia->totalCount;?></p>
                <hr class="mtb04">
                <span class="text-success"><strong>Paid :</strong> <?php echo $nintyDays->paidAmount + $nintyDaysExpedia->paidAmount;?></span>
                <div class="clearfix"></div>
                <span class="text-danger"><strong>Unpaid :</strong> <?php echo $nintyDays->unpaidAmount;?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <hr>
</div>

<?php endif; } ?>
<!-- Reports section -->

<?php if($statistics==12):?>
<!-- Recent Bookings -->
<?php if(pt_permissions('booking',@$userloggedin)){ ?>
<?php  echo modules::run($UriSegment.'/bookings/dashboardBookings'); ?>
<?php } ?>
<!--Recent Bookings -->

<!-- Expedia Recent Bookings -->
<?php if(!empty($isadmin)){ $chkExpedia = $chklib->is_mod_available_enabled("ean");
 if($chkExpedia){ echo modules::run('ean/eanback/dashboardBookings'); } } ?>
<!--Expedia Recent Bookings -->

<?php endif; if(($statistics==1)):?>
<h1 class="title"><i class="fa fa-bar-chart"></i> Statistics</h1>
<div class="row">
  <div class="col-md-12">
    <?php if(!empty($isadmin)){ ?>
    <div class="panel panel-default">
        <h4 class="head"> Visit Statistics of <?php echo date('F', time()); ?></h4>
      <div class="panel-body">
        <?php
          $totaldays = count($visits);
          $arr = array();
          $maxhits = array();
             foreach($visits as $v){
            if(empty($v)){
                 $arr[] = 0;
               }
               foreach($v as $vsub){
                $arr[] = $vsub;
               }
            }

            foreach($arr as $aaa){
            	if(!empty($aaa)){
            	$maxhits[] = $aaa->hitscount;
            }
          }?>
        <br>
        <div id="resgraph" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php endif;?>
<?php
$id = ($this->session->userdata('hotel'));
$listroom = (getShortRoom($id));
?>
<?php if(!isset($_GET['statistics']) && !isset($_GET['chart'])):?>
<div class="container">
    <div class="row">
  		<h1 class="title"><i class="fa fa-tachometer"></i> DASBOARD</h1>
    	<div class="col-xs-12 col-sm-6 col-md-6">
    		 <div class="row">
    		 	<div class="panel panel-default">
    		 		<h2>Room List</h2>
    		 		<div class="panel-body"  style="padding: 1px 0px;" >
			    	<?php if(count($listroom>0)): foreach($listroom as $k=>$v):?>
			    		<div class="col-xs-12 col-sm-12 col-md-12"  style="padding: 0px;" >
			            <div class="well well-sm">
			                <div class="row">
			                    <div class="col-sm-6 col-md-6">
			                        <img src="<?=base_url();?>/uploads/images/hotels/rooms/thumbs/<?=strlen($v->thumbnail_image>10)?	$v->thumbnail_image:"blank.jpg";?>" alt="" class="img-rounded img-responsive" />
			                    </div>
			                    <div class="col-sm-6 col-md-6">
			                        <h4 class="mt-0"><?=$v->room_title;?></h4>
			                       <div class="form-group"> <label class="label label-primary label-key">Master Rate IDR <?=number_format($v->room_basic_price);?></label></div>
			                       <ul style="margin-top: 40px;">
			                            <li><a href="<?=$basse;?>/hotels/listrates?room=<?=$v->room_id;?>&type=setup"><i class="glyphicon glyphicon-edit"></i> Update Rate & Allotments</a></li>
			                        	<li><a href="<?=base_url()?>admin/coupons/"><i class="glyphicon glyphicon-edit"></i> Promotion</a></li>
			                        	<li><a href="<?=$base;?>/hotels/roomgallery/<?=$v->room_id;?>"><i class="glyphicon glyphicon-edit"></i> Gallery</a>	</li>
			                        </ul>
			                        <div class="btn-group pull-right">
			                            <a href="<?=$base;?>/hotels/rooms/manage/<?=$v->room_id;?>" class="btn btn-default btn-block btn-default">Edit Room</a> 
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <?php
			        endforeach; endif;
			        ?>
		        </div>
		     </div>
        </div>
</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			 <div class="row">
			 	<div class="col-xs-12 col-sm-12 col-md-12">
				    <a href="<?=__URL__;?>/quickbooking/?applytax=no&service=hotels" class="btn btn-warning btn-block">
				      <div class="h5"><span class="glyphicon glyphicon-phone-alt"></span> Call Center</div>
				    </a>
			    </div>
			    <div class="col-xs-12 col-sm-6  col-md-12">
					<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/plugin/calendar/zabuto.min.css">
					<div id="my-calendar"></div>
			    </div>
			 </div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 mt10">
			<!-- Recent Bookings -->
			<?php if(pt_permissions('booking',@$userloggedin)){ ?>
			<?php  echo modules::run($UriSegment.'/bookings/dashboardBookings'); ?>
			<?php } ?>
			<!--Recent Bookings -->
		</div>
    </div>
</div>

<?php endif;?>

<!---quick booking modal-->
<div class="modal fade" id="quickbook" tabindex="-1" role="dialog" aria-labelledby="ADD_BLOG_CAT" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url().$this->uri->segment(1); ?>/quickbooking/" method="GET">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Quick Booking</h4>
        </div>
        <div class="modal-body form-horizontal">
          <div class="form-group">
            <label class="col-md-3 control-label" >Apply Tax</label>
            <div class="col-md-4">
              <select name="applytax" class="form-control" id="apply" >
                <option value="yes" >Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" id="service" >Service</label>
            <div class="col-md-4">
              <select required name="service" data-placeholder="Select" class="form-control" id="servicetype" tabindex="1">
                <option value="">Select</option>
                <?php
                  foreach($quickmodules as $mod):
                    $istrue = $chklib->is_mod_available_enabled($mod);
                     $isintegration = $chklib->is_integration($mod);
                   if($istrue && !$isintegration && !in_array($mod,$chklib->notinclude)){
                     if(pt_permissions($mod,@$userloggedin)){
                  ?>
                <option value="<?php echo $mod;?>"><?php echo ucfirst($mod);?></option>
                <?php } } endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Next</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->
<!-- Charts -->
<script src="<?php echo base_url(); ?>assets/include/highcharts/highcharts.js"></script>
<!-- Charts -->
<script type="text/javascript">
  $(function () {



          $('#resgraph').highcharts({
                  chart: {
              type: 'column',
               zoomType: 'x'
          },
          title: {
              text: ''
          },
          xAxis: {
            title: {
                  text: "<?php echo date('F', time()); ?>"
              },
            categories: [<?php for($day =1;$day <= $totaldays;$day++){echo $day.","; }?>]
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Visits'
              },
              stackLabels: {
                  enabled: true,
                  style: {
                      fontWeight: 'bold',
                      color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                  }
              }
          },
          legend: {
              align: 'right',
              x: -70,
              verticalAlign: 'top',
              y: 20,
              floating: true,
              backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
              borderColor: '#CCC',
              borderWidth: 1,
              shadow: false
          },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.x + '</b><br/>' +
                      this.series.name + ': ' + this.y + '<br/>' +
                      'Total: ' + this.point.stackTotal;
              }
          },
          plotOptions: {
              column: {
                  stacking: 'normal',
                  dataLabels: {
                      enabled: false,
                      color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                      style: {
                          textShadow: '0 0 3px black, 0 0 3px black'
                      }
                  }
              }
          },
          series: [{
              name: 'Unique',
              data: [<?php       foreach($arr as $aaa){
    if(!empty($aaa)){

    echo $aaa->visitscount.",";
    }else{
      echo "0,";
    }

    } ?>],
       stack: 'male'
          }, {
              name: 'Total Hits',
              data: [<?php       foreach($arr as $aaa){
    if(!empty($aaa)){

    echo $aaa->hitscount - $aaa->visitscount.",";
    }else{
      echo "0,";
    }

    } ?>],
      stack: 'female'
          }]
          });
      });


</script>