<? 
require("conn.php");

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
        $conexion = new conexion;
        $conn = $conexion->conectar();

        $datos = $conn->query('SELECT * FROM empleado');
        $resultados = $datos->fetchAll();
        
        switch ($_GET["type"]) {
            case "json":
                result_json($resultados);
                break;
            
            case "xml":
                result_xml($resultados);
                break;
            default:
                echo("Por favor, defina el tipo de resultado");
            break;
        }

echo "";

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
function result_json($resultado){
    $arreglo = array(
        "sucess"=>false,
        "status"=>array("status_code"=>200,"status_text"=> "OK"),
        "data"=>$resultado,
        "message"=>"",    
        "cant" => sizeof($resultado) 
    );
    header("HTTP/1.1".$arreglo["status"]["status_code"]." ".$arreglo["status"]["status_text"]);
    header("Content-Type: Aplication/json");
    echo(json_encode($arreglo));
}
function result_xml($resultado){
    $xml = new SimpleXMLElement("<empleado />");
    foreach($resultado as $i => $v){
        $subnodo = $xml->addChild("empleado");
        $invertir = array_flip($v);
        array_walk_recursive($invertir, array($subnodo, 'addChild'));
    }
    header("Content-type: text/xml");
    echo($xml->asXML());
}

?>
