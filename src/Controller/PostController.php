<?php

namespace App\Controller;

use App\Entity\Post;
use App\Service\Pagination;
use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    /**
     * Get all posts
     * 
     * @Route("/posts/{page<\d+>?1}", name="posts_index")
     * 
     * @param PostRepository $repo
     * @param Integer $page
     * @param Pagination $pagination
     * @return Response
     */
    public function index(PostRepository $repo, $page, Pagination $pagination)
    {
        $pagination->setEntityClass(Post::class)
                   ->setCurrentPage($page)
                   ->setLimit(5);
        return $this->render('post/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * Get a single post based on the slug
     * 
     * @Route("/posts/{slug}", name="posts_show")
     * 
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }
}
