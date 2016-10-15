<?php

namespace Craffft\ContaoOAuth2Bundle\Tests\DataFixtures\ORM;

use Craffft\ContaoOAuth2Bundle\Entity\Member;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadMemberData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $member = $this->getDefaultMember();
        $manager->persist($member);

        $memberDisabled = $this->getDefaultMember();
        $memberDisabled->setUsername('johndoe_disabled');
        $memberDisabled->setDisable(true);
        $manager->persist($memberDisabled);

        $memberStartAvailable = $this->getDefaultMember();
        $memberStartAvailable->setUsername('johndoe_start_available');
        $memberStartAvailable->setStart(time() - 300);
        $manager->persist($memberStartAvailable);

        $memberStartRestricted = $this->getDefaultMember();
        $memberStartRestricted->setUsername('johndoe_start_restricted');
        $memberStartRestricted->setStart(time() + 300);
        $manager->persist($memberStartRestricted);

        $memberStopAvailable = $this->getDefaultMember();
        $memberStopAvailable->setUsername('johndoe_stop_available');
        $memberStopAvailable->setStop(time() + 300);
        $manager->persist($memberStopAvailable);

        $memberStopRestricted = $this->getDefaultMember();
        $memberStopRestricted->setUsername('johndoe_stop_restricted');
        $memberStopRestricted->setStop(time() - 300);
        $manager->persist($memberStopRestricted);

        $manager->flush();
    }

    /**
     * @return Member
     */
    protected function getDefaultMember()
    {
        $member = new Member();
        $member->setTstamp(710678100);
        $member->setFirstname('John');
        $member->setLastname('Doe');
        $member->setDateOfBirth(710678100);
        $member->setGender('male');
        $member->setCompany('Craffft');
        $member->setStreet('Foo Bar Street');
        $member->setPostal('12345');
        $member->setCity('Foocity');
        $member->setState('Barstate');
        $member->setCountry('de');
        $member->setPhone('01234 / 567890');
        $member->setMobile('015200000000');
        $member->setFax('01234 / 567891');
        $member->setEmail('foo@bar.com');
        $member->setWebsite('http://craffft.de');
        $member->setLanguage('de');
        $member->setGroups(array(1, 2, 3));
        $member->setLogin(true);
        $member->setUsername('johndoe');
        $member->setPassword('$2y$10$iJWuZPtdipi27EHxFreGLeDaRF2njJNHuUdtx/gAgD9P6fBWEvm8m'); // pa$$word
        $member->setAssignDir('');
        $member->setHomeDir('');
        $member->setDisable(false);
        $member->setStart('');
        $member->setStop('');
        $member->setDateAdded(710678100);
        $member->setLastLogin(710678100);
        $member->setCurrentLogin(710678100);
        $member->setLoginCount(3);
        $member->setLocked(0);
        $member->setSession(null);
        $member->setAutologin(null);
        $member->setCreatedOn(710678100);
        $member->setActivation('');

        return $member;
    }
}
