<?php

namespace Commands;

use Error;
use Illuminate\Database\Capsule\Manager as Database;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MigrationCommand
 *
 * Manages database migrations
 *
 * @package Commands
 */
class MigrationCommand extends Command
{
    /**
     * @var\Symfony\Component\Console\Input\InputInterface $input
     */
    protected $input;

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected $output;

    /**
     *  Command configuration
     *
     */
    protected function configure()
    {
        $this->setName('database')->addArgument('action', InputArgument::REQUIRED, 'Migration action (migrate/rollback).');
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
        $this->input = $input;
        $this->output = $output;

        $this->output->writeln('Performing migration');

        try {
            if ($input->getArgument('action') === 'migrate') {
                $this->migrate();
            }
            if ($input->getArgument('action') === 'rollback') {
                $this->rollback();
            }
        } catch (\Exception $exception) {
            $this->output->writeln($exception->getMessage());
        } catch (Error $error) {
            $this->output->writeln($error->getMessage());
        }

        $this->output->writeln('Migration complete');
    }

    /**
     * Run Migrations
     *
     */
    public function migrate()
    {
        Database::schema()->create('contacts', function ($table) {
            $table->integer('id')->unsigned();
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->index();
            $table->timestamp('dt_utc');
            $table->string('original_tz');
            $table->string('note')->nullable();
            $table->string('ip', 45)->nullable();
            $table->string('card_path')->nullable();
            $table->boolean('email_domain_verified')->default(0);
            $table->string('remote_server_response', 10)->default(0);
        });

        $this->output->writeln('Contacts table create migrated.');
    }

    /**
     * Revert Migrations
     *
     */
    public function rollback()
    {
        Database::schema()->dropIfExists('contacts');

        $this->output->writeln('Contacts table create migration rolled back.');
    }
}

