<?php

    require "database.php";

    class Statement extends Database {
        private $dbCon;

        public function __construct($host, $user, $pwd, $dbName) {
            parent::__construct($host, $user, $pwd, $dbName);
            $this->dbCon = parent::connect();
            $this->dbCon->query("SET NAMES utf8");
        }

        public function isUsernameUsed($username) {
            $stmt = $this->dbCon->prepare("SELECT COUNT(id) AS vane FROM felhasznalok WHERE username LIKE ?");
            $stmt->bindParam(1, $username);
            $stmt->execute();
            $result = $stmt->fetch();
            return ($result['vane'] > 0);
        }

        public function isEmailUsed($email) {
            $stmt = $this->dbCon->prepare("SELECT COUNT(id) AS vane FROM felhasznalok WHERE email LIKE ?");
            $stmt->bindParam(1, $email);
            $stmt->execute();
            $result = $stmt->fetch();
            return ($result['vane'] > 0);
        }

        public function fixNewUser($name, $username, $password, $email) {
            $stmt = $this->dbCon->prepare("INSERT INTO felhasznalok (teljes_nev, username, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $username);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $password);
            $stmt->execute();
            return ($stmt->errorCode() == "00000");
        }

        public function loginDataCheck($username, $password) {
            $stmt = $this->dbCon->prepare("SELECT COUNT(id) AS vane FROM felhasznalok WHERE username LIKE ? AND password LIKE ?");
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $password);
            $stmt->execute();
            $result = $stmt->fetch();
            return ($result['vane'] == 1);
        }

        public function getUserId($username) {
            $stmt = $this->dbCon->prepare("SELECT id FROM felhasznalok WHERE username LIKE ?");
            $stmt->bindParam(1, $username);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['id'];
        }

        public function getPublicUserData($userId) {
            $stmt = $this->dbCon->prepare("SELECT username FROM felhasznalok WHERE id=?");
            $stmt->bindParam(1, $userId);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function getKategoriakId() {
            $stmt = $this->dbCon->prepare("SELECT DISTINCT id FROM kategoriak");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function getKategoriak() {
            $stmt = $this->dbCon->prepare("SELECT DISTINCT kategoria_nev FROM kategoriak");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function kategoriaAtalakit($kat){
            $stmt = $this->dbCon->prepare("SELECT id FROM kategoriak WHERE kategoria_nev=?");
            $stmt->bindParam(1, $kat);
            $stmt->execute();
            return $stmt->fetch();

        }

        public function insertAkku($kategoriaSelect,$cikkszam,$termekar,$termeknev,$parameter,$file,$keszlet,$ah){
            $stmt = $this->dbCon->prepare("INSERT INTO termekek(kategoria_id,cikkszam,ar,nev,parameterek,kep,keszlet,amper_ora) VALUES (?,?,?,?,?,?,?,?)");  
            $stmt->bindParam(1, $kategoriaSelect);
            $stmt->bindParam(2, $cikkszam);
            $stmt->bindParam(3, $termekar);
            $stmt->bindParam(4, $termeknev);
            $stmt->bindParam(5, $parameter);
            $stmt->bindParam(6, $file);
            $stmt->bindParam(7, $keszlet);
            $stmt->bindParam(8, $ah);
            $stmt->execute();
        }

        public function showAkksi(){
            $stmt = $this->dbCon->prepare("SELECT id,kategoria_id,cikkszam,ar,nev,parameterek,kep,keszlet,amper_ora,aktiv FROM termekek ORDER BY amper_ora ASC");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function showTermekekAdmin(){
            $stmt = $this->dbCon->prepare("SELECT id,cikkszam,ar,nev,keszlet,amper_ora,aktiv FROM termekek");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function termekTorol($product_id){
            $stmt = $this->dbCon->prepare("UPDATE termekek SET aktiv='0' WHERE id=?");
            $stmt->bindParam(1, $product_id);
            $stmt->execute();
        }

        public function termekMegj($product_id){
            $stmt = $this->dbCon->prepare("SELECT id,cikkszam,ar,nev,amper_ora FROM termekek WHERE id=?");
            $stmt->bindParam(1, $product_id);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function termekMegjKetto($product_id){
            $stmt = $this->dbCon->prepare("SELECT id,kategoria_id,cikkszam,ar,nev,parameterek,kep,keszlet,amper_ora,aktiv FROM termekek WHERE id=?");
            $stmt->bindParam(1, $product_id);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function adminModosit($cikkszam,$ar,$nev,$parameterek,$kep,$keszlet,$amper_ora,$product_id){
            $stmt = $this->dbCon->prepare("UPDATE termekek SET cikkszam=?,ar=?,nev=?,parameterek=?,kep=?,keszlet=?,amper_ora=? WHERE id=?");
            $stmt->bindParam(1, $cikkszam);
            $stmt->bindParam(2, $ar);
            $stmt->bindParam(3, $nev);
            $stmt->bindParam(4, $parameterek);
            $stmt->bindParam(5, $kep);
            $stmt->bindParam(6, $keszlet);
            $stmt->bindParam(7, $amper_ora);
            $stmt->bindParam(8, $product_id);
            $stmt->execute();
        }

        public function rendelesLeadOsszesito($userId, $szmod, $fizmod, $vegosszeg){
            $stmt=$this->dbCon->prepare("INSERT INTO rendelesek(felhasznalo_id,szallitasi_mod,fizetesi_mod,datum,brutto_osszeg,statusz) VALUES (?,?,?,NOW(),?,'0')");  
            $stmt->bindParam(1, $userId);
            $stmt->bindParam(2, $szmod);
            $stmt->bindParam(3, $fizmod);
            $stmt->bindParam(4, $vegosszeg);
            $stmt->execute();
        }

        public function rendelesLeadAdatok($userId, $utolsoRendId, $nev, $telefon, $email, $irsz, $varos, $utca, $hsz, $megj){
            $stmt=$this->dbCon->prepare("INSERT INTO rendelok(felhasznalo_id, rendeles_id,nev,telefon,email,iranyitoszam,varos,utca,haz_szam,megjegyzes) VALUES (?,?,?,?,?,?,?,?,?,?)"); 
            $stmt->bindParam(1, $userId); 
            $stmt->bindParam(2, $utolsoRendId);
            $stmt->bindParam(3, $nev);
            $stmt->bindParam(4, $telefon);
            $stmt->bindParam(5, $email);
            $stmt->bindParam(6, $irsz);
            $stmt->bindParam(7, $varos);
            $stmt->bindParam(8, $utca);
            $stmt->bindParam(9, $hsz);
            $stmt->bindParam(10, $megj);
            $stmt->execute();
        }

        public function rendelesIdLeker(){
            $stmt=$this->dbCon->prepare("SELECT id FROM rendelesek ORDER BY id LIMIT 1");
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }

        public function rendelesLeadTermekek($utolsoRendId, $product_id, $db){
            $stmt=$this->dbCon->prepare("INSERT INTO rendelt_termekek(rendeles_id,termek_id,db) VALUES (?,?,?)");
            $stmt->bindParam(1, $utolsoRendId);
            $stmt->bindParam(2, $product_id);
            $stmt->bindParam(3, $db);
            $stmt->execute();
        }

        public function keszletLevon($product_id, $db){
            $stmt = $this->dbCon->prepare("UPDATE termekek SET keszlet=keszlet-? WHERE id = ?");
            $stmt->bindParam(1, $db);
            $stmt->bindParam(2, $product_id);
            $stmt->execute();
        }

        public function keszletLevonElfogy($product_id){
            $stmt = $this->dbCon->prepare("SELECT keszlet FROM termekek WHERE id = ?");
            $stmt->bindParam(1, $product_id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }

        public function rendelesekAdmin(){
            $stmt = $this->dbCon->prepare("SELECT rendelesek.id,rendelok.nev,rendelok.telefon,rendelok.email,rendelok.iranyitoszam,rendelok.varos,rendelok.utca,rendelok.haz_szam,rendelok.megjegyzes,rendelesek.szallitasi_mod,rendelesek.fizetesi_mod,rendelesek.datum,rendelesek.brutto_osszeg,rendelesek.statusz FROM rendelesek INNER JOIN rendelok ON rendelesek.id=rendelok.rendeles_id ORDER BY rendelesek.id ASC");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function userRendeleseiLeker($userId){
            $stmt = $this->dbCon->prepare("SELECT rendelt_termekek.db, rendelesek.datum, rendelesek.brutto_osszeg, rendelesek.statusz, termekek.nev, termekek.amper_ora, termekek.ar FROM rendelt_termekek INNER JOIN rendelesek ON rendelt_termekek.rendeles_id=rendelesek.id INNER JOIN termekek ON rendelt_termekek.termek_id=termekek.id WHERE rendelesek.felhasznalo_id=?");
            $stmt->bindParam(1, $userId);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function statFrissit($rend_id){
            $stmt = $this->dbCon->prepare("UPDATE rendelesek SET statusz='1' WHERE rendelesek.id=?");
            $stmt->bindParam(1,$rend_id);
            $stmt->execute();
        }

        public function nevKeresoSt($keres){
            $stmt = $this->dbCon->prepare("SELECT id,kategoria_id,cikkszam,ar,nev,parameterek,kep,keszlet,amper_ora,aktiv FROM termekek WHERE nev LIKE '%?%'");
            $stmt->bindParam(1, $keres);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function amperoraKereso($keres){
            $stmt = $this->dbCon->prepare("SELECT id,kategoria_id,cikkszam,ar,nev,parameterek,kep,keszlet,amper_ora,aktiv FROM termekek WHERE amper_ora=?");
            $stmt->bindParam(1, $keres);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        
        public function parameterKereso($keres){
            $stmt = $this->dbCon->prepare("SELECT id,kategoria_id,cikkszam,ar,nev,parameterek,kep,keszlet,amper_ora,aktiv FROM termekek WHERE parameterek LIKE '%?%'");
            $stmt->bindParam(1, $keres);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        

    }
?>