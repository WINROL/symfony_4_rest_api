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
        $this->loadLottery($manager);

        /**
         * @todo сделать загрузку данных для остальных таблиц
         */
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    protected function loadLottery(ObjectManager $manager)
    {
        for ($i = 1; $i < 10; $i++) {
            $lottery = new Lottery();
            $lottery->setEntryPrice(random_int(1, 5));

            $s1 = random_int(1, 2) === 2 ? '-' : '+';
            $s2 = random_int(1, 2) === 2 ? '-' : '+';

            $days1 = random_int(1, 100);
            $days2 = random_int(1, 100);

            $dateStart = (new \DateTime())->modify("{$s1} {$days1} days");
            $dateEnd = (new \DateTime())->modify("{$s2} {$days2} days");
            if ($dateEnd < $dateStart) {
                $dateEnd->modify('+ 101 day');
            }
            $lottery->setStartDate($dateStart);
            $lottery->setEndDate($dateEnd);

            $manager->persist($lottery);
        }

        $manager->flush();
    }
}