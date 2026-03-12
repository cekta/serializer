<?php

declare(strict_types=1);

namespace Cekta\Serializer;

use Cekta\Serializer\Exception\FailEncode;
use Cekta\Serializer\Exception\InvalidMessageFormat;

class JSON
{
    public function encode(Jsonable $obj): string
    {
        $result = json_encode(
            [
                'class' => get_class($obj),
                'payload' => $obj->jsonSerialize()
            ],
            JSON_PRETTY_PRINT
        );
        if ($result === false) {
            throw new FailEncode();
        }
        return $result;
    }

    /**
     * @param string $message
     * @return object
     * @throws InvalidMessageFormat
     */
    public function decode(string $message): object
    {
        $decoded = json_decode($message, true);
        if (
            !is_array($decoded)
            || !array_key_exists('class', $decoded)
            || !is_string($decoded['class'])
            || !array_key_exists('payload', $decoded)
            || !is_array($decoded['payload'])
            || !in_array(Jsonable::class, ($r = class_implements($decoded['class'])) === false ? [] : $r)
        ) {
            throw new InvalidMessageFormat();
        }

        return $decoded['class']::fromArray($decoded['payload']);
    }
}
