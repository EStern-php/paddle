<?php

include("include/header.php");

?>

<body>

<h1>Paddle Game</h1>

<h2>Game</h2>
    <a class="otherlink" href="<?php echo APP_PATH ?>/game/highscore"> Highscore</a>
    <div id="content">
    <p class="errormsg"><?php echo $data['error'] ?? ""; ?></p>
        
  <div class="container">
      <button id="startgame-btn">Start Game</button>
  </div>

  <div class="container">
      <canvas id="gx" width="480" height="320"></canvas>
      <script>
        $("#startgame-btn").click(function(){
              c=document.getElementById("gx");
            cc=c.getContext('2d');
            document.addEventListener("keydown", keyDownHandler, false);
          document.addEventListener("keyup", keyUpHandler, false);
            var interval = setInterval(update,10);
          var score = 0;
          var x = c.width/2;
          var y = c.height -30;
          var dx = 2;
          var dy = -2;
          var ballRadius = 10;
          var paddleHeight = 10;
          var paddleWidth = 75;
          var paddleX = (c.width-paddleWidth) / 2;
          var rightPressed = false;
          var leftPressed = false;
          var brickRowCount = 3;
          var brickColumnCount = 5;
          var brickWidth = 75;
          var brickHeight = 20;
          var brickPadding = 10;
          var brickOffsetTop = 30;
          var brickOffsetLeft = 30;
          var bricks = [];
          
          
        function createBricks(){
           for(var cu=0;cu<brickColumnCount;cu++){
              bricks[cu] = [];
              for(var r=0; r<brickRowCount; r++){
                  bricks[cu][r] = {x:0,y:0,status:1};
              }
          } 
        }
          
        function keyDownHandler(e){
            if(e.key == "Right" || e.key == "ArrowRight"){
                rightPressed = true;
            }else if (e.key == "Left" || e.key == "ArrowLeft"){
                leftPressed = true;          
            }
        }
        function keyUpHandler(e){
            if(e.key == "Right" || e.key == "ArrowRight"){
                rightPressed = false;
            }else if (e.key == "Left" || e.key == "ArrowLeft"){
                leftPressed = false;          
            }        
        }
          
        function drawBall(){
            cc.beginPath();
            cc.arc(x,y,ballRadius,0, Math.PI*2);
            cc.fillStyle = "#0095DD";
            cc.fill();
            cc.closePath();
        }
        function drawPaddle() {
            
            cc.beginPath();
            cc.rect(paddleX, c.height-paddleHeight, paddleWidth, paddleHeight);
            cc.fillStyle = "#0095DD";
            cc.fill();
            cc.closePath();
           
           
        }
        function drawBricks(){
            for(var cu=0; cu < brickColumnCount; cu++){
                for(var r=0; r<brickRowCount; r++){
                    if(bricks[cu][r].status == 1){
                        var brickX = (cu*(brickWidth+brickPadding))+brickOffsetLeft;
                        var brickY = (r*(brickHeight+brickPadding))+brickOffsetTop;
                       
                        bricks[cu][r].x = brickX;
                        bricks[cu][r].y = brickY;
                        cc.beginPath();
                        cc.rect(brickX,brickY,brickWidth,brickHeight);
                        cc.fillStyle = "#0095DD";
                        cc.fill();
                        cc.closePath();
                    }
                       
                    
                    
                }
            }
        }
          function drawScore(){
              cc.font = "16px Arial";
              cc.fillStyle = "#0095DD";
              cc.fillText("Score: " +score, 8,20);
          }
          function collisionDetection() {
            for(var cu=0; cu<brickColumnCount; cu++) {
                for(var r=0; r<brickRowCount; r++) {
                    var b = bricks[cu][r];
                    if(b.status == 1) {
                        if(x > b.x && x < b.x+brickWidth && y > b.y && y < b.y+brickHeight) {
                            dy = -dy;
                            b.status = 0;
                            score++;
                        }
                    }
                }
            }
        }
        function checkBrickStatus(){
            for(var cu=0; cu<brickColumnCount; cu++) {
                for(var r=0; r<brickRowCount; r++) {
                    var b = bricks[cu][r];
                    if(b.status == 1) {
                        return true;
                        break;
                    }
                }
            }
             for(var cu=0; cu<brickColumnCount; cu++) {
                for(var r=0; r<brickRowCount; r++) {
                    var b = bricks[cu][r];
                    b.status = 1;
                }
            }
        }
        
        createBricks();
      
        function update(){
            cc.clearRect(0,0,c.width,c.height);
            drawBricks();
            drawBall();
            drawPaddle();
            collisionDetection();
            drawScore();
            checkBrickStatus()
            x += dx;
            y += dy;
            if(x + dx > c.width-ballRadius || x + dx < ballRadius) {
                dx = -dx;
            }
            if(y + dy < ballRadius) {
                dy = -dy;
            }else if(y+dy > c.height-ballRadius){
                if(x > paddleX && x < paddleX + paddleWidth) {
                    dy = -dy;
                }else{
                    
                    $.ajax({
                        type: "POST" ,url: "<?php echo APP_PATH; ?>/game/addscore/", data: {score:score}, success: function(result){
                            console.log(result);
                            alert("GAME OVER");
                        }
                    })
                     
                    document.location.reload();
                    clearInterval(interval);
                }
            }
            if(rightPressed) {
                paddleX += 7;
                if (paddleX + paddleWidth > c.width){
                    paddleX = c.width - paddleWidth;
                }
            }
            else if(leftPressed) {
                paddleX -= 7;
                if (paddleX < 0){
                    paddleX = 0;
                }
            }
        }
        });
          
      </script>
  </div>
</div>
</body>