<?php
require_once('config/db.php');

class UserModel{
    private $conexion;

    public function __construct(){
        $this->conexion = db::conexion();
    }

    public function verificarCampo($campo,$valor):bool{
        $sql="SELECT usuario FROM users WHERE $campo = :valor";
        $sentencia = $this->conexion->prepare($sql);
        $arrayDatos = [":valor"=>$valor];
        $resultado = $sentencia->execute($arrayDatos);
        if(!$resultado) return false;
        $user = $sentencia->fetch(PDO::FETCH_ASSOC);
        if(!empty($user)){
            return false;
        }else{
            return true;
        }
    }

    public function insert(array $user):?int{ //devuelve entero o null
        $sql="INSERT INTO users(usuario, password, name, email) VALUES (:usuario,:password,:name,:email);";
        $sentencia = $this->conexion->prepare($sql);
        $arrayDatos=[
            ":usuario"=>$user["usuario"],
            ":password"=>$user["password"],
            ":name"=>$user["name"],
            ":email"=>$user["email"],
        ];
        $resultado = $sentencia->execute($arrayDatos);
        /*Pasar en el mismo orden de los ? execute devuelve un booleano.
        True en caso de que todo vaya bien, falso en caso contrario.*/
        //Así podriamos evaluar
        return ($resultado==true)?$this->conexion->lastInsertId():null ;
    }

    public function read(int $id): ?stdClass{
        $sentencia = $this->conexion->prepare("SELECT * FROM users WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devuelve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $user = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($user == false) ? null : $user;
    }

    public function readAll():array{
        $sql = "SELECT * FROM users";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    public function delete (int $id):bool{
        $sql="DELETE FROM users WHERE id =:id";
        try {
            $sentencia = $this->conexion->prepare($sql);
            //devuelve true si se borra correctamente
            //false si falla el borrado
            $resultado= $sentencia->execute([":id" => $id]);
            return ($sentencia->rowCount ()<=0)?false:true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function edit (int $idAntiguo, array $arrayUsuario):bool{
        try {
            $sql="UPDATE users SET name = :name, email=:email, ";
            $sql.= "usuario = :usuario, password= :password ";
            $sql.= " WHERE id = :id;";
            $arrayDatos=[
                ":id"=>$idAntiguo,
                ":usuario"=>$arrayUsuario["usuario"],
                ":password"=>$arrayUsuario["password"],
                ":name"=>$arrayUsuario["name"],
                ":email"=>$arrayUsuario["email"],
            ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function search (string $texto, string $opcion, string $campo):array{
        switch($opcion){
            case "empezar":
                $dato = $texto."%";
                break;
            case "acabar":
                $dato = "%".$texto;
                break;
            case "contener":
                $dato = "%". $texto."%";
                break;
            case "igual":
                $dato = $texto;
                break;
        }
        $sql="SELECT * FROM users WHERE $campo LIKE :dato";
        $sentencia = $this->conexion->prepare($sql);
        //ojo el si ponemos % siempre en comillas dobles "
        $arrayDatos=[":dato"=>$dato];
        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return [];
        $users = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    public function login(string $usuario,string $password): ?stdClass{
        $sentencia = $this->conexion->prepare("SELECT * FROM users WHERE usuario=:usuario and password=:contra");
        $arrayDatos = [
            ":usuario" => $usuario,
            ":contra"=>$password
        ];
        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return null;
        $user = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($user == false) ? null : $user;
    }
}