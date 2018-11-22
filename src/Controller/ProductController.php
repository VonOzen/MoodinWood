<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductSearch;
use App\Form\ProductSearchType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = new ProductSearch();
        $form   = $this->createForm(ProductSearchType::class, $search);
        $form->handleRequest($request);


        return $this->render('product/index.html.twig', [
            'products' => $this->repo->findAllInStock($search),
            'form'     => $form->createView()
        ]);
    }

    /**
     * Show a single product
     * 
     * @Route("/creation/{slug}", name="products_show")
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
