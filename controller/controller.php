<?php
require "model/model.php";
// require "model/modelPost.php";


function createJson ($req){
    $i = 0;
    $y = 0;
    $x = 0;
    $tab_tmp =[];

    while ($data = $req->fetch()){
        $tab_tmp[$i]['id'] = $data['id_room'];
        $tab_tmp[$i]['room_name'] = $data["name"];
        $tab_tmp[$i]['room_describ'] = $data['description'];
        $tab_tmp[$i]['poster_principale'] = $data['path_img'];
        $picsFacts = getPicsAndFacts($data['id_room']);
        while($data_picsFacts = $picsFacts->fetch()){
            $y++;
            
            if (!empty($data_picsFacts["fact"])){
                
                $tab_tmp[$i]['picsAndFacts']["pf" . $x]["p"] = $data_picsFacts["name"];
                $tab_tmp[$i]['picsAndFacts']["pf" . $x]["f"] = $data_picsFacts["fact"];
                $x++;
            }else {
                $tab_tmp[$i]['pics']['p' . $y] = $data_picsFacts["name"];
            }
              
           ;
            
        }
        $y = 0;
        $x = 0;
        $i++;
    }

    return $tab_tmp;
}

function getAllRoomToJson($isOfficial){
    $req = getAllRoom($isOfficial);

    $tab_tmp = createJson($req);

    $result['result'] = $tab_tmp;

    $json_tab = json_encode($result);
    return $json_tab;

}

function getRoomToJson($room){
    $req = getRoom($room);

    $tab_tmp = createJson($req);

    $result['result'] = $tab_tmp;

    $json_tab = json_encode($result);

    return $json_tab;

}
function postARoom($name, $path_img, $description){
    
    $req =  postRoom($name, $path_img, $description );
 
    return $req;
 }
 
