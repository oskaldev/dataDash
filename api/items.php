<?php
require_once "../connection.php";

header("Content-Type: application/json");

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$nameFilter = isset($_GET['name']) ? mysqli_real_escape_string($link, $_GET['name']) : '';
$idFilter = isset($_GET['id']) ? intval($_GET['id']) : 0; 

$offset = ($page - 1) * $limit;

$whereClauses = [];
if ($nameFilter) {
  $whereClauses[] = "products.name LIKE '%$nameFilter%'";
}
if ($idFilter > 0) {
  $whereClauses[] = "products.id = $idFilter"; 
}

$whereSql = '';
if (count($whereClauses) > 0) {
  $whereSql = 'WHERE ' . implode(' AND ', $whereClauses);
}

$query = "SELECT products.id, products.name, products.description, products.price, categories.name AS category
          FROM products
          LEFT JOIN categories ON products.category_id = categories.id
          $whereSql
          LIMIT $limit OFFSET $offset";

$result = mysqli_query($link, $query);

if ($result) {
  $items = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $items[] = [
      "id" => $row['id'],
      "name" => $row['name'],
      "preview_text" => $row['description'],
      "price" => number_format((float)$row['price'], 2, '.', ''), 
      "category" => $row['category']
    ];
  }

  if (count($items) > 0) {
    
    $countQuery = "SELECT COUNT(*) AS total FROM products $whereSql";
    $countResult = mysqli_query($link, $countQuery);
    $countData = mysqli_fetch_assoc($countResult);
    $totalItems = $countData['total'];
    $totalPages = ceil($totalItems / $limit);


    echo json_encode([
      "meta" => [
        "current_page" => $page,
        "total_pages" => $totalPages,
        "total_items" => $totalItems,
        "limit" => $limit
      ],
      "items" => $items
    ], JSON_PRETTY_PRINT);
  } else {
    http_response_code(404);
    echo json_encode([
      "error_code" => 404,
      "error_message" => "Товары не найдены по заданным параметрам"
    ], JSON_PRETTY_PRINT);
  }
} else {
  http_response_code(500);
  echo json_encode([
    "error_code" => 500,
    "error_message" => "Ошибка сервера при получении списка товаров"
  ], JSON_PRETTY_PRINT);
}
