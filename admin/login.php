<?php
session_set_cookie_params([
  'path' => '/',
  'domain' => '.test-task',  // Обратите внимание на точку перед именем домена
  'secure' => false,
  'httponly' => true,
]);
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/connection.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Admin Login</title>
</head>

<body>
  <div class="bg-gray-50 font-[sans-serif]">
    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
      <div class="max-w-md w-full">

        <div class="p-8 rounded-2xl bg-white shadow">
          <h2 class="text-gray-800 text-center text-2xl font-bold">Sign in</h2>
          <form method="post" class="mt-8 space-y-4">
            <div>
              <label class="text-gray-800 text-sm mb-2 block">User name</label>
              <div class="relative flex items-center">
                <input id="username" name="username" type="text" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter user name" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                  <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                  <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z" data-original="#000000"></path>
                </svg>
              </div>
            </div>

            <div>
              <label class="text-gray-800 text-sm mb-2 block">Password</label>
              <div class="relative flex items-center">
                <input id="password" name="password" type="password" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter password" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                  <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                </svg>
              </div>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-4">
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                  Remember me
                </label>
              </div>

            </div>

            <div class="!mt-8">
              <button type="submit" name="submit1" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                Sign in
              </button>
              <div class="alert alert-danger" id="errormsg" style="margin-top:10px; display: none;">
                <strong>Не совпадает!</strong> Проверьте правильность ввода почты или пароля !
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

<?php

// $password = "1234"; 
// $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// echo "Хеш пароля: " . $hashedPassword;

if (isset($_POST["submit1"])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Защищенный запрос для получения данных о пользователе
  $stmt = $link->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // Проверка пароля с использованием password_verify
  if ($user && password_verify($password, $user['password'])) {
    // Успешный вход
    $_SESSION["user"] = $username;
    echo "<script>window.location = 'admin_dashboard.php';</script>";
  } else {
    // Ошибка при входе
    echo "<script>document.getElementById('errormsg').style.display = 'block';</script>";
  }
}


?>