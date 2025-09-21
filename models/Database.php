<?php
class Database
{
    private static $server = "localhost";
    private static $user = "root";
    private static $password = "";
    private static $dbName = "SOA";
    private static $port = "3306";

    public static function connect()
    {
        try {
            $connection = new PDO("mysql:host=" . self::$server . ";port=" . self::$port . ";dbname=" . self::$dbName, self::$user, self::$password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            die("Fallo al establecer conexion" . $e->getMessage());
        }
    }
}
