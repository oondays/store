<?php
define('DB_SERVER', 'localhost'); // Сервер базы данных
define('DB_USERNAME', 'root'); // Имя пользователя для подключения к базе данных
define('DB_PASSWORD', ''); // Пароль для подключения к базе данных (пустой, если используется по умолчанию)
define('DB_NAME', 'bookstore'); // Имя базы данных
try {
    // Создаем новое соединение с базой данных с использованием PDO
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Устанавливаем режим обработки ошибок PDO на исключения
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Обрабатываем исключение в случае ошибки подключения к базе данных
    die("ERROR: Could not connect. " . $e->getMessage()); // Завершаем выполнение скрипта и выводим сообщение об ошибке
}
?>
