<?php
session_start();
$firstname = $lastname = $email = '';
$score = 0;
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
// build a database named "TetrisDb"
$dbname = "TetrisDb";
$conn = new mysqli(localhost, root, orange00);  //please change "orange00" to your own password, thanks!
$sql = "CREATE DATABASE TetrisDb";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error. "<br>";
}

//select database
$conn->select_db("TetrisDb");

// create table
$sqltb = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
score INT(6)
)";
if ($conn->query($sqltb) === TRUE) {
    echo "Table MyGuests created successfully". "<br>";
} else {
    echo "Error creating table: " . $conn->error. "<br>";
}

// insert into table
$sqlinsrt = "INSERT INTO MyGuests (firstname, lastname, email,score)
VALUES ('John', 'Doe', 'john@example.com', 1200)";
$sqlinsrt2 = "INSERT INTO MyGuests (firstname, lastname, email,score)
VALUES ('Ahmed', 'smith', 'ahmed@example.com', 23980)";
$sqlinsrt3 = "INSERT INTO MyGuests (firstname, lastname, email,score)
VALUES ('Lu', 'Jun', 'jun@example.com', 100)";
$conn->query($sqlinsrt2);
$conn->query($sqlinsrt3);
if ($conn->query($sqlinsrt) === TRUE) {
    echo "New record created successfully"."<br>" ;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error. "<br>";
}

// show data in database
$sqlslct = "SELECT id, firstname, lastname, score FROM MyGuests";
$result = $conn->query($sqlslct);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " " . " - Score: ".$row["score"]."<br>";
    }
} else {
    echo "0 results";
}
?>
<button> <a href = "TetrisLogin.php">Login in to Game!</a></button>
</body>

