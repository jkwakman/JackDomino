<?php

use PHPUnit\Framework\TestCase;
use JackDomino\Elements\DominoPool;
use JackDomino\Elements\Domino;

class DominoPoolTest extends TestCase
{

    /**
     * @covers DominoPool::add()
     */
    public function testAdd()
    {

        $domino1 = new Domino(1, 2);
        $dominoPool = new DominoPool();

        $dominoPool->add($domino1);

        $this->assertEquals(2, count($dominoPool->getPlayableValues()));

        $domino2 = new Domino(3, 4);
        $dominoPool->add($domino2,0);

        $this->assertEquals($domino2,$dominoPool->getDominoByPosition(0));

        $domino3 = new Domino(5, 6);
        $dominoPool->add($domino3,2);

        $this->assertEquals($domino3,$dominoPool->getDominoByPosition(2));
    }

    /**
     * @covers DominoPool::clear()
     */
    public function testClear()
    {
        $dominoPool = new DominoPool();
        $domino1 = new Domino(1, 2);
        $dominoPool->add($domino1);

        $dominoPool->clear();

        $this->assertEquals(0, count($dominoPool->getPlayableValues()));
    }

    /**
     * @covers DominoPool::pickWithValue()
     */
    public function testPickWithValue()
    {
        $dominoPool = new DominoPool();
        $domino1 = new Domino(1, 2);
        $domino2 = new Domino(3, 4);

        $dominoPool->add($domino1);
        $dominoPool->add($domino2);

        $this->assertEquals($domino2, $dominoPool->pickWithValue(4));
    }

    /**
     * @covers DominoPool::getPlayableValues()
     */
    public function testGetPlayableValues()
    {
        $dominoPool = new DominoPool();
        $domino1 = new Domino(1, 2);
        $domino2 = new Domino(3, 4);

        $domino2->markAsPlayed(4);

        $dominoPool->add($domino1);
        $dominoPool->add($domino2);

        $this->assertEquals(3, count($dominoPool->getPlayableValues()));
    }

    /**
     * @covers DominoPool::play()
     */
    public function testPlay()
    {
        $dominoPool = new DominoPool();
        $domino1 = new Domino(1, 2);
        $domino2 = new Domino(2, 4);

        $dominoPool->add($domino1);
        $playedDomino = $dominoPool->play($domino2,0);

        $this->assertEquals(1, count($playedDomino->getPlayableValues()));
        $this->assertEquals(1, count($dominoPool->getPlayableValues()));
    }

    /**
     * @covers DominoPool::getDominoByPosition()
     */
    public function testGetDominoByPosition()
    {

        $dominoPool = new DominoPool();
        $domino1 = new Domino(1, 2);

        $dominoPool->add($domino1);

        $domino2 = new Domino(3, 4);
        $dominoPool->add($domino2,1);

        $this->assertEquals($domino2,$dominoPool->getDominoByPosition(1));
    }

    /**
     * @covers DominoPool::getPosition()
     */
    public function testGetPosition()
    {

        $dominoPool = new DominoPool();
        $domino1 = new Domino(1, 2);

        $dominoPool->add($domino1);

        $domino2 = new Domino(3, 4);
        $dominoPool->add($domino2,1);

        $this->assertEquals($dominoPool->getPosition(4),1);
    }

    /**
     * @covers DominoPool::getFulSet()
     */
    public function testGetFullSet()
    {
        $dominoPool = new DominoPool();
        $this->assertEquals(28,count($dominoPool->getFullSet()));
    }
}