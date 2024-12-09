<?php
require_once "controllers/clientsController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$controlador = new ClientsController();
$usuario = "";

if (isset($_REQUEST["evento"])) {
    $mostrarDatos = true;

    switch ($_REQUEST["evento"]) {
        case "todos":
            $users = $controlador->listar();
            $mostrarDatos = true;
        break;
        case "filtrar":
            $usuario = ($_REQUEST["busqueda"]) ?? "";
            $opcion = $_POST["opcion"];
            $parametro = $_POST["usuario"];
            $users = $controlador->buscar($usuario,$opcion,$parametro);
        break;
        case "borrar":
            $visibilidad = "visibility";
            $mostrarDatos = true;
            $clase = "alert alert-success";
            //Mejorar y poner el nombre/usuario
            $mensaje = "El usuario con id: {$_REQUEST['id']} Borrado correctamente";
            if (isset($_REQUEST["error"])) {
                $clase = "alert alert-danger ";
                $mensaje = "ERROR!!! No se ha podido borrar el usuario con id: {$_REQUEST['id']}";
            }
        break;
    }
} 
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3border-bottom">
        <h1 class="h3">Buscar Cliente</h1>
    </div>

    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?=$mensaje ?>
        </div>
        <div>
            <form action="index.php?tabla=client&accion=buscar&evento=filtrar" method="POST">
                <div class="form-group">
                    <select name="usuario" id="usuario">
                        <option value="idFiscal">ID Fiscal</option>
                        <option value="contact_name">Nombre</option>
                        <option value="contact_email">Email</option>
                        <option value="contact_phone_number">Teléfono</option>
                        <option value="company_name">Compañía</option>
                        <option value="company_address">Dir. Compañía</option>
                        <option value="company_phone_number">Tel. Compañía</option>
                    </select>
                    <select name="opcion" id="opcion">
                        <option value="empezar">Empieza por</option>
                        <option value="acabar">Acaba en</option>
                        <option value="contener">Contiene</option>
                        <option value="igual">Igual a</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="usuario">Buscar Cliente</label>
                    <input type="text" required class="form-control" id="busqueda" name="busqueda" value="<?=$usuario?>" placeholder="Buscar">
                </div>
                <button type="submit" class="btn btn-success" name="Filtrar"><i class="fas fa-search"></i>Buscar</button>
            </form>
            <!-- Este formulario es para ver todos los datos -->
            <form action="index.php?tabla=client&accion=buscar&evento=todos" method="POST">
                <button type="submit" class="btn btn-info" name="Todos"><i class="fas fa-list"></i> Listar</button>
            </form>
        </div>
        <?php
        if ($mostrarDatos) {
            ?>
                <table class="table table-light table-hover">
                <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ID Fiscal</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Compañía</th>
                <th scope="col">Tel. Compañía</th>
                <th scope="col">Dir. Compañía</th>
                <th scope="col"></th>
                <th scope="col"></th>
                
            </tr>
                </thead>
                <tbody>
            <?php foreach ($users as $user) :
                $id = $user->id;
            ?>
                 <tr>
                    <th scope="row"><?= $user->id ?></th>
                    <td><?= $user->idFiscal ?></td>
                    <td><?= $user->contact_name ?></td>
                    <td><?= $user->contact_email ?></td>
                    <td><?= $user->contact_phone_number ?></td>
                    <td><?= $user->company_name ?></td>
                    <td><?= $user->company_phone_number ?></td>
                    <td><?= $user->company_address ?></td>
                    <td><a class="btn btn-danger" href="index.php?tabla=client&accion=borrar&id=<?= $id?>"><i class="fa fa-trash"></i> Borrar</a></td>
                    <td><a class="btn btn-success" href="index.php?tabla=client&accion=editar&id=<?= $id?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
            </table>
            <?php
        }
        ?>
    </div>
</main>