<?php
include_once("Database.php");
class Student
{
    public static function selectStudent()
    {
        $connection = Database::connect();
        $sqlSelect = "SELECT * FROM estudiantes";
        $result = $connection->prepare($sqlSelect);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createStudent($data)
    {
        $connection = Database::connect();
        $sqlInsert = "INSERT INTO estudiantes (cedula, nombre, apellido, direccion, telefono) VALUES (?, ?, ?, ?, ?)";
        $result = $connection->prepare($sqlInsert);

        return $result->execute([
            $data['cedula'],
            $data['nombre'],
            $data['apellido'],
            $data['direccion'],
            $data['telefono']
        ]);
    }

    public static function updateStudent($data)
    {
        $connection = Database::connect();
        $sqlUpdate = "UPDATE estudiantes SET nombre=?, apellido=?, direccion=?, telefono=? WHERE cedula=?";
        $result = $connection->prepare($sqlUpdate);
        return $result->execute([
            $data['nombre'],
            $data['apellido'],
            $data['direccion'],
            $data['telefono'],
            $data['cedula']
        ]);
    }

    public static function deleteStudent($cedula)
    {
        $connection = Database::connect();
        $sqlDelete = "DELETE FROM estudiantes WHERE cedula=?";
        $result = $connection->prepare($sqlDelete);
        return $result->execute([$cedula]);
    }
}
