<?php

    namespace MyProject\Models\Users;

    use MyProject\Models\ActiveRecordEntity;

    class User extends ActiveRecordEntity{
        
        protected $firstName;
        protected $lastName;
        protected $mail;
        protected $password;
        protected $patronymic;
        protected $phoneNumber;
        protected $birthday;
        protected $gender;

        public function getFirstName(): string {
            return $this->firstName;
        }

        public function getLastName(): string {
            return $this->lastName;
        }

        public function getMail(): string {
            return $this->mail;
        }

        public function getPassword(): string {
            return $this->password;
        }

        public function getPatronymic(): string {
            return $this->patronymic;
        }

        public function getPhoneNumber() {
            return $this->phoneNumber;
        }

        public function getBirthday(): string {
            return $this->birthday; 
        }

        public function getGender(): string {
            return $this->gender;
        }

        protected static function getTableName(): string {
            return 'customers';
        }
    }