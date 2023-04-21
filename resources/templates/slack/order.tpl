{
    "blocks": [
        {
            "type": "section",
            "text": {
                "type": "mrkdwn",
                "text": "{{ subject }}"
            }
        }
    ],
    "attachments": [
        {
            "color": "#92aa40",
            "fields": [
                {
                    "title": "Order Information",
                    "value": "{{ order_id }}: {{ order.amount | price_format }}"
                },
                {
                    "title": "Order URL",
                    "value": "{{ order_url }}"
                },
                {
                    "title": "Status",
                    "value": "{{ status }}"
                },
                {
                    "title": "Last updated",
                    "value": "{{ order.updated_at }}"
                },
                {
                    "title": "Customer",
                    "value": "{{ customer.name }} ({{ customer.phone }} - {{ customer.email }})"
                }
            ]
        }
    ]
}
