<!DOCTYPE html>
<!--Rapisca Alexandru Stefan
	Corso B-->

<html lang="en">

	<head>
		<title>Rancid Tomatoes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="http://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rotten.gif" type="image/gif" rel="shortcut icon">
		<link href="movie.css" type="text/css" rel="stylesheet" />
		<?php 
			$movie=$_GET["film"];
		?>
	</head>

	<body>
	
		<div class="banner">
			<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes" />
		</div>
		
		<h1 class="title-header">
		
		<!--estraggo dal file nome, percentuale e immagine del film-->
		
		<?php 
			$title = file("$movie/info.txt", FILE_IGNORE_NEW_LINES);
		
				#stampo nome e percentuale?>
			<?=$title[0]?>
			(<?=$title[1]?>)
							
		</h1>
		
		<div class="outer-box">
		
			<div class="left-box">

				<div class="rating-box">
					<?php 				#scelgo immagine in base a percentuale
					$rating = $title[2];
					if ($rating < 60){
						?>
						<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rottenbig.png" alt="Rotten" />
					<?php }
					else { ?>
						<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/freshbig.png" alt="Fresh" />
					<?php } ?>	
					<?=$rating?>%
				</div>
				
				<div class="column-container">
				<?php    #conto il numero di recensioni 
					$review_num = count(glob("$movie/review*.txt"));
					
					if(($review_num % 2) == 0){
						$meta = $review_num / 2;  
					} #pari
					else{
						$meta = ($review_num/2)+1;
					}#dispari
					?>
				
					<div class="left-column">
						<?php
							#conto prima meta 
							for($count = 1; $count <= $meta; $count++){
								if($review_num < 10){ #se meno di 10 recensioni
									list($review, $img, $author, $link) = file("$movie/review$count.txt", FILE_IGNORE_NEW_LINES);
								}else{ #piu di 10 recensioni
									list($review, $img, $author, $link) = file("$movie/review0"."$count.txt", FILE_IGNORE_NEW_LINES);
								}
						?>
						<div class="review">
							<div class="quote">
								<p>
								<?php 
								#scelgo l'immagine giusto da aggiungere alla recensione
								if($img == "ROTTEN"){?>
									<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif" alt="Rotten" />
								<?php
								}else{?>
									<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif" alt="Fresh" />
								<?php } ?>
								<!-- Stampo recensione con autore e font-->
									<q> <?= $review?></q>
								</p>
							</div>
							<div class="author">
								<p>
									<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic" />
									<?=$author?> <br />
									<span class="italic"><?=$link?></span>
								</p>
							</div>
						</div>
							<?php }?>
					</div>
					
					<div class="right-column">
				<?php		#prelevo l 'altra meta delle recensioni
							for(; $count <= $review_num; $count++){
								if($review_num < 10){
									list($review, $img, $author, $link) = file("$movie/review$count.txt", FILE_IGNORE_NEW_LINES);
								}else{
									#piu di 10 recensioni
									if($count < 10){
										#siamo a meno di 10 stampate
										list($review, $img, $author, $link) = file("$movie/review0"."$count.txt", FILE_IGNORE_NEW_LINES);
									}else{
										#bisogna stampare da 10 in poi quindi cambia il nome del file
										list($review, $img, $author, $link) = file("$movie/review$count.txt", FILE_IGNORE_NEW_LINES);	
									}
								}
						?>
						<!--Procedure di stampa e scelta immagine: uguale a prima-->
						<div class="review">
							<div class="quote">
								<p>
								<?php 
								if($img == "ROTTEN"){?>
									<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif" alt="Rotten" />
								<?php
								}else{?>
									<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif" alt="Fresh" />
								<?php } ?>
									<q> <?= $review?></q>
								</p>
							</div>
							<div class="author">
								<p>
									<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic" />
									<?=$author?> <br />
									<span class="italic"><?=$link?></span>
								</p>
							</div>
						</div>
							<?php }?>
						
					</div>
				
				</div>
				
			</div>
		
			<div class="right-box">
				<!--immagine relativa a film-->
				<div>
					<img src="<?=$movie?>/overview.png" alt="general overview" />
				</div>
				
				<div class="description-box">
				
				<?php
					#leggo il file e divido i dati in modo da poterli gestire
					$overview = file("$movie/overview.txt");
					foreach ($overview as $line){
						list($def, $desc) = explode(":", $line);
				?>
					<!--STAMPA-->
					<dl>
						<dt><?=$def?></dt>
						<dd><?=$desc?></dt>
					</dl>
				<?php } ?>
				
					
				</div>
				
			</div>
			<!-- Modifico index-bar a seconda del numero di recensioni-->
			<div class="index-bar">
					<p>(1-<?= $review_num?>) of <?= $review_num?></p>
			</div>
				
		</div>

		<div class="validator">
			<a href="ttp://validator.w3.org/check/referer"><img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/w3c-xhtml.png" alt="Validate HTML" /></a> <br />
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" /></a>
		</div>
		
	</body>
	
</html>
