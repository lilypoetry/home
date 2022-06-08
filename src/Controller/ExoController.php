<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExoController extends AbstractController
{
    #[Route('/ma/nouvelle/page', name: 'app_exo')]
    public function index(): Response
    {
        return $this->render('exo/index.html.twig', [
            'number_rand' => random_int(1, 5)
        ]);
    }

    
    #[Route('/image/{id}', name: 'app_image', requirements: ['id' => '\d+'])]
    public function image(int $id): Response
    {
        $pictures = [
            1 => 'bateau.jpg',
            2 => 'lotus.jpg',
            3 => 'sea.jpg'
        ];

        // Attribue une valeur par défaut à ma variable
        $image = 'notfound.jpg';

        if (array_key_exists($id, $pictures)) {
            // ... on extrait la valeur du tableau et on ecrase la valeur
            // de la variable "$image" par celle-ci
            $image = $pictures[$id];
        }

        return $this->render('exo/image.html.twig', [
            'image' => $image
        ]);
    }

}
