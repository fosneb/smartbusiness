<?php
$host = 'localhost';
$db   = 'smartbusiness';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

$table = 'application';
$stmt = $pdo->query("SELECT * FROM `$table`");
$rows = $stmt->fetchAll();


if (count($rows) > 0) {
    echo "<style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 16px;
            background: #f9f9f9;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            width: 250px;
        }
        .card h3 {
            margin-top: 0;
            font-size: 1.2em;
            color: #333;
        }
        .card p {
            margin: 4px 0;
            color: #555;
        }
    </style>";

    echo "<div class='card-container'>";
    foreach ($rows as $row) {
        echo "<div class='card'>";
        // Например, используем первое поле как заголовок
        $keys = array_keys($row);
        echo "<h3> Заявка №" . htmlspecialchars($row[$keys[0]]) . "</h3>";
        for ($i = 1; $i < count($keys); $i++) {
            $key = htmlspecialchars($keys[$i]);
            $value = htmlspecialchars($row[$keys[$i]]);
            echo "<p><strong>$key:</strong> $value</p>";
        }
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>Нет данных для отображения.</p>";
}
