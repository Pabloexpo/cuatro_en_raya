<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();

        //CAMBIO ENTRE X/O
        if (!empty($_SESSION['eleccion'])) {
            $eleccion = $_SESSION['eleccion']; //RECUPERAMOS EL VALOR
        } else {
            $eleccion = "X"; //EMPEZAMOS LA PARTIDA EN X
        }
        if (isset($_POST['valores'])) {
            $_SESSION['valores'] = $_POST['valores'];
            echo $_SESSION['valores'];
        }

        if (isset($_POST['valores'])) {
            switch ($eleccion) {
                case "X":
                    $eleccion = "O"; //        echo $valores;

                    break;
                case "O":
                    $eleccion = "X";
                    break;
            }
        }
        echo $eleccion . "<br>";
        $tablero = array(); //ELABORACIÓN DEL ARRAY
        if (isset($_SESSION['juego'])) {
            $tablero = $_SESSION['juego'];
        } else {
            for ($i = 0; $i < 6; $i++) {
                $fila = array(); //FILA QUE LUEGO AÑADIMOS
                for ($j = 0; $j < 7; $j++) {
                    $fila[] = '-';
                }
                $tablero[] = $fila; //LO METEMOS EN EL BIDIMENSIONAL
            }
        }
        //HACEMOS LA ALGORITMIA PARA MODIFICAR LA TABLA
        $columna = substr($_SESSION['valores'], 1, 1); //COLUMNA A MODIFICAR

        for ($i = 5; $i >= 0; $i--) {
            if ($tablero[$i][$columna] == '-') {
                $tablero[$i][$columna] = $eleccion;
                break;
            }
        }

        //PASAMOS A TABLA
        echo '<table border="1">';

        for ($i = 0; $i < 7; $i++) {
            echo '<tr>';
            echo '<form method="post">';
            if ($i == 6) {
                for ($j = 0; $j < 7; $j++) {
                    echo "<td><button name='valores' type='submit'value='$i$j'>Enviar</button></td>";
                }
            } else {
                for ($j = 0; $j < 7; $j++) {
                    echo "<td>" . $tablero[$i][$j] . "</td>";
                }
            }
            echo '</form>';
            echo '</tr>';
        }
        echo '</table>';

        $_SESSION['juego'] = $tablero;
        $_SESSION['eleccion'] = $eleccion; //ESTO DEBE IR AL FINAL 
        ?>
    </body>
</html>
