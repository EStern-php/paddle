<?php 


class account extends Controller{
    
    public function __construct($action){
       
        $this->model = new accountM();
        if(method_exists($this, $action)){
            $this->$action();
        }else{
            echo "logout";
           
            header("Location: http://localhost/racer/account/");
            exit();
        }
        
        if(isset($_SESSION['user'])){
            echo "inloggad";
            if($action == "logout"){
                echo "logout";
            }else{
                header("Location: http://localhost/racer/game/");
                exit();
            }
            
        }
        
        
        $this->$action();
    }
    
    public function index(){
        
        if(isset($_SESSION['user'])){
            //om man är inloggad så redirecta till game.php så den controllern tar över.
            echo "inloggad";
            header("Location: http://localhost/racer/game/");
            exit();
        }else{
            $data = [
                "css" => ["css/test.css"],
                "js" => "js"
            ];
            
            $this->loadView("login",$data);
           // echo"sekl";
        }
        
       // echo "view";
    }
    public function logout(){
        unset ($_SESSION["user"]);
        $data = [
                "css" => ["../css/test.css"],
                "js" => "js",
                "error" => "You have been logged out."
            ];
            
        $this->loadView("login",$data);
    }
    public function createUser(){
        //Kolla om newuser är satt och försök i så fall skapa ny user. Annars visas bara vyn.
        $errormsg = "";
        if(isset($_POST['newuser'])){
            //Kollar bara så de båda fälten för lösenord stämmer. Stämmer det inte så får man ett felmeddelande. Borde byggas in fler kontroller på t.ex. längd.
            if($_POST['pass'] == $_POST['repassword']){
                var_dump($_POST['pass']);
                
                $pass = $this->model->hashPass($_POST['pass']);
                $dbData = [];
                $dbData['name'] = $_POST['username'];
                $dbData['pass'] = $pass;
                $dbData['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $user = $this->model->createNewUser($dbData);
                if($user == true){
                    $errormsg = "New user created. Please login.";
                }else{
                     $errormsg = "Something went wrong we. Please try again.";
                }
            }else{
                $errormsg = "Your password don't match";
            }
        }
        $data = [
                "css" => ["../css/test.css"],
                "js" => "js",
                "error" => $errormsg
            ];
        
        $this->loadView("createaccount", $data);   
    }
    public function login(){
         $errormsg = "";
       
        if(isset($_POST['username']) && isset($_POST['password']) ){

            $userid = $this->model->checkPass($_POST['username'], $_POST['password']);
           
            if($userid != false){
                $this->model->loginUser($userid);
                 var_dump($_SESSION['user']);
      
                 header("Location: http://localhost/racer/game/");
                exit();
              
                
            }else{
                $errormsg = "Couldn't log in. Try again.";
            }
        }
        $data = [
                "css" => ["../css/test.css"],
                "js" => "js",
                "error" => $errormsg
            ];
        
        $this->loadView("login",$data);
    }
}

?>