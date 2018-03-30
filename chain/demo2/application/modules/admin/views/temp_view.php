<div class="panel panel-default">
  <?php if(empty($this->uri->segment(2))){
  	?>
  	<h2><?php echo $header_title; ?></h2>
  	<?php
  }else{
  	?>
  <h1 class="title"><i class="fa fa-table"></i> <?php echo str_replace("Management","",$header_title); ?></h1>
  <?php } ?>
  <?php if(@$addpermission && !empty($add_link)){ ?>
   <form class="add_button" action="<?php echo $add_link; ?>" method="post"><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add</button></form>
  <?php } ?>
   <div class="panel-body">
     <?php echo $content; ?>
   </div>
 </div>