---
layout: page
title: Research & Decisions
nav_order: 2
permalink: /research/
---

# Research & Decisions

> **Status note (2026-10-25):** This page records earlier project research and historical design statements; it is not approval of the Phase 1 expansion or verification of every earlier claim. The current, evidence-qualified proposal is in [the architecture document](architecture.md), with platform-specific evidence in [the research report](research/platform-models.md), [crosswalk](crosswalk.md), and [open gaps](research/gaps.md). No implementation changes are authorized by those proposals.

This page documents the research that shaped Omnievent Schemas, the design decisions made, and the trade-offs considered along the way. Transparency here is intentional — we want collaborators to understand *why* things are the way they are, and to challenge us when they disagree.

---

## The Landscape We Studied

### Endurance Sports Platforms

Before writing a single line of schema, we catalogued the data formats used across the endurance sports ecosystem:

| Category | Examples |
|----------|---------|
| Event registration portals | RunSignUp, RaceRoster, Active.com, Eventbrite (sports), Sportic |
| Timing & results | RaceResult, MYLAPS, FinisherPix, Sportic Results |
| Event discovery | Running USA, Parkrun, Let's Do This |
| Governing bodies | World Athletics, ITU (World Triathlon), UCI |

**Key finding:** No two platforms agree on even the most basic field names. `startDate`, `start_date`, `date_start`, `eventDate`, and `race_date` all mean the same thing. Multiply that across dozens of fields and hundreds of platforms, and you have the root cause of integration hell.

### Existing Standards

We reviewed every relevant existing standard before deciding to create a new one:

| Standard | Strengths | Why it wasn't enough |
|----------|-----------|----------------------|
| **Schema.org/Event** | Broad adoption, SEO-friendly, covers basics | Too generic; no concept of "race" or "category"; focused on discovery, not data exchange |
| **iCalendar / iCal (RFC 5545)** | Universal calendar support | Text-based, no support for nested structures like races or registrations |
| **OpenActive** | UK-focused, covers physical activity broadly | Oriented toward leisure activity sessions, not competitive endurance events; governance is complex |
| **govuk-content-schemas** | Clear JSON Schema approach, well documented | UK government context; not sports-specific |
| **Strava API** | De facto standard for activity data | Proprietary; post-event only; no registration or event management data |

**Conclusion:** Schema.org/Event was the closest existing standard, so we chose to align with its vocabulary wherever possible (same field names, same enum values for `eventStatus`) while extending it with endurance-specific objects (`Race`, `Course`, participant data, registrations).

---

## Design Decisions

### 1. JSON Schema over other formats

**Options considered:** JSON Schema, XML Schema (XSD), Protocol Buffers, GraphQL SDL, OpenAPI.

**Decision:** JSON Schema Draft-07.

**Reasoning:**
- JSON is the lingua franca of web APIs — every platform already speaks it
- JSON Schema validators exist in every major programming language
- Draft-07 is widely supported and stable
- Schemas are human-readable and can be published as raw URLs (no toolchain required to consume them)
- Aligns with how [api-platform/schema-generator](https://github.com/api-platform/schema-generator) generates models from Schema.org vocabulary

### 2. Align with Schema.org vocabulary

**Decision:** Use Schema.org field names and enum values wherever a direct mapping exists.

**Reasoning:**
- Reduces the learning curve for developers already familiar with Schema.org
- Enables structured data markup (JSON-LD) for SEO without a separate vocabulary
- Future-proofs adoption as search engines and aggregators increasingly understand Schema.org natively
- `eventStatus` values (`EventScheduled`, `EventCancelled`, `EventPostponed`, etc.) are directly borrowed from Schema.org

### 3. Keep schemas minimal and non-prescriptive

**Decision:** Require only what is truly essential; make everything else optional.

**Required fields per schema:**
- Event: `name`, `startDate`, `eventStatus`
- Race: `name`
- Course: *(none)*

**Reasoning:**
- A standard that demands 30 required fields will never be adopted — the barrier is too high
- Real-world event data is often incomplete, especially at publication time
- Platforms can add validation on top of the base schemas for their own requirements
- It's easier to add required fields in a future version than to remove them

### 4. Nested `races` array inside `Event`

**Decision:** Races are embedded as an array within the Event object, referencing the Race schema via `$ref`.

**Alternatives considered:**
- Flat structure with foreign keys (rejected: requires a database-style join to reconstruct an event)
- Separate schema documents with no nesting (rejected: makes the most common operation — publishing a full event — unnecessarily complex)

**Trade-off:** Deeply nested JSON can be large. Accepted — most events have fewer than 10 races, and the payload size is negligible compared to the integration cost of flat structures.

### 5. Participation types: `solo`, `team`, `relay`

**Decision:** Race participation is limited to three enum values.

**Reasoning:**
- These three types cover the overwhelming majority of endurance event formats
- More granular types (e.g., "mixed relay", "corporate team") can be expressed via custom fields without breaking the standard
- Keeping enums small makes validation deterministic and documentation concise

### 6. PHP as the reference implementation

**Decision:** The reference models are written in PHP, using [swaggest/php-json-schema](https://github.com/swaggest/php-json-schema) and [swaggest/php-code-builder](https://github.com/swaggest/php-code-builder).

**Reasoning:**
- Sportic's existing platform is PHP-based — a PHP reference implementation is immediately useful
- PHP is widely used in the endurance sports ecosystem (many race management systems are PHP-based)
- The schemas themselves are language-agnostic; the PHP models are just one possible code generation target

**Note for other ecosystems:** The JSON Schema files in `/dist` are the canonical source of truth. Community contributions of generated models in other languages (Python, TypeScript, Go, etc.) are very welcome.

---

## Factors That Shaped the Schema

### Data collected across real events

The schemas were validated against real event data from multiple endurance sports platforms, including:
- Multi-race marathons with separate wave starts
- Triathlon events with swim/bike/run segments
- Trail ultra races with variable start times per category
- Relay events with team composition rules

Every field in the schema exists because a real platform needed to exchange it.

### The "importer problem"

One key design test: *can a platform write a generic importer that handles any compliant Event JSON without custom logic?* Every schema decision was evaluated against this criterion. Fields that required custom parsing logic per-event were either standardised or dropped.

### Privacy and PII considerations

Participant schemas deliberately do not include fields like passport numbers, payment card data, or health records — even though some platforms collect this data. The standard covers what needs to be *shared*, not everything that might be *stored*.

---

## Open Questions

These are areas where the standard is intentionally underdetermined, and community input is sought:

1. **Results data** — Should there be a `Result` schema linking a `Participant` to a `Race` with finish time, position, and splits? Draft work has started.
2. **Course geometry** — GPS track / route data (GPX/GeoJSON) integration is not yet defined.
3. **Pricing** — Registration pricing tiers and early-bird windows are common but complex to standardise.
4. **Localisation** — Multi-language event names and descriptions.
5. **Accessibility** — Fields to describe accessibility provisions at events.

[Open a discussion on GitHub →](https://github.com/sportic/omnievent-schemas/discussions)
