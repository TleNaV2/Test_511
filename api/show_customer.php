<?php
include 'condb.php';

try {
    // ดึงข้อมูลคนเดียว (ใช้ในหน้าแก้ไข)
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare("SELECT customer_id, firstName, lastName, phone, username FROM customers WHERE customer_id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            echo json_encode(["success" => false, "message" => "ไม่พบข้อมูลลูกค้า"]);
            exit;
        }
        echo json_encode(["success" => true, "data" => $row]);
        exit;
    }

    // ดึงข้อมูลทั้งหมด (ใช้ในหน้ารายชื่อ)
    $stmt = $conn->query("SELECT customer_id, firstName, lastName, phone, username FROM customers ORDER BY customer_id ASC");
    echo json_encode(["success" => true, "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
