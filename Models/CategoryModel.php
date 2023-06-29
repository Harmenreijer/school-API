<?php
require_once("Common/GeneralFunctions.php");
class CategoryModel extends Controller{
    public function CreateCategoryModel(){
        $ControlThis = array("Name","Omschrijving");
        $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

        if($Control){
            $pdo = GeneralFunctions::GetPDO();
            $sql = "SELECT MAX(CategoryID) FROM category";
            $stmt = $pdo->prepare($sql);

            try{
                $stmt->execute();
            }catch(PDOException $e) {
              print("SQL_ERROR");  
            }
            $CategoryID = $stmt->fetch();

            $NewID = $CategoryID["MAX(CategoryID)"] += 1;
            $pdo = $_POST["PDO_OBJ"];

            $sql = "INSERT INTO `category`(CategoryName, CategoryID, CategoryDescription)
            VALUES (:CategoryName, :CategoryID, :CategoryDescription)";
            $params = [
                'CategoryName' => $_GET["Name"],
                'CategoryID' => $NewID,
                'CategoryDescription' => $_GET["Omschrijving"]
            ];

            $stmt = $pdo->prepare($sql);
            try{
                $stmt->execute($params);
            }catch(PDOException $e) {
                print("SQL_ERROR"); 
            }
            $QueryReturn = $stmt->fetchAll();

            if($QueryReturn == array()){
                $Return = "Category made succesfully";
            }else{
                $Return = "Failed to make Category";
            }

            return $Return;
        }
    }

    public function GetCategoryModel(){
        if(isset($_GET["CategoryID"])){
            $ControlThis = array("CategoryID");
            $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

            if($Control){
                $pdo = GeneralFunctions::GetPDO();

                $sql = "SELECT * FROM Category WHERE CategoryID = :CategoryID";
                $params = [
                    'CategoryID' => $_GET["CategoryID"]
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

                $sql = "SELECT * FROM Category WHERE CategoryName = :CategoryName";
                $params = [
                    'CategoryName' => $_GET["Name"]
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

    public function RemoveCategoryModel(){
        $ControlThis = array("CategoryID");
        $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

        if($Control){
            $pdo = GeneralFunctions::GetPDO();

            $sql = "DELETE FROM category WHERE `CategoryID` = :CategoryID";
            $params = [
                'CategoryID' => $_GET["CategoryID"]
            ];

            $stmt = $pdo->prepare($sql);

            try{
                $stmt->execute($params);
            }catch(PDOException $e) {
                print("SQL_ERROR");  
            }
            $Company = $stmt->fetch();

            
            return"Category was deleted";
            
        }else{
            return("NoCategoryID");
        }
    }

    public function UpdateCategoryModel(){
        $ControlThis = array("UpdateCollumn","UpdateValue","CategoryID");
        $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

        if($Control){
            $pdo = GeneralFunctions::GetPDO();

            $sql = "UPDATE `category` SET `".$_GET["UpdateCollumn"]."` = '".$_GET["UpdateValue"]."' WHERE `CategoryID` = :CategoryID";
            $params = [
                'CategoryID' => $_GET["CategoryID"]
            ];

            $stmt = $pdo->prepare($sql);

            try{
                $stmt->execute($params);
            }catch(PDOException $e) {
                print("SQL_ERROR");  
            }
            $Company = $stmt->fetch();
            
            return"Updated Category Info";
        
        }
    }
}