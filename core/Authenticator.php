<?php

    namespace core;

    class Authenticator
    {
        protected array $user;
        private Database $db;

        public function __construct() {
            $this->db = App::resolve(Database::class);
        }

        public function attempt($email, $password): bool {
            $this->user = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();

            if (empty($this->user) || !password_verify($password, $this->user['password'])) {
                return false;
            }

            $this->login();
            return true;
        }

        public function attemptRegister($email): bool {
            $this->user = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();
            return !!empty($this->user);
        }

        public function register($email, $password): void {
            $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)]);

            $this->user = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();

            $this->login();
        }

        public function login() {
            $_SESSION['user'] = [
                'email' => $this->user['email'],
                'user_id' => $this->user['user_id'],
            ];
            session_regenerate_id(true);
        }

        public function logout() {
           Session::destroy();
        }
    }