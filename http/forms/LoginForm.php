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

            return empty($this->errors);

        }

        public function getErrors(): array {
            return $this->errors;
        }

        public function setErrors($field, $message) {
            $this->errors[$field] = $message;
        }
    }