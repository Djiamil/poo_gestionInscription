<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use App\Entity\AnneeScolaire;
use App\Form\InscriptionType;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnneeScolaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantController extends AbstractController
{
    
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(EtudiantRepository $repo, PaginatorInterface $paginator,Request $request): Response
    {
        $etudiant=$repo->findAll();
        $repository = $paginator->paginate(
            $etudiant,
            $request->query->getInt('page', 1),
            6
        );
       
        return $this->render('etudiant/index.html.twig', [
            // 'controller_name' => 'EtudiantController',
            'etudiants' => $repository,
            'titre'=>"LISTE DES ETUDIANTS"
        ]);
    }

    #[Route('etudiant/afficher/{id<[0-9]+>}', name: 'app_afficher')]
    public function afficher(Etudiant $etudiant): Response
    {  
        return $this->render('etudiant/afficher.html.twig',[
            'etudiant' => $etudiant    
        ]);
    }

    #[Route('etudiant{id<[0-9]+>}', name: 'app_supprimer')]
    public function supprimer(EtudiantRepository $repo, Etudiant $etudiant, Request $request): Response
    {  
        // $q = $qb->update('app_Offer', 'o')
        $repo -> remove($etudiant,true);
        $repo->flush();
        return $this->redirectToRoute('app_etudiant');
}


#[Route('etudiant/edith{id<[0-9]+>}', name: 'app_edith')]

public function edith(EtudiantRepository $repo, Etudiant $etudiant, int $id): Response
{  
    $etudiant=$repo->find($id);
    

    return $this->render ('etudiant/idith.html.twig',[
        'etud' =>$etudiant,
        'titre' =>"Etudiant a modifier"
    ]);
}

#[Route('etudiant/inscription', name: 'appapp_inscription')]
public function inscription(EntityManagerInterface $entityManager,Request $request){
   
    $inscription = new Inscription();
    $form = $this->createForm(InscriptionType::class, $inscription);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
        $date = new \DateTime;
        $inscription->setDate($date);
        $inscription->setAc($this->getUser());
        $entityManager->persist($inscription);
        $entityManager->flush();
        return $this->redirectToRoute('app_etudiant');
    }

    return $this->render('etudiant/inscrition.html.twig',[
        'form' => $form->createView()
    ]);


}


}
