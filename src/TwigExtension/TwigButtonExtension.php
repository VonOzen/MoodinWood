<?php

namespace App\TwigExtension;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class TwigButtonExtension extends AbstractExtension
{

  public function getFilters()
  {
    return [
      new TwigFilter('button', [$this, 'buttonFilter'], ['is_safe' => ['html']])
    ];
  }

  public function buttonFilter($content, array $options = []) : string
  {
    $defaultOptions = [
      'color' => 'primary',
      'icon'  => '',
      'type'  => ''    
    ];

    $options = array_merge($defaultOptions, $options);

    $tpl = '<button type="%s" class="button %s"><i class="%s"></i>%s</button>';

    return sprintf(
      $tpl,
      $options['type'],
      $options['color'],
      $options['icon'],
      $content
    );
  }

}