<?php
include("../config/db.php");

if(isset($_POST['register'])){
  $name  = $_POST['name'];
  $email = $_POST['email'];
  $pass  = password_hash($_POST['password'],PASSWORD_DEFAULT);

  mysqli_query($con,
    "INSERT INTO users(name,email,password)
     VALUES('$name','$email','$pass')"
  );

  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="auth-container">
  <div class="auth-box">
    <form method="post">
      <h2>Register</h2>
      <input name="name" required placeholder="Name">
      <input name="email" type="email" required placeholder="Email">
      <input name="password" type="password" required placeholder="Password">
      <button name="register">Register</button>
    </form>
  </div>
</div>

</body>
</html>
