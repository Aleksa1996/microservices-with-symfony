<?php

namespace App\Blog\Infrastructure\Ui\Command;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Common\Application\Bus\Command\CommandBus;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use App\Blog\Application\Command\CreateCategoryCommand as ApplicationCreateCategoryCommand;

class CreateCategoryCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-category';

    public function __construct(private CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the blog.')
            ->addArgument('parentId', InputArgument::OPTIONAL, 'The id of the blog category parent.')
            ->setDescription('Creates blog category')
            ->setHelp('This command allows you to create a blog category');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->commandBus->handle(
                new ApplicationCreateCategoryCommand(
                    Uuid::uuid4()->toString(),
                    $input->getArgument('name'),
                    $input->getArgument('parentId'),
                )
            );

            $io->success('Creating category succeed.');

            return Command::SUCCESS;
        } catch (HandlerFailedException $e) {
            $nestedExceptions = $e->getNestedExceptions();
            $ee = $nestedExceptions[0] ?? new \Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
            $io->error(
                sprintf(
                    "Creating category failed. \nException: %s\nMessage: %s\nFile: %s\nLine: %s\n",
                    get_class($ee),
                    $ee->getMessage(),
                    $ee->getFile(),
                    $ee->getLine()
                )
            );
            return Command::FAILURE;
        }
    }
}
