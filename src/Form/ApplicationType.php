<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType
{
  /**
   * Set the HTML attributes via the form builder
   *
   * @param String $label
   * @param String $placeholder
   * @param Array $options
   * @return Array
   */
  protected function setAttributes($label, $placeholder, $options = [])
  {
    return array_merge_recursive([
      'label' => $label,
      'attr'  => [
        'placeholder' => $placeholder
      ]
      ], $options)
    ;
  }
}