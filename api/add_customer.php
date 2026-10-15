<?php
include 'condb.php';

$data = json_decode(file_get_contents("php://input"), true);

if (
    empty($data['firstName']) || empty($data['lastName']) ||
    empty($data['phone']) || empty($data['username']) || empty($data['password'])
) {
    echo json_encode(["success" => false, "message" => "ข้อมูลไม่ครบ"]);
    exit;
}

try {
    $stmt = $conn->prepare(
        "INSERT INTO customers (firstName, lastName, phone, username, password)
         VALUES (:firstName, :lastName, :phone, :username, :password)"
    );
    $stmt->execute([
        ':firstName' => $data['firstName'],
        ':lastName'  => $data['lastName'],
        ':phone'     => $data['phone'],
        ':username'  => $data['username'],
        ':password'  => password_hash($data['password'], PASSWORD_DEFAULT)
    ]);
    echo json_encode(["success" => true, "message" => "เพิ่มข้อมูลเรียบร้อย"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
