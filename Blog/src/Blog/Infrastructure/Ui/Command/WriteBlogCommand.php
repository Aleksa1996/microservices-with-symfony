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
use App\Blog\Application\Command\WriteBlogCommand as ApplicationWriteBlogCommand;

class WriteBlogCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:write-blog';

    public function __construct(private CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('title', InputArgument::REQUIRED, 'The title of the blog.')
            ->addArgument('content', InputArgument::REQUIRED, 'The content of the blog.')
            ->addArgument('categoryId', InputArgument::REQUIRED, 'The Category of the blog.')
            ->addArgument('authorId', InputArgument::REQUIRED, 'The Author of the blog.')
            ->setDescription('Creates blog')
            ->setHelp('This command allows you to write a blog');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->commandBus->handle(
                new ApplicationWriteBlogCommand(
                    Uuid::uuid4()->toString(),
                    $input->getArgument('title'),
                    $input->getArgument('content'),
                    $input->getArgument('categoryId'),
                    $input->getArgument('authorId')
                )
            );

            $io->success('Writing blog succeed.');

            return Command::SUCCESS;
        } catch (HandlerFailedException $e) {
            $nestedExceptions = $e->getNestedExceptions();
            $ee = $nestedExceptions[0] ?? new \Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
            $io->error(
                sprintf(
                    "Writing blog failed. \nException: %s\nMessage: %s\nFile: %s\nLine: %s\n",
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
