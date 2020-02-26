<?php

namespace App\Providers;

use App\Serializers\CustomDataSerializer;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Set custom serializer to fractal.
        $this->app->bind(Manager::class, function ($app) {
            $manager = new Manager;

            // Use the custom serializer
            return $manager->setSerializer(new CustomDataSerializer);
        });
    }
}
