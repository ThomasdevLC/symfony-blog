<?php

namespace App\Tests\Form;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        $formData = [
            'nom' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $model = new Contact();
        $form = $this->factory->create(ContactType::class, $model);

        $expected = new Contact();
        $expected->setNom($formData['nom']);
        $expected->setEmail($formData['email']);
        $expected->setMessage($formData['message']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $model);

    }

    public function testFormView(): void
    {
        $form = $this->factory->create(ContactType::class);

        $view = $form->createView();
        $children = $view->children;

        $this->assertArrayHasKey('nom', $children);
        $this->assertArrayHasKey('email', $children);
        $this->assertArrayHasKey('message', $children);
        $this->assertArrayHasKey('envoyer', $children);
    }

    public function testGetId(): void
    {
        $contact = new Contact();
        $this->assertNull($contact->getId());
    }

    public function testCreatedAt(): void
    {
        $contact = new Contact();
        $date = new \DateTime();
        $contact->setCreatedAt($date);
        $this->assertEquals($date, $contact->getCreatedAt());
    }

    public function testIsSent(): void
    {
        $contact = new Contact();
        $contact->setIsSent(true);
        $this->assertTrue($contact->isSent());
    }
}
