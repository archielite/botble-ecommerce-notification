<?php

namespace ArchiElite\EcommerceNotification\Listeners;

use ArchiElite\EcommerceNotification\Supports\EcommerceNotification;
use Botble\Ecommerce\Events\OrderReturnedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderReturnedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderReturnedEvent $event): void
    {
        $order = $event->order;

        EcommerceNotification::make()
            ->sendNotifyToDriversUsing('order', 'Your order {{ order_id }} has been returned on {{ site_name }}.', [
                'order_id' => get_order_code($order->id),
                'order_url' => route('orders.edit', $order->id),
                'order' => $order,
                'status' => $order->status->label(),
                'customer' => $order->address,
            ]);
    }
}
