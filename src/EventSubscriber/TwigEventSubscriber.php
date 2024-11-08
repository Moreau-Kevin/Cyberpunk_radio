<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use App\Repository\RadioListRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;
class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $RadioListRepository;

    public function __construct(Environment $twig, RadioListRepository $RadioListRepository)
    {
        $this->twig = $twig;
        $this->RadioListRepository = $RadioListRepository;
    }
    public function onKernelController(ControllerEvent $event): void
    {
        $this->twig->addGlobal('RadioList', $this->RadioListRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
