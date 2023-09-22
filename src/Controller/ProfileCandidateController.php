<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\FormCandidateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileCandidateController extends AbstractController
{
    #[Route('/profile', name: 'app_profile_candidate')]
    public function index(Request $request,  EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // si un user n'existe pas on redirige vers la page login
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        //on passe à une variable l'entitymanager pour récupérer le répository de la class
        $repositoryCandidate = $entityManager->getRepository(Candidate::class);

        //on utitlise la methode du repository findOneBy qui prend un tableaux en paramêtre, ici user
        $candidate = $repositoryCandidate->findOneBy(['user' => $user]);

        // on fait une condition pour savoir si le canditat est vide alors on le crée avec $candidate = new Candidate
        if($candidate === null){
            $candidate = new Candidate();
            $candidate->setUser($user);
        }

        

        

        $form = $this->createForm(FormCandidateType::class, $candidate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){



            // gerer le createdAt, updatedAt, deletedAt à null, notes ...
            $entityManager->persist($candidate);
            $entityManager->flush();

            return $this->redirectToRoute('/');

        }

        return $this->render('profile/index.html.twig', [
            'formCandidate' => $form->createView(),
        ]);
    }
}
