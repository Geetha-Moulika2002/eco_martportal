<?php
include("../config/db.php");

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $pass  = $_POST['password'];

  $res = mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
  $row = mysqli_fetch_assoc($res);

  if(password_verify($pass,$row['password'])){
    $_SESSION['user'] = $row;
    if($row['role']=="admin")
      header("Location: ../admin/dashboard.php");
    else
      header("Location: ../user/dashboard.php");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="auth-container">
  <div class="auth-box">
    <form method="post">
      <h2>Login</h2>
      <input name="email" type="email" required placeholder="Email">
      <input name="password" type="password" required placeholder="Password">
      <button name="login">Login</button>
    </form>
  </div>
</div>

</body>
</html>
