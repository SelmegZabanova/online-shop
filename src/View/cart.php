
<div class="container">
    <h3>Корзина</h3>
    <div class="card-deck">
        <?php if(!is_null($productsInCart)): ?>
        <?php foreach ($productsInCart as $product): ?>
            <div class="card text-center">
                <a href="#">
                    <img class="card-img-top" src="<?= $product->getImage(); ?>" alt="Card image">
                    <div class="card-body">
                        <p class="card-text text-muted"><?= $product->getName(); ?></p>
                        <div class="card-footer">
                            <?= $product->getPrice(); ?>
                        </div>
                        <p class="card-text text-muted"><?=$product->getAmount(); ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
        <h2><?php echo  'Total Price ' . $totalPrice.'$'; ?></h2>
        <?php endif;?>

        <a href="./order" class="register" target="blank">Order</a>
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

