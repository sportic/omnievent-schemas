---
layout: page
title: Inspiration & Prior Art
nav_order: 4
permalink: /inspiration/
---

# Inspiration & Prior Art

Omnievent Schemas did not emerge from a vacuum. It was shaped by a range of existing standards, open-data initiatives, and community projects. This page acknowledges that work, explains what we borrowed, and describes where we diverged.

---

## Direct Inspirations

### Schema.org/Event

**→ [https://schema.org/Event](https://schema.org/Event)**

Schema.org is the broadest and most widely adopted structured data vocabulary on the web. It is maintained by Google, Microsoft, Yahoo, and Yandex as a shared vocabulary for machine-readable content on web pages.

**What we borrowed:**
- The `Event` object name and core fields: `name`, `description`, `startDate`, `endDate`, `url`
- The `eventStatus` enum values: `EventScheduled`, `EventCancelled`, `EventPostponed`, `EventRescheduled`, `EventMovedOnline`
- The general philosophy of describing *what happened* with minimal required fields

**Why we went further:**
Schema.org's `Event` is designed for discoverability — it helps search engines understand that a web page describes an event. It has no concept of a `Race` (a sub-event with specific competitive rules), `Participant` (an athlete with registration data), or `Course` (a physical route). Omnievent Schemas builds on Schema.org's foundation and extends it for data exchange, not just discovery.

---

### govuk-content-schemas

**→ [https://github.com/alphagov/govuk-content-schemas](https://github.com/alphagov/govuk-content-schemas)**

The UK Government Digital Service (GDS) maintains a comprehensive JSON Schema-based system for all content published on GOV.UK. It is one of the best public examples of using JSON Schema at scale in production.

**What we borrowed:**
- The approach of publishing schemas as standalone JSON Schema documents accessible via URL
- The practice of separating `required` from `optional` fields in schema design
- The value of version-controlled, publicly available schemas as a contract between systems
- The `dist/` layout convention for publishing compiled/generated schema artefacts

**Why we didn't adopt it directly:**
govuk-content-schemas is deeply tied to the GOV.UK publishing pipeline and CMS. Its content types (news articles, guidance pages, consultations) are government-specific. We needed a schema system focused on competitive sports events, not government publishing.

---

## Tools & Libraries

### api-platform/schema-generator

**→ [https://github.com/api-platform/schema-generator](https://github.com/api-platform/schema-generator)**

API Platform's schema generator creates PHP entity classes from Schema.org vocabulary definitions. It was used in the early stages of Omnievent Schemas to scaffold the PHP model classes from Schema.org's `Event` type.

**How it influenced the project:**
- Demonstrated that Schema.org vocabularies can be used as a starting point for code generation
- The generated PHP models (`models/Events/Event.php`, `models/Races/Race.php`, etc.) have their roots in this approach

---

### swaggest/php-json-schema & php-code-builder

**→ [https://github.com/swaggest/php-json-schema](https://github.com/swaggest/php-json-schema)**  
**→ [https://github.com/swaggest/php-code-builder](https://github.com/swaggest/php-code-builder)**

The Swaggest ecosystem provides PHP tooling for JSON Schema validation and code generation. Omnievent Schemas uses these libraries for:
- Validating event data against the published schemas in PHP
- Generating typed PHP classes from the schema definitions

---

### opis/json-schema

**→ [https://github.com/opis/json-schema](https://github.com/opis/json-schema)**

A PHP JSON Schema validator that supports JSON Schema drafts 06 and 07. Used in test validation pipelines for Omnievent Schemas.

---

## Related Projects Worth Knowing

### OpenActive

**→ [https://openactive.io](https://openactive.io)**

OpenActive is a UK initiative (backed by Sport England and the ODI) to make it easier for people to find and take part in physical activity. It defines an open data standard for publishing physical activity opportunities.

**Similarities:**
- Open standard for physical activity data
- Built on JSON-LD and Schema.org
- Open governance model

**Differences:**
- Focused on leisure/participation activities (fitness classes, casual runs), not competitive endurance events
- Does not cover registration, results, or participant management
- UK-centric governance

OpenActive is a valuable complementary project — it covers the "get off the couch" end of the spectrum, while Omnievent Schemas covers the "I've signed up for a race" end.

---

### World Athletics Data Standards

**→ [https://www.worldathletics.org](https://www.worldathletics.org)**

World Athletics (formerly IAAF) maintains data standards for athletics competition results and records. These are authoritative but largely proprietary and designed for governing body use, not open platform interoperability.

**What we noted:**
- The importance of standardised athlete identifiers (World Athletics ID)
- The need for result formats that can represent both individual and relay performances
- The challenge of reconciling national federation standards with international ones

---

### Parkrun Data

**→ [https://www.parkrun.com](https://www.parkrun.com)**

Parkrun is a global network of free, weekly 5K runs with a highly standardised data model. Every event has the same format, the same fields, and the same result structure. It is arguably the most successful example of a single, simple schema being applied consistently at global scale (2,000+ events per week, 10M+ participants).

**Key lesson borrowed:**
Simplicity is a feature. Parkrun's data model works precisely because it refuses to accommodate edge cases. Omnievent Schemas aspires to the same clarity for the broader endurance sports world.

---

### Strava API

**→ [https://developers.strava.com](https://developers.strava.com)**

Strava has become the de facto standard for individual activity data (GPS tracks, effort, pace, heart rate). The Strava API is a practical example of a sports data API achieving widespread third-party adoption.

**What we noted:**
- Developer-friendly documentation drives adoption more than technical elegance
- Consistent field naming and predictable response shapes matter more than optimising for edge cases
- OAuth-based access patterns (not directly relevant to schemas, but important for future API design)

**The gap Strava doesn't fill:**
Strava is post-event (activity data after the fact). It has no standard model for event registration, participant management, or pre-event race structure — exactly the space Omnievent Schemas addresses.

---

## Community & Ecosystem

Omnievent Schemas is part of the broader **Sportic** open-source ecosystem. Related projects:

- [sportic/omnievent-api](https://github.com/sportic) — REST API implementation using these schemas
- [sportic/omnievent-importers](https://github.com/sportic) — Platform-specific importers that normalise to Omnievent format

---

## Contribute to the Conversation

If you know of a standard, project, or dataset we should be aware of — or if you represent one of the projects mentioned here and want to discuss alignment — please open a discussion on GitHub.

[Open a Discussion →](https://github.com/sportic/omnievent-schemas/discussions)

We are actively looking for collaborators from:
- Race timing companies
- Registration platforms
- Results aggregators
- National and international sports federations
- Open data advocates
