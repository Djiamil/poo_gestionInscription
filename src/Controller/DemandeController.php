<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
// use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeController extends AbstractController
{
    #[Route('/demande', name: 'app_demande')]
    public function index(DemandeRepository $repo, PaginatorInterface $paginator,Request $request): Response

    {
        // $repo = $this->getDoctrine->getRepository(Demande::class);
        $demande = $repo->findAll();
        $properties = $paginator->paginate(
        $demande,
        $request->query->getInt('page', 1), 
        12
    );
        return $this->render('demande/index.html.twig', 
        [
            "demandes" => $properties,
            'titre' => "Listes des demandes"
        ]);
    }

    #[Route('/demande/ajout', name: 'app_demande_ajout')]
    public function ajout(EntityManagerInterface $entityManager,Request $request): Response
    {
        $demande = new Demande();
        $form = $this->createForm(DemandeType::class, $demande);
        $form -> handleRequest($request);
        if ( $form-> isSubmitted() && $form->isValid()){
            $entityManager->persist($demande);
            $entityManager->flush();
            $this ->redirectToRoute('app_demande');
        }
      return $this->render('demande/ajouter.html.twig',[
          'form' => $form->createView() 
      ]);
    }




}
