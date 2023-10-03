<?php

namespace App\Controller;

use App\Entity\OffreEmploi;
use App\Repository\OffreEmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(OffreEmploiRepository $offreEmploiRepository): Response
    {
  
        $offres =  $offreEmploiRepository->findBy([], ['id'=> 'DESC'],4);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'offres' => $offres,
        ]);
    }
}
