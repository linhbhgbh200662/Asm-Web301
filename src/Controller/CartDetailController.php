<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartDetailController extends AbstractController
{
    #[Route('/', name: 'view_cartdetail')]
    public function Cartindex(): Response
    {
        $cart = $this -> getDoctrine() -> getRepository(CartDetail::class) -> findAll();
        return $this ->render("cart/index.html.twig",
        [
            'cart' => $cart
        ]);
    }

    #[Route('/detail/{id}', name: 'view_cart_by_id')]
    public function CartDetails($id) {
        $cart = $his -> getDoctrine() -> getRepository(CartDetail::class) ->find($id);
        if ($cart == null ) {
            $this ->addFlash("Error", "Cart not found !");
            return $this -> redirectToRoute("view_cartdetail");
        }
        return $this -> render('cart'
    );
    }
}
