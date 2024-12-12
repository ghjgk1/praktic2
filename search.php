<?php
// Подключение к базе данных
$servername = "localhost"; // Имя сервера
$username = "root";        // Имя пользователя БД
$password = "";            // Пароль пользователя БД
$dbname = "Индивидуальная";       // Имя базы данных

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем параметр поиска из формы
    $search = $conn->real_escape_string($_POST['search']);

    // SQL-запрос для поиска книги
    $sql = "SELECT * FROM `Туры` WHERE `Страна` LIKE '%$search%' OR `Тип тура` LIKE '%$search%' OR `Продолжительность` LIKE '%$search%' OR `Стоимость` LIKE '%$search%'";
    $result = $conn->query($sql);

    // Проверяем, есть ли результаты
    if ($result->num_rows > 0) {
        /*while ($row = $result->fetch_assoc()) {
        echo "<script> 
        alert('\\nID: {$row["ID"]}\\nНаименование: {$row["Наименование"]}\\nАвтор: {$row["Автор"]}\\nЖанр: {$row["Жанр"]}\\nГод издания: {$row["Год_издания"]}\\nИздательство: {$row["Издательство"]}'); 
                    window.location.href = 'datawatch.html';
      </script>";
      exit();	}*/		
        // Выводим данные о книгах
        echo "<h2>Результаты поиска:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Номер</th>
                    <th>Страна</th>
                    <th>Тип тура</th>
                    <th>Продолжительность</th>
                    <th>Стоимость</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ID"] . "</td>
                    <td>" . $row["Страна"] . "</td>
                    <td>" . $row["Тип тура"] . "</td>
                    <td>" . $row["Продолжительность"] . "</td>
                    <td>" . $row["Стоимость"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Тур не найден.</p>";
    }
}

// Закрываем подключение
$conn->close();
?>