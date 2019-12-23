<?php



class gameM extends Model{
  
    
    public function getScores(){
        $stmt = $this->db->prepare("SELECT highscore.highscore, users.name FROM highscore LEFT JOIN users ON highscore.uid = users.uid ORDER by highscore DESC LIMIT 10");
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }
    public function addScore($score, $uid){
        $stmt = $this->db->prepare("INSERT INTO highscore (highscore,uid) VALUES (:score,:uid)");
        $stmt->bindValue(":score", $score);
        $stmt->bindValue(":uid", $uid);
        $stmt->execute();
    }

    
}

?>