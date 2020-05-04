<!DOCTYPE html>
<html>
<head>
<title>Paddle</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php
    if(isset($_SESSION['user'])){
       echo '<a href='.APP_PATH.'/account/logout/>Logout</a>';
   }
    if(isset($data['css'])){
    foreach($data['css'] as $css){
        
        echo '<link rel="stylesheet" type="text/css" href="'.$css.'">';
    }
} 
    
   
 
    
?>

</head>