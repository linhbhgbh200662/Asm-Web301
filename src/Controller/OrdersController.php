<?php

namespace App\Controller;

use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/orders')]
class OrdersController extends AbstractController
{
    #[Route('/', name: 'view_orders')]
    public function OrdersIndex(): Response
    {
        $orders = $this -> getDoctrine() -> getRepository(Orders::class) -> findAll();
        return $this ->render("orders/index.html.twig",
        [
            'orders' => $orders
        ]);
    }

    #[Route('/detail/{id}', name: 'view_orders_by_id')]
    public function OrdersDetails($id) {
        $orders = $his -> getDoctrine() -> getRepository(Orders::class) ->find($id);
        if ($orders == null ) {
            $this ->addFlash("Error", "Orders not found !");
            return $this -> redirectToRoute("view_orders");
        }
        return $this -> render('orders/deatil.html.twig',
        [
            'orders' => $orders
        ]);
    }

    #[Route('delete/{$id}', name: 'delete_orders')]
    public function OrdersDelete($id) {
        $orders = $this -> getDoctrine() ->getRepositoty(Orders::class) ->find($id);
        if ($orders == null) {
            $this -> addFlash("Error", "Orders not found !");
        }
        else {
            $manager = $managerRegistry ->getManager();
            $manager -> remove($cart);
            $manager ->flush();
            $this ->addFlash("Success", "Delete orders succeed !");
        }
        return $this ->redirectToRoute("view_orders");
    }

    #[Route('/edit', name: 'edit_orders')]
    public function OrdersEdit(Request $request, $id) {
        $orders = $this ->getDoctrine() ->getRepository(Orders::class) ->find($id);
        if ($corders == null) {
            $this ->addFlash("Error", "Orders not found !");
            return $this ->redirectToRoute("view_orders");
        }
        else {
            $form = $this ->createForm(Orders::class, $orders);
            $form ->handleRequest($request);
            if ($form ->isSubmitted() && $form ->isValid()) {
                $manager = $this -> getDoctrine() ->getManager();
                $manager ->persist($orders);
                $manager ->flush();
                $this ->addFlash("Success", "Edit orders succeed !");
                return $this -> renderForm("orders/edit.html.twig",
                [
                    'ordersForm' => $form
                ]);
            }
        }
    }
}
