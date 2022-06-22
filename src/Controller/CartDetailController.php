<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartDetailController extends AbstractController
{
    #[Route('/cart/detail', name: 'app_cart_detail')]
    public function index(): Response
    {
        return $this->render('cart_detail/index.html.twig', [
            'controller_name' => 'CartDetailController',
        ]);
    }
}
