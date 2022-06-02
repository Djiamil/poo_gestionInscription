<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Repository\DemandeRepository;
use Knp\Component\Pager\PaginatorInterface;
// use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeController extends AbstractController
{
    #[Route('/demande', name: 'app_demande')]
    public function index(DemandeRepository $repo, PaginatorInterface $paginator,Request $request): Response

    {
        $demande = $repo->findAll();
        $properties = $paginator->paginate(
        $demande,
        $request->query->getInt('page', 1), 
        12
    );
        return $this->render('demande/index.html.twig', 
        [
            "demandes" => $properties
        ]);
    }
}
