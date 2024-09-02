<?php

interface UserRepositoryInterface {
    public function guardar(User $user): bool;
    public function actualizar(User $user): bool;
    public function eliminar(int $id): bool;
}

class UserRepository implements UserRepositoryInterface {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function guardar(User $user): bool {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (id,nombre, correo_electronico, contrasena) VALUES (:id, :nombre, :correo_electronico, :contrasena)");
        $stmt->bindValue(':id', $user->newId());
        $stmt->bindValue(':nombre', $user->getNombre());
        $stmt->bindValue(':correo_electronico', $user->getCorreoElectronico());
        $stmt->bindValue(':contrasena', $user->getContrasena());
        $stmt->bindValue(':id', $user->getID());
        return $stmt->execute();
    }

    public function actualizar(User $user): bool {
		$stmt = $this->pdo->prepare("UPDATE usuarios SET nombre = :nombre, correo_electronico = :correo_electronico WHERE id = :id");
		$stmt->bindValue(':nombre', $user->getNombre());
		$stmt->bindValue(':correo_electronico', $user->getCorreoElectronico());
		$stmt->bindValue(':id', $user->getID());
		return $stmt->execute();
	}

    public function eliminar($id): bool {
		$stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
		$stmt->bindValue(':id', $id);
		return $stmt->execute();
	}
	
	public function encontrarPorId($id): bool {
		$stmt = $this->pdo->prepare("SELECT nombre,correo_electronico,contrasena FROM WHERE id = :id");
		$stmt->bindValue(':id', $user->getID());
		return $stmt->execute();
	}
}

?>