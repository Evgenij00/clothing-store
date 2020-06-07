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

        public function getPrice(): float {
            return $this->price;
        }

        static public function add(int $productId) {

            $user = UsersAuthService::getUserByToken();
            $order = self::findOneByColumn('user_id', $user->getId()); //находим корзину пользователя

            //если корзины нет, создаем новую
            if ($order === null) {
                $order = new self();
                $order->defaultInit();
                $order->save(); //загружаем в бд
            }

            //достаем товар из бд
            $product = Product::getById($productId);

            //проверяем, нет ли товара уже в корзине
            $result = OrderItem::search($product, $order);

            if ($result === null) {
                //добавляем новый товар
                $orderItem = OrderItem::add($product, $order);
            } else {
                //увеличиваем кол-во товара на ед.
                $result->setCount(($result->getCount()) + 1);
                //сохраняем елемент в бд
                $result->save();
            }

            $order->updatePrice();
            $order->save();
        }

        //отрабатывает при загрузке корзины
        static public function view(User $user): ?array {
            //получаем корзину пользователя
            $order = self::findOneByColumn('user_id', $user->getId());

            //если ее нет, создаем
            if ($order === null) {
                $order = new self();
                $order->defaultInit();
                $order->save(); //загружаем в бд
                //дальше нет смысла т.к заказ пустой, поэтому выходим
                return null;
            }

            //массив товаров-ссылок заказа
            $orderList = $order->getList();

            //заказ пустой, поэтому выходим
            if ($orderList === null) return null;
            //иначе
            $dataOrder = [];
            $dataOrder['orderList'] = $orderList;
            $dataOrder['orderPrice'] = $order->getPrice();
            return $dataOrder;
        }

        public function updatePrice() {
            $this->price = 0.0;
            // vardump($this->price);
            
            //массив товаров-ссылок заказа
            $orderList = $this->getList();
            // vardump($orderList);


            if ($orderList === []) return $this->price;

            //считаем цену
            foreach ($orderList as $orderItem) {
                $count = $orderItem->getCount();
                $price = $orderItem->getProduct()->getPrice() * $count;
                $totalPrice += $price;
            }

            $this->price = $totalPrice;
            return $this->price;
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

        private function defaultInit(): Order {
            $this->userId = $user->getId();
            $this->price = 0;
            $this->state = 0;
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