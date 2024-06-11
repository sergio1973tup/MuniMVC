<?php
    include_once 'Model/Usuario.php';
    include_once 'DataBase/Config.php';
    class Repository
    {
        private $conn;

        public function __construct(){
            $this->conn = getDataBaseConn();
        }

        function getAllUsers(){
            $Users = [];
            $sql = "SELECT * FROM munidb";

            $cons = mysqli_query($this->conn, $sql);
            if($cons->num_rows > 0){
                while($row = $cons->fetch_assoc()){
                    $Users[] = new Usuario($row ['id'], $row ['Nombre'], $row ['Apellido'], $row ['Email']);
                }
            }

            return $Users;
        }

        public function createUser(Usuario $user)
        {
            $stmt = $this->conn->prepare("INSERT INTO munidb (nombre,apellido,email) VALUES (?,?, ?)");
            $name = $user->getName();
            $lastName = $user->getLastName();
            $email = $user->getEmail();
            $stmt->bind_param("sss", $name, $lastName, $email);
            $stmt->execute();
        }

        public function Close(){
            $this->conn->close();
        }

        public function findByEmail($email) {
            $stmt = $this->conn->prepare("SELECT * FROM munidb WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
    }
?>