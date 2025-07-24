<?php
// Настройки подключения к MySQL
$host = "localhost";
$dbname = "smartbusiness";
$username = "root";
$password = "";

// Получение данных из формы
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Подключение к базе данных
$conn = new mysqli($host, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
  die("Ошибка подключения: " . $conn->connect_error);
}

// Подготовка SQL-запроса
$sql = "INSERT INTO application (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

// Выполнение запроса
if ($stmt->execute()) {
  header("Location: contact.html"); // редирект на страницу успешной отправки
  exit(); // всегда вызывайте exit после header
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>
