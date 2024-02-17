<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ?");
   $select_user->execute([$username]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'username already exists';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(username, password) VALUES(?,?)");
         $insert_user->execute([$username, $cpass]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND password = ?");
         $select_user->execute([$username, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      }
   }

}

?>
<!DOCTYPE html>
<html>
<head>
    
	<title>Bananas Portal</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
</head>
<body>
   
<?php include 'header.php'; ?>


<section class="form-container">
<div class="main-block">
    <style>
        .form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.main-block {
  max-width: 400px;
  padding: 10px;
  border-radius: 10px;
  background-color: #f4f4f4;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
  text-align: center;
  color: black;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  color:black;
  
}

.btn {
  width: 100%;
  padding: 10px;
  margin-top: 15px;
  border: none;
  border-radius: 5px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

.btn:hover {
  background-color: #0056b3;
}

p {
  text-align: center;
  color:black;
}

a {
  color: black;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
</style>

   <form action="" method="post">
      <h1>Register</h1>
      <label id="icon" for="name"><i class="fas fa-user"></i></label>
      <input type="text" name="username" required placeholder="Username" class="box" maxlength="50">
      <label id="icon" for="name"><i class="fas fa-user"></i></label>
      <input type="text" name="number" required placeholder="enter your number" class="box" min="0" max="9999999999" maxlength="10">
      <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
      <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
      <input type="password" name="cpass" required placeholder="confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Register" name="submit" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>


</body>
</html>














