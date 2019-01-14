<?php

namespace Commands;

use Bootstrap\Events\Dispatcher;
use Illuminate\Queue\Capsule\Manager as Queue;
use Predis\Client;
use Simpleue\Queue\RedisQueue;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportCommand
 *
 * Manages database migrations
 *
 * @package Commands
 */
class ImportCommand extends Command
{
    /**
     *  Command configuration
     *
     */
    protected function configure()
    {
        $this->setName('import');
    }

    /**
     * Command execution
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Contacts import started.');

        $dispatcher = new Dispatcher();
        $dispatcher->fire(new \HyveMobileTest\Events\ImportContactsEvent);

        $output->writeln('Contacts import completed.');
    }
}
