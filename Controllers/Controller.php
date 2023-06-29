<?php
class Controller{
    public function Constructer(){
        //automaticly do stuff
        if(isset($_GET["API_token"])){

            $pdo = GeneralFunctions::GetPDO();

            $sql = "SELECT UserID FROM users WHERE API_token = :API_token";
            $params=[
                'API_token' => $_GET["API_token"]
            ];
            $stmt = $pdo->prepare($sql);

            try{
                $stmt->execute($params);
            }catch(PDOException $e) {
              print("SQL_ERROR");  
            }
            $UID = $stmt->fetch();

            if($UID != false){
                $_POST["UID"] = $UID;
            }else{
                $this->OutputMaker('No "API_token" given!',401);
            }

        }else{
            $this->OutputMaker('No "API_token" given!',401);
        }
    }
    public function OutputMaker($return,$Errorcode = null){

        if($Errorcode == null){
            if($return !="" and $return != null){
                print(json_encode(array(
                    "Errorcode"=> 200,
                    "Succes" => True,
                    "Return" => $return
                )));
            }else{
                print(json_encode(array(
                    "Errorcode"=> 500,
                    "Succes" => False,
                    "Return" => $return
                )));
            }
        }else{
            if($return !="" and $return != null and $Errorcode == 200){
                print(json_encode(array(
                    "Errorcode"=> $Errorcode,
                    "Succes" => True,
                    "Return" => $return
                )));
            }else{
                print(json_encode(array(
                    "Errorcode"=> $Errorcode,
                    "Succes" => False,
                    "Return" => $return
                )));
            }
        } 
        exit();    
    }
}