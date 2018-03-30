<?php session_start();

if(empty($_POST['step2']) && empty($_SESSION['step2'])){
header("Location: 1.php");

}else{
 $_SESSION['step2'] = 2;
}
$version = explode('.', PHP_VERSION);

$yes ="<button class='btn btn-success btn-block btn-sm'>&#10004</button>";
$no ="<button class='btn btn-danger btn-block btn-sm'> &#10006;</button>";
?>
<?php include 'header.php'; ?>
<?php $G2 = 'active bold'; ?>

<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    vertical-align: middle !important;
}
</style>

      <div class="col-sm-12">
       <?php include 'side-bar.php'; ?>

        <div class="col-sm-9">

          <table class="table table-striped table-responsive table-bordered">
           <thead style="font-weight:bold">
           <tr>
           <td>Addon</td>
           <td class="text-center">Requirement</td>
           <td class="text-center">Status</td>
           </tr>
           </thead>
          <tbody>
          <tr>
          <td>PHP</td>
          <td class="text-center">5.4</td>
          <td class="text-center"><?php if($version[1] < 4){ echo $no; }else{ echo $yes;} ?></td>
          </tr>

          <tr>
          <td>MySQLi</td>
          <td class="text-center"></td>
          <td class="text-center"><?php if (function_exists('mysqli_connect')) { echo $yes; }else{ echo $no;} ?></td>
          </tr>



          <tr>
          <td>CURL</td>
          <td class="text-center"></td>
          <td class="text-center"><?php if(in_array('curl', get_loaded_extensions())){ echo $yes; }else{ echo $no;}?></td>
          </tr>

          <tr>
          <td>Uploads Folder</td>
          <td class="text-center">writable</td>
          <td class="text-center"><?php if(is_writable('../uploads')){echo $yes;}else{ echo $no; } ?></td>
          </tr>

             <tr>
          <td>Database File (database.php)</td>
          <td class="text-center">writable</td>
          <td class="text-center"><?php if(is_writable('../database.php')){echo $yes;}else{ echo $no; } ?></td>
          </tr>

           <tr>
          <td>Max File Upload Size (<?php echo $maxUpload = (int)(ini_get('upload_max_filesize')); ?>M)</td>
          <td class="text-center"> >= 2M</td>
          <td class="text-center"><?php if($maxUpload >= 2){echo $yes;}else{ echo $no; } ?></td>
          </tr>

          <tr>
          <td>Max Post Size (<?php echo $maxPost = (int)(ini_get('post_max_size')); ?>M)</td>
          <td class="text-center"> >= 8M</td>
          <td class="text-center"><?php if($maxPost >= 8){echo $yes;}else{ echo $no; } ?></td>
          </tr>

          </tbody>
          </table>

          <p class"text-danger"><strong>Note :</strong> if any error occurs please check your MySql servers <strong>( max_allowed_packet )</strong> it should be <strong>6M</strong> atleast.</p>
                   <div class="form-group">
                   <p> Great! Next, let's make sure your server has everything it needs to support PHPTRAVELS. If any of the requirements are marked  with alert, you will need to fix them before continuing. if items are marked with <button class="btn btn-success btn-xs">&#10004</button> please click on next.</p>
                   </div>

        </div>




        </div>
           </div>
          <div class="clearfix"></div>
         <div class="modal-footer">

         <?php $value ="20"; ?>
        <?php include 'progress.php' ?>

             <form action="3.php" method="POST">
              <a href="1.php"><button type="button" class="btn btn-default">Back</button></a>
         <input type="hidden" name="step3" value="3" />
      <button type="submit" class="btn btn-primary">Next</button>
         </form>

     </div>
    </div>
   </div>
  </body>
</html>



<!-- fade starts -->
    <script>
    var speed = 'slow';
    $('html, body').hide();
    $(document).ready(function() {
    $('html, body').fadeIn(speed, function() {
    $('a[href], button[href]').click(function(event) {
    if(!$(this).hasClass('target')){
    var url = $(this).attr('href');
    if (url.indexOf('#') == 0 || url.indexOf('javascript:') == 0) return;
    event.preventDefault();
    $('html, body').fadeOut(speed, function() {
    window.location = url;
    }); } }); }); });
    </script>
    <!-- fade ends -->