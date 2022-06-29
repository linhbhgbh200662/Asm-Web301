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
            $product -> setName("Name $i");
            $product -> setType("T-shirt");
            $product -> setImage("https://mcdn.nhanh.vn/store/2071/ps/20220615/ts265.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

            $product = new Product;
            $product -> setName("Name $i");
            $product -> setType("Polo");
            $product -> setImage("https://product.hstatic.net/1000346413/product/dsc02736-vuong_39678bc0b8e9450290d8d5c8d2c9c521_master.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

            $product = new Product;
            $product -> setName("Name $i");
            $product -> setType("Hoodie");
            $product -> setImage("https://is4.fwrdassets.com/images/p/fw/z/COTF-MK2_V1.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

            $product = new Product;
            $product -> setName("Name $i");
            $product -> setType("Jacket");
            $product -> setImage("https://vulcano.vn/images/products/2020/11/25/original/ao-jacket-0603-1606301557.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

            $product = new Product;
            $product -> setName("Name $i");
            $product -> setType("Varsity");
            $product -> setImage("https://img.cdn.vncdn.io/nvn/ncdn/store/24295/ps/20211117/VASITY_JACKET_UPSET.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

        }

        $manager->flush();
    }
}
