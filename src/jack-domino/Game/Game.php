<?php

namespace JackDomino\Game;

use JackDomino\Elements\DominoPool;
use JackDomino\Elements\Domino;

/**
 * Class Game
 *
 * Main class for starting a game.
 * This is not interactive because it was not a requirement in the assessment
 *
 * @package JackDomino\Game
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
final class Game implements GameInterface
{

    /**
     * @var DominoPool $board
     */
    private $board;

    /**
     * @var DominoPool $stack
     */
    private $stack;

    /**
     * @var Player $player1
     */
    private $player1;

    /**
     * @var Player $player2
     */
    private $player2;

    /**
     * Start a new game
     */
    public function start()
    {

        //First we setup a stack
        $this->stack = new DominoPool();
        $this->stack->getFullSet();

        //Get the 7 random items
        $pool1 = new DominoPool($this->stack->pickRandom(7));
        $pool2 = new DominoPool($this->stack->pickRandom(7));

        $this->player1 = new Player('Alice', $pool1);
        $this->player2 = new Player('Bob', $pool2);

        //Get the first item
        $this->board = new DominoPool($this->stack->pickRandom(1));

        echo PHP_EOL . 'Game starting with first tile: ' . $this->board . PHP_EOL;

        //Make a loop over the full set..
        for ($i = 0; $i <= count(DominoPool::FULL_SET); $i++) {
            //Even for player2
            if ($i % 2 == 0) {
                $player = $this->player2;
            } else { //Otherwise player1
                $player = $this->player1;
            }

            //Make a turn
            $this->turn($player);

            //Check if we have a winner
            if ($this->hasWon($player)) {
                echo PHP_EOL . 'Player ' . $player . ' has won!';
                break;
            } else if ($this->isBlocked($this->stack)) {
                echo PHP_EOL . 'Game is blocked. Stack is empty';
                break;
            }
        }
    }

    /**
     * Make a turn
     *
     * @param Player $player
     * @return bool
     */
    public function turn(Player $player) : bool
    {

        $played = false;

        while (!$played) {
            //Do we have matching available values?
            $matchingValues = array_intersect($this->board->getPlayableValues(), $player->dominoPool->getPlayableValues());

            if (count($matchingValues)) {
                foreach ($matchingValues as $value) {
                    //Select the board domino
                    $position = $this->board->getPosition($value);

                    if (is_integer($position)) {
                        $boardDomino = $this->board->getDominoByPosition($position);

                        //Get the domino of the player
                        $playerDomino = $player->dominoPool->pickWithValue($value);
                        $playerDomino = $this->board->play($playerDomino, $position);

                        if ($position > 0) {
                            $position++;
                        }

                        $this->board->add($playerDomino, $position);

                        echo PHP_EOL . $player . ' plays ' . $playerDomino . ' to connect to tile ' . $boardDomino . ' on the board';
                        echo PHP_EOL . 'Board is now ' . $this->board;

                        $played = true;
                        break;
                    }
                }
            } else {
                //Pick a new tile
                $newDomino = $this->getTileFromStack($this->stack);

                if ($newDomino) {
                    echo PHP_EOL . $player . ' can\'t play, drawing tile ' . $newDomino;
                    $player->dominoPool->add($newDomino);
                } else {
                    $played = true;
                }
            }
        }

        return $played;
    }

    /**
     * Get tile from stack
     *
     * @param DominoPool $stack
     * @return Domino|null
     */
    public function getTileFromStack(DominoPool $stack): ? Domino
    {

        //Pick a new tile
        $newDomino = $stack->pickRandom(1);

        if($newDomino) {
            $newDomino = $newDomino[0];
        }

        return $newDomino;
    }

    /**
     * Check if a player has won
     *
     * @param Player $player
     * @return bool
     */
    public function hasWon(Player $player): bool
    {

        if (count($player->dominoPool->getPlayableValues()) == 0) {
            return true;
        }

        return false;
    }

    /**
     * Check if a game is blocked
     *
     * @param DominoPool $stack
     * @return bool
     */
    public function isBlocked(DominoPool $stack): bool
    {

        if (count($stack->getPlayableValues()) == 0) {
            return true;
        }

        return false;
    }
}
