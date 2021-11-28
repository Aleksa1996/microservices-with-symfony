<?php

namespace App\Common\Application\Bus\Query;

interface QueryBus
{
    public function handle($query): mixed;
}
