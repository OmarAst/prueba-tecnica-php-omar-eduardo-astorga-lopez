<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCrearUsuario()
    {
        $user = new User('Juan Perez', 'juanperez@example.com', 'micontraseña');
        $this->assertEquals('Juan Pérez', $user->getNombre());
        $this->assertEquals('juanperez@example.com', $user->getCorreoElectronico());
    }
	
	public function testCrearYBuscarUsuario()
	{
		$user = new User('Juan Perez', 'juanperez@example.com', 'micontraseña');
		$this->userRepository->guardar($user);

		$userEncontrado = $this->userRepository->encontrarPorId($user->getId());

		$this->assertEquals($user, $userEncontrado);
	}

    public function testCambiarContrasena()
    {
        $user = new User('Ana Garcia', 'anagarcia@example.com', 'contraseña123');
        $user->cambiarContrasena('nuevacontraseña');
        $this->assertTrue($user->verificarContrasena('nuevacontraseña'));
        $this->assertFalse($user->verificarContrasena('contraseña123'));
    }

    public function testCambiarCorreo()
    {
        $user = new User('Ana Garcia', 'anagarcia@example.com', 'contraseña123');
        $user->setCorreoElectronico('juanperez@example.com');
        $this->assertTrue($user->verificarContrasena('nuevacontraseña'));
        $this->assertFalse($user->verificarContrasena('contraseña123'));
    }

    public function testCambiarNombre()
    {
        $user = new User('Ana Garcia', 'anagarcia@example.com', 'contraseña123');
        $user->setNombre('Clara Garcia');
    }
	
	public function testGuardarUsuarioEnBaseDeDatos()
	{
		// Configurar la conexión a la base de datos
		$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'user', 'password');

		// Crear un usuario y guardarlo
		$user = new User('Ana Garcia', 'anagarcia@example.com', 'contraseña123');
		$userRepository = new UserRepository($pdo);
		$userRepository->guardar($user);

		// Verificar que el usuario se haya guardado en la base de datos
		$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE correo_electronico = :correo');
		$stmt->execute([':correo' => 'anagarcia@example.com']);
		$result = $stmt->fetch();

		$this->assertNotNull($result);
		$this->assertEquals('Ana Garcia', $result['nombre']);
	}

}

?>