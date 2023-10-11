<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Media;
use App\Entity\User;
use App\Form\FormCandidateType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class ProfileCandidateController extends AbstractController
{
    #[Route('/profile', name: 'app_profile_candidate')]
    public function index(Request $request,  EntityManagerInterface $entityManager): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();

        // si un user n'existe pas on redirige vers la page login
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        //on utitlise la methode du repository findOneBy qui prend un tableaux en paramêtre, ici user
        $candidate = $user->getCandidate();

        // on fait une condition pour savoir si le canditat est vide alors on le crée avec $candidate = new Candidate
        if($candidate === null){
            $candidate = new Candidate();
            $candidate->setUser($user);
        }

        
        $form = $this->createForm(FormCandidateType::class, $candidate);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
        //    dd($candidate);
            
            $directory1 = $this->getParameter('kernel.project_dir') . '/public/assets/uploads/';

            /**
             * @var UploadedFile $profil
             */
            $profil = $form['profilPicture']->getData();

            $profileMedia = new Media();

            if ($profil) {
                $extension = $profil->guessExtension();
                if (!$extension) {
                    $extension = 'png';
                }
                
                $profilPicture = Uuid::v7() . '.' . $extension;
                $profil->move($directory1, $profilPicture);
                $profileMedia->setPath($profilPicture);
                $candidate->setProfilPicture($profileMedia);
            }

            $directory2 = $this->getParameter('kernel.project_dir') . '/public/assets/uploads/';
            $passport = $form['passport']->getData();

            $passportMedia = new Media();

            if ($passport) {
                $extension = $passport->guessExtension();
                if (!$extension) {
                    $extension = 'png';
                }
                
                $passportPicture = Uuid::v7() . '.' . $extension;
                $passport->move($directory2, $passportPicture);
                $passportMedia->setPath($passportPicture);
                $candidate->setPassport($passportMedia);
            }

            $directory3 = $this->getParameter('kernel.project_dir') . '/public/assets/uploads/';
            $cv = $form['cv']->getData();

            $cvMedia = new Media();

            if ($cv) {
                $extension = $cv->guessExtension();
                if (!$extension) {
                    $extension = 'png';
                }
                
                $cvPicture = Uuid::v7() . '.' . $extension;
                $cv->move($directory3, $cvPicture);
                $cvMedia->setPath($cvPicture);
                $candidate->setCv($cvMedia);
            }

            // gerer le createdAt, updatedAt, deletedAt à null
            if($candidate->getDateCreated() === null){
            $candidate->setDateCreated(new DateTimeImmutable());
            }

            if($candidate->getDateDeleted() === null){
                $candidate->setDateDeleted(new DateTimeImmutable());
                }
            

            $candidate->setDateUpdated(new DateTimeImmutable());

            $entityManager->persist($profileMedia);
            $entityManager->persist($passportMedia);
            $entityManager->persist($cvMedia);
            
            $entityManager->persist($candidate);
            $entityManager->flush();


        }

        return $this->render('profile/index.html.twig', [
            'formCandidate' => $form->createView(),
            'candidate' => $candidate
        ]);
    }
}
