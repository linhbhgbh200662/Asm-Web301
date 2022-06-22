<?php

namespace App\DataFixtures;

use App\Entity\CartDetail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CartDetailFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $cartdetail = new CartDetail;
            $cartdetail -> setQuantity(rand(50,100));
            $cartdetail -> setPrice((float)(rand(520000,1500000)));
            $manager -> persist($cartdetail);
        }

        $manager->flush();
    }
}
