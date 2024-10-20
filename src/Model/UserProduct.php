<?php
namespace Model;
class UserProduct extends Model
{
    private int $id;
    private string $image;
    private string $name;
    private string $description;
    private string $price;
    private string $amount;
    public function showCart($user_id): array|null
    {

        $stmt = $this->pdo->prepare("SELECT * FROM products INNER JOIN user_products ON products.id = user_products.product_id WHERE user_products.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $data = $stmt->fetchAll();
        if($data === false) {
            return null;
        }
        foreach($data as $product) {
            $obj = new self();
            $obj->id = $product["id"];
            $obj->image = $product["image"];
            $obj->name = $product["name"];
            $obj->description = $product["description"];
            $obj->price = $product["price"];
            $obj->amount = $product["amount"];

            $products[]=$obj;
        }
        return $products;
    }
    public function select($user_id, $product_id): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
        $result = $stmt->fetchAll();
        if($result === false) {
            return false;
        }
        return true;
    }
    public function add($user_id, $product_id, $amount)
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }
    public function addMore($user_id, $product_id, $amount)
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET amount = amount+:amount WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

}