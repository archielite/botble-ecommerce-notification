<?php

namespace ArchiElite\EcommerceNotification\Listeners;

use ArchiElite\EcommerceNotification\Supports\EcommerceNotification;
use Botble\Ecommerce\Events\ShippingStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendShippingStatusChangedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ShippingStatusChanged $event): void
    {
        $shipment = $event->shipment;
        $order = $shipment->order;

        EcommerceNotification::make()
            ->sendNotifyToDriversUsing(
                'shipping-status-changed',
                'The shipping status of your order {{ order_id }} has been changed to {{ order_status }} on {{ site_name }}.',
                [
                    'order_id' => get_order_code($order->id),
                    'order_url' => route('orders.edit', $shipment->order_id),
                    'order' => $order,
                    'order_status' => $shipment->status->label(),
                    'customer' => $order->address,
                    'shipment' => $shipment,
                ]
            );
    }
}
