<?php

class TennisGame2 implements TennisGame
{
    private $playerOnePoint = 0;
    private $playerTwoPoint = 0;
    private $playerOneResult = "";
    private $playerTwoResult = "";
    private $playerOneName = "";
    private $playerTwoName = "";

    public function __construct($player1Name, $player2Name)
    {
        $this->playerOneName = $player1Name;
        $this->playerTwoName = $player2Name;
    }

    public function getScore()
    {
        $scoreIsTied = ($this->playerOnePoint == $this->playerTwoPoint) && $this->playerOnePoint < 4;
        $scoreIsDeuce = $this->playerOnePoint == $this->playerTwoPoint && $this->playerOnePoint >= 3;
        $isPlayerOneAdvantage = $this->playerOnePoint > $this->playerTwoPoint && $this->playerTwoPoint >= 3;
        $isPlayerTwoAdvantage = $this->playerTwoPoint > $this->playerOnePoint && $this->playerOnePoint >= 3;
        $isPlayerOneWin = $this->playerOnePoint >= 4 && $this->playerTwoPoint >= 0 && ($this->playerOnePoint - $this->playerTwoPoint) >= 2;
        $isPlayerTwoWin = $this->playerTwoPoint >= 4 && $this->playerOnePoint >= 0 && ($this->playerTwoPoint - $this->playerOnePoint) >= 2;

        if ($isPlayerOneWin) {
            return "Win for player1";
        }

        if ($isPlayerTwoWin) {
            return "Win for player2";
        }

        if ($scoreIsDeuce) {
            return "Deuce";
        }

        if ($scoreIsTied) {
            $score = $this->getScoreType($this->playerOnePoint);
            $score .= "-All";
            return $score;
        }

        if ($isPlayerOneAdvantage) {
            return "Advantage player1";
        }

        if ($isPlayerTwoAdvantage) {
            return "Advantage player2";
        }


        $this->playerOneResult = $this->getScoreType($this->playerOnePoint);
        $this->playerTwoResult = $this->getScoreType($this->playerTwoPoint);
        return "{$this->playerOneResult}-{$this->playerTwoResult}";
    }

    public function wonPoint($player) : void
    {
        if ($player == $this->playerOneName) {
            $this->playerOnePoint++;
        } else if ($player == $this->playerTwoName) {
            $this->playerTwoPoint++;
        }
    }

    public function getScoreType(int $playerPoint): string
    {
        if ($playerPoint == 0) {
            return "Love";
        }
        if ($playerPoint == 1) {
            return "Fifteen";
        }
        if ($playerPoint == 2) {
            return "Thirty";
        }
        if ($playerPoint == 3) {
            return "Forty";
        }
        return '';
    }

//    public function isPlayerWinning($player): bool
//    {
//        if ($player == $this->playerOneName) {
//            $isPlayerWinning = $this->playerOnePoint > $this->playerTwoPoint && $this->playerOnePoint < 4;
//        }
//
//        if ($player == $this->playerTwoName) {
//            $isPlayerWinning = $this->playerTwoPoint > $this->playerOnePoint && $this->playerTwoPoint < 4;
//        }
//
//        return $isPlayerWinning;
//
//    public function playerHasPointsAndTheOtherDoesnt(string $playerName): bool
//    {
//        if ($playerName === $this->playerOneName) {
//            return $this->playerOnePoint > 0 && $this->playerTwoPoint == 0;
//        }
//        if ($playerName === $this->playerTwoName) {
//            return $this->playerTwoPoint > 0 && $this->playerOnePoint == 0;
//        }
//        return false;
//    }
}
