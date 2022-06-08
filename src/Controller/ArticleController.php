<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use DateTime;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'article' => $articleRepository->find(4),
            'post' => $articleRepository->findOneBy(['title' => 'Titre_7'], ['created_at' => 'DESC']),
            'posts' =>$articleRepository->findBy(['created_at' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-06-08 08:24:33')])
        ]);
    }
}
