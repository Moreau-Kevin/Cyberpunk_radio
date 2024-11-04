<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\RadioList;

class RadioListController extends AbstractController
{
    #[Route('/radio/list', name: 'app_radio_list')]
    public function index(): Response
    {
        return $this->render('radio_list/index.html.twig', [
            'controller_name' => 'RadioListController',
        ]);
    }
    #[Route('/Radio_List', name: 'app_RadioList' )]
    public function ListAllRadio(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(RadioList::class);
        $RadioList= $repository->findAll();
        //echo print_r($RadioList);
        return $this->render('RadioList/radiolist.html.twig', [
            'RadioList' => $RadioList,
        ]);
    }
}

