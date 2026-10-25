# Research gaps and approval questions

**Status:** Open items from Phase 1. Inaccessible or non-field-level evidence is labeled **unverified**, not filled by assumption.

## Platform documentation gaps

| Platform | Gap | Evidence needed before an adapter is specified |
|---|---|---|
| RunSignup | Complete, current examples and exact data types for each event, pricing period, fee, question/waiver, giveaway/add-on, coupon, team, participant and order field; write permissions are endpoint-specific. | Save sanitized authorized responses and request schemas from the current official API methods. Confirm timezone, currency precision, age calculation and incremental sync semantics. |
| Race Roster | Accessible documentation covers results, not a complete event-registration API schema. | Obtain official full API reference/OpenAPI and access terms. Confirm auth, event/sub-event, capacity, age eligibility, teams/relays, questions, product variants, pricing, participants, registration, orders and CRUD support from first-party examples. |
| ACTIVE Network | Activity Search API is verified as discovery-oriented; asset sub-components and all returned pricing/date fields need field-level confirmation. Separate ACTIVE APIs/products were not reviewed. | Pin the exact search API version/spec and sample response. Confirm field names, timezone, currency, units, registration URL behavior and whether any separate API is authorized for configuration/transactions. |
| Movemint | Developer API site could not be resolved from this environment; only organizer workflow help was discoverable. API endpoints, fields, access policy and operations are unknown. | Obtain accessible official developer docs/OpenAPI, auth/sandbox access, versioning policy and sanitized request/response examples. |

## Cross-cutting unresolved modeling questions

1. **Public versus private exchange:** which participant/registration fields are suitable for portable exchange, and which are opt-in, access-controlled data? This proposal intentionally excludes payment-card data and health records and requires privacy review before adding sensitive fields.
2. **Participant identity:** when may an adapter deduplicate people across events? Canonical IDs must not imply global identity matching; platform identifiers are scoped by source.
3. **Eligibility and gender:** define age bands and reference date exactly; distinguish a participant's gender identity from competition eligibility rules and category labels. Do not normalize an organizer's rule into a person's identity.
4. **Prices and taxes:** confirm whether each source amount is a base fee, tax, processor charge, donation or total payable. Preserve source components and original precision; currency conversion is not an import/export transformation.
5. **Race nomenclature:** validate `Race` versus platform-specific event/division/sub-event objects with real payloads. Names do not prove equivalent semantics.
6. **Multi-day and local-time events:** choose explicit behavior for date-only events, timestamps without offset, races in multiple time zones, daylight-saving transitions and cancelled/rescheduled dates.
7. **Schema release policy:** select a stable schema URI/version scheme and specify compatibility guarantees only after maintainers approve the proposed model.
8. **JSON-LD projection:** review real output with schema.org consumers and Google requirements. Schema.org-valid JSON-LD and eligibility for a Google rich result are separate claims.
9. **Crosswalk confidence:** no published adapter fixtures or API payloads are checked in today. Crosswalk statuses must be upgraded only when backed by source examples and round-trip tests.

## Evidence retrieval limitation

The research environment could not resolve official documentation hostnames with `web_fetch` or terminal DNS for several sites. Official links and indexed search summaries provide pointers, but they do not replace examination of the live endpoint schema. In particular, do not convert search-generated summaries into authoritative exact field names. The platform-model document and crosswalk deliberately retain `unverified` where first-party evidence was insufficient.
