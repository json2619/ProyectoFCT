<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<?php
session_start();

require_once '../db/db.php';

$base = "sneakmarket";

$db = new DB($base);


function MenorInterv($filas, $intervalo)
{
    $inicio = $filas[2]['Hora']; 
    $diferecia = time() - $inicio;  
    return($diferecia <= $intervalo);
}

function TresDeneg($filas)
{
    $denegados = FALSE;
    $cont = 0;
    if (count($filas) >= 3) {
        reset($filas);
        while (($fila = current($filas)) !== FALSE && $fila['Acceso'] == "D") {
            $cont++;
            next($filas);
        }
        $denegados = ($cont == 3);
    }
    return $denegados;
}

function Bloqueado($usu)
{
    global $db;
    $bloqueado = FALSE;  
    $consulta = "SELECT Hora,Acceso 
              FROM  login
              where Usuario=:Usuario
              ORDER by hora desc
              limit 3";
    $param = array();
    $param[":Usuario"] = $usu;
    $db->ConsultaDatos($consulta, $param);
    $filas = $db->filas; 
    $bloqueado = -1;  
    $tiempoBloqueo = 300; 
    if (TresDeneg($filas)) {
        $intervalo = 300;  
        if (MenorInterv($filas, $intervalo)) {
            $bloqueado = $filas[0]['Hora'] + $tiempoBloqueo;
        }
    }
    return $bloqueado;
}

function IntentoLogin($usu, $cla)
{
    global $db;
    $consulta = "select count(*) as cuenta from usuarios where usuario=:usuario and contrasena=:contrasena";
    $param = array();
    $param[":usuario"] = $usu;
    $param[":contrasena"] = $cla;
    $db->ConsultaDatos($consulta, $param);
    $fila = $db->filas[0]; 
    return $fila;
}

function InsertarLogin($usu, $cla, $acceso)
{
    global $db;
    $consulta = "insert into login values(:Usuario,:Clave,:Hora,:Acceso)";
    $param = array();
    $param[":Usuario"] = $usu;
    $param[":Clave"] = $cla;
    $param[":Hora"] = time();  
    $param[":Acceso"] = $acceso;
    $db->ConsultaSimple($consulta, $param);
}

if (isset($_POST['Enviar'])) {
    $usu = $_POST['Usuario'];
    $salt1 = "~#!()=";
    $salt2 = "?)=€@";
    $cla = $salt1 . $_POST['Clave'] . $salt2;
    $cla = sha1($cla); 
    $bloqueado = Bloqueado($usu);
    if ($bloqueado == -1) {  
        $fila = IntentoLogin($usu, $cla);
        if ($fila['cuenta'] == 1) {  
            echo "<b> Login correcto!!!</b>";
            InsertarLogin($usu, $cla, "C");
            $_SESSION['usuario'] = $usu;  
            header('Location: Menu.php');
        } else {
            echo "<b> Usuario/Clave incorrecto </b>";
            InsertarLogin($usu, $cla, "D");
        }
    } else  { 
        $campos = getdate($bloqueado);   
        $hora = $campos['hours'] . ":" . $campos['minutes'] . ":" . $campos['seconds'];
        $dia = $campos['mday'] . "/" . $campos['mon'] . "/" . $campos['year'];
        echo "<b>El usuario $usu esta bloqueado hasta las $hora del dia $dia</b>";
    }
}
?>

<div class="login-container">
    <h2>Login</h2>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <div class="form-group">
            <label for="Usuario">Usuario</label>
            <input type="text" id="Usuario" name="Usuario" required>
        </div>
        <div class="form-group">
            <label for="Clave">Contraseña</label>
            <input type="password" id="Clave" name="Clave" required>
        </div>
        <button type="submit" name="Enviar">Iniciar sesión</button>
    </form>
</div>

</body>
</html>