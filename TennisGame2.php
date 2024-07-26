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
        $score = "";
        $scoreIsTied = ($this->playerOnePoint == $this->playerTwoPoint) && $this->playerOnePoint < 4;
        $scoreIsDeuce = $this->playerOnePoint == $this->playerTwoPoint && $this->playerOnePoint >= 3;
        $isPlayerOneAdvantage = $this->playerOnePoint > $this->playerTwoPoint && $this->playerTwoPoint >= 3;
        $isPlayerTwoAdvantage = $this->playerTwoPoint > $this->playerOnePoint && $this->playerOnePoint >= 3;
        $isPlayerOneWin = $this->playerOnePoint >= 4 && $this->playerTwoPoint >= 0 && ($this->playerOnePoint - $this->playerTwoPoint) >= 2;
        $isPlayerTwoWin = $this->playerTwoPoint >= 4 && $this->playerOnePoint >= 0 && ($this->playerTwoPoint - $this->playerOnePoint) >= 2;

        if ($scoreIsTied) {
            $score = $this->getScoreType($this->playerOnePoint);
            $score .= "-All";
        }

        if ($scoreIsDeuce) {
            $score = "Deuce";
        }

        if ($isPlayerOneAdvantage) {
            $score = "Advantage player1";
        }


        if ($isPlayerTwoAdvantage) {
            $score = "Advantage player2";
        }


        if ($this->playerHasPointsAndTheOtherDoesnt($this->playerOneName) || $this->playerHasPointsAndTheOtherDoesnt($this->playerTwoName) || $this->isPlayerWinning($this->playerOneName) || $this->isPlayerWinning($this->playerTwoName)) {
            $this->playerOneResult = $this->getScoreType($this->playerOnePoint);
            $this->playerTwoResult = $this->getScoreType($this->playerTwoPoint);
            $score = "{$this->playerOneResult}-{$this->playerTwoResult}";
        }

        if ($isPlayerOneWin) {
            $score = "Win for player1";
        }


        if ($isPlayerTwoWin) {
            $score = "Win for player2";
        }

        return $score;
    }


    public function wonPoint($player) : void
    {
        if ($player == $this->playerOneName) {
            $this->playerOnePoint++;
        } else if ($player == $this->playerTwoName) {
            $this->playerTwoPoint++;
        }
    }

    /**
     * @return string
     */
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

    /**
     * @return bool
     */
    public function isPlayerWinning($player): bool
    {
        if ($player == $this->playerOneName) {
            $isPlayerWinning = $this->playerOnePoint > $this->playerTwoPoint && $this->playerOnePoint < 4;
        }

        if ($player == $this->playerTwoName) {
            $isPlayerWinning = $this->playerTwoPoint > $this->playerOnePoint && $this->playerTwoPoint < 4;
        }

        return $isPlayerWinning;
    }

    /**
     * @param string $playerName
     * @return bool
     */
    public function playerHasPointsAndTheOtherDoesnt(string $playerName): bool
    {
        if ($playerName === $this->playerOneName) {
            return $this->playerOnePoint > 0 && $this->playerTwoPoint == 0;
        }

        if ($playerName === $this->playerTwoName) {
            return $this->playerTwoPoint > 0 && $this->playerOnePoint == 0;
        }

        return false;
    }
}
