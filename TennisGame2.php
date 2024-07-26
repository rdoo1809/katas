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
        if ($scoreIsTied) {
            if ($this->playerOnePoint == 0) {
                $score = "Love";
            }
            if ($this->playerOnePoint == 1) {
                $score = "Fifteen";
            }
            if ($this->playerOnePoint == 2) {
                $score = "Thirty";
            }
            $score .= "-All";
        }

        $scoreIsDeuce = $this->playerOnePoint == $this->playerTwoPoint && $this->playerOnePoint >= 3;
        if ($scoreIsDeuce) {
            $score = "Deuce";
        }

        $playerOneHasPointsPlayerTwoDoesNot = $this->playerOnePoint > 0 && $this->playerTwoPoint == 0;
        if ($playerOneHasPointsPlayerTwoDoesNot) {
            if ($this->playerOnePoint == 1) {
                $this->playerOneResult = "Fifteen";
            }
            if ($this->playerOnePoint == 2) {
                $this->playerOneResult = "Thirty";
            }
            if ($this->playerOnePoint == 3) {
                $this->playerOneResult = "Forty";
            }

            $this->playerTwoResult = "Love";
            $score = "{$this->playerOneResult}-{$this->playerTwoResult}";
        }

        $playerTwoHasPointsPlayerOneDoesNot = $this->playerTwoPoint > 0 && $this->playerOnePoint == 0;
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

        $isPlayerOneWinning = $this->playerOnePoint > $this->playerTwoPoint && $this->playerOnePoint < 4;
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

        $isPlayerTwoWinning = $this->playerTwoPoint > $this->playerOnePoint && $this->playerTwoPoint < 4;
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

        $isPlayerOneAdvantage = $this->playerOnePoint > $this->playerTwoPoint && $this->playerTwoPoint >= 3;
        if ($isPlayerOneAdvantage) {
            $score = "Advantage player1";
        }

        $isPlayerTwoAdvantage = $this->playerTwoPoint > $this->playerOnePoint && $this->playerOnePoint >= 3;
        if ($isPlayerTwoAdvantage) {
            $score = "Advantage player2";
        }

        $isPlayerOneWin = $this->playerOnePoint >= 4 && $this->playerTwoPoint >= 0 && ($this->playerOnePoint - $this->playerTwoPoint) >= 2;
        if ($isPlayerOneWin) {
            $score = "Win for player1";
        }

        $isPlayerTwoWin = $this->playerTwoPoint >= 4 && $this->playerOnePoint >= 0 && ($this->playerTwoPoint - $this->playerOnePoint) >= 2;
        if ($isPlayerTwoWin) {
            $score = "Win for player2";
        }

        return $score;
    }

    private function SetP1Score($number)
    {
        for ($i = 0; $i < $number; $i++) {
            $this->P1Score();
        }
    }

    private function SetP2Score($number)
    {
        for ($i = 0; $i < $number; $i++) {
            $this->P2Score();
        }
    }

    private function P1Score()
    {
        $this->playerOnePoint++;
    }

    private function P2Score()
    {
        $this->playerTwoPoint++;
    }

    public function wonPoint($player)
    {
        if ($player == "player1") {
            $this->P1Score();
        } else {
            $this->P2Score();
        }
    }
}
