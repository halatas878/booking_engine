 <!-- End row -->
    <div id="ADDREVIEW" class="panel-collapse collapse">
    <div class="panel panel-default">
  <div class="panel-heading"><strong><?php echo trans('083');?></strong> <a href="#ADDREVIEW" data-toggle="collapse" data-parent="#accordion"><span class="badge badge-default pull-right">x</span></a></div>
  <div class="panel-body">
  <div class="col-md-12">

     <form class="form-horizontal row" method="POST" id="reviews-form-<?php echo $tour->id;?>" action="" onsubmit="return false;">
        <div id="review_result<?php echo $tour->id;?>" > </div>
          <div class="alert resp" style="display:none"></div>
          <div class="spacer20px">
            <div class="col-md-5" style="padding-left: 0px;">
              <div class="panel panel-default">
                <div class="panel-heading"><strong><?php echo trans('0350');?></strong></div>
                <input class="form-control form" type="text" name="fullname" placeholder="<?php echo trans('0390');?> <?php echo trans('0350');?>">
              </div>
            </div>
            <div class="col-md-5" style="padding-right: 0px;">
              <div class="panel panel-default">
                <div class="panel-heading"><strong><?php echo trans('094');?></strong></div>
                <input class="form-control form" type="text" name="email" placeholder="<?php echo trans('0390');?> <?php echo trans('094');?>">
              </div>
            </div>
            <div class="col-md-2" style="padding-right: 0px;">
              <div class="panel panel-default">
                <div class="panel-heading"><strong><?php echo trans('0340');?></strong></div>
                <select class="form-control" id="" name="overall">
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5"> 5 </option>
                  <option value="6"> 6 </option>
                  <option value="7"> 7 </option>
                  <option value="8"> 8 </option>
                  <option value="9"> 9 </option>
                  <option value="10"> 10 </option>
                </select>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="panel panel-default">
              <div class="panel-heading"><strong><?php echo trans('0391');?></strong></div>
              <textarea class="form-control form" type="text" placeholder="<?php echo trans('0391');?>" name="reviews_comments" id="" cols="30" rows="7"></textarea>
            </div>
            <p class="text-danger"><strong><?php echo trans('0371');?></strong> : <?php echo trans('085');?>.</p>
          </div>
         <input type="hidden" name="addreview" value="1" />
     <!--    <input type="hidden" name="overall" id="overall_<?php echo $tour->id; ?>" value="1" /> -->
        <input type="hidden" name="reviewmodule" value="tours" />
        <input type="hidden" name="reviewfor" value="<?php echo $tour->id; ?>" />
       <div class="form-group">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-block addreview" id="<?php echo $tour->id; ?>" ><?php echo trans('086');?></button>
          </div>
        </div>
      </form>



    </div>
    </div>
    </div>
    </div>
    <br><br>
