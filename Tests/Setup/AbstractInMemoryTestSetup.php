<?php

namespace Craffft\ContaoOAuth2Bundle\Tests\Setup;

use Craffft\ContaoOAuth2Bundle\Tests\DataFixtures\ORM\LoadMemberData;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\DependencyInjection\Container;

abstract class AbstractInMemoryTestSetup extends WebTestCase
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Application
     */
    protected static $application;

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();

        // Clean-Up
        self::runCommand(
            new ArrayInput(
                array(
                    'command'   => 'doctrine:database:drop',
                    '--env'     => 'test',
                    '--force'   => true
                )
            )
        );

        self::runCommand(
            new ArrayInput(
                array(
                    'command'   => 'doctrine:database:create',
                    '--env'     => 'test',
                )
            )
        );

        // Update InMemory-Schema based on the mapping information of the entities
        self::runCommand(
            new ArrayInput(
                array(
                    'command'   => 'doctrine:schema:update',
                    '--env'     => 'test',
                    '--force'   => true
                )
            )
        );

        $this->container = static::$kernel->getContainer();
        $this->em = $this->container
            ->get('doctrine')
            ->getManager();

        // Load MemberData fixture
        $memberDataFixture = new LoadMemberData();
        $memberDataFixture->setContainer($this->container);
        $memberDataFixture->load($this->em);
    }

    /**
     * @param $command
     * @return int
     * @throws \Exception
     */
    protected static function runCommand($command)
    {
        return self::getApplication()->run($command);
    }

    /**
     * @return Application
     */
    protected static function getApplication()
    {
        if (null === self::$application) {
            $client = static::createClient();

            self::$application = new Application($client->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->em->getConnection()->close();

        parent::tearDown();
    }
}
