<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\ProductTypeType;
use App\Repository\TypeRepository;
use Symfony\Component\HttpFoundation\Request;
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
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('admin/product/type/index.html.twig', [
            'types' => $this->repo->findAll()
        ]);
    }

    /**
     * Create a new product type
     * 
     * @Route("admin/types/new", name="admin_types_new")
     *
     * @return Response
     */
    public function new(Request $request)
    {
        $type = new Type();
        $form = $this->createForm(ProductTypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($type);
            $this->manager->flush();

            $this->addFlash(
                'success',
                "Le type de produit <strong>{$type->getName()}</strong> a été ajouté."
            );

            return $this->redirectToRoute('admin_types_index');
        }

        return $this->render('admin/product/type/new.html.twig', [
            'form'  => $form->createView(),
            'types' => $this->repo->findAll()
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
    public function edit(Type $type, Request $request)
    {
        $form = $this->createForm(ProductTypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($type);
            $this->manager->flush();

            $this->addFlash(
                'success',
                'Le type de produit a bien été modifié.'
            );

            return $this->redirectToRoute('admin_types_index');
        }
        

        return $this->render('admin/product/type/edit.html.twig', [
            'form'  => $form->createView(),
            'type'  => $type,
            'types' => $this->repo->findAll(),
            'edit'  => 'Editer le produit'
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

        return $this->redirectToRoute('admin_types_index');
    }
}
