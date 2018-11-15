<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
  
  /**
   * @var String
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Length(min=2, max=100, minMessage="Le prénom doit faire au minimum 2 caractères", maxMessage="Le prénom doit faire au maximum 100 caractères")
   */
  private $firstName;

  /**
   * @var String
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Length(min=2, max=100, minMessage="Le prénom doit faire au minimum 2 caractères", maxMessage="Le prénom doit faire au maximum 100 caractères")
   */
  private $lastName;

  /**
   * @var String
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Email(message="Veuillez entrer un format email valide")
   */
  private $email;

  /**
   * @var String
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Length(min=2, max=200, minMessage="Le sujet doit faire au minimum 2 caractères", maxMessage="Le sujet doit faire au maximum 200 caractères")
   */
  private $subject;

  /**
   * @var String
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Length(min=10, minMessage="Le sujet doit faire au minimum 10 caractères")
   */
  private $message;

  /**
   * Get the value of firstName
   *
   * @return  String
   */ 
  public function getFirstName()
  {
    return $this->firstName;
  }

  /**
   * Set the value of firstName
   *
   * @param  String  $firstName
   *
   * @return  self
   */ 
  public function setFirstName(String $firstName)
  {
    $this->firstName = $firstName;

    return $this;
  }

  /**
   * Get the value of lastName
   *
   * @return  String
   */ 
  public function getLastName()
  {
    return $this->lastName;
  }

  /**
   * Set the value of lastName
   *
   * @param  String  $lastName
   *
   * @return  self
   */ 
  public function setLastName(String $lastName)
  {
    $this->lastName = $lastName;

    return $this;
  }

  /**
   * Get the value of email
   *
   * @return  String
   */ 
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @param  String  $email
   *
   * @return  self
   */ 
  public function setEmail(String $email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of subject
   *
   * @return  String
   */ 
  public function getSubject()
  {
    return $this->subject;
  }

  /**
   * Set the value of subject
   *
   * @param  String  $subject
   *
   * @return  self
   */ 
  public function setSubject(String $subject)
  {
    $this->subject = $subject;

    return $this;
  }

  /**
   * Get the value of message
   *
   * @return  String
   */ 
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * Set the value of message
   *
   * @param  String  $message
   *
   * @return  self
   */ 
  public function setMessage(String $message)
  {
    $this->message = $message;

    return $this;
  }
}