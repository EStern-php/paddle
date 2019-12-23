<?php

//echo "login";
include("include/header.php");
//var_dump($data);

?>

<body>

<h1>Paddle Game</h1>

<h2>Highscore</h2>
    <a class="otherlink" href="index"> Game</a>
    <div id="content">
    <p class="errormsg"><?php echo $data['error'] ?? ""; ?></p>
  <div class="container containerhighscore">
      <?php
        echo '<div class="h3"><h3 class="h3-name">Name</h3><h3 class="h3-score">Score</h3></h3></div>';
        $rowclass = "container-row";
        $row = 0;
        foreach($data['scores'] as $scores){
            
            if($row % 2 == 0){
                $rowclass = "container-row-grey";
            }else{
                $rowclass = "container-row";
            }
            echo '<div class="'.$rowclass.'">';
            echo '<p class="name-score">';
            echo $scores['name'];
            echo '<span class="highscore">';
            echo $scores['highscore'];
            echo '</span>';
            echo '</p>';
            echo '</div>';
            $row++;
            
        }
      
      ?>

  </div>

  <div class="container">

  </div>
</div>
</body>