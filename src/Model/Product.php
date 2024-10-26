<?php
namespace Model;
class Product extends Model
{
    private int $id;
    private string $image;
    private string $name;
    private string $description;
    private string $price;
    private int $amount;

    public static function getAllProducts(): array|null
    {

        $stmt = self::getPDO()->query("SELECT * FROM products");
        $data = $stmt->fetchAll();
        $products=[];
        if($data === false) {
            return null;
        }
        foreach($data as $product) {
            $obj = new Product();
            $obj->id = $product["id"];
            $obj->image = $product["image"];
            $obj->name = $product["name"];
            $obj->description = $product["description"];
            $obj->price = $product["price"];

            $products[]=$obj;
        }
        return $products;
    }
    public static function getCartByUser($user_id): array|null
    {

        $stmt = self::getPDO()->prepare("SELECT * FROM products INNER JOIN user_products ON products.id = user_products.product_id WHERE user_products.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $data = $stmt->fetchAll();
        $products = [];
        if($data === false) {
            return null;
        }
        foreach($data as $product) {
            $obj = new self();
            $obj->id = $product["product_id"];
            $obj->image = $product["image"];
            $obj->name = $product["name"];
            $obj->description = $product["description"];
            $obj->price = $product["price"];
            $obj->amount = $product["amount"];

            $products[]=$obj;
        }
        return $products;
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

    public function getAmount(): int
    {
        return $this->amount;
    }
}
