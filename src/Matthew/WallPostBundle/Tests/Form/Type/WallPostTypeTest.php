<?php
namespace Matthew\WallPostBundle\Tests\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase;
use Matthew\WallPostBundle\Form\Type\WallPostType;
use Matthew\WallPostBundle\Entity\WallPost;

class TestedTypeTest extends TypeTestCase
{

    public function testSubmitValidData()
    {
        $formData = array(
            'title' => 'Some Valid Title',
            'author' => 'Matthew',
            'body' => 'Body context'
        );

        $type = new WallPostType();
        $form = $this->factory->create($type);

        $object = new WallPost();
        $object->setTitle($formData['title']);
        $object->setAuthor($formData['author']);
        $object->setBody($formData['body']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}