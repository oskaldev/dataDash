<?php
require_once "../connection.php";

header("Content-Type: application/json");

$nameFilter = isset($_GET['name']) ? mysqli_real_escape_string($link, $_GET['name']) : '';

$query = "SELECT id, name FROM categories WHERE name LIKE '%$nameFilter%'";
$result = mysqli_query($link, $query);

if ($result) {
  $categories = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = [
      "id" => $row['id'],
      "name" => $row['name']
    ];
  }

  if (count($categories) > 0) {
    echo json_encode([
      "status" => "success",
      "data" => [
        "categories" => $categories
      ]
    ], JSON_PRETTY_PRINT);
  } else {
    // Если категорий не найдено, возвращаем ошибку 404
    http_response_code(404);
    echo json_encode([
      "status" => "error",
      "error_code" => 404,
      "error_message" => "Категории не найдены по заданным параметрам"
    ], JSON_PRETTY_PRINT);
  }
} else {
  // Ошибка сервера
  http_response_code(500);
  echo json_encode([
    "status" => "error",
    "error_code" => 500,
    "error_message" => "Ошибка сервера при получении списка категорий"
  ], JSON_PRETTY_PRINT);
}
