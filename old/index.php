<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>test</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen, print">
	</head>
	<body> 
		<?php
			require_once 'simple_html_dom.php';
 			
 			$html = new simple_html_dom();
 			//https://fr.wikipedia.org/w/index.php?title=   <titre_de_l'article>   &printable=yes'
			$html->load_file('https://fr.wikipedia.org/w/index.php?title=Logiciel_libre&printable=yes');
			
			$contenu = $html->find('body', 0);
			
			$removeById = $contenu->getElementById('jump-to-nav');
			$removeById->outertext = '';
			$contenu = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $contenu);
			
			//$removeStyle = $contenu->find('div.thumbinner');
			//$removeStyle->removeAttribute('style');
			
			echo $contenu;
		?>
	</body>
</html>