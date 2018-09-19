<?php

use PHPUnit\Framework\TestCase;
use JackDomino\Elements\DominoValue;

class DominoValueTest extends TestCase
{

    /**
     * @covers DominoValue::getValue()
     */
    public function testGetValue()
    {

        $dominoValue = new DominoValue(1, true);

        $this->assertSame($dominoValue->getValue(), 1);
    }

    /**
     * @covers DominoValue::isPlayable()
     */
    public function testIsPlayable()
    {

        $dominoValue = new DominoValue(1, false);

        $this->assertSame($dominoValue->isPlayable(), false);
    }

    /**
     * @covers DominoValue::markAsPlayed()
     */
    public function testMarkAsPlayed()
    {

        $dominoValue = new DominoValue(1, true);
        $dominoValue->markAsPlayed();

        $this->assertSame($dominoValue->isPlayable(), false);
    }
}