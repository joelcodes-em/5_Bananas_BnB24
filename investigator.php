<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $loginid = $_POST['loginid'];
   $loginid = filter_var($loginid, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `investi` WHERE loginid = ? AND password = ?");
   $select_user->execute([$loginid, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
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
   
<!-- header section starts  -->
<?php include 'header.php'; ?>
<!-- header section ends -->

<section class="form-container">
    <style>
        .form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

form {
  max-width: 300px;
  padding: 20px;
  border-radius: 10px;
  background-color: #f4f4f4;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h3 {
  font-size: 24px;
  margin-bottom: 20px;
  text-align: center;
  color: #333; /* Text color */
}

.box {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  color: #555; /* Text color */
}

.btn {
  width: 100%;
  padding: 10px;
  margin-top: 15px;
  border: none;
  border-radius: 5px;
  background-color: #007bff;
  color: #fff; /* Text color */
  cursor: pointer;
}

.btn:hover {
  background-color: #0056b3;
}

p {
  text-align: center;
  color: #666; /* Text color */
}

a {
  color: #007bff;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
</style>

   <form action="dashboard.php" method="post">
      <h3>Investigator Login </h3>
      <input type="text" name="loginid" required placeholder="Login ID" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login" name="submit" class="btn">
   </form>

</section>


</body>
</html>