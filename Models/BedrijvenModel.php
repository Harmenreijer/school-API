<?php
require_once("Common/GeneralFunctions.php");
class BedrijvenModel extends Controller{
    public function CreateCompanyModel(){
        $ControlThis = array("Name","Omschrijving","Email","TelefoonNmr");
        $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

        if($Control){
            $pdo = GeneralFunctions::GetPDO();
            $sql = "SELECT MAX(CompanyID) FROM company";
            $stmt = $pdo->prepare($sql);

            try{
                $stmt->execute();
            }catch(PDOException $e) {
              print("SQL_ERROR");  
            }
            $CompanyID = $stmt->fetch();

            $NewID = $CompanyID["MAX(CompanyID)"] += 1;
            $pdo = $_POST["PDO_OBJ"];

            $sql = "INSERT INTO `company`(CompanyName, CompanyID, CompanyDescription, Email, TelefoonNmr)
            VALUES (:CompanyName, :CompanyID, :CompanyDescription, :Email, :TelefoonNmr)";
            $params = [
                'CompanyName' => $_GET["Name"],
                'CompanyID' => $NewID,
                'CompanyDescription' => $_GET["Omschrijving"],
                'Email' => $_GET["Email"],
                'TelefoonNmr' => $_GET["TelefoonNmr"],
            ];

            $stmt = $pdo->prepare($sql);
            try{
                $stmt->execute($params);
            }catch(PDOException $e) {
                print("SQL_ERROR"); 
            }
            $QueryReturn = $stmt->fetchAll();

            if($QueryReturn == array()){
                $Return = "Company made succesfully";
            }else{
                $Return = "Failed to make company";
            }

            return $Return;
        }
    }

    public function GetCompanyModel(){
        if(isset($_GET["CompanyID"])){
            $ControlThis = array("CompanyID");
            $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

            if($Control){
                $pdo = GeneralFunctions::GetPDO();

                $sql = "SELECT * FROM company WHERE CompanyID = :CompanyID";
                $params = [
                    'CompanyID' => $_GET["CompanyID"]
                ];

                $stmt = $pdo->prepare($sql);

                try{
                    $stmt->execute($params);
                }catch(PDOException $e) {
                    print("SQL_ERROR");  
                }
                $Company = $stmt->fetch();
                return $Company;
            }
        }elseif(isset($_GET["Name"])){
            $ControlThis = array("Name");
            $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

            if($Control){
                $pdo = GeneralFunctions::GetPDO();

                $sql = "SELECT * FROM company WHERE CompanyName = :CompanyName";
                $params = [
                    'CompanyName' => $_GET["Name"]
                ];

                $stmt = $pdo->prepare($sql);

                try{
                    $stmt->execute($params);
                }catch(PDOException $e) {
                    print("SQL_ERROR");  
                }
                $Company = $stmt->fetch();
                return $Company;
            }
        }else{
            return("NoIdentifier");
        }
    }

    public function RemoveCompanyModel(){
        $ControlThis = array("CompanyID");
        $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

        if($Control){
            $pdo = GeneralFunctions::GetPDO();

            $sql = "DELETE FROM company WHERE `CompanyID` = :CompanyID";
            $params = [
                'CompanyID' => $_GET["CompanyID"]
            ];

            $stmt = $pdo->prepare($sql);

            try{
                $stmt->execute($params);
            }catch(PDOException $e) {
                print("SQL_ERROR");  
            }
            $Company = $stmt->fetch();

            
                return"Company was deleted";
            
        }else{
            return("NoCompanyID");
        }
    }

    public function UpdateCompanyModel(){
        $ControlThis = array("UpdateCollumn","UpdateValue","CompanyID");
        $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

        if($Control){
            $pdo = GeneralFunctions::GetPDO();

            $sql = "UPDATE `company` SET `".$_GET["UpdateCollumn"]."` = '".$_GET["UpdateValue"]."' WHERE `CompanyID` = :CompanyID";
            $params = [
                'CompanyID' => $_GET["CompanyID"]
            ];

            $stmt = $pdo->prepare($sql);

            try{
                $stmt->execute($params);
            }catch(PDOException $e) {
                print("SQL_ERROR");  
            }
            $Company = $stmt->fetch();
            
            return"Updated Company Info";
        
        }
    }
}