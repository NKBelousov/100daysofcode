<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Meme;

class GetMemeCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meme:count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда для получения количества мемов в системе';

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
        $count = count(Meme::all());
        echo "Количество мемов: $count\n";
        return $count;
    }
}
