<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
} else {
    $user_id = $_SESSION['user_id'];
    $pdo = new PDO('pgsql:host=postgres;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare("SELECT * FROM products INNER JOIN user_products ON products.id = user_products.product_id WHERE user_products.user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $data = $stmt->fetchAll();
}
?>

<div class="container">
    <h3>Корзина</h3>
    <div class="card-deck">
        <?php foreach ($data as $product): ?>
            <div class="card text-center">
                <a href="#">
                    <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="Card image">
                    <div class="card-body">
                        <p class="card-text text-muted"><?php echo $product['name']; ?></p>
                        <div class="card-footer">
                            <?php echo $product['price']; ?>
                        </div>
                        <p class="card-text text-muted"><?php echo $product['amount']; ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    body {
        font-style: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 18px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }
</style>
