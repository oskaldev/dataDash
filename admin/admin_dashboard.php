<?php
session_start();
require_once "../src/includes/auth.php";
require_once "../connection.php";
if (!isset($_SESSION["admin"])) {
?>
  <script>
    window.location = "login.php";
  </script>
<?php
}

$query = "SELECT products.id, products.name, products.description, products.price, categories.name AS category_name
          FROM products
          LEFT JOIN categories ON products.category_id = categories.id";
$result = mysqli_query($link, $query);

$customerQuery = "SELECT customers.id, customers.username, customers.password, `groups`.name AS group_name 
                  FROM customers
                  LEFT JOIN `groups` ON customers.group_id = `groups`.id";
$customerResult = mysqli_query($link, $customerQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/login.css">
  <title>Admin Login</title>
</head>

<body>

  <div class="mx-auto w-3/4 mt-5 relative overflow-x-auto shadow-md rounded-lg">
    <?php
    require_once "pages/list/product-list.php";
    require_once "pages/list/users-list.php";
    ?>

  </div>

</body>

</html>