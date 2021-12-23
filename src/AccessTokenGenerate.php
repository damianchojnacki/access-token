<?php

namespace Damianchojnacki\AccessToken;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AccessTokenGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'access-token:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates access token';

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
        $token = AccessToken::generate();

        $this->writeNewEnvironmentFileWith($token);

        $this->output->success('Access token saved to .env file. You can now access your site by visiting url below:');

        $this->info(route('homepage', [
            'token' => $token
        ], true));
    }

    /**
     * Write a new environment file with the given key.
     *
     * @param  string  $key
     * @return void
     */
    protected function writeNewEnvironmentFileWith($token)
    {
        file_put_contents($this->laravel->environmentFilePath(), preg_replace(
            $this->tokenReplacementPattern(),
            'ACCESS_TOKEN='.$token,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }

    /**
     * Get a regex pattern that will match env APP_KEY with any random key.
     *
     * @return string
     */
    protected function tokenReplacementPattern()
    {
        $escaped = preg_quote('='.$this->laravel['config']['access.token'], '/');

        return "/^ACCESS_TOKEN{$escaped}/m";
    }
}
