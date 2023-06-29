<?php
require_once("Models/CoupleModel.php");
require_once("Controller.php");
require_once("Common/GeneralFunctions.php");

class CoupleController extends Controller{

    public function CreateCouple(){
        $obj = new CoupleModel;
        $return = $obj->CreateCoupleModel();
        Controller::OutputMaker($return);
    }

    public function RemoveCouple(){
        $obj = new CoupleModel;
        $return = $obj->RemoveCoupleModel();
        switch ($return) {
            case '':
                Controller::OutputMaker("No CategoryID given",500);
                break;
            
            default:
                Controller::OutputMaker($return);
                break;
        }
        Controller::OutputMaker($return);
    }
    public function GetCompanyCategory(){
        $obj = new CoupleModel;
        $return = $obj->GetCompanyCategoryModel();
        Controller::OutputMaker($return);
    }
}