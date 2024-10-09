<?php

    namespace core;

    class Authenticator
    {
        protected array $errors = [];
        protected array $user;
        private Database $db;

        public function __construct() {
            $this->db = App::resolve(Database::class);
        }

        public function attempt($email, $password): bool {
            $this->user = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();

            // check email
            if (empty($this->user)) {
                $this->errors['email'] = "Please enter a valid email address.";
                return false;
            }

            // check password

            if (!password_verify($password, $this->user['password'])) {
                $this->errors['password'] = "Password does not match.";;
                return false;
            }
            return true;
        }

        public function attemptRegister($email): bool {
            $this->user = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();

            if (!empty($this->user)) {
                $this->errors['email'] = "Email does exist";
                return false;
            }
            return true;
        }


        public function getErrors(): array {
            return $this->errors;
        }

        public function getUser(): array {
            return $this->user;
        }

        public function register($email, $password): void {
            $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)]);

            $this->user = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();

            $this->login($this->user);
        }

        public function login($user) {
            $_SESSION['user'] = [
                'email' => $user['email'],
                'user_id' => $user['user_id'],
            ];
            session_regenerate_id(true);
        }

        public function logout() {
            $_SESSION = [];
            session_destroy();

            $params = session_get_cookie_params();
            setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']  );

        }
    }