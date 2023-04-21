{{ subject }}

<strong>Order Amount</strong>: {{ order.amount | price_format }}

<strong>Order URL</strong>: {{ order_url }}

<strong>Shipment status</strong>: {{ status }}

<strong>Last updated</strong>: {{ shipment.updated_at }}

<strong>Customer</strong>: {{ customer.name }} ({{ customer.phone }} - {{ customer.email }})
