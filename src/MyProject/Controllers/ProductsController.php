<?php

    namespace MyProject\Controllers;

    use MyProject\View\View;
    use MyProject\Models\Products\Product;
    use MyProject\Exceptions\NotFoundException;
    use MyProject\Services\UsersAuthService;

    class ProductsController extends AbstractController {

        public function view(int $productId): void {

            //массив картинок товара
            // $images = Image::getById($productId);

            // if (empty($images)) {  //Сравнить с методом $product === null
            //     $this->view->renderHtml('error/404.php', [], 404);
            //     return;
            // } 

            $product = Product::getById($productId);

            // vardump($product);

            // $reflector = new \ReflectionObject($product);  //обязательно вначале - (\)!!
            // $properties = $reflector->getProperties();

            // $array = [];

            // foreach ($properties as $property) {
            //     $array[] = $property->getName();
            // }

            // vardump($properties);
            // return;



            if (empty($product)) {  //Сравнить с методом $product === null
                throw new NotFoundException();
            }

            $this->view->renderHtml(
                'product/product.php', 
                [
                    'product' => $product,
                    // 'images' => $images,
                ]
            );
        }

        public function edit(int $productId): void { //редактирование объектов
            
            $product = Product::getById($productId);

            if ($product === null) { //empty($product) или так???
                throw new NotFoundException();
            }

            $product->setName('Шортики');
            $product->setPrice(99.09);

            $product->save();
        }

        public function add(): void { //редактирование объектов
            
            // $product = new Product();
            $product;

            if ($product === null) { //empty($product) или так???
                throw new NotFoundException();
            }

            $product->setName('Розовое Худи');
            $product->setMainImg('/img/goods/14247601-2-sesame.jpg');
            $product->setPrice(298.75);
            $product->setStatus('1');
            $product->setSale(0);

            // vardump($product);
            // return;

            $product->save();

            vardump($product);

        }

        public function remove(int $productId): void {
            $product = Product::getById($productId);

            if ($product === null) {
                throw new NotFoundException();
            }
            // vardump($product);

            $product->delete();

            vardump($product);
        }
    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }