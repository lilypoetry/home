<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    // Démande requirement 'id' en entier '\d+', $id=0 valeur par default
    #[Route('/home/{id}/{prenom}', name: 'app_home', requirements: ['id'=>'\d+'])]
    public function index(int $id = 0, string $prenom = null): Response
    {
        return $this->render('home/index.html.twig', [
            'id' => $id,
            'prenom' => $prenom
        ]);
    }

    #[Route('/', name: 'accueil')]
    public function accueil(): Response
    {
        // Code à exécuter
        $variable = 'test';
        $brouette = 'brouette';

        $users = [
            'John', 'Johnny', 'Jonas', 'Jean'
        ];

        dump($users); // Affiche dans la barre de debug
        // dd($users); // Affiche et arrête le code

        // Dernière position
        // JAMAIS RIEN EN DESSOUS
        return $this->render('home/accueil.html.twig', [
            'variable' => $variable,
            'brouette' => $brouette,
            'age' => 40,
            'users' => $users
        ]);
    }

    #[Route('/vars', name: 'vars')]
    #[IsGranted('ROLE_USER')] // pour proteger les access
    public function vars(Request $request): Response
    {
        // $nom = $_GET
        $nom = $request->query->get('nom');
        // dd($nom);

        return $this->render('home/render.html.twig', [
            'nom' => $nom
        ]);
    }
}


