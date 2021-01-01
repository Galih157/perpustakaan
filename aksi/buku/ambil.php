<?php

include __DIR__ . '../../../classes/Database.php';

$db = new Database();

$buku = $db->getData('buku');

header('content-type: application/json');

echo json_encode(['data' => $buku]);
