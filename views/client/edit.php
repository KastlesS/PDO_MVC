<?php
require_once "controllers/clientsController.php";
//recoger datos
if (!isset($_REQUEST["id"])) {
    header('location:index.php?accion=listar');
    exit();
}
$id = $_REQUEST["id"];
$controlador = new ClientsController();
$user = $controlador->ver($id);
$nombre = $user->contact_name;
$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;
if ($user == null) {
    $visibilidad = "visbility";
    $mensaje = "El usuario con id: {$id} no existe. Por favor vuelva a la pagina anterior";
    $clase = "alert alert-danger";
    $mostrarForm = false;
} else if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "modificar") {
    $visibilidad = "vibility";
    $mensaje = "Usuario con id {$id} y nombre: {$nombre} ha sido modificado con éxito";
    if (isset($_REQUEST["error"])) {
        $mensaje = "No se ha podido modificar el id {$id}";
        $clase = "alert alert-danger";
    }
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3border-bottom">
        <h1 class="h3">Editar Cliente con Id: <?= $id ?></h1>
    </div>

    <div id="contenido">
        <div id="msg" name="msg" class="<?= $clase ?>" <?= $visibilidad ?> > <?= $mensaje ?> </div>
            <?php
            if ($mostrarForm) {
            ?>
            <form action="index.php?tabla=client&accion=guardar&evento=modificar" method="POST">
                <input type="hidden" id="id" name="id" value="<?= $user->id ?>">

                <div class="form-group">
                    <label for="usuario">ID Fiscal </label>
                    <input type="text" required class="form-control" id="fiscal" name="fiscal" aria-describedby="fiscal" placeholder="Introduce su ID Fiscal" value="<?=$user->idFiscal?>">
                    <small id="usuario" class="form-text text-muted">Compartir tu usuario lo hace menos seguro.</small>
                </div>

                <div class="form-group">
                    <label for="name">Nombre de Contacto</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Introduce tu Nombre de Contacto" value="<?=$user->contact_name?>">
                </div>
                <div class="form-group">
                    <label for="tel">Número de Teléfono</label>
                    <input type="text" required class="form-control" id="tel" name="tel" placeholder="Teléfono" value="<?=$user->contact_phone_number?>">
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Introduce tu email" value="<?=$user->contact_phone_number?>">
                </div>
                <div class="form-group">
                    <label for="comp">Nombre de la compañía</label>
                    <input type="text" required class="form-control" id="comp" name="comp" placeholder="Nombre de la Compañía" value="<?=$user->company_name?>">
                </div>
                <div class="form-group">
                    <label for="comp">Número de la compañía</label>
                    <input type="text" required class="form-control" id="compTel" name="compTel" placeholder="Número de la Compañía" value="<?=$user->company_phone_number?>">
                </div>
                <div class="form-group">
                    <label for="comp">Dirección de la compañía</label>
                    <input type="text" required class="form-control" id="compDir" name="compDir" placeholder="Dirección de la Compañía" value="<?=$user->company_address?>">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-danger" href="index.php?tabla=client&accion=listar">Cancelar</a>
            </form>
            <?php
                } else {
            ?>
            <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
            <?php
                }
            ?>
        </div>
    </div>
</main>