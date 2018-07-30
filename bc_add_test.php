<?php

require_once './bc_add.php';

class BcAddTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataAdd
     * @param string $a
     * @param string $b
     * @param string $expected
     */
    public function testAdd(string $a, string $b, string $expected)
    {
        $this->assertEquals($expected, alt_bc_add($a, $b));
    }

    /**
     * @return array
     */
    public function dataAdd() : array
    {
        $cases = [];

        $cases[] = [
            '0',
            '0',
            '0',
        ];

        $cases[] = [
            '1',
            '0',
            '1',
        ];

        $cases[] = [
            '-1',
            '0',
            '-1',
        ];

        $cases[] = [
            '0',
            '1',
            '1',
        ];

        $cases[] = [
            '0',
            '-1',
            '-1',
        ];

        $cases[] = [
            '1',
            '1',
            '2',
        ];

        $cases[] = [
            '-1',
            '-1',
            '-2',
        ];

        $cases[] = [
            '1',
            '9',
            '10',
        ];

        $cases[] = [
            '1',
            '-9',
            '-8',
        ];

        $cases[] = [
            '199995',
            '5',
            '200000',
        ];

        $cases[] = [
            '199995',
            '-5',
            '199990',
        ];

        $cases[] = [
            '-199995',
            '5',
            '-199990',
        ];

        $cases[] = [
            '8',
            '999992',
            '1000000',
        ];

        $cases[] = [
            '11',
            '99',
            '110',
        ];

        $cases[] = [
            '11',
            '-999',
            '-988',
        ];

        $cases[] = [
            '123456789',
            '987654321',
            '1111111110',
        ];

        $cases[] = [
            '123456789',
            '-987654321',
            '-864197532',
        ];

        $cases[] = [
            '-123456789',
            '-987654321',
            '-1111111110',
        ];

        $cases[] = [
            '9223372036854775807', // PHP_INT_MAX
            '9223372036854775807', // PHP_INT_MAX
            '18446744073709551614', // bcadd(PHP_INT_MAX, PHP_INT_MAX)
        ];

        $cases[] = [
            '9223372036854775807', // PHP_INT_MAX
            '-922337203685477580', // PHP_INT_MAX
            '8301034833169298227', // bcadd(PHP_INT_MAX, PHP_INT_MAX)
        ];

        $cases[] = [
            '-9223372036854775807', // PHP_INT_MAX
            '922337203685477580', // PHP_INT_MAX
            '-8301034833169298227', // bcadd(PHP_INT_MAX, PHP_INT_MAX)
        ];

        $cases[] = [
            '9223372036854775807', // PHP_INT_MAX
            '-9223372036854775808', // PHP_INT_MIN
            '-1', // bcadd(PHP_INT_MAX, PHP_INT_MIN)
        ];

        $cases[] = [
            '-9223372036854775807', // PHP_INT_MAX
            '-9223372036854775807', // PHP_INT_MAX
            '-18446744073709551614', // bcadd(PHP_INT_MAX, PHP_INT_MAX)
        ];

        return $cases;
    }
}