<?php
$hostName = "securepassword";
$userName = "asouser";
$password = "securepassword";
$dbName = "aso_practice";
$conn = new mysqli($hostName, $userName, $password, $dbName);
if ($conn) {
  echo "connected";
} else {
  echo "not connected";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo list</title>
</head>

<body>
  <style>
    * {
      margin: 0px;
      padding: 0px;
    }
  </style>
  <header></header>
  <main>
    <h2>To Do List App</h2>
    <form action="todolist.php">
      <div>
        <label for="title">title:</label>
        <input name="title" type="text" placeholder="title">
      </div>
      <div>
        <label for="description">description:</label>
        <input name="description" type="text" placeholder="description">
      </div>
      <div>
        <button type="submit" name="submit" id=add_btn></button>
      </div>
    </form>
  </main>
  <footer>
    <h4>
      Autors:
    </h4>
    <ul>
      <li>Willy Samuel Paz Colque</li>
      <li>Compañero 1</li>
      <li>Compañero 2</li>
    </ul>
  </footer>
</body>

</html>