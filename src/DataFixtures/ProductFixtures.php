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
            $product -> setType("T-shirt, Polo, Hoodie, Jacket");
            $product -> setImage("https://mcdn.nhanh.vn/store/2071/ps/20220615/ts265.jpg");
            $product -> setPrice((float)(rand(123000,1820450)));
            $manager -> persist($product);

        }

        $manager->flush();
    }
}
