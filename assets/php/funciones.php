<?php
function is_valid_dni(string $dni): bool{
    $letter = substr($dni, -1);
    $numbers = substr($dni, 0, -1);
    $patron = "/[0-9]{7,8}[A-Z]/";
    if (preg_match($patron, $dni) && substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers % 23, 1) == $letter && strlen($letter) == 1 ) {
        return true;
    }
    return false;
}

function validateNie($nif){
    if (preg_match('/^[XYZT][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Z0-9]/', $nif)) {
      for ($i = 0; $i < 9; $i ++){
        $num[$i] = substr($nif, $i, 1);
      }

      if ($num[8] == substr("TRWAGMYFPDXBNJZSQVHLCKE", substr(str_replace(array("X","Y","Z"), array("0","1","2"), $nif), 0, 8) % 23, 1)) {
        return true;
      } else {
        return false;
      }
    }
  }


function HayNulos(array $camposNoNulos, array $arrayDatos): array{
    $nulos = [];
    foreach ($camposNoNulos as $index => $campo) {
        if (!isset($arrayDatos[$campo]) || empty($arrayDatos[$campo]) || $arrayDatos[$campo] == null) {
            $nulos[] = $campo;
        }
    }
    return $nulos;
}

function existeValor(array $array, string $campo, mixed $valor): bool{
        return in_array ($array[$campo],$valor);

}

function DibujarErrores($errores, $campo){
    $cadena = "";
    if (isset($errores[$campo])) {
        $last = end($errores);
        foreach ($errores[$campo] as $indice => $msgError) {
            $salto = ($errores[$campo] == $last) ? "" : "<br>";
            $cadena .= "{$msgError}.{$salto}";
        }
    }
    return $cadena;
}

function is_valid_email($str){
    return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
}

function fechaEs($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}

function validarNif($valor):bool {
    $dni = '/^[0-9]';
    $nie = '/^[XYZ]';

    if(preg_match($dni,$valor)){
        is_valid_dni($valor);
    
    } else if (preg_match($nie,$valor)){
        validateNie($valor);

    } else {

    }
}
