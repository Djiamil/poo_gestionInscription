<?php

namespace App\Controller;

use App\Form\ProfType;
use App\Entity\Professeur;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(ProfesseurRepository $repository, Request $request,PaginatorInterface $paginator): Response
    {
        $professeur = $repository->findAll();
        $repo = $paginator->paginate(
            $professeur,
            $request -> query->getInt('page',1),
            6
        );
        return $this->render('professeur/index.html.twig', [
            'professeurs' =>$repo,
            'titre' => "Liste des professeurs"
            
        ]);
    }

    #[Route('/professeur/ajouterprof', name: 'app_profajoute')]

    public function ajouterprof(EntityManagerInterface $entityManager,Request $request)
    {
        $professeur = new Professeur();
        $form = $this->createForm(ProfType::class, $professeur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($professeur);
            $entityManager->flush();
            return $this->redirectToRoute('app_professeur');
        }
        return $this->render('/professeur/ajouterprof.html.twig',[
            'form' => $form->createView()
        ]);

    }
}
