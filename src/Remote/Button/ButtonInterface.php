<?php

namespace App\Remote\Button;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\DependencyInjection\Attribute\Lazy;

#[AutoconfigureTag]
#[Lazy(ButtonInterface::class)]
interface ButtonInterface
{
    public function press(): void;
}
