<?php

namespace App\Controller;

use App\Form\AuthorFormType;
use App\Repository\ArticleRepository;
use DateTime;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
use App\Entity\Author;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'article' => $articleRepository->find(4),
            'post' => $articleRepository->findOneBy(['title' => 'Titre_7'], ['created_at' => 'DESC']),
            'posts' =>$articleRepository->findBy(['created_at' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-06-08 08:24:33')]),
            'results' => $articleRepository->findByTitleOrDescription('Titre_122', 'Description_2')
        ]);
    }

    #[Route('/article/relation', name: 'app_article_relation')]
    public function relations(AuthorRepository $authorRepository): Response
    {
        return $this->render('article/relations.html.twig', [
            'authors' => $authorRepository->findAll()
        ]);
    }

    // Création une route
    #[Route('/author/new', 'author_new')]
    public function newAuthor(Request $request, AuthorRepository $authorRepository): Response
    {
        // Déclare un objet vide dépendant de l'entité "Author"
        $author = new Author();
        // dump($author);

        //Crée le formulaire
        $form = $this->createForm(AuthorFormType::class, $author);

        // Remplis l'objet "$author" des données du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dump($author);
            $authorRepository->add($author, true);

            // Flash message success
            $this->addFlash('success', 'Votre auteur à bien été enregistré !');

            // Ecraser l'ancien formulaire
            $author = new Author();
            $this->createForm(AuthorFormType::class, $author);
        }

        return $this->render('home/newAuthor.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

/**
 * Pour afficher author dans l'index, simplement ajouter 
 * 'authors' => $authorRepository->findAll() dans le tableau render(,[...])
 * ajoute 'AuthorRepository $authorRepository' après ArticleRepository $articleRepository
 */