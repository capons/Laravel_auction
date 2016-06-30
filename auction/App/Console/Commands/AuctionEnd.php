<?php

namespace App\Console\Commands;

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Console\Command;
use Mail;

class AuctionEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auction close and send email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct ()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    /*
    public function handle()
    {

        $this->info('test');

    }
    */
    public function handle()
    {
        $data = array( //send variable to mail view
            'name'=> 'sdfdssdf',
            'email'=>'sdfsdfsdfsdf',
            'c_message'=> 'send email from Schedul'
        );
        Mail::send('mail.promise_buy', $data, function($message)
        {
            $message->from('sdfsdf@sdfd.xom', 'Auction');
            $message->to('example@test.com', 'John Doe')->subject('Test');
        });

        $this->info('Test has fired.');
    }
}
