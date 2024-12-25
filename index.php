<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8"> 
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
   <title>Document</title>
</head>
<body>
   <?php
   session_start();
   // Проверяем, вошел ли пользователь в систему
   if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
      header("location: login.php"); 
      exit; 
   }
   require_once '../functions.php'; // Подключаем файл с функциями для работы с книгами
   $books = getAllBooks(); // Получаем список всех книг из базы данных
   ?>
   <h1>Управление книгами</h1> 
   <a href="add_book.php"><button type="button" id="my-btn" class="btn btn-dark">Добавить книгу</button></a>
   <a href="logout.php"><button type="button" id="my-btn" class="btn btn-dark">Выйти из аккаунта</button></a>
   <table border='1'> 
   <tr>
       <th>Название</th> 
       <th>Автор</th> 
       <th>Категория</th> 
       <th>Цена</th> 
       <th>Удалить</th> 
   </tr>
   <?php foreach ($books as $book): ?> <!-- Цикл по всем книгам -->
   <tr>
       <td><?= htmlspecialchars($book['title']) ?></td> <!-- Название книги с защитой от XSS -->
       <td><?= htmlspecialchars($book['author_first_name'] . ' ' . htmlspecialchars($book['author_last_name'])) ?></td> <!-- Имя и фамилия автора с защитой от XSS -->
       <td><?= htmlspecialchars($book['category_name']) ?></td> <!-- Название категории с защитой от XSS -->
       <td><?= htmlspecialchars($book['price']) ?> руб.</td> <!-- Цена книги с защитой от XSS и указанием валюты -->
       <td>
        <a href="delete_book.php?id=<?= htmlspecialchars($book['book_id']) ?>">Удалить</a><!-- Ссылки на удаление книги, с передачей ID книги в URL -->
       </td>
   </tr>
   <?php endforeach; ?>
   </table>
</body>
</html>
