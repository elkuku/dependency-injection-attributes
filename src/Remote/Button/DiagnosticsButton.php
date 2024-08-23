<?php

namespace App\Remote\Button;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
use Symfony\Component\DependencyInjection\Attribute\Exclude;
use Symfony\Component\DependencyInjection\Attribute\When;

#[AsTaggedItem('diagnostics')]
#[When('dev')]
#[Exclude]
final class DiagnosticsButton implements ButtonInterface
{
    public function press(): void
    {
        dump('Running diagnostics...');
    }
}
