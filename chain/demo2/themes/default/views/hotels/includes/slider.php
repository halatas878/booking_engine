<div class="col-md-7 go-right">
<div class="fotorama bg-dark" data-allowfullscreen="true" data-width="100%"
     data-ratio="4/2.7" data-nav="thumbs">
<?php foreach($hotel->sliderImages as $img){ ?>
<img src="<?php echo $img['fullImage']; ?>"/>
<?php } ?>
</div>
<div class="visible-xs visible-sm"><div style="margin-top:25px"></div></div>
</div>


