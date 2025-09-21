<?php

include_once "conexion.php";

class Crud
{

    public static function select()
    {

        $conn = new Conexion();

        $connect = $conn->connect();

        $sqlQuery = "select * from estudiantes";

        $result = $connect->prepare($sqlQuery);

        $result->execute();

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }

    public static function insert()
    {

        $conn = new Conexion();

        $connect = $conn->connect();

        $sqlQuery = "select * from estudiantes";

        $result = $connect->prepare($sqlQuery);

        $result->execute();

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }
    public static function update()
    {

        $conn = new Conexion();

        $connect = $conn->connect();

        $sqlQuery = "select * from estudiantes";

        $result = $connect->prepare($sqlQuery);

        $result->execute();

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }
    public static function delete()
    {

        $conn = new Conexion();

        $connect = $conn->connect();

        $sqlQuery = "select * from estudiantes";

        $result = $connect->prepare($sqlQuery);

        $result->execute();

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }
}
