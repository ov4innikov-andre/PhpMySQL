<?php
function my_autoloader($class) {
    include $class . '.php';
}
spl_autoload_register('my_autoloader');
interface DatabaseWrapper
{
    public function insert(array $tableColumns, array $values): array;
    public function update(int $id, array $values): array;
    public function find(int $id): array;
    public function delete(int $id): bool;
}
class Table implements DatabaseWrapper {
    protected $table;
    protected $values;
    protected $pdo;
    public function __construct() {
        $this->pdo = new PDO('sqlite:database.db');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function insert(array $tableColumns, array $values): array {
        $this->table = $this->tableName;
        $this->columns = implode(',', $tableColumns);
        $this->values = "'" . implode("','", $values) . "'";
        $sql = "INSERT INTO {$this->table} ({$this->columns}) VALUES ({$this->values})";
        $result = $this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function update(int $id, array $values): array {
        $this->table = $this->tableName;
        $setValues = '';
        foreach ($values as $column => $value) {
            $setValues .= "$column = '$value',";
        }
        $setValues = rtrim($setValues, ',');
        $sql = "UPDATE {$this->table} SET $setValues WHERE {$this->primaryKey} = $id";
        $result = $this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function find(int $id): array {
        $this->table = $this->tableName;
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = $id";
        $result = $this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function delete(int $id): bool {
        $this->table = $this->tableName;
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id";
        $result = $this->pdo->query($sql);
        return $result; 
    }
}
class Shop extends Table {
    protected $tableName = 'shop';
    protected $tableColumns = ['Id', 'name', 'address']; 
    protected $primaryKey = 'Id';
}
class Product extends Table {
    protected $tableName = 'product';
    protected $tableColumns = ['Id', 'productId', 'name', 'price', 'counts'];
    protected $primaryKey = 'Id';
}
class Orders extends Table {
    protected $tableName = 'orders';
    protected $tableColumns = ['Id', 'orderId', 'created_at'];
    protected $primaryKey = 'Id';
}
class Order_product extends Table {
    protected $tableName = 'order_product';
    protected $tableColumns = ['Id', 'orderId'];
    protected $primaryKey = 'Id';
}
class Client extends Table {
    protected $tableName = 'client';
    protected $tableColumns = ['Id', 'name', 'phone'];
    protected $primaryKey = 'Id';
}
$shop = new Shop;
$shop->insert(['name','address'],['test name','test address']);
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
