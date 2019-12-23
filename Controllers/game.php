<?php 

class game extends Controller{
    
    public function __construct($action = null){
        
        if(!isset($_SESSION['user'])){
           
            header("Location: http://localhost/racer/account/");
            exit();
        }
        
        $this->model = new gameM();
        
        if(method_exists($this, $action)){
            $this->$action();
        }else{
            header("Location: http://localhost/racer/game/");
            exit();
        }
        
      //  $this->index();
    }
    public function index(){
        $data = [
                "css" => ["../css/test.css"],
                "js" => "js"
            ];
         $this->loadView("game",$data);
    }
    public function highscore(){
         $scores = $this->model->getScores();
            $data = [
                "css" => ["../css/test.css"],
                "js" => "js",
                "scores" => $scores
            ];
        
         $this->loadView("highscore",$data);
    }
    public function addScore(){
        $score = $_POST['score'] ?? "test";
        $uid = $_SESSION['user'];
         echo $score;
        if($score){
            $this->model->addScore($score, $uid);
        }
       
         
    }
   
}

?>