<?php

    namespace MyProject\Models\Addresses;

    use MyProject\Models\Users\User;
    use MyProject\Models\ActiveRecordEntity;
    use MyProject\Services\Db;

    class Address extends ActiveRecordEntity {

        protected $userId;

        protected $country;
        protected $region;
        protected $city;
        protected $streetAddress;
        protected $postcode;

        public function getCountry(): string {
            return $this->country;
        }

        public function getRegion(): string {
            return $this->region;
        }

        public function getCity(): string {
            return $this->city;
        }

        public function getStreetAddress(): string {
            return $this->streetAddress;
        }

        public function getPostcode(): int {
            return $this->postcode;
        }

        static public function ajax($data, User $user) {

            // if($data->id !== null) return null;
            // vardump($data);
            // return;

            // $check = self::findOneByColumn()

            $address = new self();
            $address->userId = $user->getId();
            $address->country = $data->country;
            $address->region = $data->region;
            $address->city = $data->city;
            $address->streetAddress = $data->streetAddress;
            $address->postcode = (int)$data->postcode;
            // vardump($address);

            $address->save();
        }

        protected static function getTableName(): string {
            return 'user_address';
        }
    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }