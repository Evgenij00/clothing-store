<?php

    namespace MyProject\Controllers;
    use MyProject\View\View;
    use MyProject\Services\Db;
    use MyProject\Models\Products\Product;

    class ProductsController {
        private $view;

        private $db;

        public function __construct() {
            $this->view = new View(__DIR__ . '/../../../templates');

            $this->db = new Db();
        }

        public function view(int $productId) {

            $product = Product::getById($productId);

            if (empty($product)) {  //Сравнить с методом $product === null
                $this->view->renderHtml('error/404.php', [], 404);
                return;
            }

            $this->view->renderHtml('product/product.php', ['product' => $product]);
        }
    }