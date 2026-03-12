<?php

declare(strict_types=1);

namespace Cekta\Serializer;

interface Jsonable extends \JsonSerializable
{
    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array;

    /**
     * @param array<mixed> $array
     * @return static
     */
    public static function fromArray(array $array): static;
}
