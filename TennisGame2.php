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
        $playerOneHasPointsPlayerTwoDoesNot = $this->playerOnePoint > 0 && $this->playerTwoPoint == 0;
        $playerTwoHasPointsPlayerOneDoesNot = $this->playerTwoPoint > 0 && $this->playerOnePoint == 0;
        $isPlayerOneWinning = $this->playerOnePoint > $this->playerTwoPoint && $this->playerOnePoint < 4;
        $isPlayerTwoWinning = $this->playerTwoPoint > $this->playerOnePoint && $this->playerTwoPoint < 4;
        $isPlayerOneAdvantage = $this->playerOnePoint > $this->playerTwoPoint && $this->playerTwoPoint >= 3;
        $isPlayerTwoAdvantage = $this->playerTwoPoint > $this->playerOnePoint && $this->playerOnePoint >= 3;
        $isPlayerOneWin = $this->playerOnePoint >= 4 && $this->playerTwoPoint >= 0 && ($this->playerOnePoint - $this->playerTwoPoint) >= 2;
        $isPlayerTwoWin = $this->playerTwoPoint >= 4 && $this->playerOnePoint >= 0 && ($this->playerTwoPoint - $this->playerOnePoint) >= 2;

        if ($scoreIsTied) {
            $score = $this->getScoreType($score, $this->playerOnePoint);
            $score .= "-All";
        }

        if ($scoreIsDeuce) {
            $score = "Deuce";
        }

        if ($playerOneHasPointsPlayerTwoDoesNot) {
            $this->playerOneResult = $this->getScoreType($score, $this->playerOnePoint);
            $this->playerTwoResult = "Love";
            $score = "{$this->playerOneResult}-{$this->playerTwoResult}";
        }

        if ($playerTwoHasPointsPlayerOneDoesNot) {
            if ($this->playerTwoPoint == 1) {
                $this->playerTwoResult = "Fifteen";
            }
            if ($this->playerTwoPoint == 2) {
                $this->playerTwoResult = "Thirty";
            }
            if ($this->playerTwoPoint == 3) {
                $this->playerTwoResult = "Forty";
            }
            $this->playerOneResult = "Love";
            $score = "{$this->playerOneResult}-{$this->playerTwoResult}";
        }

        if ($isPlayerOneWinning) {
            if ($this->playerOnePoint == 2) {
                $this->playerOneResult = "Thirty";
            }
            if ($this->playerOnePoint == 3) {
                $this->playerOneResult = "Forty";
            }
            if ($this->playerTwoPoint == 1) {
                $this->playerTwoResult = "Fifteen";
            }
            if ($this->playerTwoPoint == 2) {
                $this->playerTwoResult = "Thirty";
            }
            $score = "{$this->playerOneResult}-{$this->playerTwoResult}";
        }

        if ($isPlayerTwoWinning) {
            if ($this->playerTwoPoint == 2) {
                $this->playerTwoResult = "Thirty";
            }
            if ($this->playerTwoPoint == 3) {
                $this->playerTwoResult = "Forty";
            }
            if ($this->playerOnePoint == 1) {
                $this->playerOneResult = "Fifteen";
            }
            if ($this->playerOnePoint == 2) {
                $this->playerOneResult = "Thirty";
            }
            $score = "{$this->playerOneResult}-{$this->playerTwoResult}";
        }

        if ($isPlayerOneAdvantage) {
            $score = "Advantage player1";
        }


        if ($isPlayerTwoAdvantage) {
            $score = "Advantage player2";
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
     * @param string $score
     * @return string
     */
    public function getScoreType(string $score, int $playerPoint): string
    {
        if ($playerPoint == 0) {
            $score = "Love";
        }
        if ($playerPoint == 1) {
            $score = "Fifteen";
        }
        if ($playerPoint == 2) {
            $score = "Thirty";
        }
        if ($playerPoint == 3) {
            $score = "Forty";
        }
        return $score;
    }
}
