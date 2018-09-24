<?php
namespace App\Command;

use App\Repository\CityRepository;
use App\Service\HttpService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReportingDataCommand extends Command
{
    private $httpService;
    private $cityRepository;

    public function __construct(HttpService $httpService, CityRepository $cityRepository)
    {
        $this->httpService = $httpService;
        $this->cityRepository = $cityRepository;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:get-data')

            // the short description shown while running "php bin/console list"
            ->setDescription('Get reporting data')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to get reporting data...')

            ->addArgument('country', InputArgument::OPTIONAL, 'country')
            ->addArgument('city', InputArgument::OPTIONAL, 'city')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'PERSIST REPORTING DATA',
            '======================',
            '',
        ]);

        $city = $input->getArgument('city');
        $country = $input->getArgument('country');

        if(empty($city) === false && empty($country) === false) {
            // retrieve the argument value using getArgument()
            $output->writeln('City: ' . $city);
            // retrieve the argument value using getArgument()
            $output->writeln('Country: ' . $country);

            $this->httpService->setApiUrl($country, $city);
        }

        $this->httpService->getReportingData();
        $response = $this->httpService->createDataTransferObjects();
        foreach ($response as $object) {
            $this->cityRepository->create($object);
        }

        // outputs a message followed by a "\n"
        $output->writeln('The data has been successfully inserted!');
    }
}