<?php

abstract class Product {
    abstract function getPrice();
}

class digitalProduct extends Product {

    public $name;
    public $price;

    function getPrice() {
        return $this->price;
    }
}

class Product extends singlePieceProduct {

    public $name;
    public $price;

    function getPrice() {
        return $this->price;
    }

    function getCount() {
        $count = checDBcount($this->name);
        return $count;
    }

}

class Product extends onWeightProduct {

    public $name;
    public $price;

    function getPrice($weight) {
        return $this->price * $weight;
    }

    function getCount() {
        $count = checDBcount($this->name);
        return $count;
    }
}

