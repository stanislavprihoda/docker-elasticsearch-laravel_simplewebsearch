#!/bin/bash
curl -XPUT http://localhost:9200/ecommerce/ \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache' \
  -d '{
    "mappings": {
    	"_doc": {
    		"properties": {
		        "categories": {
		            "type": "nested",
		            "properties": {
		                "name": {
		                    "type": "text",
		                "fields": {
		                    "keyword": {
		                        "type": "keyword",
		                        "ignore_above": 256
		                    }
		                },
		                "fielddata": true
		              }
		            }
		        },
		        "description": {
		            "type": "text",
		            "fields": {
		                "keyword": {
		                    "type": "keyword",
		                    "ignore_above": 256
		                }
		            }
		        },
		        "name": {
		            "type": "text",
		            "fields": {
		                "keyword": {
		                    "type": "keyword",
		                    "ignore_above": 256
		                }
		            }
		        },
		        "price": {
		            "type": "float"
		        },
		        "quantity": {
		            "type": "long"
		        },
		        "status": {
		            "type": "text",
		            "fields": {
		                "keyword": {
		                    "type": "keyword",
		                    "ignore_above": 256
		                }
		            },
		            "fielddata": true
		        },
		        "tags": {
		            "type": "text",
		            "fields": {
		                "keyword": {
		                    "type": "keyword",
		                    "ignore_above": 256
		                }
		            }
		        }
		    }
    	}
    }
}'