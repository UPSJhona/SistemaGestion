<?php
session_start();
if (!$_SESSION['isLogged']) {
    header("Location: ../public/controladores/login.php");
}
?>
<?php


include '../../config/conexionBD.php';
$actual = isset($_POST["actual"]) ? trim($_POST["actual"]) : null;
$nueva = isset($_POST["nueva"]) ? trim($_POST["nueva"]) : null;
$repnueva = isset($_POST["repnueva"]) ? trim($_POST["repnueva"]) : null;
$cod = $_GET["usu_cod"];

$sql = "SELECT usu_password FROM usuario WHERE usu_codigo='$cod'";

$result = $conn->query($sql);
$result = $result->fetch_assoc();

if (MD5($actual) === $result["usu_password"]) {
    if ($nueva === $repnueva) {
        $sql = "UPDATE usuario SET usu_password = MD5('$nueva') WHERE usu_codigo ='$cod'";
        if ($conn->query($sql) === true) {
            header("Location: ../vista/usuario/index.php");
        } else {
            header("Location: CambiarContra.php");
        }
    }
}