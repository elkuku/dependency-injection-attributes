<?php

namespace App\Remote\Button;

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;

#[Autoconfigure(
    tags: [ButtonInterface::class],
    lazy: ButtonInterface::class,
)]
interface ButtonInterface
{
    public function press(): void;
}
