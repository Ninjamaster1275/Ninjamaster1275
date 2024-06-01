<?php
class msaccess{
    private $conexion;
    private $name = '../xd.mdb';

    public function conectar(){
        $db = getcwd()."\\".$this->name;
        $dsn = "DRIVER={Microsoft Access Driver (*.mdb)};DBQ=".$db;
        $this->conexion = odbc_connect($dsn, '', '');
    }

    public function desconectar()
    {
        odbc_close($this->conexion);
    }

    function insert($tabla, $campos, $valores)
    {
        $q = 'INSERT INTO '.$tabla.' ('.$campos.') VALUES ('.$valores.')';
        $resultado = $this->consulta($q);
        if($resultado) return true;
        else return false;
    }

    public function consulta($q)
    {
        $resultado = odbc_exec($this->conexion, $q) or die(odbc_errormsg());
        return $resultado;
    }
}

$db = new msaccess();
$db->conectar();

$nombre = $_POST["n"];
$apellido = $_POST["a"];
$grupo = $_POST["g"];
$matricula = $_POST["m"];
$telefono = $_POST["t"];
$culturaElegida = $_POST["c"];

$rs = $db->consulta("SELECT * FROM RegistroCultura");
$db -> insert("RegistroCultura","nombre, apellido, grupo, matricula, telefono, culturaElegida"," '$nombre', '$apellido', '$grupo', '$matricula', '$telefono', '$culturaElegida' ");

$db->desconectar();

header("Refresh: 0; url=../../index.html");
?>
