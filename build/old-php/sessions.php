<?php
    
    header('Content-Type: text/html; charset=utf-8');
    session_start();

    class Auth {
        private $_lg = 'user';
        private $_pass = 'php';

        public function maybe() { //функция maybe() проверяет, была ли начата сессия и авторизирован ли пользователь в системе ресурса.
            if (isset($_SESSION['authoris'])) {
                return $_SESSION['authoris'];
            }
            else return false;
        }

        public function auth($lg, $pass) { //С помощью auth() проводим авторизацию. Проверяем правильность введенного пароля и логина.
            if ($lg == $this->_lg && $pass == $this->_pass) {
                $_SESSION['authoris'] = true;
                $_SESSION['l'] = $lg;
                return true;
            }
            else {
                $_SESSION['authoris'] = false;
                return false;
            }
        }
    }
?>