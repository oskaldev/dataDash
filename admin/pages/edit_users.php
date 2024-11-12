<?php
session_start();
require_once "../../connection.php";

if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['id'])) {
  echo "Не указан ID пользователя.";
  exit();
}

$customer_id = $_GET['id'];

$query = "SELECT * FROM customers WHERE id = $customer_id";
$result = mysqli_query($link, $query);
$customer = mysqli_fetch_assoc($result);

if (!$customer) {
  echo "Ошибка: пользователь не найден.";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $group_id = intval($_POST['group_id']);

  $update_query = "UPDATE customers SET group_id = $group_id WHERE id = $customer_id";
  if (mysqli_query($link, $update_query)) {
    header("Location: ../admin_dashboard.php");
    exit();
  } else {
    echo "Ошибка при обновлении группы пользователя.";
  }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Редактировать группу пользователя</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <h2 class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg text-center focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    Редактировать группу пользователя
  </h2>

  <form class="max-w-sm mx-auto" method="POST">
    <label class="block mb-2 font-medium text-gray-900 dark:text-dark" for="group_id">Группа:</label>
    <select name="group_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <?php
      $groups_result = mysqli_query($link, "SELECT * FROM `groups`");
      while ($group = mysqli_fetch_assoc($groups_result)) {
        $selected = $group['id'] == $customer['group_id'] ? "selected" : "";
        echo "<option value='{$group['id']}' $selected>{$group['name']}</option>";
      }
      ?>
    </select><br>

    <button type="submit" class="mt-10 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
      Обновить группу
    </button>
  </form>
</body>

</html>