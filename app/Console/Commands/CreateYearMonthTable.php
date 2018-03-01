<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class CreateYearMonthTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tdo:ymt {table} {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '按月创建表';

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
        $dstName = $srcName . date('_ym', strtotime($date));
        $ret = DB::statement("create table if not exists $dstName like $srcName;");
        return $ret;
    }
}
