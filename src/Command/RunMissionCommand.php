<?php

namespace App\Command;

use App\Entity\Mission;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunMissionCommand extends Command
{
    protected static $defaultName = 'app:run-mission';

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        try {
            $mission = new Mission();

            $mission->createFromFile('inputfile.txt');

            foreach($mission->getRovers() as $rover)
            {
                $rover->explore($mission->getArea());

                $output->writeln(implode(' ', $rover->getLastPosition()));
            }
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }

        return 0;
    }
}