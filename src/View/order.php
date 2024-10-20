<!DOCTYPE html>
<form action="./order" method="POST">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Form</title>
</head>
<body>
<div class="container">
    <header>Order Form
        <span>Create your order.</span>
    </header>
    <div class="in-container">
        <h2>Personal Information</h2>
        <div class="row">
            <div class="col2">
                <input type="text" name="name">
                <label style="color: darkred">
                    <?php
                    if(isset($errors['name'])) {
                        print_r ($errors['name']); } ?>
                <label for="name">Name</label>
            </div>
        </div>
        <div class="row">
            <input type="email" name="email">
            <label style="color: darkred">
                <?php
                if(isset($errors['email'])) {
                    print_r ($errors['email']); } ?>
            <label for="email">Email</label>
        </div>
        <div class="row">
            <input type="tel" name="phone">
            <label style="color: darkred">
                <?php
                if(isset($errors['phone'])) {
                    print_r ($errors['phone']); } ?>
            <label for="phone">Contact number</label>
        </div>
        <h2>Order Information</h2>
        <div class="row">
            <?php foreach ($productsInCart as $product): ?>
            <h3> Products to order:<?php echo $product->getName(); ?></h3>

        </div>
        <div class="row">
            <h3>Amount: <?php echo $product->getAmount(); ?></h3>
            <?php endforeach; ?>
            <h2> Total price: <?php echo $totalPrice . '$'; ?></h2>

        </div>


        <div class="row">
            <input type="submit" name="submit" value="Submit">
        </div>
    </div>
</body>
</html>
<style>
    body{
        background: #1d1e22;
        font-family: 'Open Sans', sans-serif;
        font-weight: 300;
    }
    .container{
        width: 45%;
        margin: 50px auto;
    }
    header{
        color: #fff;
        text-align: center;
        font-size: 36px;
        font-weight: 600;
        margin: 50px 0;
    }
    header>span{
        display: block;
        font-size: 30px;
        font-weight: 400;
    }
    .in-container{
        width: 100%;
        margin: 40px 0;
        color: #f6f6f6;
    }
    h2{
        font-weight: 400;
        color: #007bff;
        border-bottom: 1px solid #007bff;
        border-width: 2px;
        margin: 20px 50px;
        padding: 10px;
        text-align: center;
    }
    .row{
        width: 100%;
        margin: 20px 0;
        padding: 0;
        display: table;
    }
    .col2{
        display: table;
        width: 47%;
        float: left;
    }
    .col2:nth-child(2){
        display: table;
        float: right;
    }
    label{
        line-height: 35px;
        display: table-header-group;
        letter-spacing: 0.9px;
        transition: all 0.3s ease;
    }
    input{
        width: 100%;
        display: table-row-group;
        border-sizing: border-box;
        padding: 15px;
        border: 2px solid #ddd;
        border-radius: 5px;
        background: transparent;
        color: #f6f6f6;
        font-size: 1rem;
    }
    input:focus{
        outline: none !important;
        border-color: #EF5350;
    }
    input:focus + label{
        color: #EF5350;
    }
    input[type="submit"]{
        display: table;
        width: 30%;
        margin: 20px -32px 0 auto;
        background: #EF5350;
        border: 0;

    }
    input[type="submit"]:hover{
        background: transparent;
        border: 2px solid #007bff;
        color: #007bff;
        cursor: pointer;
    }

</style>
