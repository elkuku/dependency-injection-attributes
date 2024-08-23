<?php

namespace App\Controller;

use App\Remote\Button\ButtonInterface;
use App\Remote\Button\PowerButton;
use App\Remote\RemoteInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\AutowireCallable;
use Symfony\Component\DependencyInjection\Attribute\AutowireServiceClosure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use function Symfony\Component\String\u;

final class RemoteController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET', 'POST'])]
    public function index(Request $request, RemoteInterface $remote): Response
    {
        if ('POST' === $request->getMethod()) {
            try {
                $remote->press($button = $request->request->getString('button'));
            } catch (NotFoundExceptionInterface $e) {
                throw $this->createNotFoundException(sprintf('Button "%s" not found.', $button), previous: $e);
            }

            $this->addFlash('success', sprintf('%s pressed', u($button)->replace('-', ' ')->title(allWords: true)));

            return $this->redirectToRoute('home');
        }

        return $this->render('index.html.twig', [
            'buttons' => $remote->buttons(),
        ]);
    }

    #[Route('/power', name: 'power')]
    public function power(
        #[Autowire(service: PowerButton::class)]
        ButtonInterface $button,
    ): Response {
        if (true) { // some condition
            dump($button);

            $button->press();

            dd($button);
        }
    }

    /**
     * @param \Closure():string[] $remote
     */
    #[Route('/buttons', name: 'buttons')]
    public function buttons(
        #[AutowireCallable(service: RemoteInterface::class, method: 'buttons')]
        \Closure $remote,
        CacheInterface $cache,
    ): Response {
        $buttons = $cache->get('buttons', function () use ($remote) {
            dd($remote());

            return $remote();
        });

        return $this->json($buttons);
    }
}
