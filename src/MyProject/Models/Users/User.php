<?php

    namespace MyProject\Models\Users;

    use MyProject\Models\ActiveRecordEntity;
    use MyProject\Exceptions\InvalidArgumentException;

    class User extends ActiveRecordEntity{
        
        //геттеры и сетторы
        protected $firstName;
        protected $lastName;
        protected $email; //корректность и уникальность
        protected $passwordHash; //не менее 8 символов и в md5
        // protected $patronymic;
        protected $phoneNumber;
        protected $birthday;
        protected $gender;

        //только геттеры, заполняются сервером значениями по умолчанию
        protected $role;
        protected $isConfirmed;
        protected $authToken;
        protected $createdAt;

        public function getRole(): string {
            return $this->role;
        }

        public function getFirstName(): string {
            return $this->firstName;
        }

        public function getLastName(): string {
            return $this->lastName;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getPasswordHash(): string {
            return $this->passwordHash;
        }

        // public function getPatronymic(): string {
        //     return $this->patronymic;
        // }

        public function getPhoneNumber() {
            return $this->phoneNumber;
        }

        public function getBirthday(): string {
            return $this->birthday; 
        }

        public function getGender(): int {
            return $this->gender;
        }

        public function getAuthToken(): string {
            return $this->authToken;
        }

        public static function signUp(array $userData): User {
            // vardump($userData);
            // return;

            // $dateNow = date('Y-m-d H:i:s');
            // vardump($dateNow);
            // return;

            if (empty($userData['firstName'])) {
                throw new InvalidArgumentException('Введите имя');
            }
            
            //без кирилицы
            if (!preg_match('/^[A-Za-z0-9]+$/', $userData['firstName'])) {
                throw new InvalidArgumentException('Некорректное имя');
            }

            if (empty($userData['lastName'])) {
                throw new InvalidArgumentException('Введите фамилию');
            }

            //без кирилицы
            if (!preg_match('/^[A-Za-z0-9]+$/', $userData['lastName'])) {
                throw new InvalidArgumentException('Некорректная фамилия');
            }

            //без кирилицы пока без отчества
            // if (
            //     mb_strlen($userData['patronymic']) != 0 &&  
            //     !preg_match('/^[A-Za-z0-9]+$/', $userData['patronymic'])
            // ){
            //     throw new InvalidArgumentException('Некорректное отчество');
            // }

            if (empty($userData['email'])) {
                throw new InvalidArgumentException('Введите email');
            }

            if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException('Некорректный Email');
            }

            if (static::findOneByColumn('email', $userData['email']) !== null) {
                throw new InvalidArgumentException('Пользователь с такие Email уже существет');
            } 

            if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException('Некорректный Email');
            }

            if (empty($userData['password'])) {
                throw new InvalidArgumentException('Введите пароль');
            }

            if (mb_strlen($userData['password']) < 8) {
                throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
            }

            if ($userData['password'] != $userData['r-password']) {
                throw new InvalidArgumentException('Пароли не совпадают');
            }

            if (empty($userData['gender'])) {
                throw new InvalidArgumentException('Выберите пол');
            }

            $user = new User();
            $user->firstName = $userData['firstName'];
            $user->lastName = $userData['lastName'];
            // $user->patronymic = $userData['patronymic'];
            $user->email = $userData['email'];
            $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
            $user->gender = (int) $userData['gender'];

            $user->role = 'user';
            $user->isConfirmed = (int) false; //MySQL не поддерживает тип boolean и заменяет его на TIMYINT(1), поэтому явно задаем тип int!!!
            $user->authToken = md5(random_bytes(100)) . md5(random_bytes(100)); //random_bytes — Генерирует криптографически безопасные псевдослучайные байты. Мы не будем передавать после того как вошли на сайт в cookie ни пароль, ни его хеш. Мы будем использовать только этот токен, который у каждого пользователя будет свой и он никак не будет связан с паролем – так безопаснее.
            $user->createdAt = date('Y-m-d H:i:s');
            // vardump($user);
            $user->save();

            return $user;
        }

        public static function login(array $loginData): User {
            
            if (empty($loginData['email'])) {
                throw new InvalidArgumentException('Введите email');
            }

            if (empty($loginData['password'])) {
                throw new InvalidArgumentException('Введите пароль');
            }

            $user = User::findOneByColumn('email', $loginData['email']);

            if ($user === null) {
                throw new InvalidArgumentException('Пользователя с такием email не существует');
            }
            
            if (!password_verify($loginData['password'], $user->getPasswordHash())) { //Проверяет, соответствует ли пароль хешу.
                throw new InvalidArgumentException('Неверный пароль');
            }

            $user->refreshAuthToken();
            $user->save();

            return $user;
        }

        private function refreshAuthToken() {
            $this->authToken = md5(random_bytes(100)) . md5(random_bytes(100)); //после входа обновляем токен
        }

        protected static function getTableName(): string {
            return 'users';
        }
    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }