<?php
    namespace MyProject\Controllers;
    use MyProject\View\View;

    class MainController {

        private $view;

        public function __construct() {
            $this->view = new View(__DIR__ . '/../../../templates');
        }

        public function main() {

            $goods = [
                ['href' => '/pages/product-info.html', 'img' => '/img/goods/14247601-1-sesame.jpg', 'title' => 'Худи в стиле oversized бежевого цвета ASOS DESIGN', 'price' => '1 790,00 ₽'],
                ['href' => '/pages/product-info.html', 'img' => '/img/goods/14247601-1-sesame.jpg', 'title' => 'Худи в стиле oversized бежевого цвета ASOS DESIGN', 'price' => '1 790,00 ₽'],
            ];

            $this->view->renderHtml('main/main.php', ['goods' => $goods]); //Зачем??? - ['goods' => $goods]
        }

        public function sayHello($name) {
            $this->view->renderHtml('main/hello.php', ['name' => $name]);
        }
    }