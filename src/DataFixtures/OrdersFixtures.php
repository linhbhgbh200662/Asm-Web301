<?php

namespace App\DataFixtures;

use App\Entity\OrderDetail;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class OrdersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=12; $i++) {
            $orderdetail = new OrderDetail;
            $orderdetail -> setQuantity(rand(50,100));
            $orderdetail -> setUnitPrice(rand(50,100));
            // $orderdetail -> setDate(\DateTime::createFromFormat('Y/m/d', '2001/01/03'));
            $manager -> persist($orderdetail);

        }

        $manager->flush();
    }
}
