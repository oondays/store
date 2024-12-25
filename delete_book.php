<?php
session_start(); // Запускаем сессию для доступа к данным сессии
// Проверяем, вошел ли пользователь в систему
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
   header("location: login.php"); // Если не вошел, перенаправляем на страницу входа
   exit; // Завершаем выполнение скрипта
}
require_once '../functions.php'; // Подключаем файл с функциями для работы с книгами
// Проверяем, был ли отправлен POST-запрос (удаление книги)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   deleteBook($_POST["id"]); // Вызываем функцию для удаления книги с переданным ID
   header("location: index.php"); // Перенаправляем на страницу управления книгами после удаления
} else if (isset($_GET["id"])) { // Проверяем, был ли передан ID книги через GET-запрос
   // Получаем ID книги из GET запроса и отображаем форму подтверждения удаления
   echo '<form method="post">'; // Создаем форму с методом POST для отправки запроса на удаление
   echo '<input type="hidden" name="id" value="' . htmlspecialchars($_GET["id"]) . '">'; // Скрытое поле для хранения ID книги

   echo 'Вы уверены что хотите удалить эту книгу?';
   echo '<button type="submit">Удалить книгу</button>'; 
   echo '</form>'; 
}
?>
