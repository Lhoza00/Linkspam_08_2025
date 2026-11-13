<?php 
class Login{
    private $error = "";
    private $DB;

    public function __construct($DB) {
        $this->DB = $DB;
    }
    public function evaluate($data){
        $userName = trim($data['userName']);
        $userPassword = trim($data['userPassword']);
        if (isset($userName) && isset($userPassword)) {
            $sqlUserDetails = "SELECT * FROM userdetails WHERE userName = ? LIMIT 1";
            $result = $this->DB->read($sqlUserDetails, [$userName]);
            if($result){
                $row = $result[0];
                $PasswordVerified = password_verify($userPassword, $row["userPassword"]);
                if($PasswordVerified){
                    //$this->error .= "successfil";
                    $_SESSION['myuserId'] = $row['userID'];
                    header("Location: Profile.php?username=" . $userName);
                    exit;
                }else{
                    $this->error .= "Incorrect Username or Password</br>";
                }
            }else{
                $this->error .= "Database error. Please try again later.<br>";
            }
        }
        return $this->error;
    }

    public function checkLogin($userId){
        if(!empty($userId)){
            $sqlCheckLogged = "SELECT * FROM userStats WHERE userId = ? LIMIT 1";
            $result = $this->DB->read($sqlCheckLogged, [$userId]);
            if($result){
                $user_data = $result[0];
                return $user_data;
            }else{
                header("Location: Logout.php");
                exit; 
            }
        }else{
            header("Location: Logout.php");
            exit; 
        }
    }

     public function checkData($userId){
        if(!empty($userId)){
            $sqlCheckLogged = "SELECT * FROM userdetails WHERE userId = ? LIMIT 1";
            $result = $this->DB->read($sqlCheckLogged, [$userId]);
            if($result){
                $user_data = $result[0];
                return $user_data;
            }else{
                return false; 
            }
        }else{
            header("Location: Logout.php");
            exit; 
        }
    }

}
?>