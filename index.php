<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF8">
        <title>NOTAS</title>
    </head>
    <body>
        
        <center> 
                
                <center>
                    <form action="controller/controller.php">
                        <input type="hidden" value="listar" name="opcion">
                        <input type="submit" value="Consultar listado">
                    </form>
                </center>
            
            

                    <center>
                        <form action="controller/controller.php">
                            <input type="hidden" value="listar_desc" name="opcion">
                            <input type="submit" value="Consultar listado descendente">
                        </form>
                    </center>
                
                
                    <center>
                        <form action="controller/controller.php">
                            <input type="hidden" value="crear" name="opcion">
                            <input type="submit" value="Crear alumno">
                        </form>
                    </center>

                    
                    <center>
                        <form action="view/restaurar.php">
                            <input type="hidden" value="restaurar" name="opcion">
                            <input type="submit" value="Restaurar Notas">
                        </form>
                    </center>
                
       
        </center>
        
        <table border="1">
            <tr>
                <th>CODIGO</th>
                <th>NOMBRES</th>
                <th>NOTA 1</th>
                <th>NOTA 2</th>
                <th>PROMEDIO</th>
                <th>ELIMINAR</th>
                <th>ACTUALIZAR</th>
            </tr>
            <?php
            session_start();
            include './model/Alumno.php';

            if (isset($_SESSION['listado'])) {
                
                $listado = unserialize($_SESSION['listado']);
                
                foreach ($listado as $alum) {
                    
                    echo "<tr>";
                    echo "<td>" . $alum->getCedula() . "</td>";
                    echo "<td>" . $alum->getNombres() . "</td>";
                    echo "<td>" . $alum->getNota1() . "</td>";
                    echo "<td>" . $alum->getNota2() . "</td>";
                    echo "<td>" . $alum->getPromedio() . "</td>";

                    echo "<td><a href='controller/controller.php?opcion=eliminar&cedula=" . $alum->getCedula() . "'>eliminar</a></td>";
                    echo "<td><a href='controller/controller.php?opcion=cargar&cedula=" . $alum->getCedula() . "'>actualizar</a></td>";
                    echo "</tr>";
               
                }
                
                echo "<tr>";
                echo "<td colspan=4>PROMEDIO GENERAL</td><td>" . $_SESSION['promedioGeneral'] . "</td>";
                
                }
                
            else {
                
                echo "No se han cargado datos.";
            
            }
            
            if (isset($_SESSION['mensaje'])){ 
            
                echo "<br>MENSAJE DEL SISTEMA: <font color='red'>" . $_SESSION['mensaje'] . "</font><br>";
            }
            
            ?>
            
        </table>
    </body>
</html>
