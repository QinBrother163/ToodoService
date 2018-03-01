<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class MoveDayTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tdo:mdt {table} {date} {field=created_at}';

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
        $dstName = $srcName . date('_ym', $date);

        $beginTime = date('Y-m-d', $date);
        $endTime = date('Y-m-d', strtotime('+1 day', $date));
        $field = $this->argument('field');

        $ret = DB::statement("create table if not exists $dstName like $srcName;");
        if (!$ret) return $ret;
        $ret = DB::statement("insert into $dstName select * from $srcName where $field between '$beginTime' and '$endTime';");
        if (!$ret) return $ret;
        $ret = DB::statement("delete from $srcName where $field between '$beginTime' and '$endTime';");
        return $ret;
    }
}
