<?php
    session_start();
    $error = isset($_SESSION["errores"])?"visible":"invisible";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3border-bottom">
        <h1 class="h3">Añadir usuario</h1>
    </div>

    <div id="contenido">
        <form action="index.php?tabla=user&accion=guardar&evento=crear" method="POST">
            <div class="form-group">
                <label for="usuario">Usuario </label>
                <input type="text" required class="form-control" id="usuario" name="usuario" aria-describedby="usuario" placeholder="Introduce Usuario" pattern="^[A-Za-z0-9]{2,50}$">
                <small id="usuario" class="form-text text-muted">Compartir tu usuario lo hace menos seguro.</small>
                <div class="alert alert-danger <?=$error?>" ><?=$_SESSION["errores"]["usuario"]?></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" required class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="name">Nombre </label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Introduce tu Nombre" pattern="^[A-Z][a-z]{1,20}">
            </div>
            <div class="form-group">
                <label for="email">email </label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Introduce tu email" pattern="^[A-Za-z0-9]+@gmail.com$">
                <div class="alert alert-danger <?=$error?>" ><?=$_SESSION["errores"]["email"]?></div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-danger" href="index.php">Cancelar</a>
        </form>
        <div id="contenido">
            <?php
                $cadena=(isset($_REQUEST["error"]))?"Error, ha fallado la inserción":"";
                $visibilidad=(isset($_REQUEST["error"]))?"visible":"invisible";
            ?>
        <div class="alert alert-danger <?=$visibilidad?>" ><?=$cadena?></div>
    </div>
</main>