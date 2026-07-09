---
name: tiktokshop-mcp
description: Use the local TikTok Shop API Reference MCP server to discover API documents efficiently and fetch precise endpoint documentation. Trigger when a task asks about TikTok Shop API reference docs, endpoint capabilities, request/response fields, document lookup, or the `tiktokshop` MCP tools.
---

### Purpose

This project includes a local MCP server named `tiktokshop` that exposes the live TikTok Shop API Reference. Use this skill to avoid loading the full API tree unnecessarily and to retrieve only the API document needed for the current task.

### Available MCP Tools

- `mcp_tiktokshop_get_api_list`: returns the TikTok Shop API Reference document tree or a filtered subset.
- `mcp_tiktokshop_get_api_detail`: returns the detailed content for one API reference document.

### Preferred Workflow

1. Treat `mcp_tiktokshop_get_api_list` as a searchable index, not as full documentation.
2. Use targeted filters whenever possible:
   - `category` for a known top-level area, such as `Orders`, `Products`, or `Logistics`.
   - `search` for endpoint names or concepts, such as `order list`, `inventory`, or `shipment`.
3. Call `mcp_tiktokshop_get_api_detail` only after identifying the exact document.
4. Prefer fetching detail by `path` when available because document paths are stable and human-readable.

### Efficient Lookup Examples

Find order APIs:

```json
{"category":"Orders"}
```

Search by endpoint concept:

```json
{"search":"order list"}
```

Fetch a specific document:

```json
{"path":"get-order-list-202309"}
```

### Compact Index Format

When summarizing or storing API-list results for future use, keep only these fields unless the task needs more metadata:

```json
{
  "category": "Orders",
  "name": "Get Order List",
  "path": "get-order-list-202309",
  "document_id": "..."
}
```

Avoid preserving repeated tree metadata such as `parent_id`, `doc_type`, `url`, and `update_time` unless they are directly relevant.

### Compact API Detail Format

When summarizing a `mcp_tiktokshop_get_api_detail` response for future use, do not paste the full response schema unless explicitly requested. Prefer this compact, implementation-focused shape:

```json
{
  "category": "Orders",
  "name": "Get Order List",
  "path": "get-order-list-202309",
  "document_id": "650aa8094a0bb702c06df242",
  "method": "POST",
  "endpoint": "/order/202309/orders/search",
  "description": "Returns orders created or updated in a specified timeframe with optional filters.",
  "required_headers": ["content-type", "x-tts-access-token"],
  "required_query": ["app_key", "sign", "timestamp", "page_size", "shop_cipher"],
  "optional_query": ["sort_order", "page_token", "sort_field"],
  "optional_body_filters": [
    "order_status",
    "create_time_ge",
    "create_time_lt",
    "update_time_ge",
    "update_time_lt",
    "shipping_type",
    "buyer_user_id",
    "is_buyer_request_cancel",
    "warehouse_ids"
  ],
  "pagination": {
    "request": "page_token",
    "response": "next_page_token"
  },
  "key_response_objects": ["code", "message", "request_id", "data", "orders", "total_count"]
}
```

Adjust field names to match the endpoint being summarized, but keep the output focused on method, endpoint path, authentication, required query/header fields, request body filters, pagination, and key response objects.

### Known Top-Level Categories

Common categories in the API Reference include:

- `Authorization`
- `Event`
- `Seller`
- `Products`
- `Promotion`
- `Orders`
- `Fulfillment`
- `Fulfilled by TikTok (FBT)`
- `Logistics`
- `Return and refund`
- `Finance`
- `Analytics`
- `Customer service`
- `Customer engagement`
- `Affiliate creator`
- `Supply chain`
- `Tools`

### When to Use `include_dirs=true`

Use `include_dirs=true` only for category discovery or when you need to inspect the document hierarchy. The full tree is large, so normal endpoint lookup should use `category` or `search` instead.

### Practical Rules

- Do not paste the entire API tree into an answer unless explicitly requested.
- Do not paste an entire API detail schema unless the user explicitly asks for the full schema.
- Do not call `get_api_detail` for many unrelated documents unless the user asks for a comparison.
- If multiple documents match, summarize the likely candidates and fetch the most relevant one first.
- If an API name is ambiguous, search first, then disambiguate by category, path, or endpoint purpose.
- For implementation tasks, use the API detail response as the source of truth for HTTP method, path, query/body fields, authentication, and response schema.
