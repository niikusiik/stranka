<?php 
include '../../assets/header.php';

		/*$oblast=glob("*",GLOB_ONLYDIR);
		for ($i=0; $i < count($oblast); $i++) { 
			$menuGaleria[]=file_get_contents($oblast[$i].'/'.basename($oblast[$i]).'.txt');
		}
		$gal=key($menuGaleria);
		$nadpis= file_get_contents($gal.'/header.txt');
		$text=file_get_contents($gal.'/description.txt');
		$thumb=$gal.'/thumb.jpg';*/
?>





<section id="obsah">
<div class="container">
	<div class="row pt-5">
		<div class="col-2">
			<nav class="nav flex-column nav-pills nav-fill">
				<?php 
				
				
	foreach (glob('../galeria/*') as   $value) {
				if($value == '../galeria/index.php'){
				
				}
				else

			$menuGaleria[basename($value)] =file_get_contents($value . '/'. basename($value) . '.txt');
			
				if (isset($_GET['gal'])) {
					$gal = $_GET['gal'];
				}
				else $gal = key($menuGaleria);
			}
		
				 ?>
				 	<?php 	

				 		foreach ($menuGaleria as $adresar => $nazov) {
				 			
				 		
				 	 ?>
				
					
					<?php 

					if ($adresar == $gal) {
						echo '<a href="?gal='.$adresar.'"class="nav-link active ">
					 '.$nazov.'</a>';
					} else {
						
						echo '<a href="?gal='.$adresar.'"class="nav-link ">
					 '.$nazov.'</a>';
					
					}
					

					 ?>


				<?php 	} ?>
			
			</nav>

		</div>
<div class="col-10">


<?php 

$nadpis = file_get_contents('../galeria/'.$gal.'/header.txt');

$text = file_get_contents('../galeria/'.$gal.'/description.txt');
$thumb = '../galeria/'.$gal.'/thumb.jpg';
$fotky = glob('../galeria/'.$gal.'/*_zmensena.jpg');
 ?>




<h2 class="py-3 font-weight-bold font-italic "> <?php echo $nadpis; ?></h2>
	<div class="container">
		<div class="row">
			<div class="col-md-5 font-weight-bold font-italic">  <?php echo $text; ?></div>
			<div class="col-md-5 "> <img  src="<?php echo $thumb; ?>" alt=""  class = "w-75 rounded-circle " ></div>
		</div>
	</div>
	 <div class="container">
	 	<div class="row">
	 		 	<?php 	 	 
	 	foreach ($fotky as $fotka) {
	 	echo '<img  src="'.$fotka.'" alt=""  class = "p-1 w-25 p-2 border-primary">';	
	 }
 
	  ?>

	 	</div>
	 </div>
	
 

	
	
	


	 
	
</div>

	 </div>
</div>
</section>
<?php
include '../../assets/footer.php';
?>
