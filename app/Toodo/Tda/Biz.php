<?php

namespace App\Toodo\Tda;

class UserRecord
{
    public $songId;
    public $score;
}

class MatchRecord
{
    public $userId;
    public $score;
}

class MatchScore
{
    public $matchId;
    public $songId;
    public $score;
}