<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MatchTimelineTest extends WebTestCase
{
  public function testcheckIfGetKey()
  {
    $client = static::createClient();
    $client->request('GET', '/game/timeline/EUW1_6143457528');
    $this->assertSame(200, $client->getResponse()->getStatusCode());
    // $this->assertArrayHasKey('matchID', json_decode($client->getResponse()->getContent(), true));
  }
}
