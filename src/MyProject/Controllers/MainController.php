<?php
    namespace MyProject\Controllers;

    use MyProject\View\View;
    use MyProject\Models\Products\Product;
    use MyProject\Models\Users\User;
    use MyProject\Models\Images\Image;

    class MainController {

        private $view;

        public function __construct() {

            $this->view = new View(__DIR__ . '/../../../templates');
            
        }

        public function main() {

            $goods = Product::findAll();
            // $goods = User::findAll();
            // $goods = Image::findAll();
            

            // vardump($goods);
            // return;

            $this->view->renderHtml('main/main.php', ['goods' => $goods]);
        }

        public function sayHello($name) {
            $this->view->renderHtml('main/hello.php', ['name' => $name]);
        }
    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }