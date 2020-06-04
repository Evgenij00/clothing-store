<?php

    namespace MyProject\Controllers;

    use MyProject\View\View;
    use MyProject\Models\Users\User;
    use MyProject\Exceptions\InvalidArgumentException;
    use MyProject\Services\UsersAuthService;
    use MyProject\Models\Orders\Order;

    class UserController extends AbstractController {

        public function signUp() {
            // vardump($_POST);
            // return;

            if (!empty( $_POST )) {
                try {
                    $user = User::signUp($_POST);
                } catch(InvalidArgumentException $e) {
                    $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                    return;
                }
            }

            if ($user instanceof User) {
                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }

            $this->view->renderHtml('users/signUp.php');
        }

        public function login() {

            if (!empty($_POST)) {
                try {
                    $user = User::login($_POST);
                    UsersAuthService::createToken($user);
                    header('Location: /');
                    exit();
                } catch(InvalidArgumentException $e) {
                    $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                    return;
                }
            }

            $this->view->renderHtml('users/login.php');

        }

        public function cart() {

            $user = UsersAuthService::getUserByToken();
            // vardump($user);
            // return;

            if ($user === null) {
                echo 'Войдите в систему';
                return;
            }

            // $cartList = CartItem::view($user);
            /////////////////////////////////////////////////////////////////////////

            $cartList = Order::view($user);
            vardump($cartList);

            // foreach($cartList as $product) {
            //     vardump(($product->getProperties())[1]);
            // }
            // return;

            //////////////////////////////////////////////////////////////////////

            $this->view->renderHtml('cart/cart.php', [
                'cartList' => $cartList
            ]);
        }

        //типо удалил токен
        public function exit() {
            UsersAuthService::deleteToken();

            echo 'зачем так делать :(';
        }
    }

function vardump($var) {
    static $int=0;
    echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
    var_dump($var);
    echo '</pre>';
    $int++;
}