<?php

    namespace MyProject\Models\Products;
    use MyProject\Services\Db;
    use MyProject\Models\ActiveRecordEntity;

    class Product extends ActiveRecordEntity {
        
        protected $name;
        protected $description;
        protected $shortDescription;
        protected $price;
        protected $status;
        protected $sale;

        public function getName(): string {
            return $this->name;
        }

        public function getDescription(): string {
            return $this->description;
        }

        public function getShortDescription(): string {
            return $this->shortDescription;
        }

        public function getPrice(): float {
            return $this->price;
        }

        public function getStatus(): string {
            return $this->status;
        }

        public function getSale(): float {
            return $this->sale;
        }

        protected static function getTableName(): string {
            return 'goods';
        }
    }