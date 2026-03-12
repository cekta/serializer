<?php

declare(strict_types=1);

namespace Cekta\Serializer\Test;

use Cekta\Serializer\Exception\InvalidMessageFormat;
use Cekta\Serializer\JSON;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class JSONTest extends TestCase
{
    private JSON $json;

    protected function setUp(): void
    {
        $this->json = new JSON();
    }

    public function testEncodeAndDecode(): void
    {
        $value = 10;
        $example = new Example($value);
        $example2 = $this->json->decode($this->json->encode($example));
        $this->assertInstanceOf(Example::class, $example2);
        /** @var Example $example2 */
        $this->assertSame($example->int, $example2->int);
    }

    #[DataProvider('invalidMessageFormatProvider')]
    public function testDecodeInvalidMessageFormat(string $message): void
    {
        $this->expectException(InvalidMessageFormat::class);
        $this->expectExceptionMessage("Message format invalid");
        $this->json->decode($message);
    }

    
    public static function invalidMessageFormatProvider()
    {
        $a = [
            [
                'class' => \stdClass::class, // not implement Jsonable
                'payload' => [],
            ],
            [
                'class' => \stdClass::class,
                'payload' => 'not array',
            ],
            [
                'class' => \stdClass::class,
                // no payload
            ],
            [
                'class' => ['not string'],
                'payload' => [],
            ],
            [
                // empty
            ]
        ];

        $result = [];
        foreach ($a as $item) {
            $result[] = [json_encode($item)];
        }
        $result[] = ['not valid json string'];
        return $result;
    }
}
