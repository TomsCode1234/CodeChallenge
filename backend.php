<?php
    $cars = json_decode(file_get_contents("http://dev-test.choosewisely.co.uk/cars.json"));
    $models = json_decode(file_get_contents("http://dev-test.choosewisely.co.uk/models.json"));

    $carIdArray = array();
    $modelIdArray = array();
    $carInputArray = array();

    $currentModel;


    function atStartCars(){
        global $cars, $carIdArray;
        foreach($cars as $carId){
            array_push($carIdArray, $carId->id);
        }
        return json_encode($carIdArray);
    }


    function atStartModels(){
        global $models, $modelIdArray;
        foreach($models as $modelId){
            array_push($modelIdArray, $modelId->modelId);
        }
        return json_encode($modelIdArray);
    }


    function returnData() {
        global $cars, $models, $carInputArray, $currentModel;
        $current = "";
        if ((isset($_GET["car"])) && (isset($_GET["model"]))){
            if ((($_GET["car"])=== "") && (($_GET["model"])=== "")){
                foreach($cars as $carIdList){
                    $current = $carIdList;
                    foreach($models as $modelIdList){
                        if(($modelIdList->modelId) === ($carIdList->modelId)){
                            $current = (object) array_merge((array)$current, (array)$modelIdList);
                        }
                    }
                    array_push($carInputArray, $current);
                }
                echo json_encode($carInputArray);
            }
            
            
                if ((($_GET["car"])!== "") && (($_GET["model"])=== "")){
                    foreach($cars as $carIdList){
                        if (($carIdList->id) === ($_GET["car"])){
                            $current = $carIdList;
                            $currentModel = $carIdList->modelId;
                        }
                    }
                    foreach($models as $modelIdList){
                        if(($currentModel) === ($modelIdList->modelId)){
                            $current = (object) array_merge((array)$current, (array)$modelIdList);   
                        }
                    }
                    array_push($carInputArray, $current);
                    echo json_encode($carInputArray);
                }
                
            
                if ((($_GET["car"])=== "") && (($_GET["model"])!== "")){
                    foreach($cars as $carIdList){
                        if ($carIdList->modelId === ($_GET["model"])){
                            $current = $carIdList;
                            foreach($models as $modelIdList){
                                if(($modelIdList->modelId) === ($carIdList->modelId)){
                                    $current = (object) array_merge((array)$current, (array)$modelIdList);
                                }
                        }
                    }
                        if($current !== ""){
                            array_push($carInputArray, $current);
                            $current ="";
                        }
                        
                }
                echo json_encode($carInputArray);
                }   
        }
    }

    

    if (isset($_GET["action"])){
        switch($_GET["action"]){
            case "getData":
                returnData();
                break;
        }
    }


?>