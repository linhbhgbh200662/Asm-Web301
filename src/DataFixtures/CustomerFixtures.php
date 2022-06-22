<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CustomerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $customer = new Customer;
            $customer -> setName("Customer $i");
            $customer -> setAddress("Ha Noi");
            $customer -> setPhone("");
            $customer -> setDateOfBirth(\DateTime::createFromFormat('Y/m/d', '2002/08/08'));
            $manager -> persist($customer);

        }

        $manager->flush();
    }
}
