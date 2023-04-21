{{ subject }}

Order Amount: {{ order.amount | price_format }}

Order URL: {{ order_url }}

Status: {{ status }}

Last updated: {{ order.updated_at }}

Customer: {{ customer.name }} ({{ customer.phone }} - {{ customer.email }})
