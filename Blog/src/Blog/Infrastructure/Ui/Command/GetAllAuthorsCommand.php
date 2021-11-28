<?php

namespace App\Blog\Infrastructure\Ui\Command;

use App\Blog\Application\Query\AuthorCollectionQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Common\Application\Bus\Query\QueryBus;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Serializer\SerializerInterface;

class GetAllAuthorsCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:get-all-authors';

    public function __construct(private QueryBus $queryBus, private SerializerInterface $serializer)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Get all authors')
            ->setHelp('This command allows you to read all authors in the system');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $authors = $this->queryBus->handle(
                new AuthorCollectionQuery()
            );

            $io->success('Getting all authors succeed.');

            foreach ($authors as $author) {
                $io->writeln($this->serializer->serialize($author, 'json'));
            }

            return Command::SUCCESS;
        } catch (HandlerFailedException $e) {
            $nestedExceptions = $e->getNestedExceptions();
            $ee = $nestedExceptions[0] ?? new \Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
            $io->error(
                sprintf(
                    "Getting all authors failed. \nException: %s\nMessage: %s\nFile: %s\nLine: %s\n",
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
