<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\OffreEmploi;
use App\Repository\CandidatureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidaturesController extends AbstractController
{
    #[Route('/offre/{id}/postuler', name: 'postuler')]
      public function postuler(EntityManagerInterface $entityManager, OffreEmploi $offre): response
      {        
        $candidature = new Candidature();
  
     /**
      * @var User $user
     */
        $user = $this->getUser();
        $candidature->setOffreEmploi($offre); 
        $candidature->setCandidate($user->getCandidate());
       
 
        $entityManager->persist($candidature);
        $entityManager->flush();

        return $this->redirectToRoute('app_candidatures');
      }

    #[Route('/candidatures', name: 'app_candidatures')]
    public function index(CandidatureRepository $candidatureRepository): Response
    {
      /**
      * @var User $user
     */
      $user = $this->getUser();
      $candidatures = $candidatureRepository->findBy(['candidate' => $user->getCandidate()]);
      
        return $this->render('candidatures/index.html.twig', [
            'candidatures' => $candidatures,
        ]);
    }
}
