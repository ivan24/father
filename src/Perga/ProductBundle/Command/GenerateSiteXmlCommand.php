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
use Perga\ProductBundle\Entity\Product;

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

        $urls = array();
        $staticPages = array();
        $staticPages[] = $router->generate('front-page');
        $staticPages[] = $router->generate('contact');
        $domain = $this->getContainer()->getParameter('domain');
        $products = $this->getContainer()->get('doctrine')->getManager()->getRepository('PergaProductBundle:Product')->findAll();
        foreach ($staticPages as $page) {
            $urls[] = $this->generateXMLItem($page);
        }

        /**@var $product Product */
        foreach ($products as $product) {
            $urls[] = $this->generateXMLItem(
                $router->generate('product-show', array('slug' => $product->getSlug())),
                'monthly',
                '0.5'
            );
        }
        $content = $twig->render(self::SITEMAP_TEMPLATE, array('urls' => $urls, 'domain' => $domain));
        $fs->dumpFile($filePath, $content, 0444);
        $output->writeln("<info>sitemap.xml successfully created</info>");
    }

    protected function  generateXMLItem($url, $changefreq = 'monthly', $priority = '1.0')
    {
        $date = new \DateTime();
        return array(
            'loc' => $url,
            'lastmod' => $date->format('Y-m-d'),
            'changefreq' => $changefreq,
            'priority' => $priority);
    }
} 