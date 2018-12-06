<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\ProductTypeType;
use App\Repository\TypeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProductTypeController extends AbstractController
{
    private $manager;
    private $repo;

    public function __construct(ObjectManager $manager, TypeRepository $repo)
    {
        $this->manager = $manager;
        $this->repo    = $repo;
    }
    /**
     * Get all product types for admin purpose
     * 
     * @Route("/admin/types", name="admin_types_index")
     *
     * @return TypeCollection|null
     */
    public function index() : ?TypeCollection
    {
        return $this->render('admin/product/type/index.html.twig', [
            'types' => $this->repo->findAll(),
        ]);
    }

    /**
     * Create a new product type
     * 
     * @Route("admin/types/new", name="admin_types_new")
     *
     * @return Response
     */
    public function new()
    {
        $type = new Type();
        $form = $this->createForm(ProductTypeType::class, $type);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($type);
            $this->manager->flush();

            $this->addFlash(
                'success',
                "Le type de produit <strong>{$type->getName()}</strong> a été ajouté."
            );

            $this->redirectToRoute('admin_types_index');
        }

        return $this->render('admin/product/type/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Edit an existing product type
     *
     * @Route("/admin/types/{name}/edit", name="admin_types_edit")
     * 
     * @param Type $type
     * @return Response
     */
    public function edit(Type $type)
    {
        $form = $this->createForm(ProductTypeType::class, $type);



        return $this->render('admin/product/type/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Undocumented function
     * 
     * @Route("/admin/types/{name}/delete", name="admin_types_delete")
     *
     * @param Type $type
     * @return void
     */    
    public function delete(Type $type)
    {
        $this->manager->remove($type);
        $this->manager->flush();

        $this->addFlash(
            'success',
            "Le type de produit \"<strong>{$type->getName()}</strong>\" a été supprimé."
        );

        $this->redirectToRoute('admin_types_index');
    }
}
