<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Doom Eternal - The Ancient Gods Part 3');
        $product->setDescription('');
        $product->setPicture('');

        $manager->persist($product);
        $manager->flush();
    }
}
