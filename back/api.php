<?php
require 'db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'getTasks':
        getTasks($pdo);
        break;
    case 'addTask':
        addTask($pdo);
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
}

function getTasks($pdo) {
    $stmt = $pdo->query('SELECT * FROM tasks');
    $tasks = $stmt->fetchAll();
    echo json_encode($tasks);
}

function addTask($pdo) {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['description'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Description is required']);
        return;
    }

    $stmt = $pdo->prepare('INSERT INTO tasks (description) VALUES (:description)');
    $stmt->execute(['description' => $data['description']]);
    echo json_encode(['success' => true]);
}
?>

