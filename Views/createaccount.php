<?php

//echo "login";
include("include/header.php");
//var_dump($data);

?>

<body>

<h1>Paddle Game</h1>
<form id="login-form" action="createUser" method="post">
<h2>New User</h2>
    <p class="errormsg"><?php echo $data['error']; ?></p>
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>
      
    <label for="psw"><b>Retype Password</b></label>
    <input type="password" placeholder="Enter Password again" name="repassword" required>
      
    <label for="psw"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
      <input hidden type="hidden" name="newuser" value="newuser"> 
    <button id="login-btn" type="submit">Create User</button>
  </div>

  <div class="container">
      <span class="psw"><a href="login">Login</a></span>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

</body>