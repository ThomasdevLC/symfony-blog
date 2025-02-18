<?php

namespace App\Service;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

class ContactService
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function persistContact(Contact $contact): void
    {
        $contact->setIsSent(false);
        $contact->setCreatedAt(new \DateTime('now'));

        $this->manager->persist($contact);
        $this->manager->flush();

    }
}
