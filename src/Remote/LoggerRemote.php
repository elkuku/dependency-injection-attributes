<?php

namespace App\Remote;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(RemoteInterface::class)]
final class LoggerRemote implements RemoteInterface
{
    public function __construct(
        private RemoteInterface $inner,
        private LoggerInterface $buttonLogger,
    ) {
    }

    public function press(string $name): void
    {
        $this->buttonLogger->info('Pressing button {name}', ['name' => $name]);

        $this->inner->press($name);

        $this->buttonLogger->info('Button {name} pressed', ['name' => $name]);
    }

    public function buttons(): iterable
    {
        return $this->inner->buttons();
    }
}
