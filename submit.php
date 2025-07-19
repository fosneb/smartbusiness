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
  echo "Сообщение успешно отправлено!";
} else {
  echo "Ошибка при сохранении: " . $stmt->error;
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>
