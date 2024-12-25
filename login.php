<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Вход в админку</title>
    <link rel="stylesheet" href="/css/styles.css"> 
</head>
<body>
    <h1>Вход в административную панель</h1> 
    <form method="post"> 
        <label for="username">Логин:</label> 
        <input type="text" name="username" required><br> 
        <label for="password">Пароль:</label> 
        <input type="password" name="password" required><br><br> 
        <button type="submit">Войти</button> 
    </form>
</body>
</html>

<?php
session_start(); 
require_once '../config.php'; // Подключаем файл конфигурации для доступа к настройкам базы данных
// Проверяем, был ли отправлен POST-запрос
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем введенные логин и пароль (замените на вашу логику проверки пользователя)
    if ($_POST["username"] == "newfit" && $_POST["password"] == "qsw123") {
        $_SESSION["loggedin"] = true; // Устанавливаем переменную сессии для отметки о входе пользователя
        header("location: index.php"); // Перенаправляем пользователя на главную страницу административной панели
        exit; // Завершаем выполнение скрипта, чтобы предотвратить дальнейшую обработку
    } else {
        echo "Неверный логин или пароль."; // Сообщение об ошибке при неверном логине или пароле
    }
}
?>