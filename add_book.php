<?php
session_start(); // Запускаем сессию для доступа к данным сессии
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) /*Проверяем, вошел ли пользователь в систему*/
{
   header("location: login.php"); // Если не вошел, перенаправляем на страницу входа
   exit; // Завершаем выполнение скрипта
}
require_once '../functions.php'; // Подключаем файл с функциями для работы с книгами
// Проверяем, был ли отправлен POST-запрос (добавление новой книги)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Вызываем функцию для создания новой книги с данными из формы
   createBook($_POST['title'], $_POST['description'], $_POST['price'], $_POST['author_id'], $_POST['category_id']);
   header("location: index.php"); // Перенаправляем на страницу управления книгами после добавления
}
// Получаем список всех авторов и категорий для выпадающих списков
$authors = getAllAuthors();
$categories = getAllCategories();
?>
<!-- Форма для добавления новой книги -->
<form method="POST">
   <label for="title">Название книги:</label>
   <input type="text" name="title" required><br>
   <label for="description">Описание:</label>
   <textarea name="description"></textarea><br> 
   <label for="price">Цена:</label>
   <input type="number" step="0.01" name="price" required><br> 
   <label for="author_id">Автор:</label>
   <select name="author_id"> 
      <?php foreach ($authors as $author): ?> 
         <option value="<?= htmlspecialchars($author['author_id']) ?>"><?= htmlspecialchars($author['first_name'] . ' ' . htmlspecialchars($author['last_name'])) ?></option>
      <?php endforeach; ?>
   </select><br>
   <label for="category_id">Категория:</label>
   <select name="category_id">
      <?php foreach ($categories as $category): ?> 
         <option value="<?= htmlspecialchars($category['category_id']) ?>"><?= htmlspecialchars($category['name']) ?></option>
      <?php endforeach; ?>
   </select><br>
   <button type="submit">Добавить книгу</button> 
</form>
