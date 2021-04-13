<!DOCTYPE html>
<html>
  <head>
    <title>Plan for Smart Service : Sign Up</title>
  </head>
  <body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    if(isset($_POST['signup'])){
      try {
          $conn = new mysqli($servername, $username, $password);

          }
      catch(PDOException $e)
          {

          }

      $sql = "CREATE DATABASE userdb";
      if($conn->query($sql) == TRUE){
        echo "Database created";
      }

      $sql = "USE userdb";
      if(mysqli_query($conn,$sql)){
        echo "database selected : userdb";
      }else{
        echo "Error Selecting Database: " . mysqli_error($conn);
      }

      $sql = "CREATE TABLE Userdata (
      userid INT(6) UNSIGNED AUTO_INCREMENT UNIQUE,
      fname VARCHAR(255) NOT NULL,
      lname VARCHAR(255) NOT NULL,
      email VARCHAR(255) NOT NULL,
      pass VARCHAR(255) NOT NULL,
      pnum VARCHAR(255) NOT NULL,
      addy VARCHAR(255) NOT NULL
      )";

      if (mysqli_query($conn, $sql)) {
        echo "Users created successfully";
      }

      $fname = $_POST['fname'] ?? "";
      $lname =  $_POST['lname'] ?? "";
      $email = $_POST['email'] ?? "";
      $passw = $_POST['pass'] ?? "";
      $pnum = $_POST['pnum'] ?? "";
      $addy = $_POST['addy'] ?? "";

      $dsn = 'mysql:dbname=userdb;host=localhost';
      $user = 'root';
      $pass = '';

      $pdo = new PDO($dsn,$user,$pass);
      $sql = "INSERT INTO  userdata(fname,lname,email,pass,pnum,addy)
               VALUES(?,?,?,?,?,?)";
      $smt = $pdo->prepare($sql);
      $smt->execute(array($fname,$lname,$email,md5($passw),$pnum,$addy)); //execute the query


      mysqli_close($conn);

      header("Location: testing.php");
    }
    ?>

    <div>
      <form action=signup.php method="post">
      <label for="fname">First Name:</label>
      <input type="text" name="fname"><br><br>
      <label for="lname">Last Name:</label>
      <input type="text" name="lname"><br><br>
      <label for="email">Email:</label>
      <input type="text" name="email"><br><br>
      <label for="pass">Password:</label>
      <input type="text" name="pass"><br><br>
      <label for="pnum">Phone Number:</label>
      <input type="text" name="pnum"><br><br>
      <label for="addy">Address:</label>
      <input type="text" name="addy"><br><br>
      <input type="submit" name="signup" value="signup">
      </form>
    </div>

  </body>
</html>
