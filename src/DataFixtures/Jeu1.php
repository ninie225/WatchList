<?php

namespace App\DataFixtures;

use App\Entity\Film;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Jeu1 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $film1 = new Film();
        $film1->setTitle("Le Parrain");
        $film1->setFilmmaker("Francis Ford Coppola");
        $film1->setYear(1972);
        $film1->setIsWatched(false);
        $film1->setPicture("leparrain.jpg");
        $manager->persist($film1);

        $film2 = new Film();
        $film2->setTitle("The Dark Knight");
        $film2->setFilmmaker("Christopher Nolan");
        $film2->setYear(2008);
        $film2->setIsWatched(false);
        $film2->setPicture("thedarkknight.jpg");
        $manager->persist($film2);

        $film3 = new Film();
        $film3->setTitle("La liste de Schindler");
        $film3->setFilmmaker("Steven Spielberg");
        $film3->setYear(1993);
        $film3->setIsWatched(false);
        $film3->setPicture("lalistedeschindler.jpg");
        $manager->persist($film3);

        $film4 = new Film();
        $film4->setTitle("Pulp fiction");
        $film4->setFilmmaker("Quentin Tarantino");
        $film4->setYear(1994);
        $film4->setIsWatched(false);
        $film4->setPicture("pulpfiction.jpg");
        $manager->persist($film4);

        $manager->flush();
    }
}
