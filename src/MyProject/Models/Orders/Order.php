<?php

    namespace MyProject\Models\Orders;

    use MyProject\Models\ActiveRecordEntity;
    use MyProject\Services\UsersAuthService;
    use MyProject\Services\Db;
    use MyProject\Models\Products\Product;
    use MyProject\Models\Orders\OrderItem;
    use MyProject\Models\Users\User;

    class Order extends ActiveRecordEntity {

        protected $userId;
        protected $price;
        protected $state;

        //остальные св-ва

        //добавляем товар в бд
        static public function add(int $productId) {

            $user = UsersAuthService::getUserByToken();
            $order = self::findOneByColumn('user_id', $user->getId()); //находим корзину пользователя
            // vardump($user);
            // vardump($product);

            //если корзины нет, создаем новую
            if ($order === null) {
                $order = new self();
                $order->userId = $user->getId();
                $order->price = 0;
                $order->state = 0;
                $order->save(); //загружаем в бд
            }
            // vardump($order);

            $product = Product::getById($productId);  //достаем товар из бд

            //ищем товар в корзине
            $check = OrderItem::isFindItem($product->getId(), $order->getId());
            // vardump($check);

            if ($check !== null) {
                $check->setCount(($check->getCount()) + 1);
                $check->save();
            } else {
                $orderItem = OrderItem::add($product, $order->getId());
            }

            //добавляем продукт в корзину, возвращаем продукт с определенным свойством size

            $order->updatePrice($user->getId());
            $order->save();
        }

        static public function view(User $user): ?array {

            $order = self::findOneByColumn('user_id', $user->getId());


            if ($order === null) {
                $order = new self();
                $order->userId = $user->getId();
                $order->price = 0;
                $order->state = 0;
                $order->save(); //загружаем в бд
                return null;
            }

            //массив для наших товаров с размерами
            $products = [];

            $orderList = $order->getList();
            // vardump($orderList);

            if ($orderList === null) return null;

            foreach($orderList as $orderItem) {
                // vardump($orderItem);
                $id = $orderItem->getGoodsId();
                $product = Product::findOneByColumn('id', $id);
                // vardump($product);
                $product->orderItemId = $orderItem->getId();
                $product->mainProperty = $orderItem->getGoodsProperties();
                $product->count = $orderItem->getCount();
                // vardump($product->getProperties());
                $products[] = $product;
                $totalPrice += $product->getPrice();
            }

            // vardump($products);
            // vardump($totalPrice);
            $orderData = [];
            $data['orderList'] = $products;
            $data['totalPrice'] = $totalPrice;
            // vardump($products);
            return $data;
        }

        private function updatePrice(): void {
            // $this->price = 0.0;
            
            //получаем все продукты из корзины
            $orderList = $this->getList();
            // vardump($orderList);

            //считаем цену
            foreach ($orderList as $orderItem) {
                // vardump($orderItem);
                $product = Product::findOneByColumn('id', $orderItem->getGoodsId());
                // vardump($product);
                $totalPrice += $product->getPrice();
            }

            $this->price = $totalPrice;
        }

        //получаем именно объекты корзины
        private function getList(): ?array {

            $sql = "SELECT oc.* FROM `orders_cart` AS `oc` JOIN orders AS `o` WHERE oc.order_id = o.id AND o.id = :id ORDER BY goods_id;";
            // vardump($sql);

            $db = Db::getInstace();
            $result = $db->query($sql, [':id' => $this->getId()], OrderItem::class);
            // vardump($result);

            if ($result === null) return null;
            return $result;
        }

        protected static function getTableName(): string {
            return 'orders';
        }

    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }