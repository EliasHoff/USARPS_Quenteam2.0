<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="RPSRound")
 */

class RPSRound
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $roundNr;
    /** @Column(type="integer") **/
    protected $gameNr;
    /** @Column(type="string") **/
    protected $symbol1;
    /** @Column(type="string") **/
    protected $symbol2;
    /** @Column(type="integer") **/
    protected $winner;
    /** @Column(type="string") **/
    protected $time;


    public function __construct(int $roundNr, int $gameNr, string $symbol1, string $symbol2, int $winner, string $time)
    {
        $this->roundNr = $roundNr;
        $this->gameNr = $gameNr;
        $this->symbol1 = $symbol1;
        $this->symbol2 = $symbol2;
        $this->winner = $winner;
        $this->time = $time;
    }

    public function getroundNr(): int
    {
        return $this->roundNr;
    }
    public function getGameNr(): int
    {
        return $this->gameNr;
    }
    public function getSymbol1(): string
    {
        return $this->symbol1;
    }
    public function getSymbol2(): string
    {
        return $this->symbol2;
    }
    public function getWinner(): int
    {
        return $this->winner;
    }
    public function getTime(): string
    {
        return $this->time;
    }
}
