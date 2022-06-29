<?php

namespace App\Controller;

use App\Entity\OrderDetail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/order')]
class OrderDetailController extends AbstractController
{
    #[Route('/', name: 'view_orderdetail')]
    public function OrderIndex(): Response
    {
        $order = $this -> getDoctrine() -> getRepository(OrderDetail::class) -> findAll();
        return $this ->render("order/index.html.twig",
        [
            'order' => $order
        ]);
    }

    #[Route('/detail/{id}', name: 'view_cart_by_id')]
    public function OrderDetails($id) {
        $order = $his -> getDoctrine() -> getRepository(OrderDetail::class) ->find($id);
        if ($order == null ) {
            $this ->addFlash("Error", "Order not found !");
            return $this -> redirectToRoute("view_orderdetail");
        }
        return $this -> render('order/deatil.html.twig',
        [
            'order' => $order
        ]);
    }

    #[Route('delete/{$id}', name: 'delete_orderdetail')]
    public function OrderDelete($id) {
        $cart = $this -> getDoctrine() ->getRepositoty(OrderDetail::class) ->find($id);
        if ($order == null) {
            $this -> addFlash("Error", "OrderDetail not found !");
        }
        else {
            $manager = $managerRegistry ->getManager();
            $manager -> remove($order);
            $manager ->flush();
            $this ->addFlash("Success", "Delete orderdetail succeed !");
        }
        return $this ->redirectToRoute("view_orderdetail");
    }

    #[Route('/edit', name: 'edit_orderdetail')]
    public function OderDetailEdit(Request $request, $id) {
        $order = $this ->getDoctrine() ->getRepository(OrderDetail::class) ->find($id);
        if ($order == null) {
            $this ->addFlash("Error", "OrderDetail not found !");
            return $this ->redirectToRoute("view_orderdetail");
        }
        else {
            $form = $this ->createForm(OrderDetail::class, $order);
            $form ->handleRequest($request);
            if ($form ->isSubmitted() && $form ->isValid()) {
                $manager = $this -> getDoctrine() ->getManager();
                $manager ->persist($order);
                $manager ->flush();
                $this ->addFlash("Success", "Edit orderdetail succeed !");
                return $this -> renderForm("order/edit.html.twig",
                [
                    'orderForm' => $form
                ]);
            }
        }
    }
}
