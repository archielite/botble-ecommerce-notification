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
                'order_id' => $order->code,
                'order_url' => route('customer.orders.view', $order->getKey()),
                'order' => $order,
                'status' => $order->return_status->label(),
                'customer' => $order->address,
            ]);
    }
}
