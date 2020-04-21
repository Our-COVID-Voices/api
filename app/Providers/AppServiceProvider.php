<?php

declare(strict_types=1);

namespace App\Providers;

use App\Sms\LogSmsSender;
use App\Sms\NullSmsSender;
use App\Sms\SmsSender;
use App\Sms\TwilioSmsSender;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Use CarbonImmutable as the date instance.
        Date::use(CarbonImmutable::class);

        // Bind the SMS sender concrete implementation to the interface through configuration.
        switch (Config::get('sms.driver')) {
            case 'twilio':
                $this->app->singleton(SmsSender::class, TwilioSmsSender::class);
                break;
            case 'log':
                $this->app->singleton(SmsSender::class, LogSmsSender::class);
                break;
            case 'null':
            default:
                $this->app->singleton(SmsSender::class, NullSmsSender::class);
                break;
        }

        // Define the Twilio client service.
        $this->app->singleton(Client::class, function () {
            return new Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
