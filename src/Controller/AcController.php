<?php

namespace App\Controller;

use App\Entity\Ac;
use App\Form\AcType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AcController extends AbstractController
{
    #[Route('/ac', name: 'app_ac')]
    public function index(): Response
    {
        return $this->render('ac/index.html.twig', [
            'controller_name' => 'AcController',
        ]);
    }
    #[Route('/ac/ajouteac', name: 'app_ajouteac')]
    public function ajouterp(EntityManagerInterface $entityManager,Request $request,UserPasswordHasherInterface $userPasswordHasher): Response
    {

        $ac = new Ac();
        $form = $this->createForm(AcType::class, $ac);
        $form -> handleRequest($request);
        if ( $form-> isSubmitted() && $form->isValid()){
            $pass = "passer123";
            $pasword = $userPasswordHasher->hashPassword($ac, $pass );
            $ac->setPassword($pasword);
            $ac->setRoles(['ROLE_AC']);
        $entityManager->persist($ac);
        $entityManager->flush();
        $this->redirectToRoute('app_ac');
        }


        return $this->render('ac/ajouteac.html.twig', [
            'form' => $form->createView()
        ]);
    }



}
