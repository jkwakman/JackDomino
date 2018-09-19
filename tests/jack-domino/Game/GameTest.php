<?php

use PHPUnit\Framework\TestCase;
use JackDomino\Elements\DominoPool;
use JackDomino\Elements\Domino;
use JackDomino\Game\Game;
use JackDomino\Game\Player;

class GameTest extends TestCase
{


    /**
     * @covers Game:getTileFromStack()
     */
    public function testGetTileFromStack()
    {
        $stack = new DominoPool();
        $domino = new Domino(1,2);
        $stack->add($domino);

        $game = new Game();
        $dominoFromStack = $game->getTileFromStack($stack);

        $this->assertEquals($domino,$dominoFromStack);
    }

    /**
     * @covers Game::hasWon()
     */
    public function testHasWon()
    {

        $dominoPool = new DominoPool();
        $player = new Player('Player 1',$dominoPool);
        $game = new Game();

        $this->assertEquals(true,$game->hasWon($player));
    }

    /**
     * @covers Game::isBlocked()
     */
    public function testIsBlocked()
    {
        $stack = new DominoPool();
        $game = new Game();

        $this->assertEquals(true,$game->isBlocked($stack));
    }
}