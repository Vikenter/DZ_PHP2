<?php
//1 2 3 4
class Product
{   
    public $id;
    public $title = "название товара";
    public $price;
    public function addToCart($id) {
        $id = (int)$id;
        $session = session_id();
    
        $sql = "SELECT * FROM basket_order WHERE session = '{$session}' AND product_id = '{$id}' AND order_id = 0";
        $checkBasket = getAssocResult($sql)[0];
    
        if(isset($checkBasket))
        {
            $count = $checkBasket["count"];
            $count++;
            $sql = "UPDATE `basket_order` SET `count` = '{$count}' WHERE (`session` = '{$session}') and (`product_id` = '{$id}') AND order_id = 0";
        }
        else
        {
            $sql = "INSERT INTO `basket_order` (`session`, `product_id`) VALUES ('{$session}', '{$id}')";
        }
        executeQuery($sql);
    }
}

class Bundle extends Product
{
    public $products = [];
}


// 5. Дан код:
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo(); // 1
$a2->foo(); // 2
$a1->foo(); // 3
$a2->foo(); // 4
// Что он выведет на каждом шаге? Почему?
//  Видимо потому что static. Создеётся единожды. Живёт сам по себе.


// Немного изменим п.5:
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); //1
$b1->foo(); //1
$a1->foo(); //2
$b1->foo(); //2
// 6. Объясните результаты в этом случае.
// Тоже самое, два разных класса.


// 7. *Дан код:
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo(); 
// Что он выведет на каждом шаге? Почему?
// То же самое, без вызова конструктора, но он статику и не нужен.
