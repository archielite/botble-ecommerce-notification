<?php

namespace ArchiElite\EcommerceNotification\Listeners;

use ArchiElite\EcommerceNotification\Supports\EcommerceNotification;
use Botble\Ecommerce\Events\OrderPlacedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderPlacedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderPlacedEvent $event): void
    {
        $order = $event->order;

        EcommerceNotification::make()
            ->sendNotifyToDriversUsing('order', 'A new order has been placed on {{ site_name }}.', [
                'order_id' => get_order_code($order->id),
                'order_url' => route('customer.orders.view', $order->getKey()),
                'order' => $order,
                'status' => $order->status->label(),
                'customer' => $order->address,
            ]);
    }
}
