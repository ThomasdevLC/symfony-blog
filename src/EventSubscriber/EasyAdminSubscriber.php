<?php

namespace App\EventSubscriber;

use App\Entity\Blogpost;
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
            BeforeEntityPersistedEvent::class => ['setBlogPostSlugAndDateAndUser']
        ];
    }
public function setBlogPostSlugAndDateAndUser(BeforeEntityPersistedEvent $event): void
{
    $entity = $event->getEntityInstance();

    if (!($entity instanceof Blogpost)) {
        return;
    }

    $slug = $this->slugger->slug($entity->getTitre());
    $entity->setSlug($slug);

    $now = new \DateTime('now');
    $entity->setCreatedAt($now);

    $user = $this->security->getUser();
    $entity->setUser($user);
}

}