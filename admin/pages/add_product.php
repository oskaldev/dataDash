<?php
session_start();
require_once "../../connection.php";

if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category_id = $_POST['category_id'];

  $insert_query = "INSERT INTO products (name, description, price, category_id) VALUES ('$name', '$description', $price, $category_id)";
  if (mysqli_query($link, $insert_query)) {
    header("Location: ../admin_dashboard.php");
    exit();
  } else {
    echo "Ошибка при добавлении товара.";
  }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Добавить товар</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <h2 class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg text-center focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">Добавить новый товар</h2>
  <form class="max-w-sm mx-auto" method="POST">
    <label class="block mb-2 font-medium text-gray-900 dark:text-dark" for="name" for="name">Название:</label>
    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="name" required><br>

    <label class="block mb-2 font-medium text-gray-900 dark:text-dark" for="name" for="description">Описание:</label>
    <textarea rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="description"></textarea><br>

    <label class="block mb-2 font-medium text-gray-900 dark:text-dark" for="name" for="price">Цена:</label>
    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="price" step="0.01" required><br>

    <label class="block mb-2 font-medium text-gray-900 dark:text-dark" for="name" for="category_id">Категория:</label>
    <select name="category_id">
      <?php
      $categories_result = mysqli_query($link, "SELECT * FROM categories");
      while ($category = mysqli_fetch_assoc($categories_result)) {
        echo "<option value='{$category['id']}'>{$category['name']}</option>";
      }
      ?>
    </select><br>

    <button class="mt-10 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="submit">Добавить товар</button>
  </form>
</body>

</html>