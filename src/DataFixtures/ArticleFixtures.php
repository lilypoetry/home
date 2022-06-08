<?php

namespace App\DataFixtures;

use App\Entity\Article;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Boucle for() pour insérer un certains nombre de données
        for($i = 0; $i < 13; $i++) {

            // Instancé l'entité avec laquelle travailler
            // $product = new Product();
            $article = new Article();
            $article->setTitle("Titre_$i");
            $article->setDescription("Description_$i");
            $article->setCreatedAt(new DateTimeImmutable());

            // Met de côté les données en attente d'insertion
            // $manager->persist($product);
            $manager->persist($article);
        }

        // Insère en BDD
        $manager->flush();
    }
}
