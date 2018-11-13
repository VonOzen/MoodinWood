<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var ProductRepository
     */
    private $repo;


    public function __construct(ObjectManager $manager, ProductRepository $repo)
    {
        $this->manager = $manager;
        $this->repo    = $repo;
    }


    /**
     * Get all products
     * 
     * @Route("/creations", name="products_index")
     * 
     * @return Response
     */
    public function index()
    {
        return $this->render('product/index.html.twig', [
            'products' => $this->repo->findAllInStock()
        ]);
    }
}
