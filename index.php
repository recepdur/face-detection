<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Face Detection with OpenCV</title>
		<link rel="stylesheet" href="assets/style.css" />
	</head>
	<body>

		<div id="container">

			<div class="row">
				<div id="header">
					<h1>Yüz Bulma (Face Detection)</h1>
				</div>
			</div>
			
			<div class="row">
				<div id="dropbox">
					<form id="form-upload" action="face-detect.php" method="post" enctype="multipart/form-data">
						</br></br>Fotoğrafınızı sürükleyiniz</br>ya da</br></br>						
						<div class="file-input-wrapper">
							<input type="hidden" name="hidden_value" value="true"/>
							<button class="btn-file-input">Dosya Seçin</button>
							<input id="file-input" type="file" name="dosya" />
						</div>						
					</form>							
				</div>						
			</div>

		</div>


	</body>
	
	<script src="assets/jquery.js"></script>
	<script>
		$('#file-input').change(function(){
			document.getElementById("form-upload").submit();
		});		

	</script>
</html>
