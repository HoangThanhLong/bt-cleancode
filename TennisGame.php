<?php
class TennisGame
{
    const LOVE = 0;
    const FIFTEEN = 1;
    const THIRTY = 2;
    const FORTY = 3;
    public $score = '';
    public $tempScore = 0;
    public $player1Name;
    public $player2Name;
    public $scorePlayer1;
    public $scorePlayer2;
    public function __construct($player1Name, $player2Name, $scorePlayer1, $scorePlayer2)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
        $this->scorePlayer1 = $scorePlayer1;
        $this->scorePlayer2 = $scorePlayer2;
    }
    function getScore()
    {
        $isScoreDeuce = $this->scorePlayer1 == $this->scorePlayer2;
        $isScoreMoreThan4 = $this->scorePlayer1 >= 4 || $this->scorePlayer2 >= 4;
        if ($isScoreDeuce) {
            return $this->checkDeuce();
        } else if ($isScoreMoreThan4) {
            return $this->scoreMoreThan4();
        } else {
            return $this->scoreLessthan4();
        }
    }
    function checkDeuce()
    {
        switch ($this->scorePlayer1) {
            case self::LOVE:
                $this->score = "Love-All";
                break;
            case self::FIFTEEN:
                $this->score = "Fifteen-All";
                break;
            case self::THIRTY:
                $this->score = "Thirty-All";
                break;
            case self::FORTY:
                $this->score = "Forty-All";
                break;
            default:
                $this->score = "Deuce";
                break;
        }
    }
    function scoreMoreThan4()
    {
        $minusResult = $this->scorePlayer1 - $this->scorePlayer2;
        if ($minusResult == 1)
            $this->score = "Advantage $this->player1Name";
        else if ($minusResult == -1)
            $this->score = "Advantage $this->player2Name";
        else if ($minusResult >= 2)
            $this->score = "Win for $this->player1Name";
        else
            $this->score = "Win for $this->player2Name";
    }
    function scoreLessthan4()
    {
        for ($index = 1; $index < 3; $index++) {
            if ($index == 1) $tempScore = $this->scorePlayer1;
            else {
                $this->score .= "-";
                $tempScore = $this->scorePlayer2;
            }
            switch ($tempScore) {
                case self::LOVE:
                    $this->score .= "Love";
                    break;
                case self::FIFTEEN:
                    $this->score .= "Fifteen";
                    break;
                case self::THIRTY:
                    $this->score .= "Thirty";
                    break;
                case self::FORTY:
                    $this->score .= "Forty";
                    break;
            }
        }
    }
    public function __toString()
    {
        return $this->score;
    }
}