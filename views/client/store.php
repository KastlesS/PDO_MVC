<?php
require_once "controllers/clientsController.php";
//recoger datos
if (!isset ($_REQUEST["fiscal"])){
    header('location:index.php?tabla=client&accion=crear');
    exit();
}
$id=($_REQUEST["id"])??"";//el id me servirá en editar
$arrayUser=[
    "id"=>$id,
    "idFiscal"=>$_REQUEST["fiscal"],
    "contact_name"=>$_REQUEST["name"],
    "contact_email"=>$_REQUEST["email"],
    "contact_phone_number"=>$_REQUEST["tel"],
    "company_name"=>$_REQUEST["comp"],
    "company_address"=>$_REQUEST["compDir"],
    "company_phone_number"=>$_REQUEST["compTel"],  
];
//pagina invisible
$controlador= new ClientsController();

if($_REQUEST["evento"]=="crear"){
    $controlador->crear($arrayUser);
}

if ($_REQUEST["evento"]=="modificar"){
    $controlador->editar ($id, $arrayUser);
}

