<?php

///////////////////////////////////////////////////////////////////////
//Componente controller que verifica la opcion seleccionada
//por el usuario, ejecuta el modelo y enruta la navegacion de paginas.
///////////////////////////////////////////////////////////////////////
require '../model/AcademicoModel.php';
session_start();
$academicoModel = new AcademicoModel();
$opcion = $_REQUEST['opcion'];

//limpiamos cualquier mensaje previo:
unset($_SESSION['mensaje']);
unset($_SESSION['mensaje1']);
unset($_SESSION['mensaje2']);

switch ($opcion) {
    case "listar":
//obtenemos la lista de alumnos:
        $listado = $academicoModel->getAlumnos(true);
        $promedioGeneral = $academicoModel->obtenerPromedioGeneral();
//y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        $_SESSION['promedioGeneral'] = $promedioGeneral;
        header('Location: ../index.php');
        break;

    case "listar_desc":
//obtenemos la lista de productos:
        $listado = $academicoModel->getAlumnos(false);
//y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
//obtenemos el valor total de productos:
        $_SESSION['promedioGeneral'] = $academicoModel->obtenerPromedioGeneral();
        header('Location: ../index.php');
        break;

    case "crear":
//navegamos a la pagina de creacion:
        header('Location: ../view/crear.php');
        break;

    case "guardar":
//obtenemos los valores ingresados por el usuario en el formulario:
        $cedula = $_REQUEST['cedula'];
        $nombres = $_REQUEST['nombres'];
        $nota1 = $_REQUEST['nota1'];
        $nota2 = $_REQUEST['nota2'];
        $validar = $academicoModel->validarNotas($nota1, $nota2);
        if ($validar == true) {
            try {
                $academicoModel->crearAlumno($cedula, $nombres, $nota1, $nota2);
            } catch (Exception $e) {
                //colocamos el mensaje de la excepcion en sesion:
                $_SESSION['mensaje'] = $e->getMessage();
            }
            //actualizamos la lista de alumnos para grabar en sesion:
            $listado = $academicoModel->getAlumnos();
            $_SESSION['listado'] = serialize($listado);
            $_SESSION['promedioGeneral'] = $academicoModel->obtenerPromedioGeneral();
            header('Location: ../index.php');
            break;
        } else {
            $_SESSION['mensaje1'] = "SOLO PUEDE INGRESAR VALORES POSITIVOS COMPRENDIDOS ENTRE (0 y 10)";
            header('Location: ../view/crear.php');
            break;
        }


    case "eliminar":
//obtenemos el codigo del producto a eliminar:
        $cedula = $_REQUEST['cedula'];
//eliminamos el alumno:
        $academicoModel->eliminarAlumno($cedula);
//actualizamos la lista de alumnos para grabar en sesion:
        $listado = $academicoModel->getAlumnos();
        $_SESSION['listado'] = serialize($listado);
        $_SESSION['promedioGeneral'] = $academicoModel->obtenerPromedioGeneral();
        header('Location: ../index.php');
        break;
    case "cargar":
//para permitirle actualizar un producto al usuario primero
//obtenemos los datos completos de ese producto:
        $cedula = $_REQUEST['cedula'];
        $alumno = $academicoModel->getAlumno($cedula);
//guardamos en sesion el producto para posteriormente visualizarlo
//en un formulario para permitirle al usuario editar los valores:
        $_SESSION['alumno'] = $alumno;
        header('Location: ../view/actualizar.php');
        break;
    case "actualizar":
//obtenemos los datos modificados por el usuario:
        $cedula = $_REQUEST['cedula'];
        $nombres = $_REQUEST['nombres'];
        $nota1 = $_REQUEST['nota1'];
        $nota2 = $_REQUEST['nota2'];
        $validar = $academicoModel->validarNotas($nota1, $nota2);
        if ($validar == true) {
//actualizamos los datos del producto:
            $academicoModel->actualizarAlumno($cedula, $nombres, $nota1, $nota2);
//actualizamos la lista de productos para grabar en sesion:
            $listado = $academicoModel->getAlumnos();
            $_SESSION['listado'] = serialize($listado);
            $_SESSION['promedioGeneral'] = $academicoModel->obtenerPromedioGeneral();
            header('Location: ../index.php');
            break;
        } else {
            $_SESSION['mensaje2'] = "SOLO PUEDE INGRESAR VALORES POSITIVOS COMPRENDIDOS ENTRE (0 y 10)";
            header('Location: ../view/actualizar.php');
            break;
        }

    case "restaurar":
        $academicoModel->restaurarNotas();
        $_SESSION['promedioGeneral'] = $academicoModel->obtenerPromedioGeneral();
        $listado = $academicoModel->getAlumnos();
        $_SESSION['listado'] = serialize($listado);

        header('Location: ../index.php');
        break;







    default:
//si no existe la opcion recibida por el controlador, siempre
//redirigimos la navegacion a la pagina index:
        header('Location: ../index.php');
}
