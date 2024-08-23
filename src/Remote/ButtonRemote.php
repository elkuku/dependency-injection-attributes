<?php

namespace App\Remote;

use App\Remote\Button\ButtonInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;

final class ButtonRemote
{
    public function __construct(
        #[AutowireLocator(ButtonInterface::class)]
        private ContainerInterface $buttons,
    ) {
    }

    public function press(string $name): void
    {
        $this->buttons->get($name)->press();
    }
}
