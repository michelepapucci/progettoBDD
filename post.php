<!DOCTYPE html>
<html lang="it">
<head>
    <!--
        TODO: Inserimento commenti sotto al post
        TODO: Migliorare slideshow ???
    -->
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/slideshow.js"></script>
	<?php
		require 'db_handler.php';
		$post = getPost($_GET["post_id"]);
		if ($post == false) {
			exit("ERRORE 404 - Pagina non trovata!");
		}
	?>
    <title><?php echo $post["titolo_post"] ?></title>
</head>
<body class="body">
    <div class="contenitore">
        <div class="sinistra">
            <h1 class="titolo"><?php echo $post["titolo_post"] ?></h1>
            <div>
                <span class="autore_post"><?php echo $post["nome_utente"] ?> -</span>
                <span class="data_post"><?php echo $post["data_ora_post"] ?> -</span>
                <span class="visualizzazioni">20 visualizzazioni -</span>
                <a class="link" href="#commenti">Commenti (<?php echo(getNumeroCommenti($_GET["post_id"])); ?>)</a> <br/>
                <div class = "slideshow">
					<?php
						$immagini = getImmaginiPost($_GET["post_id"]);
						if($immagini != false) {
							foreach($immagini as $immagine) {
								echo("<img class='immagine' style = 'display:none' src='" . $immagine["url"] . "'/>");
							}

					?>
                    <a class="prev">&#10094;</a>
                    <a class="next">&#10095;</a>
                    <div style="text-align:center">
                        <?php
                                for($i = 0; $i < count($immagini); $i++){
                                    echo("<span class='dot' id='$i'></span>");
                                }
							}
                        ?>
                    </div>
                </div>
                <p class="testo"><?php echo $post["testo_post"] ?></p>
            </div>
            <!-- Id ancora per link ai commenti -->
            <div id="commenti">
                <div class="div_titoletto">
                    <h3 class="titoletto">Commenti</h3>
                </div>
				<?php
					$commenti = getCommenti($_GET["post_id"]);
					if ($commenti == false) {
						echo "<div><p>Nessun Commento sotto a questo post</p></div>";
					} else {
						foreach ($commenti as $commento) {
							echo("
                            <div>
                                <p class = \"commento\">
                                    <span class = \"autore_commento\">" . $commento["nome_utente"] . ":</span><br/>"
								. $commento["testo_comm"] . "<br/>
                                    <span class = \"data_commento\">(" . $commento["data_ora_comm"] . ")</span>
                                </p>
                            </div>         
                        ");
						}
					}
				?>
            </div>
        </div>
        <div class="destra">
            <div class="div_titoletto">
                <h3 class="titoletto">Post recenti</h3>
            </div>
			<?php
				$posts = getLatestPostSidebar($_GET["post_id"]);
				foreach ($posts as $post) {
					if ($post["id_post"] != $_GET["post_id"]) {
						echo("
                        <div class = 'post_recenti'>
                            <a class = 'link' href = 'http://localhost/progettoBDD/post.php?post_id=" . $post["id_post"] . "'>" . $post["titolo_post"] . "</a>
                            <p>" . substr($post["testo_post"], 0, 100) . "...</p>
                        </div>
                        ");
					}
				}
			?>
        </div>
    </div>
</body><?php
