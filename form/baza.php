<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formularze";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$dataUrodzenia = $_POST['data-urodzenia'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$wojewodztwo = $_POST['wojewodztwo'];
$plec = $_POST['plec'];
$zgoda = isset($_POST['zgoda']) ? 1 : 0;

$imie = $conn->real_escape_string($imie);
$nazwisko = $conn->real_escape_string($nazwisko);
$dataUrodzenia = $conn->real_escape_string($dataUrodzenia);
$email = $conn->real_escape_string($email);
$telefon = $conn->real_escape_string($telefon);
$wojewodztwo = $conn->real_escape_string($wojewodztwo);
$plec = $conn->real_escape_string($plec);

$checkWojewodztwo = "SELECT * FROM wojewodztwa WHERE nazwa = '$wojewodztwo'";
$result = $conn->query($checkWojewodztwo);

if ($result->num_rows == 0) {
    $addWojewodztwo = "INSERT INTO wojewodztwa (nazwa) VALUES ('$wojewodztwo')";
    $conn->query($addWojewodztwo);
}

$sql = "INSERT INTO dane_uzytkownika (imie, nazwisko, data_urodzenia, email, telefon, wojewodztwo, plec, zgoda_newsletter)
        VALUES ('$imie', '$nazwisko', '$dataUrodzenia', '$email', '$telefon', '$wojewodztwo', '$plec', '$zgoda')";

if ($conn->query($sql) === TRUE) {
    echo "Dane zostały zapisane pomyślnie";
} else {
    echo "Błąd podczas zapisu danych: " . $conn->error;
}

$conn->close();
?>