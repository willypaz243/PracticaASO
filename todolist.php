<!DOCTYPE html>
<html lang="en">

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

    .container {
      background-color: aliceblue;
      display: flex;
      align-items: center;
      flex-direction: column;
    }

    .content {
      margin: 10px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      flex-direction: column;
      padding: 1rem;
      background-color: #303d4a;
      min-height: 80vh;
      min-width: 80vh;
      align-items: center;
      color: aliceblue;
    }

    .title {
      padding: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    .form-field {
      padding: 1rem;
    }

    .btn {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .btn button {
      width: 100px;
      height: 40px;
      background-color: rgb(0, 115, 255);

    }

    .column {
      padding: 5px 10px;
    }

    .delete-btn {
      background-color: rgb(173, 21, 21);
      color: antiquewhite;
      padding: 5px 7px;
    }
  </style>
  <main>
    <section class="container">
      <div class="content">
        <div class="title">
          <h2>To Do List App</h2>
        </div>
        <form method="POST" action="add_task.php">
          <div class="form-field">
            <div>
              <label for="title">Title</label>
            </div>
            <input name="title" type="text" placeholder="title">
          </div>
          <div class="form-field">
            <div>
              <label for="description">Description:</label>
            </div>
            <textarea name="description" id="" cols="30" rows="5"></textarea>
          </div>
          <div class="form-field btn">
            <button type="submit" name="submit" id=add_btn> save </button>
          </div>
        </form>
        <table>
          <thead>
            <tr>
              <th class="column">ID</th>
              <th class="column">title</th>
              <th class="column">description</th>
              <th class="column">created_at</th>
              <th class="column">updated_at</th>
              <th class="column">actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require 'conn.php';
            $query = $conn->query("SELECT * FROM `todolist` ORDER BY `id` ASC");
            while ($row = $query->fetch_array()) {
            ?>
            <tr>
              <td class="column">
                <?php echo $row['id'] ?>
              </td>
              <td class="column">
                <?php echo $row['title'] ?>
              </td>
              <td class="column">
                <?php echo $row['description'] ?>
              </td>
              <td class="column">
                <?php echo $row['created_at'] ?>
              </td>
              <td class="column">
                <?php echo $row['updated_at'] ?>
              </td>
              <td class="column">
                <form action="delete_task.php">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <button type="submit" class="delete-btn">Delete</button>
                </form>
              </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>

    </section>

  </main>
  <footer style="padding: 20px 50px;">
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