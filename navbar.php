<?php
	global $logged;
	global $account;
?>
<div class="contenitore_navbar">
    <ul class="navbar_sinistra">
        <li class="navbar_el lista_sinistra"><a class="link_standard" href="index.php">Home</a></li>
        <li class="navbar_el lista_sinistra"><a class="link_standard" href="about.php">About</a></li>
    </ul>
    <ul class = "navbar_destra">
        <?php
            if($logged) {
                echo "<li class = 'navbar_el lista_destra'><span>Ciao, " . $account->getNome() . "</span></li>";
            }
        ?>

        <li class = "navbar_el lista_destra dropdown"><a class = "link_standard area_utente">Area utente</a>
            <div class="drop_el">
                <?php
                    if($logged) {
                        ?>
                        <a href="creazione_blog.php">Crea un Nuovo Blog</a>
                        <a href="logout.php">Logout</a>
                        <a id="del-utente">Elimina il tuo utente</a>
                <?php
                    } else {
						echo '<a href="login.php">Accedi</a>';
                    }
                ?>

            </div>
        </li>
    </ul>
</div>
<div class = "navbar_sotto">
    <form class = "navbar_form">
        <label class = "inline" for="ricerca">Cerca un blog per
            <select class = "navbar_select" name="opzioni" id="opzioni">
                <option value="nome" id = "nome">nome</option>
                <option value="categoria" id = "categoria">categoria</option>
                <option value="tema" id = "tema">tema</option>
            </select> : </label>
        <input type="search" class = "navbar_ricerca" id="ricerca" name="ricerca">
        <input type="submit" class = "navbar_bottone" value = "Cerca">
    </form>
</div>
