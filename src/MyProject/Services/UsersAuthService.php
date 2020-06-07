<?php

    namespace MyProject\Services;

    use MyProject\Models\Users\User;

    class UsersAuthService {

        public static function createToken(User $user): void {

            $token = $user->getId() . ':' . $user->getAuthToken();
            setcookie('token', $token, 0, '/', '', false, true); //setcookie ( string $name, string $value = "", int $expires = 0, string $path = "", string $domain = "", bool $secure = FALSE, bool $httponly = FALSE) : bool. 
        }

        public static function deleteToken(): bool {
            $token = $_COOKIE['token'] ?? '';

            if(empty($token)) {
                return null;
            }

            return setcookie('token', '', -0, '/', '', false, true);
        }

        public static function getUserByToken(): ?User {
            $token = $_COOKIE['token'] ?? '';

            if(empty($token)) {
                return null;
            }

            [$userId, $authToken] = explode(':', $token, 2); //explode — Разбивает строку с помощью разделителя. 3 аргумент - Если аргумент limit является положительным, возвращаемый массив будет содержать максимум limit элементов, при этом последний элемент будет содержать остаток строки string. Если параметр limit отрицателен, то будут возвращены все компоненты, кроме последних -limit. Если limit равен нулю, то он расценивается как 1.

            $user = User::getById((int) $userId);

            if ($user === null) {
                return null;
            }

            return $user;
        }

        function vardump($var) {
            static $int=0;
            echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
            var_dump($var);
            echo '</pre>';
            $int++;
        }

    }