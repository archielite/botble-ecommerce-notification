{{ subject }}

<strong>Order Amount</strong>: {{ order.amount | price_format }}

<strong>Order URL</strong>: {{ order_url }}

<strong>Status</strong>: {{ status }}

<strong>Last updated</strong>: {{ order.updated_at }}

<strong>Customer</strong>: {{ customer.name }} ({{ customer.phone }} - {{ customer.email }})
