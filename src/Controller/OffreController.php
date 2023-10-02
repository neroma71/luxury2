<?php

namespace App\Controller;

use App\Repository\OffreEmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    #[Route('/offre', name: 'app_offre')]
    public function index(OffreEmploiRepository $offreEmploiRepository): Response
    {

        $offres = $offreEmploiRepository->findAll();

        return $this->render('offre/index.html.twig', [
            'offres' => $offres,
        ]);
    }
    #[Route('/offre/{id}', name: 'app_offre_show')]
    public function show($id, OffreEmploiRepository $offreEmploiRepository): Response
    {
        $offreEmploi = $offreEmploiRepository->find($id);

        if (!$offreEmploi) {
            throw $this->createNotFoundException('Offre d\'emploi non trouvée');
        }
         
        $offrePrecedente = $offreEmploiRepository->findOffrePrecedente($offreEmploi);
        $offreSuivante = $offreEmploiRepository->findOffreSuivante($offreEmploi);

        return $this->render('offre/show.html.twig', [
            'offreEmploi' => $offreEmploi,
            'offrePrecedente' => $offrePrecedente,
            'offreSuivante' => $offreSuivante,
        ]);
    }

}
