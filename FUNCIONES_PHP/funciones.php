<?php

    function imprimir_titulo($titulo){
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title><?php echo $titulo; ?></title>
            </head>
        <?php
    }

    function imprimir_nav(){
        ?>
            <header>
                <h2>NAVEGACION</h2>
            </header>
        <?php
    }

    function imprimir_section($id, $titulo, $descrip){
        ?>
            <section id=<?php echo $id ?>>
                <h1><?php echo $titulo ?></h1>
                <p><?php echo $descrip ?></p>
            </section>
        <?php
    }

    function imprimir_footer(){
        ?>
            <footer>
                <h3>PIE DE PAGINA</h3>
            </footer>
        <?php
    }

	function imprimir_enlace($enlace,$nombre){
		?>
			<div>
				<a href=<?php echo $enlace; ?> > <?php echo $enlace; ?> </a>
			</div>
		<?php
	}




?>