<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\Pagination;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProductController extends AbstractController
{
    /**
     * Object Manager for edit and delete
     *
     * @var ObjectManager
     */
    private $manager;

    /**
     * Product Repository
     *
     * @var ProductRepository
     */
    private $repo;


    public function __construct(ObjectManager $manager, ProductRepository $repo)
    {
        $this->manager = $manager;
        $this->repo    = $repo;
    }


    /**
     * Get all products for Admin
     * 
     * @Route("/admin/creations/{page<\d+>?1}", name="admin_products_index")
     * 
     * @param ProductRepository $repo
     * @param Int $page
     * @param Pagination $pagination
     * @return Response
     */
    public function index(ProductRepository $repo, Int $page, Pagination $pagination): Response
    {
        $pagination->setEntityClass(Product::class)
                   ->setCurrentPage($page)
                   ->setLimit(20)
                   ->setParam(['id' => 'DESC'])
        ;

        return $this->render('admin/product/index.html.twig', [
            'pagination' => $pagination
        ]);
    }


    /**
     * Create new product for Admin
     * 
     * @Route("/admin/creations/new", name="admin_products_new")
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form    = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($product);
            $this->manager->flush();

            $this->addFlash(
                'success',
                "Le produit <strong>{$product->getName()}</strong> a été enregistré avec succès"
            );

            return $this->redirectToRoute('admin_products_index');
        }

        return $this->render('admin/product/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Product edit for admin
     * 
     * @Route("/admin/creations/{id}/edit", name="admin_products_edit")
     *
     * @param Product $product
     * @param Request $request
     * @return Response
     */
    public function edit(Product $product, Request $request): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($product);
            $this->manager->flush();

            $this->addFlash(
                'success',
                "Le produit <strong>{$product->getName()}</strong> a été modifié avec succès"
            );

            return $this->redirectToRoute('admin_products_index');
        }

        return $this->render('admin/product/edit.html.twig', [
            'product' => $product,
            'form'    => $form->createView()
        ]);
    }


    /**
     * Delete product for admin
     * 
     * @Route("/admin/creations/{id}/delete", name="admin_products_delete")
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function delete(Product $product): RedirectResponse
    {
        $this->manager->remove($product);
        $this->manager->flush();

        $this->addFlash(
            'success',
            "L'article <strong>{$product->getName()}</strong> a correctement été supprimé"
        );

        return $this->redirectToRoute('admin_products_index');
    }


}
