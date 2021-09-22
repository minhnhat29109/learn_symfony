<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    private static $articleImages = [
        'asteroid.jpeg',
        'mercury.jpeg',
        'lightspeed.png',
    ];
    public function load(ObjectManager $manager)
    {
//        for ($i = 0 ;$i < 10; $i++)
//        {
//
//
//        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UserFixture::class
        ];
    }
}
