<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CustomMailService;

class CustomMailServiceProvider extends ServiceProvider {
    public function register()
    {
        if (env('APP_DEBUG')) {
            $this->app->register('Illuminate\Mail\MailServiceProvider');
        } else {
            $this->app->singleton('mailer', function() {
                return new CustomMailService();
            });
        }
    }
}
