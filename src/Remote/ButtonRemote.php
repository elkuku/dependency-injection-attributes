<?php

namespace App\Remote;

use App\Remote\Button\ButtonInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;
use Symfony\Contracts\Service\ServiceCollectionInterface;

final class ButtonRemote
{
    public function __construct(
        #[AutowireLocator(ButtonInterface::class, indexAttribute: 'key')]
        private ServiceCollectionInterface $buttons,
    ) {
    }

    public function press(string $name): void
    {
        $this->buttons->get($name)->press();
    }

    /**
     * @return string[]
     */
    public function buttons(): iterable
    {
        return array_keys($this->buttons->getProvidedServices());
    }
}
