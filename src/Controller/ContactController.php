<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * Contact page with form using Mailer component
     * 
     * @Route("/contact", name="contact")
     * 
     * @param Request $request
     * @return Response
     */
    public function contact(Request $request, ContactNotification $notification)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);

            $this->addFlash(
                'success',
                "Merci de votre message ! <br>
                Nous vous recontacterons dès que possible :)"
            );
            return $this->redirectToRoute('homepage');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact
        ]);
    }
}
