<?php

namespace ArchiElite\EcommerceNotification\Providers;

use App\Providers\EventServiceProvider as ServiceProvider;
use ArchiElite\EcommerceNotification\Listeners\SendOrderCancelledNotification;
use ArchiElite\EcommerceNotification\Listeners\SendOrderCompletedNotification;
use ArchiElite\EcommerceNotification\Listeners\SendOrderConfirmedNotification;
use ArchiElite\EcommerceNotification\Listeners\SendOrderPaymentConfirmedNotification;
use ArchiElite\EcommerceNotification\Listeners\SendOrderPlacedNotification;
use ArchiElite\EcommerceNotification\Listeners\SendOrderReturnedNotification;
use ArchiElite\EcommerceNotification\Listeners\SendShippingStatusChangedNotification;
use Botble\Ecommerce\Events\OrderCancelledEvent;
use Botble\Ecommerce\Events\OrderCompletedEvent;
use Botble\Ecommerce\Events\OrderConfirmedEvent;
use Botble\Ecommerce\Events\OrderCreated;
use Botble\Ecommerce\Events\OrderPaymentConfirmedEvent;
use Botble\Ecommerce\Events\OrderPlacedEvent;
use Botble\Ecommerce\Events\OrderReturnedEvent;
use Botble\Ecommerce\Events\ShippingStatusChanged;
use Botble\Ecommerce\Listeners\OrderCreatedNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderCancelledEvent::class => [
            SendOrderCancelledNotification::class,
        ],
        OrderCompletedEvent::class => [
            SendOrderCompletedNotification::class,
        ],
        OrderConfirmedEvent::class => [
            SendOrderConfirmedNotification::class,
        ],
        OrderCreated::class => [
            OrderCreatedNotification::class,
        ],
        OrderPaymentConfirmedEvent::class => [
            SendOrderPaymentConfirmedNotification::class,
        ],
        OrderPlacedEvent::class => [
            SendOrderPlacedNotification::class,
        ],
        OrderReturnedEvent::class => [
            SendOrderReturnedNotification::class,
        ],
        ShippingStatusChanged::class => [
            SendShippingStatusChangedNotification::class,
        ],
    ];
}
