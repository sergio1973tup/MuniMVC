<?php
    require_once 'Repository/Repository.php';

    class UserController{
        private $UserRepository;
        private $reCaptcha = '6LeRJvIpAAAAALrirDiGQBSpn0QMTC-3OrjkyjBC';

        public function __construct(){
            $this->UserRepository = new Repository();
        }

        public function Start(){
            require_once 'Views/UserView/Create.php';
        }

        public function index(){
            require_once 'Views/Template.php';
        }

        public function ShowUsers(){
            $Users = $this->UserRepository->GetAllUsers();
            
            require "Views/UserView/View.php";
        }

        public function register(){

            if (isset($_POST["boton"])){
                if (strlen($_POST['Nombre']) >= 1 && strlen($_POST['Apellido']) >= 1 && strlen($_POST['Email']) >= 1 ){
                    $id = 0;
                    $name = trim($_POST['Nombre']);
                    $lastname = trim($_POST['Apellido']);
                    $email = trim($_POST['Email']);
                    $recaptchaResponse = $_POST['g-recaptcha-response'];

                    try{
                        $this->Validate($name,$lastname,$email,$recaptchaResponse);
                        $user = new Usuario($id, $name, $lastname, $email);
                        $this->UserRepository->createUser($user);
                        echo('REGISTRADO');
                    }
                    catch(Exception $e){
                        echo 'ERROR: ' . $e->getMessage();
                    }
                    
                }
            }
            return include_once 'Views/UserView/Create.php';
        }

        private function Validate($name,$lastName,$email,$recaptchaResponse){
            if(empty($name) || empty($lastName) || empty($email)){
                throw new Exception('todos los campos son obligatorios');
            }
            if (!preg_match("/^[a-zA-Z]+$/", $name)) {
                throw new Exception("El nombre solo puede contener letras.");
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Formato de correo electrónico no válido.");
            }
            if ($this->UserRepository->findByEmail($email)) {
                throw new Exception("El correo electrónico ya está en uso.");
            }
            $this-> validateRecaptcha($recaptchaResponse);
        }

        private function ValidateRecaptcha($recaptchaResponse){
            if(empty($recaptchaResponse)){
                throw new Exception("verifique recaptcha");
            }
            
            $recaptchaURL = 'https://www.google.com/recaptcha/api/siteverify';
            $response = file_get_contents($recaptchaURL .'?secret='. $this->reCaptcha . '&response=' . $recaptchaResponse);
            $responseKey = json_decode($response,true);
            if(intval($responseKey["success"]) !== 1){
                throw new Exception("error de recaptcha, intente nuevamente");
            }
        }

    }
?>