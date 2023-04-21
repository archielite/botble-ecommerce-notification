<?php

namespace ArchiElite\EcommerceNotification\Providers;

use Illuminate\Support\ServiceProvider;

class EcommerceNotificationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! is_plugin_active('ecommerce') || ! is_plugin_active('notification-plus')) {
            return;
        }

        $this->app->register(EventServiceProvider::class);
    }
}
