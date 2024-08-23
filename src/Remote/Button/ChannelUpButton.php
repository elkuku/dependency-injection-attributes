<?php

namespace App\Remote\Button;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('channel-up', priority: 90)]
final class ChannelUpButton implements ButtonInterface
{
    public function press(): void
    {
        dump('Change the channel up');
    }
}
