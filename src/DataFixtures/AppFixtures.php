<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\UserPassportInterface;

class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUser($manager);
        $this->loadBlogPosts($manager);
    }

    public function loadBlogPosts(ObjectManager $manager)
    {

        $user = $this->getReference('user_admin');

        for ($i = 0; $i <= 20; $i++) {
            $post = new BlogPost();
            $post->setTitle("Titre " . $i);
            $post->setPublished(new \DateTime());
            $post->setContent("Contenu " . $i);
            $post->setAuthor($user);
            $post->setSlug("Slug-" . $i);
            $manager->persist($post);
        }

        $manager->flush();
    }

    public function loadComments(ObjectManager $manager)
    {

    }

    public function loadUser(ObjectManager $manager)
    {

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.com');
        $user->setName('admin');

        $user->setPassword($this->passwordEncoder->encodePassword($user, 'secret1234'));

        $this->addReference('user_admin', $user);

        $manager->persist($user);
        $manager->flush();
    }
}
