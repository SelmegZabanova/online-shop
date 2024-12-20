
<div class="container">
    <h3>Catalog</h3>
    <div class="card-deck">
        <?php if(!is_null($products)): ?>
        <?php foreach ($products as $product):?>
        <div class="card text-center">
            <a href="/product?id=<?= $product->getId(); ?>">
                <div class="card-header">
                    Hit!
                </div>
                <img class="card-img-top" src="<?= $product->getImage(); ?> " alt="Card image">
                <div class="card-body">
                    <p class="card-text text-muted"> <?= $product->getDescription(); ?></p>
                    <a href="#"><h5 class="card-title"> <?= $product->getName(); ?> </h5></a>
                    <div class="card-footer">

                        <?= $product->getPrice().'$'; ?>

                    </div>
                </div>
            </a>
            <form action="/catalog" method="post">
                <input type ="hidden" name="product_id" value="<?php echo $id = $product->getId(); ?>">
                <label>
                <input type="number" name="amount" value="1" min="1" max="100" >
            </label>
                <input type="submit" value="Добавить в корзину">
            </form>
        </div>
        <?php endforeach;?>
        <?php endif;?>
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

    .card-img-top{
        width: 100%;
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
        font-size: 11px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }
</style>
