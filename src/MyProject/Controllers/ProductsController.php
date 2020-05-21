<?php

    namespace MyProject\Controllers;
    use MyProject\View\View;
    use MyProject\Services\Db;
    use MyProject\Models\Products\Product;
    use MyProject\Models\Users\User;
    use MyProject\Models\Images\Image;

    class ProductsController {
        private $view;

        private $db;

        public function __construct() {
            $this->view = new View(__DIR__ . '/../../../templates');

            $this->db = Db::getInstace();
        }

        public function view(int $productId) {

            //массив картинок товара
            // $images = Image::getById($productId);

            // if (empty($images)) {  //Сравнить с методом $product === null
            //     $this->view->renderHtml('error/404.php', [], 404);
            //     return;
            // }

            $product = Product::getById($productId);

            if (empty($product)) {  //Сравнить с методом $product === null
                $this->view->renderHtml('error/404.php', [], 404);
                return;
            }

            $this->view->renderHtml(
                'product/product.php', 
                [
                    'product' => $product,
                    // 'images' => $images,
                ]
            );
        }
    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }