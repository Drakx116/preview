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
        $product->setName('Doom Eternal - The Ancient Gods Part II');
        $product->setDescription('DOOM Eternal : The Ancient Gods, Part II reprend là où la première extension s’était arrêtée. Ce DLC entend bien donner une conclusion satisfaisante aux aventures du Doom Slayer. Si la première partie n’était pas exempte de défauts, elle proposait tout de même une expérience plaisante. Pour clore cette épopée, id Software semble avoir mis les petits plats dans les grands, car ce deuxième volet s’affranchit des griefs de son prédécesseur.');
        $product->setPicture('https://image.jeuxvideo.com/medias/161660/1616598029-8610-capture-d-ecran.jpg');

        $manager->persist($product);
        $manager->flush();
    }
}
