<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategoryController extends AbstractController
{
    private $manager;
    private $repo;

    public function __construct(ObjectManager $manager, CategoryRepository $repo)
    {
        $this->manager = $manager;
        $this->repo    = $repo;
    }
    /**
     * Get all product categories for admin purpose
     * 
     * @Route("/admin/categories", name="admin_categories_index")
     *
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('admin/product/category/index.html.twig', [
            'categories' => $this->repo->findAll(),
        ]);
    }

    /**
     * Create a new product category
     * 
     * @Route("admin/categories/new", name="admin_categories_new")
     *
     * @return Response
     */
    public function new(Request $request)
    {
        $category = new Category();
        $form     = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($category);
            $this->manager->flush();

            $this->addFlash(
                'success',
                "La catégorie <strong>{$category->getName()}</strong> a été ajoutée."
            );

            return $this->redirectToRoute('admin_categories_index');
        }

        return $this->render('admin/product/category/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Edit an existing product category
     *
     * @Route("/admin/categories/{name}/edit", name="admin_categories_edit")
     * 
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        $form = $this->createForm(CategoryType::class, $category);



        return $this->render('admin/product/category/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Undocumented function
     * 
     * @Route("/admin/categories/{name}/delete", name="admin_categories_delete")
     *
     * @param Category $category
     * @return void
     */    
    public function delete(Category $category)
    {
        $this->manager->remove($category);
        $this->manager->flush();

        $this->addFlash(
            'success',
            "La catégorie \"<strong>{$category->getName()}</strong>\" a été supprimée."
        );

        return $this->redirectToRoute('admin_categories_index');
    }
}
