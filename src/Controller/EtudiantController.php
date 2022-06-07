<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(EtudiantRepository $repo, PaginatorInterface $paginator,Request $request): Response
    {
        $etudiant=$repo->findAll();
        $repository = $paginator->paginate(
            $etudiant,
            $request->query->getInt('page', 1),
            12
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


}
