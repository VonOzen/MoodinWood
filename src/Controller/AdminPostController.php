<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPostController extends AbstractController
{
    /**
     * Insert a new Post into the database (only for admin)
     * 
     * @Route("admin/posts/new", name="admin_posts_new")
     * 
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($post);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'article \"<strong>{$post->getTitle()}</strong>\" a été enregistré"
            );

            return $this->redirectToRoute('posts_show', [
                'slug' => $post->getSlug()
            ]);
        }


        return $this->render('admin/post/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Allow post editing for admin
     * 
     * @Route("admin/posts/{id}/edit", name="admin_posts_edit")
     *
     * @param Post $post
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(Post $post, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($post);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'article \"<strong>{$post->getTitle()}</strong>\" a bien été modifié"
            );
        }

        return $this->render('admin/post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }

    /**
     * Allow admin to delete a post
     * 
     * @Route("admin/posts/{id}/delete", name="admin_posts_delete")
     *
     * @param Post $post
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Post $post, ObjectManager $manager)
    {
        $manager->remove($post);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'article \"<strong>{$post->getTitle()}</strong>\" a été correctement supprimé"
        );

        return $this->redirectToRoute('posts_index');
    }


}
