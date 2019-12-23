<?php



class accountM extends Model{
  
    
    public function hashpass($pass){
        
        //simple password_hash för att kryptera lösenord.
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        return $pass;
    }
    public function createUid(){
        
        //skapar en unik sträng för id i databas och för att skapa en temporär reset_code
        $uid = md5(uniqid(rand(), true));
        return $uid;
    }
    public function createNewUser($data){
        $stmt = $this->db->prepare("INSERT INTO users (uid,name,pass,email) VALUES (:uid,:name,:pass,:email)");
        $stmt->bindValue(':uid',$this->createUid());
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':pass', $data['pass']);
        $stmt->bindValue(':email', $data['email']);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function checkPass($name,$pass){
        $stmt = $this->db->prepare("SELECT pass,uid FROM users WHERE name = :name");
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        $res = $stmt->fetch();
        if(password_verify($pass,$res['pass'])){
            return $res['uid'];
        }else{
            return false;
        }
    }
    public function loginUser($uid){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE uid = :uid");
        $stmt->bindValue(":uid", $uid);
        $stmt->execute();
        $res = $stmt->fetch();
        if($res){
           // var_dump($res);
            
            $_SESSION['user'] = $uid;
            
            return $res;
        }
        
    }
    
}

?>