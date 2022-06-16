<?php

namespace App\Controller;

use App\Entity\Rp;
use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\RpRepository;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $repository,PaginatorInterface $paginator,Request $request): Response
    {
        $classe = $repository->findAll();
        $repo = $paginator->paginate(
            $classe,
            $request->query->getInt('page',1),
            6
        );
        return $this->render('classe/index.html.twig', [
            'classes' =>$repo,
            'titre' =>"Liste des Classes"
        ]);
    }


    #[Route('/classe/ajouteclass', name: 'app_ajouteclass')]
    public function ajouterp(EntityManagerInterface $entityManager,Request $request,RpRepository $rprepository): Response
    {

        $classe = new Classe();
        $rp = $rprepository->findAll();
        $form = $this->createForm(ClasseType::class, $classe);
        $form -> handleRequest($request);
        if ( $form-> isSubmitted() && $form->isValid()){
        $rp = $rprepository->find($request->get('lesrp'));
        $classe ->setRp($rp);
        $entityManager->persist($classe);
        $entityManager->flush();
        $this->redirectToRoute('app_classe');
        }


        return $this->render('classe/ajouteclasse.html.twig', [
            'form' => $form->createView(),
            'rps' =>$rp
        ]);
    }
}
