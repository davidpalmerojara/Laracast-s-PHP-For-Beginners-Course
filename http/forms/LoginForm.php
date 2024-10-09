<?php

    namespace http\forms;

    use core\Validator;

    class LoginForm
    {
        protected array $errors = [];
        public function validate($email, $password): bool
        {

            if (!Validator::email($email)) {
                $this->errors['email'] = "Please enter a valid email address.";
            }

            if (!Validator::string($password)) {
                $this->errors['password'] = "Password does not match.";
            }

            return empty($this->errors);

        }

        public function getErrors(): array {
            return $this->errors;
        }
    }