<?php
require_once "models/clientModel.php";
class ClientsController {
    private $model;

    public function __construct(){
        $this->model = new ClientModel();
    }

    public function crear (array $arrayUser):void {
        try {
            $id=$this->model->insert ($arrayUser);
            ($id==null)?header("location:index.php?tabla=client&accion=crear&error=true&id={$id}"):header("location:index.php?tabla=client&accion=ver&id=".$id);
            exit ();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function ver(int $id): ?stdClass{
        return $this->model->read($id);
    }

    public function listar (){
        return $this->model->readAll ();
    }

    public function borrar(int $id): void{
        $borrado = $this->model->delete($id);
        $nombre = $_REQUEST['nombre'];
        $redireccion = "location:index.php?accion=listar&tabla=client&evento=borrar&id={$id}&nombre={$nombre}";
        if ($borrado == false) $redireccion .= "&error=true";
        header($redireccion);
        exit();
    }

    public function editar (int $id, array $arrayUser):void {
        $editadoCorrectamente=$this->model->edit ($id, $arrayUser);
        //lo separo para que se lea mejor en el word
        $redireccion="location:index.php?tabla=client&accion=editar";
        $redireccion.="&evento=modificar&id={$id}";
        $redireccion.=($editadoCorrectamente==false)?"&error=true":"";
        //vuelvo a la pagina donde estaba
        header ($redireccion);
        exit();
    }

    public function buscar (string $usuario, string $opcion, string $parametro):array {
        return $this->model->search ($usuario,$opcion,$parametro);
    }
}