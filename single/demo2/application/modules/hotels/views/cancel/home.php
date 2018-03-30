<h1 class="title"><i class="fa fa-info-circle"></i> Cancellations Policy</h1>
<div class="panel panel-default">
 	 <div class="panel-body">
 	 	<?php if(isset($_GET['edit'])):?>
 	 	<h2 class="head">Manage Role</h2>
 	 	<form class="form-horizontal" method="post" action="">
 	 		<?php
 	 		if(isset($_GET['data'])) echo '<input type="hidden" name="cancellation_id" value="'.$_GET['data'].'"/>';
 	 		?>
	 		<div class="form-group m0">
			    <label for="inputPassword3" class="col-sm-2 control-label">Title</label>
			    <div class="col-sm-6">
			     	<input type="text" name="title" class="form-control" value="<?=isset($lists[0]->title)?$lists[0]->title:'';?>"/>
			    </div>
			  </div>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Policy Period</label>
			    <div class="col-sm-6">	
			    	<span class="labe">From</span>
			        <input type="text" placeholder="From" name="fromdate" class="form-control input-sm dpd1" value="<?=isset($lists[0]->start_date)?date("m/d/Y",strtotime($lists[0]->start_date)):date("d/m/Y");?>" style="width: 100px; display: inline-block;"/>
			    	<span class="labe">To</span>
			        <input type="text" placeholder="To" name="todate" class="form-control input-sm dpd2" value="<?=isset($lists[0]->end_date)?date("d/m/Y",strtotime($lists[0]->end_date)):date('d/m/Y');?>" style="width: 100px; display: inline-block;"/>
			    </div>
			  </div>			  
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Role</label>
			    <div class="col-sm-6">
				  <textarea class="form-control" name="policy" ><?=$lists[0]->description;?></textarea>
			    </div>
			  </div>
				
			  <div class="panel-footer">
			    <a href="<?=base_url().$this->uri->segment(1)?>/hotels/cancelations" class="btn btn-danger canceladd">Cancel</a><button type="submit" class="btn btn-success">Save</button>
			  </div>
			</form>
			<?php else: ?>

	  <h2 class="head">Cancellation Policy Lists</h2>
	  <a href="<?=base_url().$this->uri->segment(1)?>/hotels/cancelations?edit" class="btn btn-success addnew" title="Add New">+Add New</a>
	  <table class="xcrud-list table table-striped table-hover">
		    <thead>
			    <tr>
			  		<th>Period</th>
			    	<th>Title</th>
			    	<th>Roles</th>
			    	<th>Action</th>
		    	</tr>
		    </thead>
		    <?php 
		    if(count($lists>0)) foreach ($lists as $key => $value):
		    ?>
		    <tbody>
		    	<tr id="tr_<?=$value->id;?>">
			    	<td><?=date('d-m-Y',strtotime($value->start_date))." to ".date('d-m-Y',strtotime($value->end_date));?></td>
			    	<td><?=$value->title;?></td>
			    	<td><?=$value->description;?></td>
			    	<td ><span class="btn-group"><a class="btn btn-default btn-xcrud btn btn-warning" href="<?=$_SERVER['REQUEST_URI'];?>?edit&data=<?=$value->id;?>" title="Edit" target="_self"><i class="fa fa-edit"></i></a></span>
			    		<span class="btn-group btn btn-danger delete" id="<?=$value->id;?>" ><i class="fa fa-trash-o"></i></span>
			    	</td>
			    </tr>	
		    </tbody>
		    <?php endforeach;?>
		  </table>
	  	<?php endif;?>
	</div>
    <div class="clearfix"></div>  
   </div>
 </div> 
 <script>
	$(".delete").click(function(){
      var id =  $(this).attr('id');
      $.alert.open('confirm', 'Are you sure you want to delete', function(answer) {
         if (answer == 'yes'){
            $.post("<?=base_url().$this->uri->segment(1);?>/hotelajaxcalls/deleteCancel", { id: id }, function(theResponse){
            $("#tr_"+id).fadeOut('slow');
         });
       }
        });
    });
</script>