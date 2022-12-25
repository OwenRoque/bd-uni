<?php
    //session_start();
    include("usuarios.php");
    session_start();

    $baseDatos = new usuarios();
    $res = true;
    $notas = $_POST;

    // validacion
    for ($i = 0; $i < (count($notas) - 1) / 9; $i = $i + 1) {
        if (intval($notas["continua1" . $i]) < 0 || intval($notas["continua1" . $i]) > 20){
            $res = false;
            break;
        }
        if (intval($notas["continua2" . $i]) < 0 || intval($notas["continua2" . $i]) > 20){
            $res = false;
            break;
        }
        if (intval($notas["continua3" . $i]) < 0 || intval($notas["continua3" . $i]) > 20){
            $res = false;
            break;
        }
        if (intval($notas["examen1" . $i]) < 0 || intval($notas["examen1" . $i]) > 20){
            $res = false;
            break;
        }
        if (intval($notas["examen2" . $i]) < 0 || intval($notas["examen2" . $i]) > 20){
            $res = false;
            break;
        }
        if (intval($notas["examen3" . $i]) < 0 || intval($notas["examen3" . $i]) > 20){
            $res = false;
            break;
        }
        if (($notas["estado" . $i] != "N") && ($notas["estado" . $i] != "S")){
            $res = false;
            break;
        }
    }

    if ($res)
    {
        for($i = 0;$i < (count($notas)-1)/9;$i = $i+1)
        $baseDatos->updateNotas(
            $notas["codigo_mtr" . $i], $notas['cod_curso'],
            $notas["grupo" . $i],
            $notas["estado" . $i],
            $notas["continua1" . $i],
            $notas["continua2" . $i],
            $notas["continua3" . $i],
            $notas["examen1" . $i],
            $notas["examen2" . $i],
            $notas["examen3" . $i]
        ); 
        echo json_encode(array("success" => true, "title" => "OK","icon" => "success", "msg" => "REGISTRO EXITOSO"));
    }
    else {
        $e = "Notas invalidas, verifique las notas alteradas y vuelva a intentarlo.";
        $ret = array("success" => false, "title" => "ERROR", "icon" => "error", "msg" => $e);
        echo json_encode($ret);
    }
?>