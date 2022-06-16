<?php

namespace App\Controller;

use App\Entity\Rp;
use App\Form\RpType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RpController extends AbstractController
{
    #[Route('/rp', name: 'app_rp')]
    public function index(): Response
    {
        return $this->render('rp/index.html.twig', [
            'controller_name' => 'RpController',
        ]);
    }

    #[Route('/rp/ajouterp', name: 'app_ajouterp')]
    public function ajouterp(EntityManagerInterface $entityManager,Request $request,UserPasswordHasherInterface $userPasswordHasher): Response
    {

        $rp = new Rp();
        $form = $this->createForm(RpType::class, $rp);
        $form -> handleRequest($request);
        if ( $form-> isSubmitted() && $form->isValid()){
            $pass = "passer123";
            $pasword = $userPasswordHasher->hashPassword($rp, $pass );
            $rp->setPassword($pasword);
            $rp->setRoles(['ROLE_RP']);
        $entityManager->persist($rp);
        $entityManager->flush();
        $this->redirectToRoute('app_rp');
        }


        return $this->render('rp/ajouterp.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
