<?php
namespace Matthew\WallPostBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{

    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()
            ->getStatusCode());
    }

    public function testForm()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/create', [
            'wallpost[title]' => 'Some Valid Title',
            'wallpost[author]' => 'Matthew',
            'wallpost[body]' => 'Body context'
        ]);

        $this->assertEquals(302, $client->getResponse()
            ->getStatusCode());
    }

    public function testCreateActionWithFailingValidation()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/create', [
            'wallpost[title]' => 'Invalid',
            'wallpost[author]' => null,
            'wallpost[body]' => 'Body context'
        ]);

        $this->assertEquals(302, $client->getResponse()
            ->getStatusCode());
    }
}
