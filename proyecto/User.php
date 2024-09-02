<?php
class User {
    private $id;
    private $nombre;
    private $correoElectronico;
    private $contrasena;

    // Constructor
    public function __construct($nombre, $correoElectronico, $contrasena) {
        $this->nombre = $nombre;
        $this->correoElectronico = $correoElectronico;
        $this->contrasena = $contrasena;
    }
	
    public function getId() {
		return $this->id;
	
    public function newId() {
		$this->setID(uniqid());
	}
	
    public function setId($id) {
        $this->id = $id;
	}
	
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getCorreoElectronico() {
        return $this->correoElectronico;
    }

    public function setCorreoElectronico($correoElectronico) {
        $this->correoElectronico = $correoElectronico;
    }
	
    public function cambiarContrasena($nuevaContrasena) {
        $this->contrasena = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
    }
	
    public function verificarContrasena($contrasenaIngresada) {
        return password_verify($contrasenaIngresada, $this->contrasena);
    }
	
    public function toString() {
        return "Id: " . $this->id . " Usuario: " . $this->nombre . ", Correo: " . $this->correoElectronico;
    }
}

?>