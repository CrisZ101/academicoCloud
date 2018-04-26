<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF8">
        <title> ACTUALIZAR </title>
    </head>
    <body>

        <?php
        include '../model/Alumno.php';

        session_start();
        $alumno = $_SESSION['alumno'];
        ?>

    <center> <form action="../controller/controller.php">

            <input type="hidden" value="actualizar" name="opcion">
            <!Utilizamos
                pequeños scripts PHP para obtener los valores del producto: >
            <input type="hidden" value="<?php echo $alumno->getCedula(); ?>" name="cedula">
            Cedula:<b><?php echo $alumno->getCedula(); ?></b><br>
            Nombres:<input type="text" name="nombres" value="<?php echo $alumno->getNombres(); ?>"><br>
            Nota1:<input type="number" name="nota1" value="<?php echo $alumno->getnota1(); ?>"><br>
            Nota2:<input type="number" name="nota2" value="<?php echo $alumno->getNota2(); ?>"><br>

            <input type="submit" value="Actualizar">
        </form>

    </center>   
    <center>
        <form action="../index.php">
            <input type="submit" value="Cancelar">
        </form>
    </center>  

    if (isset($_SESSION['mensaje2']))
    echo "<br>MENSAJE DEL SISTEMA: <font color='red'>" . $_SESSION['mensaje2'] . "</font><br>";
    ?>
</body>
</html>