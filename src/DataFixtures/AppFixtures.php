<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
  private $encoder;

  public function __construct(UserPasswordEncoderInterface $encoder)
  {
    $this->encoder = $encoder;
  }

  public function load(ObjectManager $manager)
  {
    $faker   = Factory::create('fr_FR');
    $slugify = new Slugify();

    // Adding fake user
    $admin = new User();
    $admin->setUsername('Admin')
          ->setEmail('hello@simonescure.fr')
          ->setHash($this->encoder->encodePassword($admin, 'admin'));
    
    $manager->persist($admin);

    // Adding fake posts
    for($i = 1; $i <= 20; $i++){
      $post = new Post();

      $title = $faker->sentence(4);

      $post->setTitle($title)
           ->setSlug($slugify->slugify($title))
           ->setPreview($faker->paragraph())
           ->setContent($faker->paragraphs(mt_rand(3,6), true))
           ->setCreatedAt($faker->dateTimeBetween('-6months'));

      $manager->persist($post);
      $manager->flush();
    }
  }
}