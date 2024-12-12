<?php
session_start();
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
    $flag = $controlador->verificar("usuario",$arrayUser["usuario"]);
    $flag2 = $controlador->verificar("email",$arrayUser["email"]);

    !$flag?$_SESSION["errores"]["usuario"]="El usuario {$arrayUser['usuario']} ya existe":"";
    !$flag2?$_SESSION["errores"]["email"]="El email {$arrayUser['email']} ya está introducido":"";
    
    ($flag&&$flag2)?$controlador->crear($arrayUser):header("location:index.php?tabla=user&accion=crear");exit();
}

if ($_REQUEST["evento"]=="modificar"){
    $controlador->editar ($id, $arrayUser);
}

