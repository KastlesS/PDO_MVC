<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3border-bottom">
        <h1 class="h3">Añadir Cliente</h1>
    </div>

    <div id="contenido">
        <form action="index.php?tabla=client&accion=guardar&evento=crear" method="POST">
            <div class="form-group">
                <label for="usuario">ID Fiscal </label>
                <input type="text" required class="form-control" id="fiscal" name="fiscal" aria-describedby="fiscal" placeholder="Introduce su ID Fiscal" pattern="^([0-9]{8}[A-Z])$|^([XYZ][0-9]{7}[A-Z])$|^([ABC][0-9]{7})[A-Z]$|^(N[0-9]{7}[A-Z])$">
                <small id="usuario" class="form-text text-muted">Compartir tu usuario lo hace menos seguro.</small>
            </div>
            <div class="form-group">
                <label for="name">Nombre de Contacto</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Introduce tu Nombre de Contacto" require>
            </div>
            <div class="form-group">
                <label for="tel">Número de Teléfono</label>
                <input type="text" required class="form-control" id="tel" name="tel" placeholder="Teléfono" pattern="^[0-9]{9}$">
            </div>
            <div class="form-group">
                <label for="email">Email </label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Introduce tu email" pattern="^[A-Za-z0-9]+@gmail.com$">
            </div>
            <div class="form-group">
                <label for="comp">Nombre de la compañía</label>
                <input type="text" required class="form-control" id="comp" name="comp" placeholder="Nombre de la Compañía" require>
            </div>
            <div class="form-group">
                <label for="comp">Número de la compañía</label>
                <input type="text" required class="form-control" id="compTel" name="compTel" placeholder="Número de la Compañía" pattern="^[A-Za-z0-9]+@gmail.com$">
            </div>
            <div class="form-group">
                <label for="comp">Dirección de la compañía</label>
                <input type="text" required class="form-control" id="compDir" name="compDir" placeholder="Dirección de la Compañía">
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