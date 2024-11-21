<?php

namespace ArchiElite\EcommerceNotification\Listeners;

use ArchiElite\EcommerceNotification\Supports\EcommerceNotification;
use Botble\Ecommerce\Events\OrderCompletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCompletedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderCompletedEvent $event): void
    {
        $order = $event->order;

        EcommerceNotification::make()
            ->sendNotifyToDriversUsing('order', 'Order {{ order_id }} has been completed on {{ site_name }}.', [
                'order_id' => get_order_code($order->id),
                'order_url' => route('customer.orders.view', $order->getKey()),
                'order' => $order,
                'status' => $order->status->label(),
                'customer' => $order->address,
            ]);
    }
}
