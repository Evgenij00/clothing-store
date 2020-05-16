<?php
    namespace MyProject\Controllers;
    use MyProject\View\View;
    use MyProject\Services\Db;
    use MyProject\Models\Products\Product;

    class MainController {

        private $view;

        private $db;

        public function __construct() {
            $this->view = new View(__DIR__ . '/../../../templates');

            $this->db = new Db();
        }

        public function main() {

            $sql = 'SELECT goods.*, goods_img.img_src AS img FROM goods INNER JOIN goods_img ON goods.id = goods_img.goods_id AND goods_img.is_main = :is_main;';
            $goods = $this->db->query($sql, [':is_main' => '1'], Product::class);

            vardump($goods);

            // $this->view->renderHtml('main/main.php', ['goods' => $goods]);
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