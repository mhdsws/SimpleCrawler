<?php 
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AppBundle\Service\CrawlerService;
use Symfony\Component\Console\Helper\Table;

class CrawlCommand extends Command
{
    
    private $Crawler;

    public function __construct(CrawlerService $Crawler)
    {
        $this->Crawler = $Crawler;
        parent::__construct();
    }

    protected function configure()
    {
        $this
        ->setName('app:crawl')
        ->setDescription('Crawl a web page.')
        ->setHelp('This command allows you to crawl a web page...')
        ->addArgument('page_url', InputArgument::REQUIRED, 'The URL of the crawled page.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Crawling page',
            $input->getArgument('page_url'),
            '============',
            '',
        ]);
        $page_result = $this->Crawler->sendCrawler($input->getArgument('page_url'));
        //$table = new Table($output);
        //$table->render();
        foreach($page_result as $item) {
                $output->writeln($item->getText());
        }       
    }
}
?>