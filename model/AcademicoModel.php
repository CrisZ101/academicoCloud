<?php

include 'Database.php';
include 'Alumno.php';


class AcademicoModel {

    public function getAlumnos($orden) {

        $pdo = Database::connect();

        if ($orden == true){
            $sql = "select * from notas order by nombres";
        }
        else{
            $sql = "select * from notas order by nombres desc";
        }
        
        $resultado = $pdo->query($sql);

        $listado = array();
        
        foreach ($resultado as $res) {
            
            $alumno = new Alumno();
            $alumno->setCedula($res['cedula']);
            $alumno->setNombres($res['nombres']);
            $alumno->setNota1($res['nota1']);
            $alumno->setNota2($res['nota2']);
            $alumno->setPromedio($res['promedio']);
            array_push($listado, $alumno);
        
        }
        
        Database::disconnect();

        return $listado;
    }


    public function getAlumno($cedula) {

        $pdo = Database::connect();

        $sql = "select * from notas where cedula=?";
        
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cedula));

        $dato = $consulta->fetch(PDO::FETCH_ASSOC);

        $alumno = new Alumno();
        
        $alumno->setCedula($dato['cedula']);
        $alumno->setNombres($dato['nombres']);
        $alumno->setNota1($dato['nota1']);
        $alumno->setNota2($dato['nota2']);
        $alumno->setPromedio($dato['promedio']);
        
        Database::disconnect();
        
        return $alumno;
        
    }

 
    public function crearAlumno($cedula, $nombres, $nota1, $nota2) {

        $prom = ($nota1 + $nota2) / 2;

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "insert into notas (cedula,nombres,nota1,nota2,promedio) values(?,?,?,?,?)";
        $consulta = $pdo->prepare($sql);

        try {
            
            $consulta->execute(array($cedula, $nombres, $nota1, $nota2, $prom));
            
        } 
        catch (PDOException $e) {
            
            Database::disconnect();
            
            throw new Exception($e->getMessage());
        
        }
        
        Database::disconnect();
    
        
        }

    
    public function eliminarAlumno($cedula) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "delete from notas where cedula=?";
        
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cedula));
        
        Database::disconnect();
    }


    public function actualizarAlumno($cedula, $nombres, $nota1, $nota2) {
        
        $prom = ($nota1 + $nota2) / 2;

        $pdo = Database::connect();
        
        $sql = "update notas set nombres=?,nota1=?,nota2=?,promedio=? where cedula=?";
        
        $consulta = $pdo->prepare($sql);

        $consulta->execute(array($nombres, $nota1, $nota2, $prom, $cedula));
        
        Database::disconnect();
    
    }

    public function obtenerPromedioGeneral() {

        $pdo = Database::connect();
        
        $sql = "select avg(promedio)as promedio from notas";
        
        $resultado = $pdo->query($sql);
        
        $data_array = $resultado->fetchAll();
        
        Database::disconnect();
        
        return (float) $data_array[0][0];
    
    }

    public function validarNotas($nota1, $nota2) {
        
        $validar = false;
        
        if ($nota1 >= 0 && $nota1 <= 10 && $nota2 > 0 && $nota2 <= 10) {
            
            $validar = true;
        
        }
        
        return $validar;
    
     }

    public function restaurarNotas() {
        
        $pdo = Database::connect();
        
        $sql = "update notas set nota1=0, nota2=0";
        
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array());

        $sql1 = "update notas set promedio=(nota1*nota2)/2";
        
        $consulta1 = $pdo->prepare($sql1);
        $consulta1->execute(array());

        Database::disconnect();
    
        
    }

}
