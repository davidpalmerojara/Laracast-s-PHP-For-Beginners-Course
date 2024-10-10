<?php

    namespace http\forms;

    use core\Validator;

    class RegistrationForm
    {
        protected array $errors = [];
        public function validate($email, $password): bool
        {

            if (!Validator::email($email)) {
                $this->errors['email'] = "Please enter a valid email address.";
            }

            if (!Validator::string($password, 7, 255)) {
                $this->errors['password'] = "Password must be at least 7 characters long.";
            }

            return empty($this->errors);

        }

        public function setErrors($field, $message) {
            $this->errors[$field] = $message;
        }

        public function getErrors(): array {
            return $this->errors;
        }
    }