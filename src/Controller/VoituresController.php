<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VoitureRepository;
use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VoitureType;
use Symfony\Component\HttpFoundation\Request;

class VoituresController extends AbstractController
{

    public function __construct(
        private VoitureRepository $voitureRepository,
        private EntityManagerInterface $entityManager,
    )
    {

    }

    /**
     * Page d'accueil, listant les voitures
     */
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $voitures = $this->voitureRepository->findAll();

        return $this->render('accueil.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    /**
     * Création d'une voiture
     */
    #[Route('/voiture/ajouter', name: 'app_car_add')]
    public function ajouterVoiture(Request $request): Response
    {
        $voiture = new Voiture();

        $form = $this->createForm(VoitureType::class, $voiture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $voiture = $form->getData();

            $this->entityManager->persist($voiture);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_car', ['id' => $voiture->getId()]);
        }

        return $this->render('nouvelle-voiture.html.twig', [
            'form' => $form->createView(), // Sur Symfony 6.2 et plus, 'form' => $form suffit.
        ]);
    }

    /**
     * Page de détail d'une voiture
     */
    #[Route('/voiture/{id}', name: 'app_car')]
    public function voiture(int $id): Response
    {
        $voiture = $this->voitureRepository->find($id);

        if(!$voiture) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('voiture.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    /**
     * Suppression d'une voiture
     */
    #[Route('/voiture/{id}/supprimer', name: 'app_car_delete')]
    public function supprimerVoiture(int $id): Response
    {
        $voiture = $this->voitureRepository->find($id);

        if(!$voiture) {
            return $this->redirectToRoute('app_home');
        }

        $this->entityManager->remove($voiture);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}
