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
        if ($this->playerOnePoint == $this->playerTwoPoint && $this->playerOnePoint < 4) {
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

        if ($this->playerOnePoint == $this->playerTwoPoint && $this->playerOnePoint >= 3) {
            $score = "Deuce";
        }

        if ($this->playerOnePoint > 0 && $this->playerTwoPoint == 0) {
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

        if ($this->playerTwoPoint > 0 && $this->playerOnePoint == 0) {
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

        if ($this->playerOnePoint > $this->playerTwoPoint && $this->playerOnePoint < 4) {
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

        if ($this->playerTwoPoint > $this->playerOnePoint && $this->playerTwoPoint < 4) {
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

        if ($this->playerOnePoint > $this->playerTwoPoint && $this->playerTwoPoint >= 3) {
            $score = "Advantage player1";
        }

        if ($this->playerTwoPoint > $this->playerOnePoint && $this->playerOnePoint >= 3) {
            $score = "Advantage player2";
        }

        if ($this->playerOnePoint >= 4 && $this->playerTwoPoint >= 0 && ($this->playerOnePoint - $this->playerTwoPoint) >= 2) {
            $score = "Win for player1";
        }

        if ($this->playerTwoPoint >= 4 && $this->playerOnePoint >= 0 && ($this->playerTwoPoint - $this->playerOnePoint) >= 2) {
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