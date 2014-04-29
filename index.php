<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>WikiPapier</title>
		<style>
			.wrap	{ margin-top: 30px; margin-left: 30px; }
			p 		{ margin-left:-15px; }
		</style>
	</head>
	<body> 
		<div class="wrap">
			<h1>
				WikiPapier
			</h1>
			</p>
			<form action="intermediaire.php" method="post" enctype="multipart/form-data">
				<p>
				    Choisissez le nombre d'article :<br/><br/>
				    <select name="choix">
				    <?php
				    
				    	// Debug
						ini_set('display_errors','1');

				    
						for ($i=1 ; $i <=50 ; $i++){
					    	echo '<option value="choix' .$i. '">' .$i. '</option>';
						}
					?>
					</select>
					<input type="submit" value="ok" />
				</p>
			</form>	
		</div>

		<!-- JAVASCRIPT -->
	    <script type="text/javascript" src="less-1.3.0.min.js"></script>
	</body>
</html>