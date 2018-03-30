<?php
class Cars_uploads_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('misc_model');
        $this->load->model('admin/countries_model');
        $this->load->model('admin/accounts_model');
        $this->load->model('cars/cars_model');


    }

   // get file extension
 function __getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;

 }


     // upload car default image

	function __car_default($id = null)
	{

		$m = '';
		$fig = rand(1, 999999);
		$uploadedfile = $_FILES['defaultphoto']['tmp_name'];
		$filename = $_FILES['defaultphoto']['name'];
		$allowed = array("jpg", "jpeg","png","gif");
		list($width,$height)= getimagesize($uploadedfile);
		$extension = $this->__getExtension($filename);
 		$extension = strtolower($extension);
		$size = $_FILES['defaultphoto']['size']/1024;  // converted to KB
		$imgsize = round($size,2);
		if(!in_array($extension, $allowed))//if 1
		{
		$m = "<font color='red'>Invalid file type kindly select only jpg/jpeg, png, gif file types.</font>";
       // $m = "1";
		//end if 1
		}else{
		//else for if 1
		if($imgsize > MAX_IMAGE_UPLOAD) //if 2
		{

	    $uperror = round(MAX_IMAGE_UPLOAD/1024,2);
		$m = "<font color='red'> Only upto ".$uperror."MB size photos allowed.</font>";
        //$m = "2";
		}else{

		$filename = str_replace(" ","-",$filename);
		if(strlen($filename) > 15)
		{

		$filename = substr($filename,0,10);

		}
		$filename = $filename.".".$extension;
		if($extension == "jpg" || $extension == "jpeg")
		{
		$src = imagecreatefromjpeg($uploadedfile);

		}elseif($extension == "png"){

		$src = imagecreatefrompng($uploadedfile);

		}elseif($extension == "gif"){

		$src = imagecreatefromgif($uploadedfile);

		}


		if($width > 250){
		$newwidth1 = 250;
		}else{
		$newwidth1 = $width;
		}
		if($height > 150){
		$newheight1 = 150;

		}else{
		$newheight1 = $height;

		}

		$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
        imagealphablending($tmp1, false);
		imagesavealpha($tmp1, true);

		imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);


		$savefile = PT_CARS_MAIN_THUMB_UPLOAD.$fig.$filename;

	   	if($extension == "jpg" || $extension == "jpeg")
		{
		imagejpeg($tmp1,$savefile,100);
		}elseif($extension == "png"){
		imagepng($tmp1,$savefile);
		}elseif($extension == "gif"){
		imagegif($tmp1,$savefile);
		}

		imagedestroy($src);
		imagedestroy($tmp1);
		$filename_db = $fig.$filename;

       if(!empty($id)){
        $this->cars_model->update_car($id);
        $this->cars_model->update_car_image('default',$filename_db,$id);
         $oldimg = $this->input->post('oldimg');
         if(!empty($oldimg)){

         @unlink(PT_CARS_MAIN_THUMB_UPLOAD.$oldimg);

         }
        $m = "done";

       }else{

        $carid = $this->cars_model->add_car();
        $this->cars_model->add_car_image('default',$filename_db,$carid);

        $m = "done";


       }


       }

		}



		return $m;
	}


	/*end __car_default() */


   // upload car Images

	function __car_images()
	{


	$imgtype = $this->input->post('imagetype');
	$carid = $this->input->post('carid');

		foreach($_FILES['files']['tmp_name'] as $key => $tmp_name){
		$fig = rand(1, 999999);
		$uploadedfile = $_FILES['files']['tmp_name'][$key];
		$filename = $_FILES['files']['name'][$key];
		$allowed = array("jpg", "jpeg","png","gif");
		list($width,$height)= getimagesize($uploadedfile);
		$extension = $this->__getExtension($filename);
 		$extension = strtolower($extension);
        $orignalsize =  $_FILES['files']['size'][$key];
		$size = $_FILES['files']['size'][$key]/1024;  // converted to KB
		$imgsize = round($size,2);

		//else for if 1
		if($imgsize > 2050) //if 2
		{
		     $js = array( "files" => array(
    array("error" => "size must be less than 2 MB")

    )

    );
        return json_encode($js);


		}else{

		$filename = str_replace(" ","-",$filename);
		if(strlen($filename) > 15)
		{

		$filename = substr($filename,0,10);

		}
		$filename = $filename.".".$extension;
		if($extension == "jpg" || $extension == "jpeg")
		{
		$src = imagecreatefromjpeg($uploadedfile);

		}elseif($extension == "png"){

		$src = imagecreatefrompng($uploadedfile);

		}elseif($extension == "gif"){

		$src = imagecreatefromgif($uploadedfile);

		}

    	if($width > 720){
		$newwidth1 = 720;
		}else{
		$newwidth1 = $width;
		}
		if($height > 480){
		$newheight1 = 480;

		}else{
		$newheight1 = $height;

		}


		$tmp=imagecreatetruecolor($newwidth1,$newheight1);



		$tmp1=imagecreatetruecolor($width,$height);

		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
		imagecopyresampled($tmp1,$src,0,0,0,0,$width,$height,$width,$height);


        if($imgtype == "slider"){
         $savethumb = PT_CARS_SLIDER_THUMB_UPLOAD.$fig.$filename;
		$savefile = PT_CARS_SLIDER_UPLOAD.$fig.$filename;

        }elseif($imgtype == "interior"){
         $savethumb = PT_CARS_INTERIOR_THUMB_UPLOAD.$fig.$filename;
		$savefile = PT_CARS_INTERIOR_UPLOAD.$fig.$filename;

        }elseif($imgtype == "exterior"){
         $savethumb = PT_CARS_EXTERIOR_THUMB_UPLOAD.$fig.$filename;
		$savefile = PT_CARS_EXTERIOR_UPLOAD.$fig.$filename;

        }


  if($extension == "gif"){

     imagegif($tmp,$savethumb);
		imagegif($tmp1,$savefile);

}elseif($extension == "jpg" || $extension == "jpeg"){

      imagejpeg($tmp,$savethumb,100);
		imagejpeg($tmp1,$savefile,100);

}elseif($extension == "png"){

   imagepng($tmp,$savethumb);
   imagepng($tmp1,$savefile);

}

      // Applying Watermark
        $wmdata = $this->settings_model->get_watermark_data();

        if($wmdata[0]->wm_status == '1'){
          if($wmdata[0]->wm_type == "img"){
            $watermark_imgpath = PT_GLOBAL_IMAGES_FOLDER.$wmdata[0]->wm_image;
$this->image_watermark($savefile,$savefile,$watermark_imgpath,$wmdata[0]->wm_position);

          }else{

 $this->text_watermark($savefile, $savefile,$wmdata[0]->wm_font_color,$wmdata[0]->wm_font_size,$wmdata[0]->wm_text);

          }


        }else{

        }

          // end Applying Watermark

		imagedestroy($src);
		imagedestroy($tmp);
		imagedestroy($tmp1);

         $this->cars_model->add_car_image($imgtype,$fig.$filename,$carid);

             if($imgtype == "slider"){

         $thumburl = PT_CARS_SLIDER_THUMB.$fig.$filename;
           $imgurls = PT_CARS_SLIDER.$fig.$filename;
           $delimg = base_url()."cars/carsback/deleteimg/".$fig.$filename."/".$imgtype;


           }

   $js = array( "files" => array(
    array("thumbnailUrl" => $thumburl, "name" => $fig.$filename, "size" => $orignalsize, "url" => $imgurls, "deleteUrl" => $delimg, "deleteType" => "DELETE"  )

    )

    );
      return json_encode($js);

        }




       }




    }


	/*end __car_images() */

     // Upload car videos
    function __car_videos(){


    	$carid = $this->input->post('carid');


    foreach($_FILES['files']['tmp_name'] as $key => $tmp_name){
		$fig = rand(1, 999999);
		$uploadedfile = $_FILES['files']['tmp_name'][$key];
		$filename = $_FILES['files']['name'][$key];

		$extension = $this->__getExtension($filename);
 		$extension = strtolower($extension);
        $orignalsize =  $_FILES['files']['size'][$key];



		$filename = str_replace(" ","-",$filename);
		if(strlen($filename) > 15)
		{

		$filename = substr($filename,0,10);

		}
		$filename = $filename.".".$extension;

          move_uploaded_file($uploadedfile, PT_CARS_VIDEOS_UPLOAD.$fig.$filename);

           $this->cars_model->add_video_link($fig.$filename,$carid,'uploads');

           $thumburl = PT_CARS_VIDEOS.$fig.$filename;
           $vidurls = PT_CARS_VIDEOS.$fig.$filename;
           $delimg = base_url()."cars/carsback/deletevids/".$fig.$filename;

   $js = array( "files" => array(
    array("thumbnailUrl" => $thumburl, "name" => $fig.$filename, "size" => $orignalsize, "url" => $vidurls, "deleteUrl" => $delimg, "deleteType" => "DELETE"  )

    )

    );
      return json_encode($js);






       }



    }
    // car upload videos


