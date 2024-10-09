<?php

namespace App\Console\Commands;

use App\Notifications\ServiceStatusNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class CheckServiceStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:service-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifie les status des services de base de données, cache et api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        //return Command::SUCCESS;
        $services = [];
        try {
            DB::connection()->getPdo();
            $services['database'] = 'Operational';
        }catch (\Exception $e){
            $services['database'] = 'Down';
        }
        try {
            Cache::store('file')->put('test', 'value', 10);
            $services['cache'] = 'Operational';
        }catch (\Exception $e){
            $services['cache'] = 'Down';
        }
        try{
            $response = Http::get('https://restcountries.com/v3.1/all');
            if ($response->successful())
            {
                $services['api'] = 'Operational';
            }else{
                $services['api'] = 'Down';
            }
        }catch (\Exception $e)
        {
            $services['api'] = 'Down';
        }
        logger($services);
        if (in_array('Down', $services)){
            logger('hey');
             Notification::route('mail', 'admin@gmail.com')
            ->notify(new ServiceStatusNotification($services));
             logger('salut');
        }
        $this->info(json_encode($services, true));

    }
}
