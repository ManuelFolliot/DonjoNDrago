<?php

namespace App\Test\Controller;

use App\Entity\Race;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RaceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/race/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('bernie94@gmail.com');
        $this->client->loginUser($testUser);
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Race::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Gestion des races de heros');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'race[name]' => 'Testing',
            'race[description]' => 'Testing',
            'race[strengthModifier]' => 'Testing',
            'race[dexterityModifier]' => 'Testing',
            'race[enduranceModifier]' => 'Testing',
            'race[intelligenceModifier]' => 'Testing',
            'race[wisdomModifier]' => 'Testing',
            'race[charismaModifier]' => 'Testing',
            'race[raceUrl]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Race();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStrengthModifier('My Title');
        $fixture->setDexterityModifier('My Title');
        $fixture->setEnduranceModifier('My Title');
        $fixture->setIntelligenceModifier('My Title');
        $fixture->setWisdomModifier('My Title');
        $fixture->setCharismaModifier('My Title');
        $fixture->setRaceUrl('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Race');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Race();
        $fixture->setName('Value');
        $fixture->setDescription('Value');
        $fixture->setStrengthModifier('Value');
        $fixture->setDexterityModifier('Value');
        $fixture->setEnduranceModifier('Value');
        $fixture->setIntelligenceModifier('Value');
        $fixture->setWisdomModifier('Value');
        $fixture->setCharismaModifier('Value');
        $fixture->setRaceUrl('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'race[name]' => 'Something New',
            'race[description]' => 'Something New',
            'race[strengthModifier]' => 'Something New',
            'race[dexterityModifier]' => 'Something New',
            'race[enduranceModifier]' => 'Something New',
            'race[intelligenceModifier]' => 'Something New',
            'race[wisdomModifier]' => 'Something New',
            'race[charismaModifier]' => 'Something New',
            'race[raceUrl]' => 'Something New',
        ]);

        self::assertResponseRedirects('/race/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getStrengthModifier());
        self::assertSame('Something New', $fixture[0]->getDexterityModifier());
        self::assertSame('Something New', $fixture[0]->getEnduranceModifier());
        self::assertSame('Something New', $fixture[0]->getIntelligenceModifier());
        self::assertSame('Something New', $fixture[0]->getWisdomModifier());
        self::assertSame('Something New', $fixture[0]->getCharismaModifier());
        self::assertSame('Something New', $fixture[0]->getRaceUrl());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Race();
        $fixture->setName('Value');
        $fixture->setDescription('Value');
        $fixture->setStrengthModifier('Value');
        $fixture->setDexterityModifier('Value');
        $fixture->setEnduranceModifier('Value');
        $fixture->setIntelligenceModifier('Value');
        $fixture->setWisdomModifier('Value');
        $fixture->setCharismaModifier('Value');
        $fixture->setRaceUrl('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/race/');
        self::assertSame(0, $this->repository->count([]));
    }
}
