<?php
class Tours_uploads_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('misc_model');
        $this->load->model('tours/tours_model');


    }

  
 
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