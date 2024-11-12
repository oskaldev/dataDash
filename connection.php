<?php
$link = mysqli_connect("localhost", "root", "", "test-task");
if (!$link) {
  die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}
