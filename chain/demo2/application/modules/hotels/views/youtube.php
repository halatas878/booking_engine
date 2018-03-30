<h1 class="title"><i class="fa fa-youtube"></i> YOUTUBE</h1>
<div class="container">
    <div class="row">
	 	<div class="panel panel-default">
	 		<div class="panel-body">
	 			<form action="" method="post">
	 				<?php if(count($lists)>0){
	 					echo '<input type="hidden" name="update" value="true"/>';
	 				}?>
	 				<div class="row form-group">
						<label class="col-md-2 control-label text-left">Title</label>
						<div class="col-md-8">
							<input class="form-control" placeholder="Input Title here" name="title"  type="text" required="" value="<?=$lists[0]->title;?>">	
						</div>
					</div>
					
					<div class="row form-group">
						<label class="col-md-2 control-label text-left">Description</label>
						<div class="col-md-8">
							<textarea class="form-control" rows="4" placeholder="" name="desc" required><?=$lists[0]->desc;?></textarea>
						</div>
					</div>
						
		 			<div class="row form-group">
						<label class="col-md-2 control-label text-left">Youtube Url</label>
						<div class="col-md-8">
							<div class="input-group">
									<input class="form-control youtubesubmit" placeholder="Youtube Url" required  name="youtubeID"  type="text" value="<?=$lists[0]->youtubeID;?>">
									<span class="input-group-btn">
										<button type="button" class="btn btn-red" onclick="checkYoutube();">
											<i class="fa fa-youtube-play"></i>
											Check Youtube Url
										</button> </span>
								</div>
								<span class="help-block" style="display: block"><i class="fa fa-info-circle"></i> Ex. : https://www.youtube.com/watch?v=L8eRzOYhLuw</span>
						</div>
					</div>
					
				<style>.thumbnail{background-color:#000;border-color: #000;}</style>
				<label class="col-md-2 control-label text-left">&nbsp;</label>
				<div class=" col-md-6" style="background: #000">
					<div class="youtube_check embed-responsive embed-responsive-4by3"  style="display:none">\
					</div>
					<a href="javascript:void(0)" class="thumbnail">
				      <img src="http://img.youtube.com/vi/<?=$lists[0]->thumb;?>/0.jpg" alt="<?=$lists[0]->title;?>">
				    </a>
				</div>
			</div>
			<div class="panel-footer">
				<input name="globalsettings" value="1" type="hidden">
				<button class="btn btn-primary">Submit</button>
			</div>
		</div>
		</form>
	</div>
</div>



<script>
function checkYoutube() {
  $('.youtube_check').find('iframe').remove();
  $('a.thumbnail').hide();
  var url = $('input.youtubesubmit').val().split("=");
  var box = $('.youtube_check');
  var iframe = $('<iframe/>').attr({
    "class": "embed-responsive-item",
    "src": "http://www.youtube.com/embed/" + url[1] + "?autoplay=1"
  }).appendTo(box);
  box.show();
}
</script>