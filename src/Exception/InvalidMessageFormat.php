<?php

declare(strict_types=1);

namespace Cekta\Serializer\Exception;

class InvalidMessageFormat extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Message format invalid');
    }
}
