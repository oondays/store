<?php
require_once 'config.php'; // Подключаем файл конфигурации, содержащий настройки подключения к базе данных

// Функция для получения всех книг из базы данных
function getAllBooks() {
    global $pdo; // Используем глобальную переменную $pdo для доступа к объекту подключения к базе данных
    // Выполняем SQL-запрос для получения всех книг с информацией об авторах и категориях
    $stmt = $pdo->query("SELECT books.*, authors.first_name AS author_first_name, authors.last_name AS author_last_name, categories.name AS category_name 
                          FROM books 
                          JOIN authors ON books.author_id = authors.author_id 
                          JOIN categories ON books.category_id = categories.category_id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Возвращаем все результаты в виде ассоциативного массива
}
// Функция для получения книги по ее идентификатору
function getBookById($id) {
    global $pdo; // Используем глобальную переменную $pdo
    // Подготавливаем SQL-запрос для получения книги по ID с информацией об авторе и категории
    $stmt = $pdo->prepare("
        SELECT books.*, authors.first_name AS author_first_name, authors.last_name AS author_last_name, categories.name AS category_name 
        FROM books 
        LEFT JOIN authors ON books.author_id = authors.author_id 
        LEFT JOIN categories ON books.category_id = categories.category_id 
        WHERE books.book_id = :id
    ");
    $stmt->execute(['id' => $id]); // Выполняем запрос с привязкой параметра :id
    return $stmt->fetch(PDO::FETCH_ASSOC); // Возвращаем результат в виде ассоциативного массива
}
// Функция для создания новой книги в базе данных
function createBook($title, $description, $price, $author_id, $category_id) {
    global $pdo; // Используем глобальную переменную $pdo
    // SQL-запрос для вставки новой книги в таблицу books
    $sql = "INSERT INTO books (title, description, price, author_id, category_id) VALUES (:title, :description, :price, :author_id, :category_id)";
    if ($stmt = $pdo->prepare($sql)) { // Подготавливаем SQL-запрос
        // Привязываем переменные к параметрам запроса
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);
        return $stmt->execute(); // Выполняем запрос и возвращаем результат (true/false)
    }
    return false; // Если подготовка запроса не удалась, возвращаем false
}
// Функция для удаления книги по ее идентификатору
function deleteBook($id) {
    global $pdo; // Используем глобальную переменную $pdo

    if ($id) { // Проверяем, что ID передан
        try {
            // Подготавливаем SQL-запрос на удаление книги по ID
            if ($stmt = $pdo->prepare("DELETE FROM books WHERE book_id = :id")) {
                return ($stmt->execute(['id' => $id])); // Выполняем запрос и возвращаем результат (true/false)
            }
        } catch (PDOException $e) { // Обрабатываем исключения при выполнении запроса
            echo "Ошибка: " . htmlspecialchars($e->getMessage()); // Выводим сообщение об ошибке с защитой от XSS
            return false; // Возвращаем false в случае ошибки
        }
        
        return false;
    }
}
// Функция для получения всех авторов из базы данных
function getAllAuthors() {
    global $pdo; // Используем глобальную переменную $pdo
    return $pdo->query("SELECT * FROM authors")->fetchAll(PDO::FETCH_ASSOC); // Выполняем запрос и возвращаем все результаты в виде ассоциативного массива
}
// Функция для получения всех категорий из базы данных
function getAllCategories() {
    global $pdo; // Используем глобальную переменную $pdo
    return $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC); // Выполняем запрос и возвращаем все результаты в виде ассоциативного массива
}
?>
