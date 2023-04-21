{{ subject }}

Order Amount: {{ order.amount | price_format }}

Order URL: {{ order_url }}

Shipment status: {{ status }}

Last updated: {{ shipment.updated_at }}

Customer: {{ customer.name }} ({{ customer.phone }} - {{ customer.email }})
