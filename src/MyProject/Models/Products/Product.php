<?php

    namespace MyProject\Models\Products;

    use MyProject\Models\ActiveRecordEntity;

    class Product extends ActiveRecordEntity {
        
        protected $name;
        protected $mainImg;
        protected $description;
        protected $shortDescription;
        protected $price;
        protected $status;
        protected $sale;

        public function getName(): string {
            return $this->name;
        }

        public function setName(string $value): void {
            $this->name = $value;
        }

        public function getMainImg(): string {
            return $this->mainImg;
        }

        public function setMainImg(string $value): void {
            $this->mainImg = $value;
        }

        public function getDescription(): string {
            return $this->description;
        }

        public function setDescription(string $value = null): void {
            $this->description = $value;
        }

        public function getShortDescription(): string {
            return $this->shortDescription;
        }

        public function setShortDescription(string $value = null): void {
            $this->shortDescription = $value;
        }

        public function getPrice(): float {
            return $this->price;
        }

        public function setPrice(float $value): void {
            $this->price = $value;
        }

        public function getStatus(): string {
            return $this->status;
        }

        public function setStatus(string $value): void {
            $this->status = $value;
        }

        public function getSale(): float {
            return $this->sale;
        }

        public function setSale(float $value): void {
            $this->sale = $value;
        }

        protected static function getTableName(): string {
            return 'goods';
        }
    }