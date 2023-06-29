<?php
require_once("Models/CategoryModel.php");
require_once("Controller.php");
require_once("Common/GeneralFunctions.php");

class CategoryController extends Controller{
    public function CreateCategory(){
        $obj = new CategoryModel;
        $return = $obj->CreateCategoryModel();
        Controller::OutputMaker($return);
    }

    public function GetCategory(){
        $obj = new CategoryModel;
        $return = $obj->GetCategoryModel();
        
        switch ($return) {
            case 'NoIdentifier':
                Controller::OutputMaker("Category identifier missing!",500);
                break;
            default:
                Controller::OutputMaker($return);
                break;
        }
    }

    public function RemoveCategory(){
        $obj = new CategoryModel;
        $return = $obj->RemoveCategoryModel();
        switch ($return) {
            case 'NoCategoryID':
                Controller::OutputMaker("No CategoryID given",500);
                break;
            
            default:
                Controller::OutputMaker($return);
                break;
        }
        Controller::OutputMaker($return);
    }
    public function UpdateCategory(){
        $obj = new CategoryModel;
        $return = $obj->UpdateCategoryModel();
        Controller::OutputMaker($return);
    }
}