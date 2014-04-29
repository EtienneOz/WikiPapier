<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>WikiPapier</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="print, screen" />
	</head>
	<body> 
		<div id="cln">
			<?php
				require_once 'simple_html_dom.php';
				
				// Debug
				ini_set('display_startup_errors', '1');
				ini_set('display_errors','1');
				
				// Débrider la limite de mémoire
				ini_set('memory_limit', '-1');			
				
				$html = new simple_html_dom();
				
				// Récupérer le nombre d'articles
				$nb = file_get_contents('temp.txt');	

				


				// ####################	
				// #### Couverture ####
				// ####################	
				
				echo '<div id="pagebreak">';			
				echo '<h1> WikiPapier<SUP> 0.1</SUP></h1>';			
				echo '<div class="pagebreak">. . .</div><div class="pagebreak">. . .</div>';			
				echo '<div class="pagebreak">. . .</div><div class="pagebreak">. . .</div>';			
				echo '</div>';				


				// ############################	
				// #### Index des articles ####
				// ############################	
				
				echo '<h1> Index des articles </h1><ul id="index">';			
				
				for ($i = 1 ; $i <= $nb ; $i++) {
					$url = [$i => htmlspecialchars($_POST['url'.$i])];
					// Vérifier l'intégrité des urls
					$urlValide  = strpos($url[$i], 'https://fr.wikipedia.org/wiki/');
					$urlValide2 = strpos($url[$i], 'http://fr.wikipedia.org/wiki/');
					if ($urlValide2 !== false){
						$url[$i] = preg_replace('#http:#' , 'https:', $url[$i]);
					}
					
					// Récupération du titre pour l'index
					$titre = [$i => preg_replace('#https://fr.wikipedia.org/wiki/#', '', $url[$i])];
					$titre[$i] = preg_replace('#_#', ' ', $titre[$i]);
					$titre[$i] = preg_replace('#%20#', ' ', $titre[$i]);
					$titre[$i] = preg_replace('#%C3%A9#', 'é', $titre[$i]);
					$titre[$i] = preg_replace('#%28#', '(', $titre[$i]);
					$titre[$i] = preg_replace('#%29#', ')', $titre[$i]);
					$titre[$i] = preg_replace('#%C3%A8#', 'è', $titre[$i]);
					$titre[$i] = preg_replace('#%C5%92#', 'Œ', $titre[$i]);
					echo '<li>'.$titre[$i].' <SUP>' .$url[$i]. '</SUP></li>';
				}
	
				echo '</ul><div class="pagebreak"> --- </div><br/>';



				// #################	
				// #### Contenu ####
				// #################	
								
				for ($i = 1 ; $i <= $nb ; $i++) {
					
					$url = [$i => htmlspecialchars($_POST['url'.$i])];
					// Vérifier l'intégrité des urls
					$urlValide  = strpos($url[$i], 'https://fr.wikipedia.org/wiki/');
					$urlValide2 = strpos($url[$i], 'http://fr.wikipedia.org/wiki/');
					if ($urlValide2 !== false){
						$url[$i] = preg_replace('#http:#' , 'https:', $url[$i]);
					}
					
					// Récupération du titre
					$titre = [$i => preg_replace('#https://fr.wikipedia.org/wiki/#', '', $url[$i])];
					
					if ( $urlValide !== false || $urlValide2 !== false ){
						
						// Récupération du html
						$html 		= file_get_html('https://fr.wikipedia.org/w/index.php?title=' . $titre[$i] . '&printable=yes');
						
						// Récupération du contenu
						$contenu 	= $html -> getElementById('content');
						$titre2 	= $html->find('title', 0);
		
						// Ménage
						$removeById = $contenu->getElementById('jump-to-nav');
						$removeById -> outertext = '';
						$contenu 	= preg_replace('/(<[^>]+) style=".*?"/i', 				'$1', 	$contenu);
						$contenu 	= preg_replace('/(<[^>]+) width=".*?"/i', 				'$1', 	$contenu);
						$contenu 	= preg_replace('/(<[^>]+) height=".*?"/i', 				'$1', 	$contenu);
						$contenu 	= preg_replace('/(<[^>]+) data-file-height=".*?"/i', 	'$1', 	$contenu);
						$contenu 	= preg_replace('/(<[^>]+) data-file-width=".*?"/i', 	'$1', 	$contenu);
		
						// Affichage du résultat
						echo $contenu;		
					}
				}
				
				
				// ##################					
				// #### Colophon ####	
				// ##################	
				
				$today = getdate();
				echo '<div class="pagebreak">. . .</div><div class="pagebreak">. . .</div><div class="pagebreak">. . .</div><div class="pagebreak">. . .</div><h1> Colophon </h1><p> Ce livre a été généré automatiquement en php le ' .$today['mday'].'/'.$today['mon'].'/'.$today['year'].' à ' .$today['hours'].'h'.$today['minutes']. ' à partir d\'une selection d\'articles Wikipédia.</p><p> Wipipapier est un projet d\'Étienne Ozeray réalisé à l\'Erg.</p><p>Projet disponible à l\'adresse&thinsp;: <i>http://etienneozeray.fr/wikipapier</i>.</p><p> Sources disponibles à l\'adresse&thinsp; <i>https://github.com/EtienneOz/WikiPapier</i> .</p><p> Wikipapier est sous licence GNU/GPL (<i>http://www.gnu.org/licenses/gpl.html</i>). Vous avez la liberté de l\'utiliser, le copier, le distribuer et le modifier. <p/> <h2> Code source (au '.$today['mday'].'/'.$today['mon'].'/'.$today['year'].')</h2><div class="pagebreakbefore">. . .</div><br/>';			
			?>
		</div>
		<pre>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
	&lt;head&gt;
		&lt;meta charset="UTF-8" /&gt;
		&lt;title&gt;WikiPapier&lt;/title&gt;
	&lt;link href="style.css" rel="stylesheet" type="text/css" media="print, screen" /&gt;
	&lt;/head&gt;
	&lt;body&gt; 
		&lt;div id="cln"&gt;
			&lt;?php
				require_once 'simple_html_dom.php';
				
				// Debug
				ini_set('display_startup_errors', '1');
				ini_set('display_errors','1');
				
				// Débrider la limite de mémoire
				ini_set('memory_limit', '-1');			
				
				$html = new simple_html_dom();
				
				// Récupérer le nombre d'articles
				$nb = file_get_contents('temp.txt');	

				


				// ####################	
				// #### Couverture ####
				// ####################	
				
				echo '&lt;div id="pagebreak"&gt;';			
				echo '&lt;h1&gt; WikiPapier&lt;SUP&gt;0.1&lt;/SUP&gt;&lt;/h1&gt;';			
				echo '&lt;div class="pagebreak"&gt;. . .&lt;/div&gt;&lt;div class="pagebreak"&gt;
				. . .&lt;/div&gt;';	
				echo '&lt;div class="pagebreak"&gt;. . .&lt;/div&gt;&lt;div class="pagebreak"&gt;
				. . .&lt;/div&gt;';									
				echo '&lt;/div&gt;';				


				// ############################	
				// #### Index des articles ####
				// ############################	
				
				echo '&lt;h1&gt; Index des articles &lt;/h1&gt;&lt;ul id="index"&gt;';			
				
				for ($i = 1 ; $i &lt;= $nb ; $i++) {
					$url = [$i =&gt; htmlspecialchars($_POST['url'.$i])];
					// Vérifier l'intégrité des urls
					$urlValide  = strpos($url[$i], 'https://fr.wikipedia.org/wiki/');
					$urlValide2 = strpos($url[$i], 'http://fr.wikipedia.org/wiki/');
					if ($urlValide2 !== false){
						$url[$i] = preg_replace('#http:#' , 'https:', $url[$i]);
					}
					
					// Récupération du titre pour l'index
					$titre = [$i =&gt; preg_replace('#https://fr.wikipedia.org/wiki/#', '', 
					$url[$i])];
					$titre[$i] = preg_replace('#_#', ' ', $titre[$i]);
					$titre[$i] = preg_replace('#%20#', ' ', $titre[$i]);
					$titre[$i] = preg_replace('#%C3%A9#', 'é', $titre[$i]);
					$titre[$i] = preg_replace('#%28#', '(', $titre[$i]);
					$titre[$i] = preg_replace('#%29#', ')', $titre[$i]);
					$titre[$i] = preg_replace('#%C3%A8#', 'è', $titre[$i]);
					$titre[$i] = preg_replace('#%C5%92#', 'Œ', $titre[$i]);
					echo '&lt;li&gt;'.$titre[$i].' &lt;SUP&gt;' .$url[$i]. '&lt;/SUP&gt;&lt;/li&gt;';
				}
	
				echo '&lt;/ul&gt;&lt;div class="pagebreak"&gt; --- &lt;/div&gt;&lt;br/&gt;';



				// #################	
				// #### Contenu ####
				// #################	
								
				for ($i = 1 ; $i &lt;= $nb ; $i++) {
					
					$url = [$i =&gt; htmlspecialchars($_POST['url'.$i])];
					// Vérifier l'intégrité des urls
					$urlValide  = strpos($url[$i], 'https://fr.wikipedia.org/wiki/');
					$urlValide2 = strpos($url[$i], 'http://fr.wikipedia.org/wiki/');
					if ($urlValide2 !== false){
						$url[$i] = preg_replace('#http:#' , 'https:', $url[$i]);
					}
					
					// Récupération du titre
					$titre = [$i =&gt; preg_replace('#https://fr.wikipedia.org/wiki/#', '', 
					$url[$i])];
					
					if ( $urlValide !== false || $urlValide2 !== false ){
						
						// Récupération du html
						$html = file_get_html('https://fr.wikipedia.org/
						w/index.php?title='.$titre[$i] . '&printable=yes');
						
						// Récupération du contenu
						$contenu = $html -&gt; getElementById('content');
						$titre2 = $html-&gt;find('title', 0);
		
						// Ménage
						$removeById = $contenu-&gt;getElementById('jump-to-nav');
						$removeById -&gt; outertext = '';
						$contenu = preg_replace('/(&lt;[^&gt;]+) style=".*?"/i', '$1', 
						$contenu);
						$contenu = preg_replace('/(&lt;[^&gt;]+) width=".*?"/i', '$1', 
						$contenu);
						$contenu = preg_replace('/(&lt;[^&gt;]+) height=".*?"/i', '$1', 
						$contenu);
						$contenu = preg_replace('/(&lt;[^&gt;]+) data-file-height=".*?"/i', 
						'$1', $contenu);
						$contenu = preg_replace('/(&lt;[^&gt;]+) data-file-width=".*?"/i', 
						'$1', $contenu);
		
						// Affichage du résultat
						echo $contenu;		
					}
				}
				
				
				// ##################					
				// #### Colophon ####	
				// ##################	
				
				$today = getdate();
				echo '&lt;div class="pagebreak"&gt;. . .&lt;/div&gt;&lt;div class="pagebreak"&gt;
				. . .&lt;/div&gt;&lt;div class="pagebreak"&gt;. . .&lt;/div&gt;&lt;div class=
				"pagebreak"&gt;. . .&lt;/div&gt;&lt;h1&gt; Colophon &lt;/h1&gt;&lt;p&gt; Ce livre 
				a été généré automatiquement en php le ' .$today['mday'].'/'.$today['mon'].
				'/'.$today['year'].' à ' .$today['hours'].'h'.$today['minutes']. ' à partir 
				d\'une selection d\'articles Wikipédia.&lt;/p&gt;&lt;p&gt; Wipipapier est un projet 
				d\'Étienne Ozeray réalisé à l\'Erg.&lt;/p&gt;&lt;p&gt;Projet disponible à l\'adresse
				&thinsp;: &lt;i&gt;http://etienneozeray.fr/wikipapier&lt;/i&gt;.&lt;/p&gt;&lt;p&gt; 
				Sources disponibles à l\'adresse&thinsp; &lt;i&gt;https://github.com/EtienneOz/
				WikiPapier&lt;/i&gt; .&lt;/p&gt;&lt;p&gt; Wikipapier est sous licence GNU/GPL 
				(&lt;i&gt;http://www.gnu.org/licenses/gpl.html&lt;/i&gt;). Vous avez la liberté 
				de l\'utiliser, le copier, le distribuer et le modifier. &lt;p/&gt; &lt;h2&gt; Code 
				source (au '.$today['mday'].'/'.$today['mon'].'/'.$today['year'].')&lt;/h2&gt;&lt;div 
				class="pagebreakbefore"&gt;. . .&lt;/div&gt;&lt;br/&gt;';			
			?&gt;
		&lt;/div&gt;
		
		&lt;?php 
		
			// #################################					
			// #### Quatrième de couverture ####	
			// #################################
						
 			echo'&lt;div class="pagebreak"&gt; . . . &lt;/div&gt;&lt;div class="pagebreak"&gt; . . . &lt;/div&gt;'; 
 		?&gt;
 				
	&lt;/body&gt;
&lt;/html&gt;
		</pre>

		<?php 
		
			// #################################					
			// #### Quatrième de couverture ####	
			// #################################
						
 			echo'<div class="pagebreak"> . . . </div><div class="pagebreak"> . . . </div>'; 
 		?>
		
	</body>
</html>