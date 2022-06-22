<?php

namespace App\DataFixtures;

use App\Entity\OrderDetail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderDetailFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $orderdetail = new OrderDetail;
            $orderdetail -> setQuantity(rand(50,100));
            $orderdetail -> setUnitPrice((float)(rand(520000,1520000)));
            $manager -> persist($orderdetail);

        }

        $manager->flush();
    }
}
