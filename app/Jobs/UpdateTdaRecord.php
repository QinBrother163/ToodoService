<?php

namespace App\Jobs;

use App\Toodo\Tda\MatchRecord;
use App\Toodo\Tda\MatchScore;
use App\Toodo\Tda\TdaMatch;
use App\Toodo\Tda\TdaRecord;
use App\Toodo\Tda\TdaSong;
use App\Toodo\Tda\TdaUser;
use App\Toodo\Tda\UserRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateTdaRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /** @var  TdaRecord */
    protected $record;

    public function __construct(TdaRecord $record)
    {
        $this->record = $record;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $record = $this->record;

        //玩家历史分数
        /** @var TdaUser $tdaUser */
        $tdaUser = TdaUser::find($record->userId);
        /** @var TdaSong $song */
        $song = TdaSong::find($record->songId);
        if (empty($tdaUser) || empty($song)) {
            $this->release();
            return;
        }
        $now = date("Y-m-d");
        $last = date("Y-m-d", strtotime($tdaUser->updated_at));
        $isLast = ($last != $now);

        $tdaUser->hisCalorie += $record->calorie;
        if ($isLast) {
            $tdaUser->lastCalorie = $tdaUser->calorie;
            $tdaUser->calorie = $record->calorie;
        } else {
            $tdaUser->calorie += $record->calorie;
        }
        /** @var UserRecord[] $records */
        $records = json_decode($tdaUser->records);
        $findRecord = false;
        foreach ($records as $userRecord) {
            if ($userRecord->songId == $record->songId) {
                if ($userRecord->score < $record->score) {
                    $userRecord->score = $record->score;
                }
                $findRecord = $userRecord;
                break;
            }
        }
        if (!$findRecord) {
            array_push($records, [
                'songId' => $record->songId,
                'score' => $record->score,
            ]);
        }
        $tdaUser->records = json_encode($records);

        //歌单历史分数
        if ($song->score < $record->score) {
            $song->score = $record->score;
            $song->user = $record->userId;
            $song->save();
        }

        //比赛歌曲
        if ($song->category == 0) {
            $now = date('Y-m-d H:i:s');
            $now1 = date('Y-m-d H:i:s', strtotime('+1 sec'));
            /** @var TdaMatch $match */
            $match = TdaMatch
                ::where('beginTime', '<', $now1)
                ->where('endTime', '>', $now)
                ->first();

            if ($match && $match->songId == $record->songId) {
                $this->updateMatchScore($match, $record);

                //玩家比赛分数
                $this->updateUserScore($match, $record, $tdaUser);
            }
        }

        $tdaUser->save();
    }

    /**
     * @param $match TdaMatch
     * @param $record TdaRecord
     * @param $tdaUser TdaUser
     */
    protected function updateUserScore($match, $record, $tdaUser)
    {
        if (empty($tdaUser->matchs)) {
            $tdaUser->matchs = '[]';
        }
        $matchId = $match->id;
        $lastId = $match->last;

        $mScores = collect(json_decode($tdaUser->matchs));
        /** @var MatchScore $lastScore */
        $lastScore = $mScores->where('matchId', $lastId)->first();
        /** @var MatchScore $mScore */
        $mScore = $mScores->where('matchId', $matchId)->first();
        if ($mScore) {
            if ($mScore->score < $record->score) {
                $mScore->score = $record->score;
            }
        } else {
            $mScore = [
                'matchId' => $matchId,
                'songId' => $match->songId,
                'score' => $record->score,
            ];
        }
        if ($lastScore) {
            $mScores = collect([$mScore, $lastScore]);
        } else {
            $mScores = collect([$mScore]);
        }
        $tdaUser->matchs = json_encode($mScores);
    }

    /**
     * @param $match TdaMatch
     * @param $record TdaRecord
     */
    protected function updateMatchScore($match, $record)
    {
        $isUpdate = false;

        /** @var MatchRecord[] $mRecords */
        $mRecords = json_decode($match->records);

        $findRecord = false;
        foreach ($mRecords as $matchRecord) {
            if ($matchRecord->userId == $record->userId) {
                $findRecord = $matchRecord;
                if ($matchRecord->score < $record->score) {
                    $matchRecord->score = $record->score;
                    $isUpdate = true;
                }
                break;
            }
        }

        if (!$isUpdate) {
            if ($findRecord) {
                return;
            }
            if (count($mRecords) < 10) {
                array_push($mRecords, [
                    'userId' => $record->userId,
                    'nick' => 113181682 + $record->userId,
                    'score' => $record->score,
                ]);
                $isUpdate = true;
            }
        }

        if (!$isUpdate) {
            $mLast = array_pop($mRecords);
            if ($record->score < $mLast->score) {
                return;
            }
            array_push($mRecords, [
                'userId' => $record->userId,
                'nick' => 113181682 + $record->userId,
                'score' => $record->score,
            ]);
            $isUpdate = true;
        }

        if ($isUpdate) {
            //排序======================================================
            $sorted = collect($mRecords)->sortByDesc('score');
            $match->records = json_encode($sorted->values()->all());
            $match->save();
        }
    }

}
