<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for( $i=1; $i<=15; $i++) {
            $product = new Product;
            $product -> setproductID('P1');
            $product -> setcartID($this -> getReference('C1'));
            $product -> setName("Name $i");
            $product -> setType("T-shirt, Polo, Hoodie, Jacket");
            $product -> setImage("https://mcdn.nhanh.vn/store/2071/ps/20220615/ts265.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

            $product = new Product;
            $product -> setproductID('P2');
            $product -> setcartID($this -> getReference('C2'));
            $product -> setName("Name $i");
            $product -> setType("Polo, Hoodie, Jacket");
            $product -> setImage("https://mcdn.nhanh.vn/store/2071/ps/20220615/ts265.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

            $product = new Product;
            $product -> setproductID('P3');
            $product -> setcartID($this -> getReference('C3'));
            $product -> setName("Name $i");
            $product -> setType("T-shirt, Polo, Hoodie, Jacket");
            $product -> setImage("https://mcdn.nhanh.vn/store/2071/ps/20220615/ts265.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

            $product = new Product;
            $product -> setproductID('P4');
            $product -> setcartID($this -> getReference('C4'));
            $product -> setName("Name $i");
            $product -> setType("T-shirt, Polo, Hoodie, Jacket");
            $product -> setImage("https://mcdn.nhanh.vn/store/2071/ps/20220615/ts265.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

            $product = new Product;
            $product -> setproductID('P5');
            $product -> setcartID($this -> getReference('C5'));
            $product -> setName("Name $i");
            $product -> setType("T-shirt, Polo, Hoodie, Jacket");
            $product -> setImage("https://mcdn.nhanh.vn/store/2071/ps/20220615/ts265.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

        }

        $manager->flush();
    }
}
