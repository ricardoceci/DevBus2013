<?php
require('clases/MySQL.php');
$op = @$_REQUEST['op'];
function abrirDB(){
    $db= MySQL::getInstance();
    return $db;
}

   function ejecutarSQL($db,$sql,$parametros){
        foreach($parametros as $key => $value){
            $sql = str_replace($key,"'".$value."'",$sql);
        }
        $db->setQuery($sql);
        $db->execute();
        if(substr($sql,0,6)=='SELECT'){
            $resultados = $db->loadObjectList();
            return $resultados;
        }
    }

$db = abrirDB();

switch($op){
    case 'inserTask':
        $usr = @$_REQUEST['usr'];
        $asunto = @$_REQUEST['asunto'];
        $vto = @$_REQUEST['vto'];
        $rte = @$_REQUEST['rte'];
        $link = @$_REQUEST['link'];
        $sql = 'INSERT into mensajes SET `destinatario` = :usuario , `asunto` = :asunto, `vencimiento` = :vencimiento, `remitente` = :remitente,`link` = :link';
        $parametros = array(
        ':usuario'=>$usr,
        ':asunto'=>$asunto,
        ':vencimiento'=>$vto,
        ':remitente'=>$rte,
        ':link'=>$link);
        ejecutarSQL($db, $sql, $parametros);
        echo "OK";
        break;
}
?>
