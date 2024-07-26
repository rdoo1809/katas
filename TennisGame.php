<?php

interface TennisGame
{
    /**
     * @param  $playerName
     * @return void
     */
    public function wonPoint($player);

    /**
     * @return string
     */
    public function getScore();
}
