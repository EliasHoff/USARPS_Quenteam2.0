<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="RPSGame")
 */

class RPSGame
{

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $gameNr;
    /** @Column(type="string") **/
    protected $player1;
    /** @Column(type="string") **/
    protected $player2;
    /** @Column(type="string") **/
    protected $date;

    public function __construct(int $gameNr, string $player1, string $player2, string $date)
    {
        $this->gameNr = $gameNr;
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->date = $date;
    }


    # Accessors
    public function getGameNr(): int
    {
        return $this->gameNr;
    }
    public function getPlayer1(): string
    {
        return $this->player1;
    }
    public function getPlayer2(): string
    {
        return $this->player2;
    }
    public function getDate(): string
    {
        return $this->date;
    }
}
