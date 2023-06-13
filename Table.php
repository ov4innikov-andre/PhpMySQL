<?php
class Table implements DatabaseWrapper {
// вставляет новую запись в таблицу, возвращает полученный объект как массив
    public function insert(array $tableColumns, array $values): array {
$sql = "INSERT INTO table ($tableColumns, $values)";
      $result = $mysqli -> query($sql);
      return $result;
    }
   // редактирует строку под конкретным id, возвращает результат после изменения
    public function update(int $id, array $values): array {
      $sql = "UPDATE table SET lastname='Doe' WHERE id=2";
       $result = $mysqli -> query($sql);
      return $result;
    }
    // поиск по id
    public function find(int $id): array {
$sql = "SELECT FROM table WHERE $id";
      $result = $mysqli -> query($sql);
      return $result;
      
    }
    // удаление по id
    public function delete(int $id): bool {
 $sql = "DELETE FROM table WHERE $id";
      $result = $mysqli -> query($sql);
      return $result;
    }
}

class Shop extends Table {
    $tableColumns = ['Id', 'name', 'adress'];
    $primaryKey = 'Id';
    $tableName = 'shop';
}
class Product extends Table {
    $tableColumns = ['Id', 'productId', 'name', 'price', 'counts'];
    $primaryKey = 'Id';
    $tableName = 'product';
}
class Orders extends Table {
    $tableColumns = ['Id', 'orderId', 'created_at'];
    $primaryKey = 'Id';
    $tableName = 'orders';
}
class Order_product extends Table {
    $tableColumns = ['Id', 'orderId'];
    $primaryKey = 'Id';
    $tableName = 'order_product';
}
class Client extends Table {
    $tableColumns = ['Id', 'name', 'phone'];
    $primaryKey = 'Id';
    $tableName = 'client';
}

$shop = new Shop;
$shop->insert(['name','adress'],['test name','test address']);
$shop->update(1, ['name'=>'new name']);
$shop->find(2);
$shop->delete(1);

$product = new Product;
$product->insert(['id','name'],['1','Test Product']);
$product->update(1, ['name'=>'new name']);
$product->find(1);
$product->delete(1);

$order = new Orders;
$order->insert(['orderId','created_at'],['1','2022-01-28 13:37:22']);
$order->update(1, ['orderId'=>2]);
$order->find(1);
$order->delete(1);

$orderProduct = new Order_product;
$orderProduct->insert(['orderId'],['1']);
$orderProduct->update(1, ['orderId'=>2]);
$orderProduct->find(1);
$orderProduct->delete(1);

$client = new Client;
$client->insert(['name','phone'],['test name','88003333333']);
$client->update(1, ['name'=>'new name']);
$client->find(1);
$client->delete(1);
