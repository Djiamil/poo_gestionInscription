<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $repository, Request $request,PaginatorInterface $paginator): Response
    {
        $module = $repository->findAll();
        $repo =$paginator->paginate(
            $module,
            $request->query->getInt('page',1),
            6
        );
        return $this->render('module/index.html.twig', [
            'title' => "Liste des modules",
            'modules' => $repo
        ]);
    }

    #[Route('/module/ajoutermodule', name: 'app_moduleajouter')]
    public function ajoutermodule(EntityManagerInterface $entityManager,Request $request): Response
    {
        $module = New Module();
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($module);
            $entityManager->flush();
            return $this->redirectToRoute('app_module');
        }
        return $this->render('module/ajoutermodule.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}
