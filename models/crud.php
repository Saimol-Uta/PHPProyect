<?php
require_once __DIR__ . '/../models/Conexion.php';

class CRUD
{

    public static function select()
    {
        $connect = new Conexion();
        $conectat = $connect->connect();
        //se crea la consulta
        $sqlSelect = "SELECT * FROM ESTUDIANTES";
        //preparar la consulta
        //el prepare es para evitar inyecciones SQL porque
        //si se pone directamente en el execute puede ser peligroso 
        $result = $conectat->prepare($sqlSelect);
        // el execute ejecuta la consulta
        $result->execute();
        //fetchAll obtiene todos los registros
        // PDO::FETCH_ASSOC obtiene solo los nombres de las columnas
        // ejemplo: array("CEDULA"=>"123456","NOMBRE"=>"Juan")
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }

    public static function insert()
    {
        $connect = new Conexion();
        $conectat = $connect->connect();

        // se obtienen los datos enviados por POST esto se puede
        // cambiar por los datos que se quieran enviar
        // en este caso se envían los datos del estudiante
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        // se crea la consulta
        $sqlInsert = "INSERT INTO ESTUDIANTES (CEDULA, NOMBRE, APELLIDO, DIRECCION, TELEFONO) VALUES ('$cedula' ,'$nombre','$apellido', '$direccion', '$telefono')";
        $resultado = $conectat->prepare($sqlInsert);
        $resultado->execute();
        $data = "Insertado";
        echo json_encode($data);
    }

    public static function update()
    {
        $connect = new Conexion();
        $conectat = $connect->connect();

        // se obtienen los datos enviados por PUT
        // OBTENEMOS LA cEDULA POR LA URL
        // EL Get es para obtener los datos de la URL
        // ejemplo: api.php?cedula=123456         
        $cedula = $_GET['cedula'];
        $nombre = $_GET['nombre'];
        $apellido = $_GET['apellido'];
        $direccion = $_GET['direccion'];
        $telefono = $_GET['telefono'];
        // se crea la consulta
        $sqlUpdate = "UPDATE ESTUDIANTES SET NOMBRE='$nombre', APELLIDO='$apellido', DIRECCION='$direccion', TELEFONO='$telefono' WHERE CEDULA='$cedula'";
        $resultado = $conectat->prepare($sqlUpdate);
        $resultado->execute();
        $data = "Actualizado";
        echo json_encode($data);
    }

    public static function delete()
    {
        $connect = new Conexion();
        $conectat = $connect->connect();

        // se obtienen los datos enviados por DELETE
        // OBTENEMOS LA cEDULA POR LA URL
        // EL Get es para obtener los datos de la URL
        // ejemplo: api.php?cedula=123456         
        if (isset($_GET['cedula'])) {
            $cedula = $_GET['cedula'];
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Falta el parámetro 'cedula'"]);
            return;
        }
        // se crea la consulta
        $sqlDelete = "DELETE FROM ESTUDIANTES WHERE CEDULA='$cedula'";
        $resultado = $conectat->prepare($sqlDelete);
        $resultado->execute();
        $data = "Eliminado";
        echo json_encode($data);
    }
}
