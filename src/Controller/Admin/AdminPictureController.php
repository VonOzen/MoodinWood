<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/admin/photo")
 */
class AdminPictureController extends AbstractController
{

  /**
   * @Route("/{id}/delete", name="admin_pictures_delete", methods="DELETE")
   */
  public function delete(Picture $picture, ObjectManager $manager, Request $request)
  {
    $data = json_decode($request->getContent(), true);

    if ($this->isCsrfTokenValid('delete' . $picture->getId(), $data['_token'])) {
      $manager->remove($picture);
      $manager->flush();
      return new JsonResponse(['success' => 1]);
    }

    return new JsonResponse(['error' => 'Une erreur est survenue lors de la suppression'], 400);

  }
}