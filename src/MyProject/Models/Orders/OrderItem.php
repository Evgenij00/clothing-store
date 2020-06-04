<?php

    namespace MyProject\Models\Orders;

    use MyProject\Models\ActiveRecordEntity;
    use MyProject\Models\Products\Product;
    use MyProject\Services\Db;

    class OrderItem extends ActiveRecordEntity {

        protected $orderId;
        protected $goodsId;
        protected $goodsProperties;
        protected $count;

        public function getCount(): int {
            return $this->count;
        }

        public function setCount($count) {
            $this->count = $count;
        }

        public function getGoodsId(): int {
            return $this->goodsId;
        }

        public function getGoodsProperties(): string {
            return $this->goodsProperties;
        }

        static public function add(Product $product, int $orderId): self {

            //Если такого товара с таким же свойством нет!!!
            $orderItem = new OrderItem();
            $orderItem->orderId = $orderId;
            $orderItem->goodsId = $product->getId();
            //добавленное свойство
            $orderItem->goodsProperties = $_POST['product-size'];
            $orderItem->count = 1;
            // vardump($orderItem);
            $orderItem->save();
            //с ценой пока не знаю че делать
            return $orderItem;
        }

        static public function isFindItem(int $productId, int $orderId) {
            $sql = "SELECT * FROM `orders_cart` WHERE order_id = :order_id AND goods_id = :goods_id AND  goods_properties = :goods_properties;";

            $db = Db::getInstace();
            $result = $db->query($sql, [
                ':order_id' => $orderId,
                ':goods_id' => $productId,
                ':goods_properties' => $_POST['product-size']
            ], self::class);

            if ($result === []) return null;

            return $result[0];
        }

        protected static function getTableName(): string {
            return 'orders_cart';
        }

    }