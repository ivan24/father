<?php
namespace Perga\ProductBundle\Command;

use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Perga\ProductBundle\Entity\Currency;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand as Command;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints\DateTime;

class UpdateCurrencyCommand extends Command
{
    protected $curAbbs = array(
        "RUB",
        "USD",
        "EUR"
    );

    protected function configure()
    {
        $this
            ->setName('perga:update:currency')
            ->setDescription('Update currency table ')
            ->setHelp(
                <<<EOT
            The <info>perga:update:currency</info> command update table currency
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln('<info>Start. Create Soap Client!</info>');
            $client = new \SoapClient("http://www.nbrb.by/Services/ExRates.asmx?wsdl");
            $date = new \DateTime();
            $output->writeln('<info>Processing Data</info>');
            $serverData = $client->ExRatesDaily(array('onDate' => $date->format('Y-m-d')));
            $xml = new \SimpleXMLElement($serverData->ExRatesDailyResult->any);
            $query = '';
            foreach ($this->curAbbs as $abbreviation) {
                $query .= sprintf('Cur_Abbreviation="%s" or ', $abbreviation);
            }
            $query = rtrim($query, " or ");
            $result = $xml->xpath("NewDataSet/DailyExRatesOnDate[{$query}]");

            $doctrine = $this->getContainer()->get('doctrine');
            $em = $doctrine->getManager();

            /** @var  $curEntity  \Perga\ProductBundle\Entity\Currency */
            $curEntity = $em->getRepository('PergaProductBundle:Currency');

            foreach ($result as $obj) {
                $currency = $curEntity->findOneByCode($obj->Cur_Code);
                if (!$currency) {
                    $currency = new Currency();
                }
                $currency->setAbbr($obj->Cur_Abbreviation);
                $currency->setCode($obj->Cur_Code);
                $currency->setRate($obj->Cur_OfficialRate);
                $em->persist($currency);
            }
            $em->flush();
            $output->writeln('<info>Currency update successfull</info>');

        } catch (\SoapFault  $e) {
            $output->writeln(sprintf("<error>%s</error>", $e->getMessage()));
            return;
        } catch (\Exception $e) {
            $output->writeln(sprintf("<error>%s</error>", $e->getMessage()));
            return;
        }

    }
} 