<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class GetUserCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда для получения количества пользователей в системе';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
        $count = count(User::all());
        echo "Количество пользователей: $count\n";
        return $count;
    }
}
