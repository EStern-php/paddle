<?php

include("include/header.php");

?>

<body>

<h1>Paddle Game</h1>
<form id="login-form" action="login" method="post">
<h2>Login</h2>
     <p class="errormsg"><?php echo $data['error'] ?? ""; ?></p>
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button id="login-btn" type="submit">Login</button>
  </div>

  <div class="container">
      <span class="psw"><a href="<?php echo APP_PATH ?>/Account/createUser">Create new Account?</a></span>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

</body>