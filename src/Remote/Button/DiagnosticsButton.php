<?php

namespace App\Remote\Button;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('diagnostics')]
final class DiagnosticsButton implements ButtonInterface
{
    public function press(): void
    {
        dump('Running diagnostics...');
    }
}
