<?php

namespace App\Remote;

use App\Remote\Button\ButtonInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final class ButtonRemote
{
    public function __construct(
        #[AutowireIterator(ButtonInterface::class, indexAttribute: 'key')]
        private iterable $buttons,
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
        foreach ($this->buttons as $name => $button) {
            yield $name;
        }
    }
}
