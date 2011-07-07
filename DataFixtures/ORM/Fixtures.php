<?php
namespace IMAG\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
  IMAG\NewsBundle\Entity\News,
  IMAG\NewsBundle\Entity\Status,
  IMAG\NewsBundle\Entity\Category;


class LoadFixtures implements FixtureInterface
{
  public function load($manager)
  {
    for($i=0 ; $i<5 ; $i++) {
      ${"s$i"} = new Status();
      ${"s$i"}->setLibelle("Status $i");
      ${"s$i"}->setLevel(rand(0,10));
      
      $manager->persist(${"s$i"});
      
      ${"c$i"} = new Category();
      ${"c$i"}->setLibelle("Category $i");
      ${"c$i"}->setLevel(rand(0,10));
      
      $manager->persist(${"c$i"});
    }

    for($i = 0 ; $i < 10 ; $i++) {
      ${"n$i"} = new News();
      ${"n$i"}->setTitle("Title for news : $i");
      ${"n$i"}->setBody('Donec sollicitudin sollicitudin tellus sit amet pretium. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce quis elit id risus convallis lobortis eu sit amet dui. Aenean feugiat, nisi eu pellentesque aliquet, mi nulla vehicula leo, eu rhoncus velit risus sit amet nisi. Quisque interdum quam non magna mattis eu bibendum ligula viverra? Ut ac sem lorem. Nam molestie, nunc eu congue faucibus, diam sem scelerisque velit, vitae sagittis tellus libero eu libero. In id odio eu nisi tincidunt facilisis. Proin iaculis mattis purus at gravida! Vivamus elementum feugiat aliquet. Vivamus tempus velit quis lorem pellentesque mattis. Nam nec magna leo. Vivamus vitae nisi et ante hendrerit tristique a non velit. Proin non mauris vitae nulla sodales lacinia. Integer sagittis, sapien nec rutrum sollicitudin; orci nibh vulputate nulla, quis sed.');
      ${"n$i"}->setPseudo("Pseudo $i");
      ${"n$i"}->setMail("toto$i@toto.fr");
      ${"n$i"}->setExpiredAt(new \DateTime('2020-01-01'));
      ${"n$i"}->setStatus(${'s'.rand(0,4)});
      ${"n$i"}->setCategory(${'c'.rand(0,4)});

      $manager->persist(${"n$i"});
    }
    
    $manager->flush();
  }
}