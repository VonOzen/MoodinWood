<?php

namespace App\Form;

use App\Entity\Contact;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
              'firstName',
              TextType::class,
              $this->setAttributes('Prénom', "Votre prénom")
            )
            ->add(
              'lastName',
              TextType::class,
              $this->setAttributes('Nom', "Votre nom")
            )
            ->add(
              'email',
              TextType::class,
              $this->setAttributes('Adresse mail', "Votre adresse mail afin d'être recontacté")
            )
            ->add(
              'subject',
              TextType::class,
              $this->setAttributes('Sujet', "Sujet de votre message")
            )
            ->add(
              'message',
              TextareaType::class,
              $this->setAttributes('Message', "Contenu de votre message")
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
