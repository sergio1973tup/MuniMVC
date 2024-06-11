<?php
    class Usuario
    {
        private int $id ;
        private string $name;
        private string $lastName;
        private string $email;

        public function __construct(int $id, string $name, string $lastName, string $email)
        {
            $this->id = $id;
            $this->name = $name;
            $this->lastName = $lastName;
            $this->email = $email;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }
        public function getLastName()
        {
            return $this->lastName;
        }
        public function getEmail(){
            return $this->email;
        }

        public function setName($name){
            $this->name = $name;
        }
        public function setLastName($lastName){
            $this->lastName = $lastName;
        }
        public function setEmail($email){
            $this->email = $email;
        }
    }

?>