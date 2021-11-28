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
use App\IdentityAccess\Application\Command\RegisterUserCommand as ApplicationRegisterUserCommand;

class RegisterUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:register-user';

    public function __construct(private CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the user.')
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the user.')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of the user.')
            ->setDescription('Creates user')
            ->setHelp('This command allows you to register a user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->commandBus->handle(
                new ApplicationRegisterUserCommand(
                    Uuid::uuid4()->toString(),
                    $input->getArgument('name'),
                    $input->getArgument('email'),
                    $input->getArgument('password'),
                )
            );

            $io->success('Registering user succeed.');

            return Command::SUCCESS;
        } catch (HandlerFailedException $e) {
            $nestedExceptions = $e->getNestedExceptions();
            $ee = $nestedExceptions[0] ?? new \Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
            $io->error(
                sprintf(
                    "Registering user failed. \nException: %s\nMessage: %s\nFile: %s\nLine: %s\n",
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
