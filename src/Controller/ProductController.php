<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/ ', name: 'view_product')]
    public function ProductIndex(ProductRepository $productRepository) {
        $product = $productRepository -> findAll();
        return $this -> render("product/index.html.twig",
        [
            'products' => $products
        ]);
    }

    #[Route('/detail/{id}', name: 'view_product_by_id')]
    public function ProductDetail(ProductRepository $productRepository, $id) {
        $product = $productRepository -> find($id);
        return $this -> render("product/detail.html.twig",
        [
            'product' => $product
        ]);
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     */
    #[Route('/delete/{id}', name: 'delete_product')]
    public function ProductDelete(ProductRepository $productRepository, $id) {
        $product = $productRepository ->find($id);
        if ($product == null) {
            $this -> addFlash("Error", "Product not found !");
        }
        else if (count($product -> getOrderDetail()) >= 1) {
            $this -> addFlash("Error", "Can not delete this product !");
        }
        else {
            $manager = $managerRegistry -> getManager();
            $manager -> remove($product);
            $manager -> flush();
            $this -> addFlash("Success", "Delete product succeed !");
        }
        return $this -> redirectToRoute("view_product");
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/add', name: 'add_product')]
    public function ProductAdd(Request $request) {
        $product = new Product;
        $form = $this -> createForm(ProductType::class, $product);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $image = $product -> getImage();
            $imgName = uniqid(); // unique id
            $imgExtension = $image -> guessExtension();
            $imageName = $imgName . "." . $imgExtension;
            try {
                $image -> move ($this -> getParameter('product_image'), $imageName);
            } catch (FileExeption $e) {
                throwException($e);
            }
            $product -> setImage($imageName);

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
        $product = $productRepository -> find($id);
        if ($product == null) {
            $this -> addFlash("Error", "Product not found !");
            return $this -> redirectToRoute('view_product');
        } 
        else {
            $form = $this -> createForm(ProductType::class, $product);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $imagFile = $form['image'] -> getData();
                if ($imageFile == null) {
                    $image = $product -> getImage();
                    $imgName = uniqid(); //unique id
                    $imgExtension = $image -> guessExtension();
                    $imageName = $imgName . "." . $imgExtension;
                    try {
                        $image -> move(
                            $this -> getParameter('product_image'),
                            $imagename
                        );
                    } catch (FileExcepsion $e) {
                        throwExcepsion($e);
                    }
                    $product -> setImage($imageName);
                }
                $manager = $managerRegistry -> getManager();
                $manager -> persist($product);
                $manager -> flush();
                $this -> addFlash("Succcess", "Edit product succeed 1");
                return $this -> redirectToRoute("view_product");
            }
            return $this -> renderForm("product/edit.html.twig",
            [
                'productForm' => $form
            ]);
        }
    }
 
    #[Route('/sortbyname/asc', name: 'sort_product_name_ascending')]
    public function ProductSortAscending(ProductRepository $productRepository) {
        $product = $productRepository -> sortByNameAscending();
        return $this -> render("product/index.html.twig",
        [
            'products' => $products
        ]);
    }

    #[Route('/sortbyname/desc', name: 'sort_product_name_descending')]
    public function ProductSortDescending(ProductRepository $productRepository) {
        $product = $productRepository ->sortByNameDescending();
        return $this -> render("product/index.html.twig",
        [
            'products' => $products
        ]);
    }


    #[Route('/searchbyname', name: 'search_product_name')]
    public function CustomerSearchByName (ProductRepository $productRepository, Request $request) {
        $name = $request -> get('keyword');
        $product = $productRepository -> searchByName($name);
        return $this -> render ("product/index.html.twig",
        [
            'products' => $products
        ]);
    }
}
