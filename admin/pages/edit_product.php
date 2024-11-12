<?php
session_start();
require_once "../../connection.php";

if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['id'])) {
  echo "ID товара обязателен.";
  exit();
}

$product_id = $_GET['id'];

$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($link, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
  echo "Товар не найден.";
  exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category_id = $_POST['category_id'];

  $update_query = "UPDATE products SET name = '$name', description = '$description', price = $price, category_id = $category_id WHERE id = $product_id";
  if (mysqli_query($link, $update_query)) {
    header("Location: ../admin_dashboard.php");
    exit();
  } else {
    echo "Ошибка при обновлении товара.";
  }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Редактировать товар</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <h2 class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg text-center focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">Редактировать товар</h2>
  <form class="max-w-sm mx-auto" method="POST">
    <label class="block mb-2 font-medium text-gray-900 dark:text-dark" for="name">Название:</label>
    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="name" value="<?php echo $product['name']; ?>" required><br>

    <label class="block mb-2 font-medium text-gray-900 dark:text-dark" for="description">Описание:</label>
    <textarea rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="description"><?php echo $product['description']; ?></textarea><br>

    <label class="block mb-2 font-medium text-gray-900 dark:text-dark" for="price">Цена:</label>
    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="price" value="<?php echo $product['price']; ?>" required><br>

    <label class="block mb-2 font-medium text-gray-900 dark:text-dark" for="category_id">Категория:</label>
    <select name="category_id">
      <?php
      $categories_result = mysqli_query($link, "SELECT * FROM categories");
      while ($category = mysqli_fetch_assoc($categories_result)) {
        $selected = $category['id'] == $product['category_id'] ? "selected" : "";
        echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
      }
      ?>
    </select><br>
    <button type="submit" class="mt-10 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Обновить товар</button>
  </form>

</body>

</html>