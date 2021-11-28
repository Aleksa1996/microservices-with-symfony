<?php

namespace App\IdentityAccess\Infrastructure\Ui\Command;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Common\Application\Bus\Command\CommandBus;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use App\IdentityAccess\Application\Command\AssignRoleToUserCommand as ApplicationAssignRoleToUserCommand;

class AssignRoleToUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:assign-role-to-user';

    public function __construct(private CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('userId', InputArgument::REQUIRED, 'The id of the user.')
            ->addArgument('roleId', InputArgument::REQUIRED, 'The id of the role.')
            ->setDescription('Assigns role to user')
            ->setHelp('This command allows you to assign role to a user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->commandBus->handle(
                new ApplicationAssignRoleToUserCommand(
                    $input->getArgument('userId'),
                    $input->getArgument('roleId'),
                )
            );

            $io->success('Assign role to user succeed.');

            return Command::SUCCESS;
        } catch (HandlerFailedException $e) {
            $nestedExceptions = $e->getNestedExceptions();
            $ee = $nestedExceptions[0] ?? new \Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
            $io->error(
                sprintf(
                    "Assign role to user failed. \nException: %s\nMessage: %s\nFile: %s\nLine: %s\n",
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
