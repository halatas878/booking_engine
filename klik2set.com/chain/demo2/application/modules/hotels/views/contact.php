<h1 class="title"><i class="fa fa-phone-square"></i> Contact</h1>
<div class="container">
    <div class="row">
	 	<div class="panel panel-default">
	 		<div class="panel-body">
	 			<form action="" method="post">
					<div class="row form-group">
			            <label class="col-md-2 control-label text-left">Hotel's Email</label>
			            <div class="col-md-4">
			              <input name="hotelemail" placeholder="Email" class="form-control " value="<?=$contact->hotel_email;?>" type="text">
			            </div>
			          </div>
			          <div class="row form-group">
			            <label class="col-md-2 control-label text-left">Hotel's Website</label>
			            <div class="col-md-4">
			              <input name="hotelwebsite" placeholder="Website" class="form-control " value="<?=$contact->hotel_website;?>" type="text">
			            </div>
			          </div>
			          <div class="row form-group">
			            <label class="col-md-2 control-label text-left">Phone</label>
			            <div class="col-md-4">
			              <input name="hotelphone" placeholder="Phone" class="form-control" value="<?=$contact->hotel_phone;?>" type="text">
			            </div>
			          </div>
			          <div class="row form-group">
			            <label class="col-md-2 control-label text-left">Full Address</label>
			            <div class="col-md-6">
			              <input name="hoteladdress" placeholder="Address" class="form-control" value="<?=$contact->hotel_map_address;?>" type="text">
			            </div>
			          </div>
		          	<div class="panel-footer">
						<button class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>