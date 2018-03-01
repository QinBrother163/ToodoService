<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class MoveLessDateTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tdo:ldt {table} {date} {field=created_at}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '从一个表移动数据到另一个表';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $srcName = $this->argument('table');
        $date = $this->argument('date');
        $date = strtotime($date);


        $deadTime = date('Y-m-d', strtotime('+1 day', $date));
        $field = $this->argument('field');

        while (true) {
            $row = DB::table($srcName)->where($field, '<', $deadTime)->orderBy($field)->first();
            if (!$row) break;

            $row = (array)$row;
            $date = strtotime($row[$field]);
            $dstName = $srcName . date('_ym', $date);

            $endTime = date('Y-m', strtotime('+1 month', $date));
            $endTime = min($endTime, $deadTime);

            DB::statement("create table if not exists $dstName like $srcName;");
            DB::statement("insert into $dstName select * from $srcName where $field < '$endTime';");
            DB::statement("delete from $srcName where $field < '$endTime';");
        }
    }
}
