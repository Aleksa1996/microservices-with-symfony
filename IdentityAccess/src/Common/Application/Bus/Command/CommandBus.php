<?php

namespace App\Common\Application\Bus\Command;

interface CommandBus
{
    public function handle($command): void;
}
