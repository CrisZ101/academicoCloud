<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    
    <center> <form action = "../controller/controller.php">
                
                <input type = "hidden" value = "guardar" name = "opcion">
                Cedula:<input type = "number" name = "cedula" required="true" ><br>
                Nombres:<input type = "text" name = "nombres" required="true"><br>
                Nota1:<input type = "number" name = "nota1"  required="true"><br>
                Nota2:<input type = "number" name = "nota2"  required="true"><br>
          
                
                        <input type = "submit" value = "Crear">
                    
        </form> </center>
        
    <center>
        <form action="../index.php">
                <input type="submit" value="Cancelar">
            </form>
    </center>
                  
<table>

    <?php
    session_start();
    if (isset($_SESSION['mensaje1']))
        echo "<br>MENSAJE DEL SISTEMA: <font color='red'>" . $_SESSION['mensaje1'] . "</font><br>";
    ?>
</table>

</body>
</html>
