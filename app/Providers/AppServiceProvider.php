<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Log;
use Illuminate\Support\Facades\Mail;
use Swift_Mailer;
use Swift_SmtpTransport;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
            $transport = Swift_SmtpTransport::newInstance(
                \Config::get('mail.host'),
                \Config::get('mail.port'),
                \Config::get('mail.encryption'))
                ->setUsername(\Config::get('mail.username'))
                ->setPassword(\Config::get('mail.password'))
                ->setStreamOptions(['ssl' => \Config::get('mail.ssloptions')]);
            
            
            $mailer = Swift_Mailer::newInstance($transport);
            Mail::setSwiftMailer($mailer);
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
