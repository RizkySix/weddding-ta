<?php

namespace App\Providers;

use App\Models\Package;
use App\Observers\CreateRatingPackage;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        Package::observe(CreateRatingPackage::class);

        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = env('APP_URL') . 'reset-password/' . $token . '?email=' . str_replace("@" , '%40' , $notifiable->email);
          
            return (new MailMessage)
                ->subject('Reset Password')
                ->line('Kamu mendapat pesan ini karena kami menerima permintaan reset password dari akun kamu.')
                ->action('Reset Password', $url)
                ->line('link ini akan kedaluwarsa dalam ' . env('PASSWORD_RESET_EXPIRE') . ' menit.')
                ->line('Jika kamu tidak merasa melakukan permintaan, abaikan pesan ini.');
        });
    }
}
