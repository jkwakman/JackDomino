<?php

use PHPUnit\Framework\TestCase;
use JackDomino\Elements\DominoPool;
use JackDomino\Elements\Domino;
use JackDomino\Game\Player;

class PlayerTest extends TestCase
{

    /**
     * @covers Player::showHand()
     */
    public function testShowHand()
    {

        $domino1 = new Domino(1, 2);
        $dominoPool = new DominoPool();

        $dominoPool->add($domino1);
        $player = new Player('Player 1',$dominoPool);
        
        $this->assertEquals('<1:2>',$player->showHand());
    }
}