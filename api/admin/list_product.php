<?php
require '../common/db_connection.php';

$name = isset($_GET['name']) ? $_GET['name'] : null;
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$price = isset($_GET['price']) ? (float)$_GET['price'] : 0;
$stock = isset($_GET['stock']) ? (int)$_GET['stock'] : 0;
$barcode = isset($_GET['barcode']) ? $_GET['barcode'] : null;

try {
    $sql_list_product = "SELECT p.*, c.name AS category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE 1=1";

    $params = [];

    if (!empty($name)) {
        $sql_list_product .= " AND p.name LIKE :name";
        $params[':name'] = '%' . $name . '%';
    }

    if ($category_id > 0) {
        $sql_list_product .= " AND p.category_id = :category_id";
        $params[':category_id'] = $category_id;
    }


    $sql_list_product .= " ORDER BY p.id ASC";

    $stmt = $conn->prepare($sql_list_product);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'message' => $products
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error : ' . $e->getMessage()
    ]);
}
?>