/************* Watermark functions *******************/
/****************************************************/


// watermark text only

function text_watermark($oldimage_name, $new_image_name,$hex,$font_size,$water_mark_text)
{

$font_path = "assets/fonts/watermark/arial.ttf"; // Font file


list($width,$height) = getimagesize($oldimage_name);
//$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

   $x = imagesx($image);
    $y = imagesy($image);

   $dx = 10;
   $dy = $y - 20;


$filetype = substr($oldimage_name,strlen($oldimage_name)-4,4);
$filetype = strtolower($filetype);
if($filetype == ".gif") $image_src = @imagecreatefromgif($oldimage_name);
if($filetype == ".jpg") $image_src = @imagecreatefromjpeg($oldimage_name);
if($filetype == ".png") $image_src = @imagecreatefrompng($oldimage_name);
if (!$image) die();



imagecopyresampled($image, $image_src, 0, 0, 0, 0, $width, $height, $width, $height);

  $a = hexdec(substr($hex,0,2));
  $b = hexdec(substr($hex,2,2));
  $c = hexdec(substr($hex,4,2));
   $txtcolor = imagecolorallocate($image, $a, $b, $c);



imagettftext($image, $font_size, 0, $dx, $dy, $txtcolor, $font_path, $water_mark_text);

if($filetype == ".gif"){
  imagegif($image,$new_image_name);

}elseif($filetype == ".jpg"){
 imagejpeg($image, $new_image_name, 100);

}elseif($filetype == ".png"){

   imagepng($image,$new_image_name);

}




imagedestroy($image);
imagedestroy($image_src);

return true;


}





