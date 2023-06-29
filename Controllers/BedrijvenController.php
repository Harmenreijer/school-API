<?php
require_once("Models/BedrijvenModel.php");
require_once("Controller.php");
require_once("Common/GeneralFunctions.php");

class BedrijvenController extends Controller{
    public function CreateCompany(){
        $obj = new BedrijvenModel;
        $return = $obj->CreateCompanyModel();
        Controller::OutputMaker($return);
    }

    public function GetCompany(){
        $obj = new BedrijvenModel;
        $return = $obj->GetCompanyModel();
        
        switch ($return) {
            case 'NoIdentifier':
                Controller::OutputMaker("Company identifier missing!",500);
                break;
            
            default:
                Controller::OutputMaker($return);
                break;
        }
        
    }

    public function RemoveCompany(){
        $obj = new BedrijvenModel;
        $return = $obj->RemoveCompanyModel();
        switch ($return) {
            case 'NoCompanyID':
                Controller::OutputMaker("No CompanyID given",500);
                break;
            
            default:
                Controller::OutputMaker($return);
                break;
        }
        Controller::OutputMaker($return);
    }
    public function UpdateCompany(){
        $obj = new BedrijvenModel;
        $return = $obj->UpdateCompanyModel();
        Controller::OutputMaker($return);
    }
    
}