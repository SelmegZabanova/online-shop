<?php

namespace Controller;
use DTO\CreateReviewDTO;
use Model\Product;
use Model\ProductsInOrder;
use Model\Review;
use Request\ReviewRequest;
use Service\Auth\AuthServiceInterface;
use Service\CartService;
use Request\ProductRequest;
use Service\OrderService;
use Service\ReviewService;

class ProductController
{
    private CartService $cartService;
    private AuthServiceInterface $authService;

    private ReviewService $productService;
    public function __construct(AuthServiceInterface $authService, CartService $cartService,  ReviewService $productService)
    {
        $this->authService = $authService;
        $this->cartService = $cartService;
        $this->productService = $productService;

    }
    public function getCatalog()
    {
        if (!$this->authService->check()) {
            header("Location:/login");
        } else {

            $products = Product::getAllProducts();


            require_once './../View/catalog.php';

        }

        require_once './../View/catalog.php';
    }
    public function addProduct() {

        if(!$this->authService->check()) {
            header("Location:/login");
        } else {
            $userId = $this->authService->getCurrentUser()->getId();

            $product_id = $_POST['product_id'];
            if(empty($_POST['amount'])) {
                $amount = 1;
            } else {
                $amount = $_POST['amount'];
            }

            $this->cartService->add($userId, $product_id,$amount);



            header("Location:/catalog");
        }
    }
    public function getProductPage(ProductRequest $productRequest)
    {
        if (!$this->authService->check()) {
            header("Location:/login");
        } else {

            $id = $productRequest->getProductId();
                $product = Product::getProductById($id);
                $reviews = Review::getAllReviewsByProductId($id);
                if(!empty($reviews)){
                    $averageRating = Review::getAverageRatingByProductId($id);
                }
                require_once './../View/product.php';
            }

            require_once './../View/product.php';

    }
    public function addReview( ReviewRequest $reviewRequest)
    {
        if (!$this->authService->check()) {
            header("Location:/login");
        }
            $userId = $this->authService->getCurrentUser()->getId();
            $userName = $this->authService->getCurrentUser()->getName();
            $productId = $reviewRequest->getProductId();
            $errors = $reviewRequest->validateReviewText();

            if(empty($errors)) {
                    $rating = $reviewRequest->getRating();
                    $text = $reviewRequest->getReviewText();
                    $result = ProductsInOrder::CheckProductInOrder($userId, $productId);
                    if($result) {
                        $dto = new CreateReviewDTO($userId, $userName,$productId, $rating, $text);
                        $this->productService->addReview($dto);
                        header("Location:/catalog");
                    }
                }
                else {
                    require_once './../View/catalog.php';
               }
               }



}