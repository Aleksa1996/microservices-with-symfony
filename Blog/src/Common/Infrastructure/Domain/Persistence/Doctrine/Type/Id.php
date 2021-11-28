<?php
namespace App\Common\Infrastructure\Domain\Persistence\Doctrine\Type;

use Ramsey\Uuid\Doctrine\UuidType;
use App\Common\Domain\Id as IdValueObject;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class Id extends UuidType
{
    const NAME = 'uuid';

    const CLASS_NAME = IdValueObject::class;

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $className = self::CLASS_NAME;

        if (empty($value)) {
            return null;
        }

        return new $className($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}
