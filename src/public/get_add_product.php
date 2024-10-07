
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>


<div class="wrapper register">
    <a href="index.html"><span class="icon-close"><ion-icon name="close-outline"></ion-icon></span></a>

    <h2>Cart</h2>

    <div class="input-box">
        <span class="icon"><i class='bx bx-user'></i></span>
        <input type="product-id" name="product-id"required>
        <label>Product-id</label>
        <label style="color: red">
            <?php if(isset($errors['product-id'])){ print_r ($errors['product-id']); } ?>
        </label>
    </div>

    <div class="input-box">
        <span class="icon"><i class='bx bx-envelope'></i></span>
        <input type="amount" name="amount" required>
        <label>Amount</label>
        <label style="color: red">
            <?php if(isset($errors['amount'])){ print_r ($errors['amount']); } ?>
        </label>
    </div>
    </div>
 <form class="form" action="/add-product" method="post">
    <a ><button type="submit" class="btn">Add</button></a>
    <div
</div>


</body>
<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        min-height: 100vh;
    }

    .wrapper{
        position: relative;
        width: 400px;
        height: 530px;
        background-color: transparent;
        border: 2px solid rgba(255, 255, 255, .5);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
        margin: auto;
        margin-top: 150px;
        padding: 40px;
        overflow: hidden;
    }
    .wrapper h2{
        font-size: 2em;
        color: #000;
        text-align: center;

    }
    .input-box{
        position: relative;
        width: 100%;
        height: 50px;
        border-bottom: 2px solid #000;
        margin: 30px 0;

    }
    .input-box label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        color: #000;
        font-weight: 500;
        pointer-events: none;
        transition: .5s;
    }
    .input-box input:focus~label,
    .input-box input:valid~label{
        top: -5px;
    }
    .input-box input{
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        font-size: 1em;
        color: #000;
        font-weight: 600;
        padding: 0 35px 0 5px;
    }
    .input-box .icon{
        position: absolute;
        right: 8px;
        font-size: 1.2rem;
        color: #000;
        line-height: 57px;
    }
    .btn{
        width: 150%;
        height: 60px;
        background: #000;
        border: none;
        outline: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1em;
        color: #fff;
        font-weight: 500;
    }

    .login-register{
        font-size: .9em;
        color: #000;
        text-align: center;
        font-weight: 500;
        margin: 25px 0 10px;

    }

    .login-register p a{
        color: #000;
        text-decoration: none;
        font-weight: 600;
    }

    .login-register p a:hover{
        text-decoration: underline;
    }
    .icon-close{
        position: absolute;
        top: 0;
        right: 0;
        width: 45px;
        height: 45px;
        background: #000;
        font-size: 2em;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom-left-radius: 20px;
        cursor: pointer;
        z-index: 1;
    }
</style>
