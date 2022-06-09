<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use DateTime;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;

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
}

/**
 * Pour afficher author dans l'index, simplement ajouter 
 * 'authors' => $authorRepository->findAll() dans le tableau render(,[...])
 * ajoute 'AuthorRepository $authorRepository' après ArticleRepository $articleRepository
 */