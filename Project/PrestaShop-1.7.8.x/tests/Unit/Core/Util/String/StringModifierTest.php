<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace Tests\Unit\Core\Util\String;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Util\String\StringModifier;

class StringModifierTest extends TestCase
{
    /**
     * @var StringModifier
     */
    private $stringModifier;

    public function setUp()
    {
        $this->stringModifier = new StringModifier();
    }

    public function testItTransformsCamelCaseToSplitWords()
    {
        $data = [
            [
                'string' => 'oneTwoThreeFour',
                'expects' => 'one Two Three Four',
            ],
            [
                'string' => 'StartsWithCap',
                'expects' => 'Starts With Cap',
            ],
            [
                'string' => 'hasConsecutiveCAPS',
                'expects' => 'has Consecutive CAPS',
            ],
            [
                'string' => 'NewMODULEDevelopment',
                'expects' => 'New MODULE Development',
            ],
            [
                'string' => 'snake_case_word',
                'expects' => 'snake_case_word',
            ],
        ];

        foreach ($data as $item) {
            $result = $this->stringModifier->splitByCamelCase($item['string']);

            $this->assertEquals($item['expects'], $result);
        }
    }

    /**
     * @dataProvider getTooLongStringsForEndCutting
     *
     * @param string $string
     * @param int $length
     * @param string $expectedOutput
     */
    public function testItCutsStringEndIfItIsTooLong(string $string, int $length, string $expectedOutput): void
    {
        $output = $this->stringModifier->cutEnd($string, $length);
        $this->assertEquals($expectedOutput, $output);
    }

    /**
     * @dataProvider getNotTooLongStringsForEndCutting
     *
     * @param string $string
     * @param int $length
     */
    public function testItDoesNotCutStringEndIfItsNotTooLong(string $string, int $length): void
    {
        $output = $this->stringModifier->cutEnd($string, $length);
        $this->assertEquals($string, $output);
    }

    /**
     * @return Generator
     */
    public function getTooLongStringsForEndCutting(): Generator
    {
        yield ['test', 3, 'tes'];
        yield ['testable', 7, 'testabl'];
        yield ['hello world 899', 13, 'hello world 8'];
    }

    /**
     * @return Generator
     */
    public function getNotTooLongStringsForEndCutting(): Generator
    {
        yield ['test', 4];
        yield ['testable', 20];
        yield ['good bye cruel world 10.99', 128];
    }
}