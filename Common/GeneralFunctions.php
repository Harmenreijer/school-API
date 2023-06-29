<?php
require_once("Controllers/Controller.php");
class GeneralFunctions extends Controller{
    public static function GetPDO(){
        
        if(isset($_POST["PDO_OBJ"])){
            return $_POST["PDO_OBJ"];
        }

        $host = "localhost";
        $db = "api_web-app";
        $user = "root";
        $pass = "";
        $charset = "utf8mb4";

        //connection string en PDO settings
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        //verbinding maken met database
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        $_POST["PDO_OBJ"] = $pdo;
        return($pdo);
    }
    public static function InputValidatorStatic($InputArray){
        $ErrorObject = new GeneralFunctions();
        $ValidData = $ErrorObject->InputValidator($InputArray);
        if($ValidData){
            return $ValidData; 
        }
    }
    public function InputValidator($InputArray){
        $OkCount = 0;
        foreach($InputArray as $IndividualInput){
            if (isset($_GET["".$IndividualInput.""])){
                if($_GET["".$IndividualInput.""]!=""){
                    $OkCount += 1;
                }elseif($_GET["".$IndividualInput.""]==""){
                    $this->OutputMaker("geen waarde voor parameter: ".$IndividualInput." opgegeven",500);
                    exit();
                }
            }elseif(empty($_GET["".$IndividualInput.""])){
                $this->OutputMaker("geen waarde voor parameter: ".$IndividualInput." opgegeven",500);
                exit();
            }
        }If ($OkCount == count($InputArray)){return true;}
    }
}