<?php
    session_start();
    require "statement.php";

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PWD', '');
    define('DBNAME', 'bagavill');

    class User extends Statement{
        private $statement;
        public $name;
        public $username;
        public $email;

        public function __construct() {
            $this->statement = new Statement(HOST, USER, PWD, DBNAME);
        }

        public function registrateAndCheck($name, $username, $email, $password1, $password2) {
            $msg = "";

            try {
                $this->nameLengthCheck($name);
            }catch(Exception $e) {
                $msg .= $e->getMessage();
            }

            try {
                $this->usernameLengthCheck($username);
            }catch(Exception $e) {
                $msg .= $e->getMessage();
            }

            try {
                $this->emailLengthCheck($email);
            }catch(Exception $e) {
                $msg .= $e->getMessage();
            }

            try {
                $this->passwordLengthCheck($password1);
                $this->passwordEqualityCheck($password1, $password2);
            }catch(Exception $e) {
                $msg .= $e->getMessage();
            }

            $msg .= ($this->statement->isUsernameUsed($username)) ? " <li>A választott felhasználónév foglalt!</li> " : "";
            $msg .= ($this->statement->isEmailUsed($email)) ? " <li>A megadott e-mail címmel már regisztráltak!</li> " : "";

            if($msg == "") {
                $msg .= (!$this->statement->fixNewUser($name, $username, hash('sha512', $password1), $email)) ? " <li>A regisztráció sikertelen! (Belső hiba)</li> " : "";
            }

            $msg = ($msg == "") ? 
            " <h5 class='text-success'>Sikeres Regisztráció!</h5> <a class='mb-3 d-block' href='login.php'>Tovább a bejelentkezésre!</a>"
            : "<ul>".$msg."</ul>";

            return $msg;
        }

        public function login($username, $password) {
            if($this->statement->loginDataCheck($username, hash("sha512", $password))) {
                $_SESSION['login'] = true;
                $_SESSION['userId'] = $this->statement->getUserId($username);
            } else {
                throw new Exception(' <h4>Hibás belépési adatok!</h4> ');
            }
        }

        public function loginCheck() {
            $userData = $this->statement->getPublicUserData($_SESSION['userId']);
            if(!empty($userData)) {
                $this->username = $userData['username'];
                return true;
            } else {
                return false;
            }
        }

        public function logout() {
            unset($_SESSION['login']);
            unset($_SESSION['userId']);
            $_SESSION['userId']="";
        }

        private function nameLengthCheck($name) {
            if(strlen($name) < 7) {
                throw new Exception(' <li>A teljes név túl rövid! (min. 7 karakter)</li> ');
            }
        }

        private function usernameLengthCheck($username) {
            if(strlen($username) < 6) {
                throw new Exception(' <li>A felhasználónév túl rövid! (min. 6 karakter)</li> ');
            } else if(strlen($username) > 20) {
                throw new Exception(' <li>A felhasználónév túl hosszú! (max. 20 karakter)</li> ');
            }
        }

        private function emailLengthCheck($email) {
            if(strlen($email) < 6) {
                throw new Exception(' <li>A e-mail cím túl rövid! (min. 6 karakter)</li> ');
            } else if(strlen($email) > 50) {
                throw new Exception(' <li>A e-mail cím túl hosszú! (max. 50 karakter)</li> ');
            }
        }

        private function passwordLengthCheck($password) {
            if(strlen($password) < 6) {
                throw new Exception(' <li>A jelszó túl rövid! (min. 6 karakter)</li> ');
            }
        }

        private function passwordEqualityCheck($password1, $password2) {
            if($password1 != $password2) {
                throw new Exception(' <li>A két jelszó nem egyezik!</li> ');
            }
        }

        public function kategoriaSelectId(){
            if(!empty($this->statement->getKategoriakId())){
                return $this->statement->getKategoriakId();
            }else{
                throw new Exception('Nincs megjelenítendő kategória');
            }
        }

        public function kategoriaSelect(){
            if(!empty($this->statement->getKategoriak())){
                return $this->statement->getKategoriak();
            }else{
                throw new Exception('Nincs megjelenítendő kategória');
            }
        }

        public function katAtalakit($kat){
            return $this->statement->kategoriaAtalakit($kat);
        }

        public function insAkku($kategoriaSelect,$cikkszam,$termekar,$termeknev,$parameter,$kep,$keszlet,$ah){
            if(empty($kategoriaSelect) || empty($cikkszam) || empty($termekar) || empty($termeknev) || empty($parameter) || empty($kep) || empty($keszlet) || empty($ah)){
                    throw new Exception("Minden mező kitöltése kötelező!");
            }else{
                $this->statement->insertAkku($kategoriaSelect,$cikkszam,$termekar,$termeknev,$parameter,$kep,$keszlet,$ah);
            }
        }

        public function rendelAdatVizsgal($userId, $nev, $telefon, $email, $szmod, $fizmod, $irsz, $varos, $utca, $hsz, $megj){
            if(empty($userId) || empty($nev) || empty($telefon) || empty($email) || empty($szmod) || empty($fizmod) || empty($irsz) || empty($varos) || empty($utca) || empty($hsz)){
                return false;
            }else{
                return true;
            }
        }

        public function rendLeadOsszesito($userId, $szmod, $fizmod, $vegosszeg){
            $this->statement->rendelesLeadOsszesito($userId, $szmod, $fizmod, $vegosszeg);
        }

        public function rendLeadAdatok($userId, $utolsoRendId, $nev, $telefon, $email, $irsz, $varos, $utca, $hsz, $megj){
            $this->statement->rendelesLeadAdatok($userId, $utolsoRendId, $nev, $telefon, $email, $irsz, $varos, $utca, $hsz, $megj);
        }
        public function rendIdLeker(){
            return $this->statement->rendelesIdLeker();
        }

        public function rendLeadTermekek($utolsoRendId, $product_id, $db){
            $this->statement->rendelesLeadTermekek($utolsoRendId, $product_id, $db);
        }

        public function keszlLevon($product_id, $db){
            $this->statement->keszletLevon($product_id, $db);
            $result = $this->statement->keszletLevonElfogy($product_id);
            if($result == 0){
                $this->statement->termekTorol($product_id);
            }
        }

        public function shAkksi(){
            return $this->statement->showAkksi();
        }

        public function shTermekekAdmin(){
            return $this->statement->showTermekekAdmin();
        }

        public function termTorol($product_id){
            return $this->statement->termekTorol($product_id);
        }

        public function termKetto($product_id){
            return $this->statement->termekMegjKetto($product_id);
        }

        public function adminTorol($product_id){
            return $this->statement->termekTorol($product_id);
            header("Refresh:1; url=http://localhost/bagavilll/admin/index.php");
        }

        public function adModosit($cikkszam,$ar,$nev,$parameterek,$kep,$keszlet,$amper_ora,$product_id){
            $this->statement->adminModosit($cikkszam,$ar,$nev,$parameterek,$kep,$keszlet,$amper_ora,$product_id);
        }

        public function kosarMuv($action, $product_id){
            $productid = $product_id;
            switch($action){
                case "add":
                    if(isset($_SESSION["cart"])){
                        $_SESSION["cart"][$product_id]++;
                        foreach($_SESSION["cart"] as $product_id => $db){
                            if($db<=$this->statement->keszletLevonElfogy($productid)){
                                $url = "kosaram.php";
                                echo "<META HTTP-EQUIV=Refresh CONTENT='0, URL=".$url."'/>";
                            }else{
                                $_SESSION["cart"][$product_id]--;
                                $url = "kosaram.php";
                                echo "<META HTTP-EQUIV=Refresh CONTENT='0, URL=".$url."'/>";
                            }
                        }
                    }else{
                        $_SESSION["cart"][$product_id]++;
                        $url = "kosaram.php";
                        echo "<META HTTP-EQUIV=Refresh CONTENT='0, URL=".$url."'/>";
                    }
                break;
        
                case "remove":
                    $_SESSION["cart"][$product_id]--;
                    if($_SESSION["cart"][$product_id]==0){
                        unset($_SESSION["cart"][$product_id]);
                        if(empty($_SESSION["cart"]))
                            unset($_SESSION["cart"]);
                    }
                    $url="kosaram.php";
                    echo "<META HTTP-EQUIV=Refresh CONTENT='0, URL=".$url."'/>";
                break;
        
                case "empty":
                    unset($_SESSION["cart"]);
                    $url="kosaram.php";
                    echo "<META HTTP-EQUIV=Refresh CONTENT='0, URL=".$url."'/>";
                break;
            }
        }

        public function kosarJelenit($product_id){
            if(!empty($this->statement->termekMegj($product_id))){
                return $this->statement->termekMegj($product_id);
            }else{
                echo 'A kosár üres';
            }
        }

        public function rendAdmin(){
            return $this->statement->rendelesekAdmin();
        }

        public function userRendelesei($userId){
            return $this->statement->userRendeleseiLeker($userId);
        }

        public function statuszFrissit($rend_id){
            $this->statement->statFrissit($rend_id);
        }

        public function nevKereso($keres){
            return $this->statement->nevKeresoSt($keres);
        }

        public function amperKereso($keres){
            return $this->statement->amperoraKereso($keres);
        }

        public function paramKereso($keres){
            return $this->statement->parameterKereso($keres);
        }

        
    }
?>