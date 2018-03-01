<?php

use Illuminate\Database\Seeder;
use App\Toodo\Tde\TurntablePrize;
use App\Toodo\Tde\TurntableProbability;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prizeID = [0, 1, 2, 3, 4, 5];
        $prizeNum = [100, 10, 50, 9999, 20, 30];
        $prizeName = ["经典游戏掌机", "数码平板电脑", "高清摄像头", "游戏币50F", "体感热舞跳舞毯", "数码摄像机"];

        $onePro = [0.01,0.01,0.01,0.01,0.01,0];
        $twoPro = [0.05,0.05,0.05,0.05,0,0];
        $threePro = [0.35,0.3,0.3,0.3,0.19,0];
        $fourPro = [0.1,0.1,0.14,0.14,0.2,0];
        $fivePro = [0.19,0.2,0.3,0.3,0.2,0];
        $sixPro = [0.3,0.34,0.2,0.2,0.4,1];

        for ($i = 0; $i < count($prizeID); $i++) {
            $log = new TurntablePrize();
            $log->fill([
                'prizeID' => $prizeID[$i],
                'prizeName' => $prizeName[$i],
                'date' => date('Y-m-d H:i:s'),
                'prizeNum' => $prizeNum[$i],
            ]);
            $log->save();
        }

        for ($i = 0; $i < count($prizeID); $i++){
            $log = new TurntableProbability();
            $log->fill([
                'userType' => $prizeID[$i],
                'onePro' => $onePro[$i],
                'twoPro' => $twoPro[$i],
                'threePro' => $threePro[$i],
                'fourPro' => $fourPro[$i],
                'fivePro' => $fivePro[$i],
                'sixPro' => $sixPro[$i],
            ]);
            $log->save();
        }

    }
}
