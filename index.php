<? 

$arreglo = array(
    "sucess"=>false,
    "status"=>400,
    "data"=>"",
    "message"=>"",
    "cant"=> 0

);

if($_SERVER["REQUEST_METHOD"] === "GET"){
    //EL METODO ES GET
    if(isset($_GET["type"]) && $_GET["type"] != ""){
        // SI ENVIÓ EL PARÁMETRO type
    }else{
        //NO HAY VALORES PARA EL PARÁMETRO type
        $arreglo = array(
            "sucess"=>false,
            "status"=>status("status_code"=>412, "status_text"=> "Precondition Failed"),
            "data"=>"",
            "message"=>"SE ESPERABA EL PARÁMETRO 'type' CON EL TIPO DE RESULTADO",
            "cant"=> 0
        
        );
    }

}else{
    //NO SE ACEPTA EL MÉTODO
    $arreglo = array(
        "sucess"=>false,
        "status"=>status("status_code"=>405, "status_text"=> "Method Not Allowed"),
        "data"=>"",
        "message"=>"NO SE ACEPTA EL MÉTODO",
        "cant"=> 0
    
    );
}

?>