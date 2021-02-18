<?php
//echo'Informacion:'.file_get_contents('php://input');
    switch($_SEVER['REQUEST_METHOD']){
      case 'POST':
        $_POST=json_decode(file_get_contents('php://input'),true);
        $resultado["mensaje"]="Guardar Producto, información:".json_encode($_POST);
        echo json_encode($resultado);
        brea;
        case 'GET':
            if (isset($_GET['id'])) {
                # Tomando el ID_producto
                $resultado["mensaje"]="retornar todos los usuarios";
                echo json_encode($resultado);
            }else {
                # Caso contrario
                $resultado["mensaje"]="Retornar todos los usuarios";
                echo json_encode($resultado);
            }
        break;
        case 'PUT':
            $_PUT=json_decode(file_get_contents('php://input'),true);
            $resultado["mensaje"]="actualizar un susario con el id:".$_GET[id].
                                   ", Informacion a actualizar:".json_encode($_PUT);
                                   echo
                                   
    }

?>