<?php

namespace App\Controller;

use App\Entity\CartDetail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cart')]
class CartDetailController extends AbstractController
{
    #[Route('/', name: 'view_cartdetail')]
    public function CartIndex(): Response
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
        return $this -> render('cart/deatil.html.twig',
        [
            'cart' => $cart
        ]);
    }

    #[Route('delete/{$id}', name: 'delete_cartdetail')]
    public function CartDetailDelete($id) {
        $cart = $this -> getDoctrine() ->getRepositoty(CartDetail::class) ->find($id);
        if ($cart == null) {
            $this -> addFlash("Error", "CartDetail not found !");
        }
        else {
            $manager = $managerRegistry ->getManager();
            $manager -> remove($cart);
            $manager ->flush();
            $this ->addFlash("Success", "Delete cartdetail succeed !");
        }
        return $this ->redirectToRoute("view_cartdetail");
    }

    #[Route('/edit', name: 'edit_cartdetail')]
    public function CartDetailEdit(Request $request, $id) {
        $cart = $this ->getDoctrine() ->getRepository(CartDetail::class) ->find($id);
        if ($cart == null) {
            $this ->addFlash("Error", "CartDetail not found !");
            return $this ->redirectToRoute("view_cartdetail");
        }
        else {
            $form = $this ->createForm(CartDetail::class, $cart);
            $form ->handleRequest($request);
            if ($form ->isSubmitted() && $form ->isValid()) {
                $manager = $this -> getDoctrine() ->getManager();
                $manager ->persist($cart);
                $manager ->flush();
                $this ->addFlash("Success", "Edit cartdetail succeed !");
                return $this -> renderForm("cart/edit.html.twig",
                [
                    'cartForm' => $form
                ]);
            }
        }
    }
}
