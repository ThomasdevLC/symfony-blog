<?php

namespace App\EventSubscriber;

use App\Entity\Blogpost;
use App\Entity\Peinture;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDateAndUser']
        ];
    }
public function setDateAndUser(BeforeEntityPersistedEvent $event): void
{
    $entity = $event->getEntityInstance();


    if (!($entity instanceof Blogpost)) {
        $now = new \DateTime('now');
        $entity->setCreatedAt($now);

        $user = $this->security->getUser();
        $entity->setUser($user);
    }

    if($entity instanceof Peinture){
        $now = new \DateTime('now');
        $entity->setCreatedAt($now);

        $user = $this->security->getUser();
        $entity->setUser($user);
    }

    return;

}

}