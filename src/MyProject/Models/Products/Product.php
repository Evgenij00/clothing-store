<?php

    namespace MyProject\Models\Products;

    class Product {
        private $img;
        private $title;
        private $description;
        private $price;

        public function __construct(string $img, string $title, string $description, string $price) {
            $this->img = $img;
            $this->title = $title;
            $this->description = $description;
            $this->price = $price;
        }

        public function getImg(): string 
        {
            return $this->img;
        }
        
        public function getTitle(): string 
        {
            return $this->title;
        }

        public function getDescription(): string 
        {
            return $this->description;
        }

        public function getPrice(): string 
        {
            return $this->price;
        }
        
    }