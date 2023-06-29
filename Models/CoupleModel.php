<?php
require_once("Common/GeneralFunctions.php");
class CoupleModel extends Controller{
    
    public function CreateCoupleModel(){
        $ControlThis = array("CompanyID","CategoryID");
        $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

        if($Control){
            $pdo = GeneralFunctions::GetPDO();
            $sql = "INSERT INTO `category_connect` (`Company_ID`, `Category_ID`) VALUES (:Company_ID, :Category_ID)";
            $stmt = $pdo->prepare($sql);

            $params=[
                'Company_ID' => $_GET["Company_ID"],
                'Category_ID' => $_GET["Category_ID"]
            ];

            try{
                $stmt->execute($params);
            }catch(PDOException $e) {
              print("SQL_ERROR");  
            }
            $QueryReturn = $stmt->fetch();

            return"Couple made succesfully";
            
        }
    }

    public function RemoveCategoryModel(){
        $ControlThis = array("Category_ID","Company_ID");
        $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

        if($Control){
            $pdo = GeneralFunctions::GetPDO();

            $sql = "DELETE FROM category_connect WHERE `Category_ID` = :CategoryID AND `Company_ID`= :Company_ID";
            $params = [
                'Category_ID' => $_GET["CategoryID"],
                'Company_ID' => $_GET["Company_ID"]
            ];

            $stmt = $pdo->prepare($sql);

            try{
                $stmt->execute($params);
            }catch(PDOException $e) {
                print("SQL_ERROR");  
            }
            $Company = $stmt->fetch();

            
            return"Couple was deleted";
        }
    }

    public function GetCompanyCategoryModel(){
        $ControlThis = array("CompanyID");
        $Control = GeneralFunctions::InputValidatorStatic($ControlThis);

        if($Control){
            $pdo = GeneralFunctions::GetPDO();

            $sql = "SELECT category_connect.Company_ID,category_connect.Category_ID FROM company LEFT JOIN category_connect ON company.CompanyID = category_connect.Company_ID WHERE category_connect.Company_ID = :Company_ID";
            $params = [
                'Company_ID' => $_GET["CompanyID"]
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
    }

}