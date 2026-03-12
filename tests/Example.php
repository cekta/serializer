<?php

declare(strict_types=1);

namespace Cekta\Serializer\Test;

use Cekta\Serializer\Jsonable;

class Example implements Jsonable
{
    public function __construct(
        public readonly int $int = 5,
    ) {
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }

    public static function fromArray(array $array): static
    {
        return new Example($array['int']);
    }
}
