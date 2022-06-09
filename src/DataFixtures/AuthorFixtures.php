<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Boucle for() pour insérer un certains nombre de données
        for($i = 0; $i < 20; $i++) {

            // Instancé l'entité avec laquelle travailler
            $author = new Author();
            $author->setName("Name_$i");

            $this->addReference("author_$i", $author);
            
            $manager->persist($author);
        }

        $manager->flush();
    }
}
