<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $faker   = Factory::create('fr_FR');
    $slugify = new Slugify();

    for($i = 1; $i <= 20; $i++){
      $post = new Post();

      $title = $faker->sentence(4);

      $post->setTitle($title)
           ->setSlug($slugify->slugify($title))
           ->setPreview($faker->paragraph())
           ->setContent('<p>'. join('</p><p>', $faker->paragraphs(mt_rand(2,6))) .'</p>')
           ->setCoverImage($faker->imageUrl(600,400))
           ->setCreatedAt($faker->dateTimeBetween('-6months'));

      $manager->persist($post);
      $manager->flush();
    }
  }
}