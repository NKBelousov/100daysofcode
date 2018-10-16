<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Meme;

class GetMeme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meme:get {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Метод для получения мема по ID';

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
        $user = Meme::find($this->argument());
        echo json_encode($user, JSON_PRETTY_PRINT) . "\n";
    }
}
