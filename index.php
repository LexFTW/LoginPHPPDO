<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
      <div class="card mt-4">
        <div class="card-body">
          <form action="index.php" method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
    // var_dump($_POST);
    if(isset($_POST['username'])){
      try {
        $pdo = new PDO("mysql:host=localhost;dbname=login", "alexis", "1234");

        $consulta = "SELECT * FROM users WHERE username ='".$_POST['username']."' && password=SHA2('".$_POST['password']."', 512);";

        unset($query);
        $query = $pdo->prepare($consulta);

        $query->execute();

        $registre = $query->fetch();

        if(!$registre){
            echo '<div class="container">' .
            '<div class="card mt-4 alert-danger">' .
            '<div class="card-body">' .
            '<h2>Usuario y/o contraseña incorrectos<h2>' .
            '</div>' .
            '</div>' .
            '</div>';
        }else{
          while ($registre) {
            echo '<div class="container">' .
            '<div class="card mt-4">' .
            '<div class="card-body">' .
            '<h2>Bienvenido, ' . $registre['name'] . '<h2>' .
            '</div>' .
            '</div>' .
            '</div>';
            $registre = $query->fetch();
          }
        }

      } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
      }
    }

 ?>
