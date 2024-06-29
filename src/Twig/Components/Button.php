<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Button 
{
    public string $label="";
    public string $url="";
    public string $size="w-80 h-32";
    public string $type="button";
    public string $textSize ="text-base lg:text-lg lg:text-2xl";
}