<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>WikiPapier</title>
		<style>
			.wrap				{ margin-top: 30px; margin-left: 30px; line-height: 110%;}
			p 					{  }
			.mono				{ font-family: monospace; font-size: 95%;}
			span				{ width: 20px; text-align:right; }
			.forms				{ width: 200px; text-align: right; margin-top: 4px; };
			input[type="text"]	{ width:200px; }
		</style>
	</head>
	<body> 
		<div class="wrap">
			<h1>
				WikiPapier
			</h1>
			<br/>
			</p>
			<form action="result.php" method="post">
				<p>
				    <?php
				    	$nb = $_POST['choix'];
				    	$nb = preg_replace('#choix#', '$1', $nb);
				    	echo 'Entrez les urls des ' .$nb. ' articles&thinsp;: <br/><br/>';
						echo '<div class="forms">';
						for ($i=1 ; $i <= $nb ; $i++){
							echo '<p class="mono">' .$i. '&thinsp;: <input type="text" name="url' .$i. '" placeholder="https://fr.wikipedia.org/wiki/Nom_de-larticle" required /></p>';
						}
						echo '<br/><p class="mono"><input type="submit" value="ok" /></p>';
						echo '</div>';
						
						$file = 'temp.txt';
						file_put_contents($file, $nb);
					?>
				</p>
			</form>	
		</div>

		<!-- JAVASCRIPT -->
	    <script type="text/javascript" src="less-1.3.0.min.js"></script>
	</body>
</html>