<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/home.css" />
    <?php require $themeurl.'views/home/slider.php';?>
			<div class="container">
               <br><br>
				<div class="row">
                     <?php include $themeurl.'views/hotels/homepage.php'; ?>
                     <?php include $themeurl.'views/integrations/ean/homepage.php'; ?>
                     <?php include $themeurl.'views/tours/homepage.php'; ?>
                     <?php include $themeurl.'views/cars/homepage.php'; ?>
				</div>
			</div>
     <?php include $themeurl.'views/offers/homepage.php'; ?>
  </div>