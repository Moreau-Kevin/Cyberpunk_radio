<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        return $this->render('main/homepage.html.twig',[
            
        ]);
    }
    #[Route('/Inscription', name: 'app_inscription')]
    public function inscription(): Response
    {
        return$this->render('Users/inscription.html.twig',[
            
        ]);
    }
    
    
}