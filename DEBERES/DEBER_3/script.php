<?php
    //OBTENER EL TEXTO DE UNA PAGINA WEB
    $data = file_get_contents("https://gist.githubusercontent.com/pixfallec/1d57da457f795958fc6abdd2c9035b48/raw/244a26d153c800ee447395ae2b5c67c03174a152/entregable2_texto4", false, stream_context_create(["http" => ["header" => "Accept-Charset: UTF-8"]]));
    //TEXTO A MINUSCULAS
    $data = strtolower($data);
    //REEMPLAZAR CARACTERES ESPECIALES TILDES
    $data = str_replace(array("á","é","í","ó","ú","ñ"),array("a","e","i","o","u","Ñ"), $data);
    //TEXTO A MAYUSCULAS
    $data = strtoupper($data);
    //REEMPLAZAR CARACTERES ESPECIALES (COMAS, PUNTOS, ETC)
    $data = str_replace(array(",",".",";",":","-","_","(",")","/","?","¿","!","¡","'","\"","[","]","{","}"),"", $data);
    //CONTAR PALABRAS IGUALES
    $palabras = array();
    $palabras = explode(" ", $data);
    $palabras = array_count_values($palabras);
    //ORDENAR DE MAYOR A MENOR
    arsort($palabras);
    //IMPRIMIR
    function imprimir_palabras(){
        global $palabras;
        $position = 0;
        foreach ($palabras as $key => $value) {
            $position++;
            if ($position%2==0) {
                ?>
                <tr>
                    <th class="text-center fonts" scope="row"><?php echo $position ?></th>
                    <td class="text-center fonts"><?php echo $key ?></td>
                    <td class="text-center fonts"><?php echo $value ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr class="table-primary">
                    <th class="bg-primary text-center fonts" scope="row"><?php echo $position ?></th>
                    <td class="bg-primary text-center fonts"><?php echo $key ?></td>
                    <td class="bg-primary text-center fonts"><?php echo $value ?></td>
                </tr>
                <?php
            }


        }
    }


?>