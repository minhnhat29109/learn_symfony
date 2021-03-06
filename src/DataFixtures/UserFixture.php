<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\Article;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('user'.$i.'@gmail.com');
            $user->setFirstName('nhat'.$i);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'minhnhat2910'));
            $user->setRoles(['ROLE_USER']);
            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);

            $task = new Task();
            $task->setName('aloalo')
                ->setContent('aloalo')
                ->setAuthor($user);
            $manager->persist($task);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);
            $manager->persist($user);
        }


        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('admin'.$i.'@gmail.com');
            $user->setFirstName('admin'.$i);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'minhnhat2910'));
            $user->setRoles(['ROLE_ADMIN']);
            $manager->persist($user);
        }
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('adminarticle'.$i.'@gmail.com');
            $user->setFirstName('nhat'.$i);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'minhnhat2910'));
            $user->setRoles(['ROLE_ADMIN_ARTICLE']);
            $manager->persist($user);
        }


        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('adminnews'.$i.'@gmail.com');
            $user->setFirstName('admin'.$i);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'minhnhat2910'));
            $user->setRoles(['ROLE_ADMIN_NEWS']);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
