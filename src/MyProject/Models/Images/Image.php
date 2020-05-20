<?php
//Пока ждем свою очередь...

// namespace MyProject\Models\Images;

// use MyProject\Services\Db;
// use MyProject\Models\ActiveRecordEntity;
// use MyProject\Models\Products\Product;

//     class Image extends ActiveRecordEntity {

//         protected $productId;
//         protected $src;

        
//         public function getProduct(): Product {
//             return Product::getById($this->productId);
//         }

//         public function getSrc(): string {
//             return $this->src;
//         }

//         protected static function getTableName(): string {
//             return 'goods_img';
//         }

//         public static function getById(int $id) {
//             $db = new Db();

//             // echo static::getTableName();

//             $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE product_id = :product_id';

//             $result = $db->query(
//                 $sql,
//                 [':product_id' => $id],
//                 static::class
//             );

//             // vardump($result);

//             return $result ? $result : null;
//         }
//     }

//     function vardump($var) {
//         static $int=0;
//         echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
//         var_dump($var);
//         echo '</pre>';
//         $int++;
//     }