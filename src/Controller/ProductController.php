<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/ ', name: 'view_product_list')]
    public function ProductIndex(ManagerRegistry $managerRegistry) {
        $products = $managerRegistry->getRepository(Product::class)->findAll();
        return $this->render("product/index.html.twig",
        [
            'products' => $products
        ]);
    }

    #[Route('/detail/{id}', name: 'view_product_by_id')]
    public function ProductDetail(ManagerRegistry $managerRegistry, $id) {
        $product = $managerRegistry->getRepository(Product::class)->find($id);
        return $this->render("product/detail.html.twig",
        [
            'product' => $product
        ]);
    }

    #[Route('/delete/{id}', name: 'delete_product')]
    public function ProductDelete(ManagerRegistry $managerRegistry, $id) {
        $product = $managerRegistry->getRepository(Product::class)->find($id);
        if ($product == null) {
            $this->addFlash("Error","Product not found !");        
        } 
        // else if (count($product->getproduct()) >= 1 ) {
        //     $this->addFlash("Error","Can not delete this product !");
        // }
        else {
            $manager = $managerRegistry->getManager();
            $manager->remove($product);
            $manager->flush();
            $this->addFlash("Success","Delete product succeed  !");
        }
        return $this->redirectToRoute("view_product_list");
    }
    #[Route('/add', name: 'add_product')]
    public function ProductAdd(Request $request) {
        $product = new Product;
        $form = $this -> createForm(ProductType::class, $product);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            // $image = $product -> getImage();
            // $imgName = uniqid(); // unique id
            // $imgExtension = $image -> guessExtension();
            // $imageName = $imgName . "." . $imgExtension;
            // try {
            //     $image -> move ($this -> getParameter('product_image'), $imageName);
            // } catch (FileExeption $e) {
            //     throwException($e);
            // }
            // $product -> setImage($imageName);

            $manager = $this -> getDoctrine() -> getManager();
            $manager -> persist($product);
            $manager -> flush();
            $this -> addFlash("Success", "Add product succeed !");
            return $this -> redirectToRoute("view_product");
        }
        return $this -> renderForm("product/add.html.twig",
        [
            'productForm' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'edit_product')]
    public function ProductEdit(Request $request, ProductRepository $productRepository, $id) {
        $product = $productRepository->find($id);
        if ($product == null) {
            $this->addFlash("Error","product not found !");
            return $this->redirectToRoute("view_product_list");        
        } else {
            $form = $this->createForm(ProductType::class,$product);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($product);
                $manager->flush();
                $this->addFlash("Success","Edit product succeed !");
                return $this->redirectToRoute("view_product_list");
            }
            return $this->renderForm("product/edit.html.twig",
            [
                'productForm' => $form
            ]);
        } 
    }
}
