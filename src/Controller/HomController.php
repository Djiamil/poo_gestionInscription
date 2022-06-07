<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomController extends AbstractController
{
    #[Route('/', name: 'app_hom')]
    public function index(): Response
    {
        return $this->render('hom/index.html.twig', [
           'titre' => "Bienvenu a la page d'accuil"
        ]);
    }
}
