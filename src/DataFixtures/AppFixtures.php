<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 20; $i++) {
            $post = new BlogPost();
            $post->setTitle("Titre " . $i);
            $post->setPublished(new \DateTime());
            $post->setContent("Contenu " . $i);
            $post->setAuthor("Auteur " . $i);
            $post->setSlug("Slug-" . $i);
            $manager->persist($post);
        }

        $manager->flush();
    }
}
