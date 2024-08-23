<?php

namespace App\Remote;

use App\Remote\Button\PowerButton;
use App\Remote\Button\VolumeDownButton;
use App\Remote\Button\VolumeUpButton;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;

final class ButtonRemote
{
    public function __construct(
        #[AutowireLocator([
            'power' => PowerButton::class,
            'channel-up' => VolumeUpButton::class,
            'channel-down' => VolumeDownButton::class,
            'volume-up' => VolumeUpButton::class,
            'volume-down' => VolumeDownButton::class,
        ])]
        private ContainerInterface $buttons,
    ) {
    }

    public function press(string $name): void
    {
        $this->buttons->get($name)->press();
    }
}
