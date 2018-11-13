<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $faker = Factory::create('fr_FR');

    for ($i=0; $i < 12; $i++) { 
      $product = new Product();

      $product->setName($faker->words(2, true))
              ->setDescription($faker->paragraphs(mt_rand(2,4), true))
              ->setType($faker->numberBetween(0, count(Product::TYPE) - 1))
              ->setPrice($faker->numberBetween(5,300))
              ->setInStock(true);

      $manager->persist($product);
      $manager->flush();
    }
  }
}