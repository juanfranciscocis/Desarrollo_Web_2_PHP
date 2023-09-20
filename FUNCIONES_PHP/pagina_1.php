<?php
    require "funciones.php";
    imprimir_titulo("FUNCIONES CON PHP");

?>
<body>

    <?php
        imprimir_nav();
        imprimir_section("inicio", "INICIO", "DESCRIPCION DE LA SECCION INICIO");
        imprimir_section("servicios", "SERVICIOS", "DESCRIPCION DE SERVICIOS");
        imprimir_section("contacto", "CONTACTO", "DESCRIPCION DE CONTACTO");
		imprimir_enlace("pagina_2.php", "Ir a pagina 2");
        imprimir_footer();
    ?>

</body>
</html>
