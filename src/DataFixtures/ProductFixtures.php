<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;
use App\Entity\Product;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $faker = Factory::create('fr_FR');

    $categories = [];

    for ($i=0; $i<=6; $i++) {
      $category = new Category();
      $category->setName($faker->words(1, true));
      $categories[] = $category;
    }

    for ($i=0; $i < 12; $i++) { 
      $product = new Product();

      $product->setName($faker->words(2, true))
              ->setDescription($faker->paragraphs(mt_rand(2,4), true))
              ->setCategory($faker->randomElement($categories))
              ->setPrice($faker->numberBetween(5,300))
              ->setInStock(true);

      $manager->persist($product);
      $manager->flush();
    }
  }
}