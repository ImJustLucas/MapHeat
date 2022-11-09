<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestTest extends WebTestCase
{
  public function testHomeOK()
  {
    $client = static::createClient();
    $client->request('GET', '/');
    $this->assertSame(200, $client->getResponse()->getStatusCode());
  }
}
