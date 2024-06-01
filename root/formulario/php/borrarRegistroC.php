<?php
class msaccess {

    private $conexion;
    private $name = 'xd.mdb';

    public function conectar()
    {
        $db = getcwd() . "\\" . $this->name;
        $dsn = "DRIVER={Microsoft Access Driver (*.mdb)};DBQ=" . $db;
        $this->conexion = odbc_connect($dsn, '', '');
    }

    public function desconectar()
    {
        odbc_close($this->conexion);
    }

    public function consulta($q)
    {
        $resultado = odbc_exec($this->conexion, $q) or die(odbc_errormsg());
        return $resultado;
    }
}

$db = new msaccess();
$db->conectar();

$Matricula = isset($_POST["Matricula"]) ? trim($_POST["Matricula"]) : null;
if (!empty($Matricula)) {
    $rs1 = $db->consulta("SELECT * FROM RegistroCultura WHERE TRIM(Matricula) = '$Matricula'");

    if (odbc_fetch_row($rs1)) {
        $rs = $db->consulta("DELETE FROM RegistroCultura WHERE TRIM(Matricula) = '$Matricula'");
        printf("<p>Registros de la matricula $Matricula eliminados correctamente</p>");
    } else {
        printf("<p>No se encontró el registro con la matricula $Matricula</p>");
    }
} else {
    printf("<p>Matrícula no especificada</p>");
}

$db->desconectar();

header("Refresh: 0; url=../../index.html");
?>

