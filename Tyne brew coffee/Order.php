<?php

    class Order
    {
        private $id;
        private $userID;
        private $date;
        private $totalPrice;

        public function __construct($id, $userID, $date, $totalPrice)
        {
            $this->id = $id;
            $this->userID = $userID;
            $this->date = $date;
            $this->totalPrice = $totalPrice;
        }

        public function getID()
        {
            return $this->id;
        }

        public function getUserID()
        {
            return $this->userID;
        }

        public function getDate()
        {
            return $this->date;
        }

        public function getTotalPrice()
        {
            return $this->totalPrice;
        }
    }

    class OrderItem
    {
        private $id;
        private $orderID;
        private $productID;
        private $price;

        public function __construct($id, $orderID, $productID, $price)
        {
            $this->id = $id;
            $this->orderID = $orderID;
            $this->productID = $productID;
            $this->price = $price;
        }

        public function getID()
        {
            return $this->id;
        }

        public function getOrderID()
        {
            return $this->orderID;
        }

        public function getProductID()
        {
            return $this->productID;
        }

        public function getPrice()
        {
            return $this->price;
        }
    }