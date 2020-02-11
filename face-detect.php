
<?php

   $hata = "";  
   $path = "";
   $sayac=0;
   
   if(isset($_POST['hidden_value']) && $_POST['hidden_value']=="true"){
   
	   if(isset($_FILES['dosya'])){
	   
			$boyut = $_FILES['dosya']['size'];
			if($boyut > (1024*1024*5)){
			   $hata = 'Dosya 5MB den büyük olamaz.';
			}else {
				$tip = $_FILES['dosya']['type'];
				$isim = $_FILES['dosya']['name'];
				$uzanti = explode('.', $isim);
				$uzanti = $uzanti[count($uzanti)-1];
				if( $uzanti == 'JPG' || $uzanti == 'jpg') { 
				 
					$dosya = $_FILES['dosya']['tmp_name'];
					$isim_directory = explode(".", $isim);
					
					$tarih = date("d.m.y");
					if (!file_exists('uploads/'.$tarih)) {
						mkdir('uploads/'.$tarih, '0655');
					}
					if (!file_exists('uploads/'.$tarih.'/'.$isim_directory[0])) {
						mkdir('uploads/'.$tarih.'/'.$isim_directory[0], '0655');
					}									
					$path = 'uploads/'.$tarih.'/'.$isim_directory[0].'/';
					copy($dosya, $path."0.jpg" );      
					echo shell_exec('webFaceDetection.exe '.$path.'0.jpg'.' '.$path); 
					
					/**  ekranda göster **/		
					if ($handle = opendir($path)) {
						while (false !== ($entry = readdir($handle))) {
							if ($entry != "." && $entry != ".."){
								//echo $dir.$entry."</br>";	
								$sayac++;
							}
						}
						closedir($handle);						
					}else {
						header("Location: index.html");
					}		
					
				}else{
					$hata = 'Resminiz JPG uzantılı olmalıdır.';
				} 
			}//end of else
			
	   }else {
			header("Location: index.html");
		} 
	}else {
		header("Location: index.html");
	} 	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Face Detection with OpenCV</title>
		<link rel="stylesheet" href="assets/style.css" />
		<script src="assets/jquery.js"></script>
	</head>
	
	<body>	
		<div id="container">
		
			<div class="row">
				<div id="header">
					<div class="box1">
						<a href="index.html" class="link1">Tekrar Deneyin</a>
					</div>	
					
					<?php
						if($hata != "") {
							echo "<h1>".$hata."</h1>";						
						}else {
							if($sayac==1){
								echo "<h1>Hiç Yüz Bulunamadı :(</h1>";
							}else {
								echo "<h1>Tespit Edilen Yüzler</h1>";
							}	
						}
					?>
				</div>
			</div>
			
			<div class="row">
				<?php
					if($hata == "") {
						if($sayac==1){
							echo '<img id="img1" src="'.$path."0.jpg".'">';
						}else {
							echo '<img id="img1" src="'.$path."face-0.jpg".'">';
						}				
					}					
				?>
			</div>
			
			<div class="row">
				<div id="kucuk-box">
					<?php
						if($hata == "") {
							if($sayac==1){
								// fotograf bulunamamis demektir.
							}else {
								for($i=1; $i<$sayac-1; $i++){
									echo '<img class="img2" src="'.$path.'face-'.$i.'.jpg'.'">';
								}
							}	
						}
					?>			
				</div>
			</div>
		</div>		
	</body>

</html>
