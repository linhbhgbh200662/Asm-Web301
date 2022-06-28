<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_MANAGER")
 */

#[Route('/customer')]
class CustomerController extends AbstractController
{
    #[Route('/ ', name: 'view_customer')]
    public function CustomerIndex(CustomerRespository $customerRepository) {
        $customer = $customerRepository -> viewAllCustomer();
        return $this -> render("customer/index.html.twig",
        [
            'customers' => $customers
        ]);
    }

    #[Route('/detail/{id}', name: 'view_customer_by_id')] 
    public function CustomerDetail(ManagerRegistry $managerRegistry, $id) {
        $customer = $managerRegistry -> getRepository(Customer::class) -> find($id);
        return $this -> render("customer/detail.html.twig",
        [
            'customer' => $customer
        ]);
    }

    
    #[Route('/delete/{id}', name: 'delete_customer')]
    public function CustomerDelete(ManagerRegistry $managerRegistry, $id) {
        $customer = $managerRegistry -> getRepository(Customer::class) -> find($id);
        if ($customer == null) {
            $this -> addFlash("Error", "Customer not found");

        }
        else {
            $manager = $this -> getDoctrine() -> getManager();
            $manager -> remove($customer);
            $manager -> flush();
            $this -> addFlash("Success", "Delete customer succeed !");
        }
        return $this -> redirectToRoute("view_customer");
    }

    #[Route('/add', name: 'add_customer')]
    public function CustomerAdd(Request $request) {
        $customer = new Customer;
        $form = $this -> createForm(CustomerType::class, $customer);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $manager = $this -> getDoctrine() -> getManager();
            $manager -> persist($customer);
            $manager -> flush();
            $this -> addFlash("Success", "Add customer succeed 1");
            return $this -> redirectToRoute("view_customer");
        }
        return $this -> render("customer/add/html.twig",
        [
            'customerForm' => $form -> createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'edit_customer')]
    public function CustomerEdit(Request $request, CustomerRepository $customerRepository, $id) {
        $customer = $customerRepository -> find($id);
        if ($customer == null) {
            $this -> addFlash("Error", "Customer not found !");
            return $this -> redirectToRoute("view_customer");
        }
        else {
            $form = $this -> createForm(CustomerType::class, $customer);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $manager = $this -> getDoctrine() -> getManager();
                $manager -> persist($custoemr);
                $manager -> flush();
                $this -> addFlash("Success", "Edit customer succed !");
                return $this -> redirectToRoute("view_customer");
            }
            return $this -> renderForm("customer/edit.html.twig",
            [
                'customerForm' => $form
            ]);
        }

        
    }
}
