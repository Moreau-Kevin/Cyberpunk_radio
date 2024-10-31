<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RadioListController extends AbstractController
{
    #[Route('/radio/list', name: 'app_radio_list')]
    public function index(): Response
    {
        return $this->render('radio_list/index.html.twig', [
            'controller_name' => 'RadioListController',
        ]);
    }
}
