<?php
    require_once "controllers/clientsController.php";

    $controlador= new ClientsController();
    $users= $controlador->listar ();
    $visibilidad="hidden";

    if (isset ($_REQUEST["evento"]) && $_REQUEST["evento"]=="borrar"){
        $visibilidad="visibility";
        $clase="alert alert-success";
        //Mejorar y poner el nombre/usuario
        $mensaje="El usuario con id: {$_REQUEST['id']} y el nombre: {$_REQUEST['nombre']} ha sido borrado correctamente";
        if (isset($_REQUEST["error"])){
            $clase="alert alert-danger ";
            $mensaje="ERROR!!! No se ha podido borrar el usuario con id: {$_REQUEST['id']}";
        }
    }
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3border-bottom">
        <h1 class="h3">Listar Cliente</h1>
    </div>
    <div id="contenido">
        <?php
        if (count($users) <= 0) :
        echo "No hay Datos a Mostrar";
        else : ?>
        <table class="table table-light table-hover">
            <thead class="table-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">ID Fiscal</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Compañía</th>
                <th scope="col">Dir. Compañía</th>
                <th scope="col">Tel. Compañía</th>
                <th scope="col">Eliminar</th>
                <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($users as $user) :
                    $id = $user->id;
                    $nombre = $user->contact_name;
                ?>
                <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><?= $user->idFiscal ?></td>
                <td><?= $user->contact_name?></td>
                <td><?= $user->contact_email ?></td>
                <td><?= $user->contact_phone_number ?></td>
                <td><?= $user->company_name ?></td>
                <td><?= $user->company_address ?></td>
                <td><?= $user->company_phone_number ?></td>
                <td><a class="btn btn-danger" href="index.php?tabla=client&accion=borrar&id=<?=$id?>&nombre=<?=$nombre?>"><i class="fa fa-trash"></i> Borrar</a></td>
                <td><a class="btn btn-success" href="index.php?tabla=client&accion=editar&id=<?=$id?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <?php
        endif;
        ?>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
    <table class="table table-light table-hover">
</main>