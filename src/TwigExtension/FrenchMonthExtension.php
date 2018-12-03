<?php

namespace App\TwigExtension;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class FrenchMonthExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('frMonth', [$this, 'frMonthFilter'])
        ];
    }

    public function frMonthFilter(String $str) : ?String
    {
        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        $string = explode(' ', $str);
        $month  = intval($string[0]) - 1;
        $year   = $string[1];

        return $months[$month] . ' ' . $year;
    }
}