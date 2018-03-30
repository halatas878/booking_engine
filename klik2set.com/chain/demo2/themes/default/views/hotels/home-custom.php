<!-- <div class="clearfix new"></div> -->

	<!-- <div class="clearfix new"></div> -->
 <!--TESTIMONI-->
<div class="testimony-wrap-box">
	<div class="w-title"><img src="images/icon-testimony.png"><span data-title="TESTIMONY"></span></div>
 	<div class="clearfix new"></div>
 	<?php if(count($reviews>0)):foreach($reviews as $k=>$v){?>
 	<div class="box-content">
 		<div class="testimony-foto"><img src="<?=base_url();?>/themes/default/images/foto-default-testimony.jpg"></div>
		<div class="testimony-text-name"><?=$v->review_name;?>
			<div class="testimony-text-content"><?php echo character_limiter(strip_tags($v->review_comment), 80);?></div>
		</div>
		<div class="clearfix new"></div>
	</div>
	
	<?php } endif;?>
</div>
<!--TESTIMONI-->
 
  
<!--VIDEO--->
<?php 
	$youtubeID = end(explode("=",$video->youtubeID));
?>
<div class="video-wrap-box">
 <div class="w-title"><img src="images/icon-video.png"><span data-title="VIDEO"></span></div>
 <div class="clearfix new"></div>
 <div class="vid youtube_check embed-responsive embed-responsive-4by3">
  <iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?=$youtubeID;?>?modestbranding=1&autohide=1&showinfo=0&controls=0" allowfullscreen=""></iframe>
  </div>

<div class="video-description-title"><?=$video->title;?></div>
<div class="video-description"><?=$video->desc;?></div>

 </div>
 

 <!--VIDEO--->
 
 <!--NEWS--->

  <div class="news-wrap-box">
 <div class="w-title"><img src="images/icon-news.png"><span data-title="NEWS"></span></div>
 <div class="clearfix new"></div>
 
<div class="col-md-12 go-right p0 m0">
          <?php if(!empty($allposts['all'])){
            foreach($allposts['all'] as $k=>$post):
             $bloglib->set_id($post->post_id);
            $bloglib->post_short_details();
             ?>
          <div class="col-md-4 go-right minp10">
            <div class="row">
              <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><img src="<?php echo pt_post_thumbnail($post->post_id); ?>" alt="<?php echo $bloglib->title;?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="ctn">
            <a href="<?php echo base_url().'blog/'.$post->post_slug;?>">
              <h3 class="go-right RTL mtb0"><?php echo $bloglib->title;?></h3>
            </a>
            <div class="post_info">
              <div class="post-left go-left">
                <ul class="go-left">
                  <li><i class="icon-calendar-empty"></i><?php echo trans('0480');?> <span class=""><?php echo $bloglib->date; ?></span></li>
                </ul>
              </div>
            </div>
            <!--p class="RTL"> <?php echo character_limiter(strip_tags($bloglib->desc), 110);?> <a href="<?php echo base_url().'blog/'.$post->post_slug;?>">[more]</a></p-->
         </div>
          <div class="clearfix"></div>
          <hr>
          <?php endforeach; }else{ echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
    </div>
</div>
 
 
 <!--NEWS--->
  </div>