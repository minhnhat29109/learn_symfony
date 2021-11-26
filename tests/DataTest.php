<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DataTest extends WebTestCase
{
    /**
     * @dataProvider additionWithNonNegativeNumbers
     * @dataProvider additionWithNegativeNumbersProvider
     */
    public function testAdd(int $a, int $b, int $expected): void
    {
        $this->assertSame($expected, $a + $b);
    }

    public function additionWithNonNegativeNumbers(): array
    {
        return [
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 2]
        ];
    }

    public function additionWithNegativeNumbersProvider(): array
    {
        return [
            [-1, 1, 0],
            [-1, -1, -2],
            [1, -1, 0]
        ];
    }
}
