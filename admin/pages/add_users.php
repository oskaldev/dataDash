<?php
session_start();
require_once "../../connection.php"; // Подключение к базе данных
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $group_id = intval($_POST['group_id']);

  $query = "INSERT INTO customers (username, password, group_id) VALUES ('$username', '$password', $group_id)";
  $result = mysqli_query($link, $query);

  if ($result) {
    header("Location: ../admin_dashboard.php");
    exit();
  } else {
    echo "error - Ошибка при добавлении пользователя";
  }
}
