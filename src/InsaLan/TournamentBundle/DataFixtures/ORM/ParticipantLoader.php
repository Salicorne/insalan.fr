<?php
namespace InsaLan\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InsaLan\TournamentBundle\Entity\Player;

class ParticipantLoader extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager)
    {
        $e = new Player();
        $e->setGameName('Herpandine');
        $e->setTournament($this->getReference('tournament-1'));
        $e->setPendingTournament($this->getReference('tournament-1'));
        $e->setUser($this->getReference('user-1'));
        $e->setGameValidated(true);
        $manager->persist($e);
        $this->addReference('participant-1', $e);

        $e = new Player();
        $e->setGameName('Séssette');
        $e->setTournament($this->getReference('tournament-1'));
        $manager->persist($e);
        $this->addReference('participant-2', $e);

        $e = new Player();
        $e->setGameName('Tanche');
        $e->setTournament($this->getReference('tournament-1'));
        $manager->persist($e);
        $this->addReference('participant--1', $e);

        $e = new Player();
        $e->setGameName('Semi-Tanche');
        $e->setTournament($this->getReference('tournament-1'));
        $manager->persist($e);
        $this->addReference('participant--2', $e);

        $e = new Player();
        $e->setGameName('Rémi');
        $e->setTournament($this->getReference('tournament-1'));
        $e->setUser($this->getReference('user-2'));
        $manager->persist($e);
        $this->addReference('participant---1', $e);

        for ($i = 3; $i <= 303; ++$i) {
            $e = new Player();
            $e->setGameName('Part '.$i);
            //$e->setTournament($this->getReference('tournament-1'));
            $teamId = (int)(($i-3)/5);
            $e->joinTeam($this->getReference('team-'.$teamId));
            $manager->persist($e);
            $this->addReference('participant-'.$i, $e);
        }

        $manager->flush();
    }
}