// image water mark

function image_watermark($source_file_path,$output_file_path,$watermark_imgpath,$p){

/* $source_file_path ="uploads/img.png";
 $output_file_path ="uploads/img.png";
*/
list($source_width, $source_height, $source_type) = getimagesize($source_file_path);
 if ($source_type === NULL) {
 return false;
 }
 switch ($source_type) {
 case IMAGETYPE_GIF:
 $source_gd_image = imagecreatefromgif($source_file_path);
 break;
 case IMAGETYPE_JPEG:
 $source_gd_image = imagecreatefromjpeg($source_file_path);
 break;
 case IMAGETYPE_PNG:
 $source_gd_image = imagecreatefrompng($source_file_path);
 break;
 default:
 return false;
 }
 $overlay_gd_image = imagecreatefrompng($watermark_imgpath);


 //getting the image size for the original image
$img_w = imagesx($source_gd_image);
$img_h = imagesy($source_gd_image);


 $w_w = imagesx($overlay_gd_image);
 $w_h = imagesy($overlay_gd_image);




if($p == "tl") {
    $dest_x = 20;
    $dest_y = 10;
} elseif ($p == "tc") {
    $dest_x = ($img_w - $w_w)/2;
    $dest_y = 10;
} elseif ($p == "tr") {
    $dest_x = $img_w - $w_w;
    $dest_y = 10;
} elseif ($p == "cl") {
    $dest_x = 0;
    $dest_y = ($img_h - $w_h)/2;
} elseif ($p == "c") {
    $dest_x = ($img_w - $w_w)/2;
    $dest_y = ($img_h - $w_h)/2;
} elseif ($p == "cr") {
    $dest_x = $img_w - $w_w;
    $dest_y = ($img_h - $w_h)/2;
} elseif ($p == "bl") {
    $dest_x = 20;
    $dest_y = $img_h - $w_h - 20;
} elseif ($p == "bc") {
    $dest_x = ($img_w - $w_w)/2;
    $dest_y = $img_h - $w_h - 20;
} elseif ($p == "br") {
    $dest_x = $img_w - $w_w - 20;
    $dest_y = $img_h - $w_h - 20;
}

 imagecopy($source_gd_image, $overlay_gd_image, $dest_x, $dest_y, 0, 0, $w_w, $w_h);


 imagepng($source_gd_image, $output_file_path);
 imagedestroy($source_gd_image);
 imagedestroy($overlay_gd_image);


  }


/************* End Watermark functions *******************/
/****************************************************/


}