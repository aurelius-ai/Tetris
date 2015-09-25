
<?php
$firstname = $lastname = $email = '';
$score = 0;
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="tetriscss.css">
</head>
<body onload = "buildMap()">
  <script type="text/javascript" src="Tetris.js" ></script>
<h1>Tetris</h1>
<div id="outer">
  
  <div id="playconsole">
  </div>
  <div id="next">
    <button id = 'start' onclick="start()" id='start'>Start</button>
    <button id  = "pause" onclick="pause()">Pause</button>
    <button id = 'help' onclick="help()">Help</button>
  </div>
  <div id="score1">
   Score: 0
  </div>
</div>
<?php
$dbname = "TetrisDb";
$conn = new mysqli(localhost, root, orange00,$dbname);
//echo $_POST["firstname"];
// insert user information from "login" page into database
if(!$_POST['score'])
{
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"]; 
  $email = $_POST["email"];

  $sqlinsrt = "INSERT INTO MyGuests (firstname, lastname, email,score)
  VALUES ('$firstname', '$lastname', '$email', 0)";

  if ($conn->query($sqlinsrt) === TRUE) {
      echo "New record created successfully"."<br>" ;
    } else {
     echo "Error: " . $sql . "<br>" . $conn->error. "<br>";
    }
}else{
  $score = $_POST["score"];
  $sqlupdate = "UPDATE MyGuests SET score=$score WHERE id = 4";
  if ($conn->query($sqlupdate) === TRUE) {
      echo "Record updated successfully"."<br>";
  } else {
     echo "Error updating record: " . $conn->error;
  }
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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Plese enter your score: <input type="number" name="score">
  <input type="submit" value="Submit">
   
</from>




</body>

</html>