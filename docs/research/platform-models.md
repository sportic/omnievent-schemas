# Registration platform model research

**Status:** Phase 1 research; this is evidence, not an approved implementation contract.
**Evidence date:** 2026-10-25. Exact field names are quoted only where they are verified in the linked documentation. Search-index summaries and product help pages are not treated as complete API specifications.

## RunSignup

**Official API documentation**

- [API overview](https://runsignup.com/API/DocOverview)
- [API methods](https://runsignup.com/API/Methods)
- [Get race](https://runsignup.com/API/race/:race_id/GET)
- [Get race participants](https://runsignup.com/API/race/:race_id/participants/GET)
- [Add or edit race participants](https://runsignup.com/API/race/:race_id/participants/POST)
- [Creating a race through the API](https://help.runsignup.com/support/solutions/articles/17000065645-creating-a-race-through-the-api)

The reference is a REST API returning JSON (also documents XML), organized around a race ID. Its race-detail resource can return race and event details plus registration-related information; participants, coupons, teams/groups, questions, and registration configuration have related methods. The participant API is documented for retrieval and add/edit operations. Race creation exists but is permissioned; it is not evidence that every race configuration field can be written by every API client.

| Area | Evidence and mapping notes |
|---|---|
| Hierarchy | A RunSignup `race` contains selectable `events` (distances/divisions); the word “event” in this API is not necessarily an OmniEvent top-level event. Preserve both levels and source IDs rather than flattening. |
| Registration configuration | The Get Race reference documents a broad detail response and optional details; available materials mention event pricing/registration periods, age pricing, giveaways, and questions. Exact JSON names and completeness must be taken from the live method reference or a captured authorized response before implementing mappings. |
| Price/fees | Race/event registration pricing and fee information is documented. Do not assume a price includes every processing fee, tax, or payment charge; retain each disclosed component and unknown totals. |
| Questions/waivers | Race details and registration methods cover question configuration and responses; waivers are included among optional race-detail data. Question type, validation and conditional behavior require field-level verification against the current method page. |
| Participants/teams | Participant responses include registration-related information; API methods exist for participant add/edit and team/group operations. A participant record is not equivalent to an order. |
| Identifiers/sync | API resources are keyed by platform race/event/participant identifiers. Participant retrieval supports paging and modified/registration filters according to the public reference; exact cursor and timestamp behavior should be tested before sync code. |
| Date, currency, units | The public pages do not provide a sufficiently stable, complete contract for every date/time, currency, distance-unit or fee field in the evidence available for this research. Treat details beyond documented examples as **unverified**. |
| Writes | Read and participant create/update operations are documented. Race creation requires special API credentials/permissions. Verify per-resource access and organizer authorization before assuming create/update support. |

**Interop conclusion:** Best evidenced source for registration configuration and records among the four platforms researched, but the adapter still needs a versioned field map, examples captured from the actual endpoints, and explicit coverage of permission-dependent write operations.

## Race Roster

**Official API documentation**

- [API Reference: Results](https://developers.raceroster.com/docs/api/results/)
- [Developer portal](https://developers.raceroster.com/)
- [How to create a sub-event](https://help.raceroster.com/en-us/knowledge-base/how-to-create-a-sub-event) (official product help, not an API schema)

The supplied public API reference is explicitly the results API. It is not, by itself, evidence for the full event-management or registration API. The public portal is the appropriate place to verify any additional endpoints and access requirements; the exact API schema was not available from the documentation retrieved for this Phase 1 review.

| Area | Evidence and mapping notes |
|---|---|
| Hierarchy | Official help uses **sub-event** for a configured event component. That supports a conceptual event/sub-event relationship, but does not establish all public API response fields. |
| Results API | Results documentation is available and concerns results integration. Do not use it as evidence that registration creation, questions, pricing, participant PII, or orders are exposed by the same API. Results/timing mappings are outside this phase. |
| Registration, products, pricing | **Unverified** from accessible official API schema. Public product/help descriptions are not sufficient evidence of API fields or CRUD support. |
| Capacity, eligibility, age calculation, teams | Product help and secondary descriptions mention sub-events and team concepts, but exact API fields, semantics and read/write coverage remain **unverified**. |
| Dates, currency, units, identifiers | Exact registration API field types, formats, currency conventions, unit codes and identifier lifecycle are **unverified**. |
| Writes | The accessible results reference does not prove registration/event write operations. **Unverified** for event and registration create/update. |

**Interop conclusion:** Keep Race Roster mappings marked unverified until the current official full API reference/OpenAPI document and partner access policy are reviewed. A discoverable API website or a results endpoint must not be mistaken for a public registration API.

## ACTIVE Network

**Official API documentation**

- [Developer portal](https://developer.active.com/docs/Home/)
- [Activity Search API v2](https://developer.active.com/docs/v2_Activity_API_Search)
- [I/O documentation](https://developer.active.com/io-docs)
- [Developer FAQ](https://developer.active.com/developer_faq)

The documented Activity Search API is an **activity discovery** surface. Its central abstraction is an asset, searchable by category, query, dates and location; returned assets may include event data and registration links. Search results describe the API as read-oriented and direct users to the organizer's registration URL. This is not a registration-management API contract.

| Area | Evidence and mapping notes |
|---|---|
| Hierarchy | The search API's asset model groups discoverable activities, including events. It does not establish an endurance-specific Event → Race → RegistrationOption hierarchy. |
| Discovery fields | Search/query, category, date/location filters, asset identity, public description/location/date and a registration URL are within the discovery API scope. Exact names and response fields must be taken from the linked API specification at implementation time. |
| Pricing | A returned asset may expose a price when supplied. The search API does not evidence registration price tiers, fee breakdowns, discounts or transaction amounts. |
| Registration | The API is for discovery and hand-off via registration URL, not for registering participants or managing an organizer's registration records. |
| Participants, questions, waivers, teams, orders | Not supported by the documented Activity Search API; do not infer these from ACTIVE's other products or partner/private APIs. |
| Writes | Asset management and registration create/update are not provided by the documented Activity Search API. Other ACTIVE products/APIs are outside the verified scope. |
| Identifiers, date/time, units, currency | Asset identity is part of the API contract. Exact identifier stability and all date/time, currency and unit conventions should be checked against the current operation schema before mapping. |

**Interop conclusion:** Model ACTIVE discovery import as a deliberately lossy event-discovery adapter with registration URL preservation. Do not promise round-trip or registration-record synchronization through Activity Search.

## Movemint

**Official documentation**

- [Developer documentation](https://docs.movemint.cc/developers)
- [Organizer documentation](https://docs.movemint.cc/)
- [Event registration dates](https://docs.movemint.cc/organizers/event-setup/registration/registration-dates)
- [Event admin](https://docs.movemint.cc/organizers/setting-up-your-event/admin-roles/event-admin)
- [Event-day registration](https://docs.movemint.cc/organizers/pre-race-event-day/event-day-registration)

The official developer-documentation URL was not retrievable in the research environment (DNS lookup failed); indexed search results did not expose a verifiable API reference, OpenAPI document, authentication scheme, endpoint list, or field schema. Organizer help pages describe product workflows, not a machine-readable API contract.

| Area | Evidence and mapping notes |
|---|---|
| Event setup and registration windows | Official organizer help documents event administration and registration dates as product workflows. Exact API representation and API accessibility are **unverified**. |
| Races/options/prices/questions | **Unverified** at the API level. Do not assume that product UI terms “ticket”, “race” or “registration option” have particular endpoint or schema names. |
| Participants, orders, teams, add-ons, discounts | Public help/search evidence is insufficient to establish API fields or CRUD capabilities; **unverified**. |
| Identifiers, date/time, currency, units | **Unverified**. |
| Writes and synchronization | **Unverified**. Obtain official API docs and an authorized sandbox account before specifying an adapter. |

**Interop conclusion:** Treat all platform field mappings and operations as unverified. Product help can guide discovery questions, but cannot serve as API evidence.

## What is and is not comparable

| Platform | Publicly evidenced center of gravity | Reliable Phase 1 boundary |
|---|---|---|
| RunSignup | Race configuration plus registration/participant API methods | Detailed mapping is plausible; verify exact current payloads, permissions and fields. |
| Race Roster | Results API is the accessible reference; product has event/sub-event concepts | Do not claim registration API coverage from results docs or product help. |
| ACTIVE Network | Public asset/activity search and registration hand-off | Discovery import only; no participant/order round-trip via this API. |
| Movemint | Organizer workflow help; developer API reference inaccessible | No API-field/capability claims until verified. |

None of the sources justifies equating a sport/race distance with a purchasable registration product. Keep event structure, registration eligibility/options, price offers, participants and orders separate.
