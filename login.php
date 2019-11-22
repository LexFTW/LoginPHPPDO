<?php

    try {
      $pdo = new PDO("mysql:host=localhost;dbname=login", "alexis", "1234");

      $consulta = "SELECT * FROM users WHERE username ='".$_POST['username']."' && password=SHA2('".$_POST['password']."', 512);";

      unset($query);
      $query = $pdo->prepare($consulta);

      $query->execute();

      $registre = $query->fetch();

      while ($registre) {
        echo 'Bienvenido, ' . $registre['name'];
        $registre = $query->fetch();
      }
    } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
    }

 ?>
