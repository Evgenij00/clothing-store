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

        public function view(int $productId): void {

            //массив картинок товара
            // $images = Image::getById($productId);

            // if (empty($images)) {  //Сравнить с методом $product === null
            //     $this->view->renderHtml('error/404.php', [], 404);
            //     return;
            // }

            $product = Product::getById($productId);

            // vardump($product);

            $reflector = new \ReflectionObject($product);  //обязательно вначале - (\)!!
            $properties = $reflector->getProperties();

            // $array = [];

            // foreach ($properties as $property) {
            //     $array[] = $property->getName();
            // }

            vardump($properties);
            return;



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

        public function edit(int $productId): void {
            
            $product = Product::getById($productId);

            if ($product === null) { //empty($product) или так???
                $this->view->renderHtml('errors/404.php', [], 404);
                return;
            }

            $product->setName('Шортики');
            $product->setPrice(99.09);

            $product->save();

        }
    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }