<?php
/**
 * Created by PhpStorm.
 * User: smykruslanal
 * Date: 31.07.2018
 * Time: 17:01
 */

namespace App\DataFixtures;

use App\Entity\Lottery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadData extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 10; $i++) {
            $lottery = new Lottery();
            $lottery->setEntryPrice(random_int(100, 1000));

            $s1 = random_int(1, 2) === 2 ? '-' : '+';
            $s2 = random_int(1, 2) === 2 ? '-' : '+';

            $days1 = random_int(1, 100);
            $days2 = random_int(1, 100);
            $lottery->setStartDate((new \DateTime())->modify("{$s1} {$days1} days"));
            $lottery->setEndDate((new \DateTime())->modify("{$s2} {$days2} days"));

            $manager->persist($lottery);
        }

        $manager->flush();
    }
}