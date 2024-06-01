<?php
class msaccess {
    private $conexion;
    private $name = '../xd.mdb';

    public function conectar() {
        $db = getcwd() . "\\" . $this->name;
        $dsn = "DRIVER={Microsoft Access Driver (*.mdb)};DBQ=" . $db;
        $this->conexion = odbc_connect($dsn, '', '');
    }

    public function desconectar() {
        odbc_close($this->conexion);
    }

    public function insert($tabla, $campos, $valores) {
        $q = 'INSERT INTO ' . $tabla . ' (' . $campos . ') VALUES (' . $valores . ')';
        $resultado = $this->consulta($q);
        return $resultado ? true : false;
    }

    public function consulta($q) {
        $resultado = odbc_exec($this->conexion, $q) or die(odbc_errormsg());
        return $resultado;
    }

    public function update($tabla, $camposValores, $condicion) {
        $q = 'UPDATE ' . $tabla . ' SET ' . $camposValores . ' WHERE ' . $condicion;
        $resultado = $this->consulta($q);
        return $resultado ? true : false;
    }
}

$db = new msaccess();
$db->conectar();

$Matricula = isset($_POST["Matricula"]) ? trim($_POST["Matricula"]) : null;
$nombreu = isset($_POST["nombreu"]) ? trim($_POST["nombreu"]) : null;
$apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : null;
$grupo = isset($_POST["grupo"]) ? trim($_POST["grupo"]) : null;
$matricula = isset($_POST["matricula"]) ? trim($_POST["matricula"]) : null;
$telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;
$deporteElegido = isset($_POST["deporteElegido"]) && $_POST["deporteElegido"] !== "no seleccionado" ? trim($_POST["deporteElegido"]) : null;

$updateParts = [];
if ($nombreu) $updateParts[] = "nombreu='$nombreu'";
if ($apellido) $updateParts[] = "apellido='$apellido'";
if ($grupo) $updateParts[] = "grupo='$grupo'";
if ($matricula) $updateParts[] = "matricula='$matricula'";
if ($telefono) $updateParts[] = "telefono='$telefono'";
if ($deporteElegido) $updateParts[] = "deporteElegido='$deporteElegido'";

if ($Matricula && !empty($updateParts)) {
    $updateQuery = implode(", ", $updateParts);
    $rs1 = $db->consulta("SELECT * FROM RegistroDeporte WHERE TRIM(Matricula) = '$Matricula'");
    if (odbc_fetch_row($rs1)) {
        $rs = $db->update("RegistroDeporte", $updateQuery, "TRIM(Matricula) = '$Matricula'");
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
