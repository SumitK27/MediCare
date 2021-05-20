<?php 
    class Account {

        private $conn;
        private $errorArray = array();

        public function __construct($conn) {
            $this->conn = $conn;
        }

        /* Register */
        public function register($fn, $ln, $em, $pw, $pw2, $rl) {
            $this->validateName($fn);
            $this->validateName($ln);
            $this->validateEmail($em);
            $this->validatePassword($pw, $pw2);

            if(empty($this->errorArray)) {
                return $this->insertUserDetails($fn, $ln, $em, $pw, $rl);
            }

            return false;
        }

        private function insertUserDetails($fn, $ln, $em, $pw, $rl) {
            $pw = hash("sha512", $pw);

            $query = $this->conn->prepare("INSERT INTO users(first_name, last_name, email, password) VALUES(:fn, :ln, :em, :pw)");
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":em", $em);
            $query->bindValue(":pw", $pw);
            $query->execute();
            
            $lastId = $this->conn->lastInsertId();
            $this->assignRole($lastId, $rl);

            return true;
        }

        /* Login */
        public function login($em, $pw) {
            $pw = hash("sha512", $pw);
            $query = $this->conn->prepare("SELECT * FROM users WHERE email=:em AND password=:pw");
            $query->bindValue(":em", $em);
            $query->bindValue(":pw", $pw);
            $query->execute();
            if($query->rowCount() == 1) {
                return true;
            }

            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
        
        // Login by Cookie
        public function c_login($em, $pw) {
            $query = $this->conn->prepare("SELECT * FROM users WHERE email=:em AND password=:pw");
            $query->bindValue(":em", $em);
            $query->bindValue(":pw", $pw);
            $query->execute();
            if($query->rowCount() == 1) {
                return true;
            }

            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }

        public function getInfo() {
            $query = $this->conn->prepare("SELECT users.user_id, users.first_name, users.last_name, users.email, roles.name from users, user_role, roles WHERE users.email=:em AND users.user_id = user_role.user_id AND user_role.role_id = roles.role_id");
            $query->bindValue(":em", $_SESSION["userLoggedIn"]);
            $query->execute();
            $userInfo = $query->fetchAll(PDO::FETCH_ASSOC);
            return $userInfo[0];
        }

        public function getUser($id) {
            $query = $this->conn->prepare("SELECT user_id, first_name, last_name, email, password, name FROM users, roles WHERE user_id=:id");
            $query->bindValue(":id", $id);
            $query->execute();
            $userInfo = $query->fetchAll(PDO::FETCH_ASSOC);
            //print_r($userInfo);
            return $userInfo[0];
        }

        public function getAllUsers() {
            $query = $this->conn->prepare("SELECT users.user_id, users.first_name, users.last_name, users.email, roles.name from users, user_role, roles WHERE users.user_id = user_role.user_id AND user_role.role_id = roles.role_id");
            $query->execute();
            $userInfo = $query->fetchAll(PDO::FETCH_ASSOC);
            //print_r($userInfo);
            return $userInfo;
        }

        public function updateUser($id, $fn, $ln, $em, $ut) {
            $query = $this->conn->prepare("UPDATE users SET user_id=:id, first_name=:fn, last_name=:ln, email=:em WHERE user_id=:id");
            $query->bindValue(":id", $id);
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":em", $em);
            $query->bindValue(":ut", $ut);
            header("Location: admin-dashboard.php");
            return $query->execute();
        }

        public function updateInfo($userInfo, $nm, $un, $gn, $dob, $cn, $yr, $st, $em) {
            $query = $this->conn->prepare("UPDATE users SET name=:nm, username=:un, gender=:gn, dob=:dob, contact=:cn, year=:yr, stream=:st, email=:em WHERE id=:id");
            $query->bindValue(":id", $userInfo["id"]);
            $query->bindValue(":nm", $nm);
            $query->bindValue(":un", $un);
            $query->bindValue(":gn", $gn);
            $query->bindValue(":dob", $dob);
            $query->bindValue(":cn", $cn);
            $query->bindValue(":yr", $yr);
            $query->bindValue(":st", $st);
            $query->bindValue(":em", $em);
            $_SESSION["userLoggedIn"] = $em;
            header("Location: logged.php");
            return $query->execute();
        }

        public function updateProfile($userInfo, $fn, $ln, $em) {
            $query = $this->conn->prepare("UPDATE users SET first_name=:fn, last_name=:ln, email=:em WHERE user_id=:id");
            print_r($query);
            $query->bindValue(":id", $userInfo["user_id"]);
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":em", $em);
            $_SESSION["userLoggedIn"] = $em;
            header("Location: index.php");
            return $query->execute();
        }

        public function updatePwd($userInfo, $op, $np, $np2) {
            // Check if both the password match
            $this->validatePassword($np, $np2);
            $op = hash("sha512", $op);
            $np = hash("sha512", $np);

            $query = $this->conn->prepare("UPDATE users SET password=:np WHERE user_id=:id AND password=:op");
            $query->bindValue(":id", $userInfo["user_id"]);
            $query->bindValue(":np", $np);
            $query->bindValue(":op", $op);
            $query->execute();

            if($query->rowCount() == 1) {
                return true;
            }

            array_push($this->errorArray, Constants::$passwordIncorrect);
            return false;
        }

        /* Validate */
        private function validateName($nm) {
            if (strlen($nm) < 2 || strlen($nm) > 25) {
                array_push($this->errorArray, Constants::$nameCharacters);
            }
            echo "$nm";
        }

        private function validateContact($cn) {
            if (strlen($cn) != 10) {
                array_push($this->errorArray, Constants::$contactInvalid);
            }
        }

        private function validateDOB($dob) {
            if (strlen($dob) < 2 || strlen($dob) > 25) {
                array_push($this->errorArray, Constants::$dateInvalid);
            }
        }

        private function validateEmail($em) {
            if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            $query = $this->conn->prepare("SELECT * FROM users WHERE email=:em");
            $query->bindValue(":em", $em);
            $query->execute();

            if ($query->rowCount() != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
            }
        }

        private function validatePassword($pw, $pw2) {
            if ($pw != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDontMatch);
                return;
            }
            
            if (strlen($pw) < 2 || strlen($pw) > 25) {
                array_push($this->errorArray, Constants::$passwordLength);
                return;
            }
        }

        private function assignRole($lastId, $role) {
            $query = $this->conn->prepare("INSERT INTO user_role(user_id, role_id) VALUES(:ui, :ri)");
            $query->bindValue(":ui", $lastId);
            $query->bindValue(":ri", $role);
            $query->execute();

            return;
        }

        public function getError($error) {
            if (in_array($error, $this->errorArray)) {
                return "<h6 class='alert alert-danger'>" . $error . "</h6>";
            }
        }
    }
?>