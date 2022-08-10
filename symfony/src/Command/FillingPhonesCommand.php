<?php

namespace App\Command;

use App\Entity\Manufacturer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\Phone\PhoneService;
use Doctrine\ORM\EntityManagerInterface;

class FillingPhonesCommand extends Command
{
    protected PhoneService $phoneService;
    protected ManufacturerService $manufacturerService;
    protected EntityManagerInterface $entityManager;
    /**
     * @param PhoneService $phoneService
     */
    public function __construct(PhoneService $phoneService, EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->phoneService = $phoneService;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setName('fill-phones')
             ->setDescription('Fill phones for manufacturer.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->phoneService->dropAllPhones();

        $manufacturers = $this->entityManager->getRepository(Manufacturer::class)->findAll();
        $model = 'Xuion';
        $ramOptions = [4,8,12,16];

        foreach($manufacturers as $manufacturer)
        {
            $output->writeln('Добавляем телефоны для производителя '.$manufacturer->getName());
            for($i = 0; $i < 10; $i++)
            {
                $ram = $ramOptions[array_rand($ramOptions)];
                $modelPrefix = $model.'_'.$i;
                $phoneSpecs = ['ram' => $ram, 'model' => $modelPrefix];

                $phone = $this->phoneService->addPhone($manufacturer, $phoneSpecs);

                $output->writeln('Добавлен телефон модели: '.$phone->getModel());
            }
        }
        return COMMAND::SUCCESS;
    }
}
