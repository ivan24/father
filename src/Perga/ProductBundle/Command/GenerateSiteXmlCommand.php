<?php
/**
 * @author Ivan Oreshkov ivan.oreshkov@itstartuplabs.com
 */

namespace Perga\ProductBundle\Command;

use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand as Command;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints\DateTime;

class GenerateSiteXmlCommand extends Command
{
    const SITEMAP_TEMPLATE = 'PergaProductBundle::sitemap.xml.twig';

    protected function configure()
    {
        $this
            ->setName('perga:generate:sitemapxml')
            ->setDescription('Generate sitemap file')
            ->setDefinition(array(
                new InputArgument('target', InputArgument::OPTIONAL, 'The target directory', 'web'),
            ))
            ->addOption(
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force rewrite the existing file')
            ->setHelp(
                <<<EOT
            The <info>perga:generate:sitemapxml</info> command helps you generates sitemaps.xml
        If you want to rebuild sitemap.xml, use <comment> --force</comment> or <comment> -f</comment> option
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Generate started');
        $targetArg = rtrim($input->getArgument('target'), '/');

        if (!is_dir($targetArg)) {
            throw new \InvalidArgumentException(sprintf('The target directory "%s" does not exist.', $input->getArgument('target')));
        }
        $fs = new Filesystem();
        $filePath = $targetArg . "/sitemap.xml";
        /** @var $twig \Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine */
        $twig = $this->getContainer()->get('templating');
        /** @var $router \Symfony\Bundle\FrameworkBundle\Routing\Router */
        $router = $this->getContainer()->get('router');

        if (!$input->getOption('force') && $fs->exists($filePath)) {
            $output->writeln('File exist. Skipped.');
            return;
        }

        if ($input->getOption('force') && $fs->exists($filePath)) {
            $output->writeln('Rewrite existing file.');
        }
        $routeCollection = $router->getRouteCollection();
        $items = array();
        $date = new \DateTime();
        $lastMod = $date->format('Y-m-d');
        $domain = $this->getContainer()->getParameter('domain');

        foreach ($routeCollection as $routeName => $route) {
            if($route->getOption('sitemap')) {
                $items[] = array(
                    'loc' => str_replace(
                        'localhost',
                        $domain,
                        $router->generate(
                            $routeName,
                            array(),
                            true
                        )
                    ),
                    'lastmod' => $lastMod,
                );
            }

        }
        $content = $twig->render(self::SITEMAP_TEMPLATE, array('items' => $items));
        $fs->dumpFile($filePath, $content, 0444);
        $output->writeln("<info>sitemap.xml successfully created</info>");
    }
} 