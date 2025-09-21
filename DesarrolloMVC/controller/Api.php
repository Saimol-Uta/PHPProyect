<?php

include_once "./DesarrolloMVC/Model/crud.php";

$opc = $_SERVER["REQUEST_METHOD"];

switch ($opc) {
    case 'GET':
        Crud::select();
        break;
    case 'POST':
        Crud::insert();
        break;
    case 'PUT':
        Crud::update();
        break;
    case 'DELETE':
        Crud::delete();
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
