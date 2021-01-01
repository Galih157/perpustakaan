<?php

include __DIR__ . '../../../classes/Database.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);

    return false;
}

$db = new Database();

$data = [
    'judul' => $_POST['judul'],
    'pengarang' => $_POST['pengarang'],
    'penerbit' => $_POST['penerbit'] ?? null,
    'tahun' => empty(($_POST['tahun'] ?? null)) ? null : (int) $_POST['tahun'],
    'isbn' => $_POST['isbn'] ?? null,
];

try {
    $db->insertData('buku', $data);

    header('content-type: application/json');
    echo json_encode(['message' => 'Buku berhasil di tambahkan']);
} catch (\PDOException $e) {
    http_response_code(500);

    echo json_encode(['message' => $e->getMessage()]);
}
