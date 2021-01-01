<?php

include __DIR__ . '../../../classes/Database.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);

    return false;
}

$db = new Database();

try {
    $db->hapusData('buku', ['id' => $_POST['id']]);
    
    header('content-type: application/json');
    echo json_encode(['message' => 'Buku berhasil di hapus']);
} catch (\PDOException $e) {
    http_response_code(500);

    echo json_encode(['message' => $e->getMessage()]);
}
