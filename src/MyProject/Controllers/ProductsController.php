<?php

    namespace MyProject\Controllers;
    use MyProject\View\View;
    use MyProject\Services\Db;

    class ProductsController {
        private $view;

        private $db;

        public function __construct() {
            $this->view = new View(__DIR__ . '/../../../templates');

            $this->db = new Db();
        }

        public function view(string $productId) {
            
            $sql = 'SELECT product.*, goods_img.img_src AS img FROM (SELECT * FROM goods WHERE id = :id) AS product INNER JOIN goods_img ON product.id = goods_img.goods_id AND goods_img.is_main = :is_main;';

            $result = $this->db->query($sql, [
                ':id' => $productId,
                ':is_main' => '1'
            ]);

            if (empty($result)) {
                $this->view->renderHtml('error/404.php', [], 404);
                return;
            }

            $this->view->renderHtml('product/product.php', ['product' => $result[0]]);
        }
    }