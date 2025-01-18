<?php
header('Content-type: application/json');

try {
    include '../../../../config/db.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $action = $data['action'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $data === 'toggle_task') {
        $taskId = $data['id'];
        $stmt = $conn->prepare('UPDATE tasks SET is_completed NOT :is_completed WHERE id = :id');
        $stmt->bindParam('id', $taskId);
        $stmt->execute();
        http_response_code('201');
        echo json_encode(['success' => true]);
    }
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
