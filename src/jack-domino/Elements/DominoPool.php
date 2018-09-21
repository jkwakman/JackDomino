<?php

namespace JackDomino\Elements;

/**
 * Class DominoPool
 *
 * This class is used for creating and managing a domino pool
 *
 * @package JackDomino\Elements
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
final class DominoPool implements DominoPoolInterface
{

    /**
     * @var array
     */
    const FULL_SET = array('0,1', '0,2', '0,3', '0,4', '0,5', '0,6', '1,2', '1,3', '1,4', '1,5', '1,6', '2,3', '2,4',
        '2,5', '2,6', '3,4', '3,5', '3,6', '4,5', '4,6', '5,6', '0,0', '1,1', '2,2', '3,3', '4,4',
        '5,5', '6,6');

    /**
     * @var Domino[]
     */
    private $pool = array();

    /**
     * DominoPool constructor.
     * @param Domino[] $pool
     */
    public function __construct(array $pool = array())
    {
        $this->pool = (function (Domino ...$pool) {
            return $pool;
        })(...$pool);
    }

    /**
     * Cast pool to string
     */
    public function __toString(): string
    {

        $string = '';

        if (count($this->pool)) {
            /**
             * @var $pool Domino
             */
            foreach ($this->pool as $pool) {
                $string .= (string)$pool . ' ';
            }

            $string = rtrim($string);
        }

        return $string;
    }

    /**
     * Add a domino to the pool
     *
     * @param Domino $domino
     * @param int $position
     * @return Domino[]
     */
    public function add(Domino $domino, $position = 0): array
    {

        //Prepend on 0
        if ($position <= 0) {
            array_unshift($this->pool, $domino);
        } else {
            $this->pool[$position] = $domino;
        }

        return $this->pool;
    }

    /**
     * Shuffle the domino pool
     *
     * @return Domino[]
     */
    public function shuffle(): array
    {

        shuffle($this->pool);

        return $this->pool;
    }

    /**
     * Clear the pool
     * @return Domino[]
     */
    public function clear(): array
    {

        $this->pool = array();

        return $this->pool;
    }

    /**
     * Pick random number of items from array
     *
     * @param int $amount
     * @return Domino[]|null
     */
    public function pickRandom(int $amount = 1): ? array
    {

        if ($amount <= count($this->pool)) {
            $this->shuffle();

            return array_splice($this->pool, 0, $amount);
        }

        return null;
    }

    /**
     * Pick with value (remove from pool)
     *
     * @param int $value
     * @return Domino|null
     */
    public function pickWithValue(int $value): ? Domino
    {

        foreach ($this->pool as $key => $domino) {
            /**
             * @var $domino Domino
             */
            if (in_array($value, $domino->getPlayableValues())) {
                $domino = array_splice($this->pool, $key, 1);

                //Return a single domino
                return $domino[0];
            }
        }

        return null;
    }

    /**
     * Get playable values
     *
     * @param string $mode
     * @return array
     */
    public function getPlayableValues(string $mode = 'value'): array
    {

        $playableValues = array();

        foreach ($this->pool as $domino) {
            $playableValues = $domino->getPlayableValues($playableValues, $mode);
        }

        return $playableValues;
    }

    /**
     * Mark a domino as played by value
     *
     * @param int $value
     * @return DominoValue|null
     */
    public function markAsPlayed(int $value): ? DominoValue
    {

        foreach ($this->pool as $key => $domino) {
            if (in_array($value, $domino->getPlayableValues())) {
                return $domino->markAsPlayed($value);
            }
        }

        return null;
    }

    /**
     * Play the tile
     *
     * @param Domino
     * @param integer $position
     * @return Domino|null
     */
    public function play(Domino $domino, int $position): ? Domino
    {

        //Loop through the playable values..
        foreach ($domino->getPlayableValues() as $dominoValue) {
            if (in_array($dominoValue, $this->getPlayableValues('object'))) {
                //Mark the domino in the pool as played
                $this->markAsPlayed((int)$dominoValue);

                //Mark the given domino as played
                $domino->markAsPlayed((int)$dominoValue, $position);

                return $domino;
            }
        }

        return null;
    }

    /**
     * Get a domino tile by position in the pool
     *
     * @param int $position
     * @return Domino|null
     */
    public function getDominoByPosition(int $position): ? Domino
    {

        if (array_key_exists($position, $this->pool)) {
            return $this->pool[$position];
        }

        return null;
    }

    /**
     * Get position by value (only playable)
     *
     * @param int $value
     * @return int|null
     */
    public function getPosition(int $value): ? int
    {

        foreach ($this->pool as $key => $domino) {
            /**
             * @var $domino Domino
             */
            if (in_array($value, $domino->getPlayableValues())) {
                return $key;
            }
        }

        return null;
    }

    /**
     * Get full set
     *
     * @return Domino[]
     */
    public function getFullSet(): array
    {

        $this->clear();

        foreach ($this::FULL_SET as $item) {
            $values = explode(',', $item);
            $domino = new Domino((int)$values[0], (int)$values[1]);

            $this->add($domino);
        }

        return $this->pool;
    }
}
