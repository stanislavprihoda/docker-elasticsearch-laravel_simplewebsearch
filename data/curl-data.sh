#!/bin/bash
curl -XPOST "http://localhost:9200/ecommerce/_doc/_bulk?pretty" \
    -H "Content-Type: application/json" \
    --data-binary "@legacy-products.json"