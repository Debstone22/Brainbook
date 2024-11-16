
<?php
require_once(__DIR__ . '/../models/Usuario.php');

class UsuarioController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
    }

    public function mostrarUsuarios() {
        $usuarios = $this->usuario->obtenerUsuarios();
        require_once(__DIR__ . '/../views/usuarios_view.php');
    }
}
?>
