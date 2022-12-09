<?php

$action = $_POST['action'];
if ($action == "CREATE") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    require_once 'Person.php';

    $person = new Person($name, $email);
    if ($person->validatePerson()) {
        if (store($person)) {
            echo $person->name . ' se ha registrado con éxito!';
            header('Refresh: 3; URL=.');
        } else {
            echo 'Email en uso, volver a intentar';
        }
    } else {
        echo 'Registro inválido. Volver a intentar';
    }

} else if ($action == "READ") {
    $list = getList();
    if ($list->num_rows > 0) {
        echo '<table border>';
        echo '<tr>';
        echo '<th>Nombre</th><th>Email</th>';
        echo '</tr>';
        while($row = $list->fetch_assoc()) {
          echo '<tr>';
          echo "<td>" . $row["Name"] . "</td>";
          echo "<td>" . $row["Email"] . "</td>";
          echo '</tr>';
        }
        echo '</table>';
    } else {
       echo "No hay personas registradas aún.";
    }
} else {
    header('Refresh: 0; URL=.');
}


function getConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "n0m3l0";
    $dbname = "moya";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}

function store($person) {
    $conn = getConnection();
    try {
        return ($conn->query("INSERT INTO Persons (Name, Email) VALUES ('$person->name', '$person->email')") === TRUE);
    } catch (Exception $e) {
        return False;
    }
}

function getList() {
    $conn = getConnection();
    return $conn->query("SELECT * FROM Persons");
}
?>