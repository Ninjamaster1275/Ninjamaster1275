<?php
class msaccess {
    private $conexion;
    private $name = 'xd.mdb';

    public function conectar() {
        $db = getcwd() . "\\" . $this->name;
        $dsn = "DRIVER={Microsoft Access Driver (*.mdb)};DBQ=" . $db;
        if (!($this->conexion = odbc_connect($dsn, '', ''))) {
            exit("Error al conectar a la base de datos.");
        }
    }

    public function desconectar() {
        odbc_close($this->conexion);
    }

    public function consulta($q) {
        $resultado = odbc_exec($this->conexion, $q);
        if (!$resultado) {
            echo "<p>Error en la consulta SQL: " . odbc_errormsg($this->conexion) . "</p>";
            return false;
        }
        return $resultado;
    }
}

$db = new msaccess();
$db->conectar();

$nombreu = isset($_POST["nombreu"]) ? trim($_POST["nombreu"]) : null;
$Matricula = isset($_POST["Matricula"]) ? trim($_POST["Matricula"]) : null;
$apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : null;
$grupo = isset($_POST["grupo"]) ? trim($_POST["grupo"]) : null;
$matricula = isset($_POST["matricula"]) ? trim($_POST["matricula"]) : null;
$telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;
$culturaElegida = isset($_POST["culturaElegida"]) && $_POST["culturaElegida"] !== "no seleccionado" ? trim($_POST["culturaElegida"]) : null;

$updateParts = [];
if ($nombreu) $updateParts[] = "nombreu='$nombreu'";
if ($apellido) $updateParts[] = "apellido='$apellido'";
if ($grupo) $updateParts[] = "grupo='$grupo'";
if ($matricula) $updateParts[] = "matricula='$matricula'";
if ($telefono) $updateParts[] = "telefono='$telefono'";
if ($culturaElegida) $updateParts[] = "culturaElegida='$culturaElegida'";

if ($Matricula && !empty($updateParts)) {
    $updateQuery = implode(", ", $updateParts);
    $rs1 = $db->consulta("SELECT * FROM RegistroCultura WHERE TRIM(Matricula) LIKE TRIM('$Matricula')");
    if (odbc_fetch_row($rs1)) {
        $rs = $db->consulta("UPDATE RegistroCultura SET $updateQuery WHERE TRIM(Matricula) LIKE TRIM('$Matricula')");
        if ($rs) {
            echo "<p>Registro actualizado correctamente.</p>";
        } else {
            echo "<p>Error al actualizar el registro.</p>";
        }
    } else {
        echo "<p>No se encontró el registro con la Matricula: $Matricula</p>";
    }
} else {
    echo "<p>Debe proporcionar una Matricula válida y al menos un dato para actualizar.</p>";
}

$db->desconectar();
header("Refresh: 0; url=../../index.html");
?>
