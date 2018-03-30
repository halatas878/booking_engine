<style>
.add_button {
    margin-top: 115px !important;
}
</style>
<div class="panel panel-default">
  <h1 class="title"><i class="fa fa-newspaper-o"></i> <?php echo $header_title; ?></h1>
  <?php if(@$addpermission){ ?>
   <form class="add_button" action="<?php echo $add_link; ?>" method="post"><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Send Newsletter</button></form>
  <?php } ?>
   <div class="panel-body">
     <?php echo $content; ?>
   </div>
 </div>