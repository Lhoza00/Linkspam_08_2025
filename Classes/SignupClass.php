<?php
class Signup {
    private $error = "";
    private $DB;  

    public function __construct($DB) {
        $this->DB = $DB;
    }
    public function evaluate($data) {
        $requiredFields = ['userName', 'fullName', 'userEmail', 'userPhoneNumber', 'userPassword', 'subType'];
        $excludeKeys = ['btnSignIn'];

        foreach ($data as $key => $value) {
            if (in_array($key, $excludeKeys)) continue;
            if (in_array($key, $requiredFields) && empty(trim($value))) {
                $this->error .= ucfirst($key) . " is empty!<br/>";
            }
        }
        // Validate password strength
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $data['userPassword'])) {
            $this->error .= "Password must be at least 8 characters and include uppercase, lowercase, and a number.";
        }

        if ($this->error === "") {
            $this->checkUniqueness($data);
            if($this->error === ""){
                $this->create_user($data);
            }else{
                return $this->error;
            }  
        }
        return $this->error;
    }

    private function checkUniqueness($data) {
        $userName = trim($data['userName']);
        if(!empty($userName)) {
            $usernameCheck = $this->DB->read("SELECT userName FROM userdetails WHERE userName = ?", [$userName]);
            if(!empty($usernameCheck)) {
                $this->error .= "Account already exists with the provided username<br/>";
                return $this->error;
            }
        }

        $userEmail = trim($data["userEmail"]);
        if (!empty($userEmail)) {
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                $this->error .= "Invalid email format.<br/>";
            }
            $emailCheck = $this->DB->read("SELECT userEmail FROM userdetails WHERE userEmail = ?",[$userEmail]);
            if(!empty($emailCheck)) {
                $this->error .= "Account already exists with the provided email.<br/>";
                return $this->error;
            }
        }

        $userPhoneNumber = trim($data["userPhoneNumber"]);
        if(!empty($data['userPhoneNumber'])){
            $phoneCheck = $this->DB->read("SELECT userPhoneNumber FROM userdetails WHERE userPhoneNumber = ?",[$userPhoneNumber]);
            if (!empty($phoneCheck)) {
                $this->error .= "Account already exists with the provided phone number.<br/>";
                return $this->error;
            }
        }
        
       // Validate payment card number
       /* $cleanCard = preg_replace('/\D/', '', $data["paymentCardNumber"]);
        if (!ctype_digit($cleanCard) || strlen($cleanCard) !== 16) {
            $this->error .= "Payment Card Number must be 16 digits.<br/>";
        }

        // Validate expiration (MMYY or MM/YYYY format assumed)
        $expiry = $data["paymentExp"];
        $current = (int)date("Ym");
        if (strlen($expiry) === 4) {
            $expYear = substr($expiry, 2, 2);
            $expMonth = substr($expiry, 0, 2);
            $expDate = (int)('20' . $expYear . $expMonth);
        } else {
            $expDate = (int)$expiry; // fallback, ideally validate more strictly
        }

        if ($expDate < $current) {
            $this->error .= "Card has expired.<br/>";
            return $this->error;
        }*/
    }

    private function createUserID($type){
        if($type == "free"){
            return 'free_' . bin2hex(random_bytes(8));
        }else if($type == "Business"){
            return 'busi_' . bin2hex(random_bytes(8));
        }
        
    }

    public function create_user($data) {
        $userId = $this->createUserID(trim($data["subType"]));
        $userName = htmlspecialchars(trim($data["userName"]), ENT_QUOTES, 'UTF-8');
        //GET FIRST NAME AND LAST NAME
        $userFullName = htmlspecialchars(trim($data["fullName"]), ENT_QUOTES, 'UTF-8');

        $userEmail = filter_var(trim($data["userEmail"]), FILTER_SANITIZE_EMAIL);
        $userPhoneNumber = preg_replace('/\D/', '', $data["userPhoneNumber"]);
        $userPassword = $data["userPassword"];
        $userPasswordHash = password_hash($userPassword, PASSWORD_DEFAULT);
        $subType = htmlspecialchars(trim($data["subType"]), ENT_QUOTES, 'UTF-8');

        /*$paymentCardNumber = preg_replace('/\D/', '', $data["paymentCardNumber"]);
        $paymentExp = htmlspecialchars(trim($data["paymentExp"]), ENT_QUOTES, 'UTF-8');*/

        try {
            $this->DB->save("INSERT INTO userdetails (userID, userName, fullName, userEmail, userPhoneNumber, userPassword, subType)
                            VALUES (?, ?, ?, ?, ?, ?, ?)", [
                $userId, $userName, $userFullName, $userEmail, $userPhoneNumber, $userPasswordHash, $subType
            ]);

           /* $this->DB->save("INSERT INTO useraccounts (userID, cardNumber, cardExp)
                            VALUES (?, ?, ?)", [
                $userId, $paymentCardNumber, $paymentExp
            ]);*/

            $this->DB->save("INSERT INTO userStats(userID, userName, userEmail)
                            VALUES (?, ?, ?)", [
                $userId, $userName, $userEmail
            ]);
        } catch (PDOException $e) {
            error_log("Signup DB error: " . $e->getMessage());
            exit();
        }
    }

}

?>