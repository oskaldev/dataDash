<?php
session_start();
require_once "../../connection.php";

if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}

// Проверяем, указан ли ID товара
if (!isset($_GET['id'])) {
  echo "ID товара обязателен.";
  exit();
}

$product_id = $_GET['id'];

// Удаляем товар
$delete_query = "DELETE FROM products WHERE id = $product_id";
if (mysqli_query($link, $delete_query)) {
  header("Location: ../admin_dashboard.php");
  exit();
} else {
  echo "Ошибка при удалении товара.";
}
