<?php
require_once "controllers/usersController.php";
//recoger datos
if (!isset ($_REQUEST["usuario"])){
    header('location:index.php?tabla=user&accion=crear');
    exit();
}
$id=($_REQUEST["id"])??"";//el id me servirá en editar
$arrayUser=[
    "id"=>$id,
    "usuario"=>$_REQUEST["usuario"],
    "password"=>$_REQUEST["password"],
    "name"=>$_REQUEST["name"],
    "email"=>$_REQUEST["email"],
];
//pagina invisible
$controlador= new UsersController();

if($_REQUEST["evento"]=="crear"){
    $controlador->crear($arrayUser);
}

if ($_REQUEST["evento"]=="modificar"){
    $controlador->editar ($id, $arrayUser);
}

