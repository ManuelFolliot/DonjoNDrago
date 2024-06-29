<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class FonctionnalTest extends WebTestCase
{
    public function testCreateUser(): void
    {
        $client = static::createClient();
        $client->request('GET', '/user/new');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'DONJ\'O & DRAG\'O');
    }

    public function testCreateHero(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('monty79@douglas.net');
        $client->loginUser($testUser);
        $client->request('GET', '/hero/new');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'DONJ\'O & DRAG\'O');
    }

    public function testCreateCampaign(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('bernie94@gmail.com');
        $client->loginUser($testUser);
        $client->request('GET', '/campaign/new');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'DONJ\'O & DRAG\'O');
    }
}
