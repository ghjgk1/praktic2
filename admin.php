<?php
$servername = "127.0.0.1";
$username = "root";
$password = ""; 
$dbname = "Индивидуальная";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $country = $_POST['country'];
    $type = $_POST['type'];
    $duration = $_POST['duration']; 
    $price = $_POST['price'];

    $sql = "INSERT INTO `Туры`(`Страна`, `Тип тура`, `Продолжительность`, `Стоимость`) 
    VALUES ('$country','$type','$duration','$price')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script> 
            alert('Тур добавлен успешно!'); 
				window.location.href = 'admin_dashboard.html';
			exit();			
          </script>";
        } else {
			echo "<script> 
            alert('Ошибка при вставке: ' . $conn->error;); 
            window.location.href = 'admin_dashboard.html'; 
          </script>";
        }    
}
$conn->close();
?>