<?php
    require_once "controllers/usersController.php";

    $controlador= new UsersController();
    $users= $controlador->listar ();
    $visibilidad="hidden";

    if (isset ($_REQUEST["evento"]) && $_REQUEST["evento"]=="borrar"){
        $visibilidad="visibility";
        $clase="alert alert-success";
        //Mejorar y poner el nombre/usuario
        $mensaje="El usuario con id: {$_REQUEST['id']} , usuario: {$_REQUEST['nombre']} y nombre: {$_REQUEST['usuario']} ha sido borrado correctamente";
        if (isset($_REQUEST["error"])){
            $clase="alert alert-danger ";
            $mensaje="ERROR!!! No se ha podido borrar el usuario con id: {$_REQUEST['id']}";
        }
    }
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3border-bottom">
        <h1 class="h3">Listar usuario</h1>
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
                <th scope="col">Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Eliminar</th>
                <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($users as $user) :
                    $id = $user->id;
                    $nombre = $user->name;
                    $usuario = $user->usuario;
                ?>
                <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><?= $user->usuario ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td><a class="btn btn-danger" href="index.php?tabla=user&accion=borrar&id=<?=$id?>&nombre=<?=$nombre?>&usuario=<?=$usuario?>"><i class="fa fa-trash"></i> Borrar</a></td>
                <td><a class="btn btn-success" href="index.php?tabla=user&accion=editar&id=<?=$id?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
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