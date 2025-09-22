<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../models/Student.php';


$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $students = Student::selectStudent();
        echo json_encode($students);
        break;

    case 'POST':
        $data = [
            'cedula' => $_POST['cedula'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'telefono' => $_POST['telefono']
        ];
        if (Student::createStudent($data)) {
            echo json_encode(['success' => true, 'message' => 'Estudiante creado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear el estudiante']);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = [
            'cedula' => $_PUT['cedula'],
            'nombre' => $_PUT['nombre'],
            'apellido' => $_PUT['apellido'],
            'direccion' => $_PUT['direccion'],
            'telefono' => $_PUT['telefono']
        ];
        if (Student::updateStudent($data)) {
            echo json_encode(['success' => true, 'message' => 'Informacion actualizada correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar']);
        }
        break;

    case 'DELETE':
        // Aceptar cédula por query string o en el cuerpo (x-www-form-urlencoded)
        parse_str(file_get_contents("php://input"), $_DELETE);
        $cedula = $_GET['cedula'] ?? ($_DELETE['cedula'] ?? null);

        if ($cedula && Student::deleteStudent($cedula)) {
            echo json_encode(['success' => true, 'message' => 'Estudiante eliminado correctamente']);
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Error al eliminar', 'cedula' => $cedula]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        break;
}
