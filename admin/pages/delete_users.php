<?php
session_start();
require_once "../../connection.php";

if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}


if (!isset($_GET['id'])) {
  echo "ID.";
  exit();
}

$customers_id = $_GET['id'];

// Удаляем товар
$delete_query = "DELETE FROM customers WHERE id = $customers_id";
if (mysqli_query($link, $delete_query)) {
  header("Location: ../admin_dashboard.php");
  exit();
} else {
  echo "Ошибка при удалении товара.";
}
