<?php

use PHPUnit\Framework\TestCase;
use JackDomino\Elements\Domino;

class DominoTest extends TestCase
{

    /**
     * @covers Domino::reverse()
     */
    public function testReverse()
    {

        $domino = new Domino(1, 2);
        $result = $domino->reverse();

        $this->assertSame($result[0]->getValue(), 2);
        $this->assertSame($result[1]->getValue(), 1);
    }

    /**
     * @covers Domino::getValues()
     */
    public function testGetValues()
    {
        $domino = new Domino(3, 4);
        $values = $domino->getValues();

        $this->assertSame($values[0]->getValue(), 3);
        $this->assertSame($values[1]->getValue(), 4);
    }

    /**
     * @covers Domino::getPlayableValues()
     */
    public function testGetPlayableValues()
    {
        $domino = new Domino(3, 4);
        $domino->getValues()[0]->markAsPlayed();

        $playable = $domino->getPlayableValues(array(), 'object');
        $this->assertSame($playable[0]->getValue(), 4);

        $playable = $domino->getPlayableValues();
        $this->assertSame($playable[0], (string)4);
    }

    /**
     * @covers Domino::markAsPlayed()
     */
    public function testMarkAsPlayed()
    {
        $domino = new Domino(1, 2);
        $played = $domino->getValues()[0]->markAsPlayed();

        $this->assertSame($played->isPlayable(), false);
    }
}