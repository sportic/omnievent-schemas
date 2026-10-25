---
layout: home
title: Home
nav_order: 1
---

# Omnievent Schemas

**An open standard for endurance sports data — built to connect platforms, not lock them in.**

---

## The Problem

The endurance sports world is fragmented. Running events, cycling races, triathlons, trail ultras — each platform (race directors, timing companies, registration portals, results services) stores and shares data in its own proprietary format.

This means:

- 🔄 Platforms can't exchange data without expensive custom integrations
- 📋 Event organisers enter the same information on five different systems
- 🧩 Athletes can't easily move their registration or results history between services
- 📊 Analytics and aggregation tools have to reverse-engineer every source

**Omnievent Schemas is the missing bridge.**

---

## What It Is

Omnievent Schemas defines a **common JSON Schema vocabulary** for the core data objects of endurance events:

| Current published schema | Covers |
|--------------------------|--------|
| **Event** | Name, description, date-only start/end, status, URL, races |
| **Race** | Name, start time, participation type (solo / team / relay) |
| **Course** | Topology |

PHP Schema.org models also cover registration-related types, but participant, registration, order and question models do not currently have corresponding published JSON Schemas.

Built on [JSON Schema Draft-07](https://json-schema.org/draft-07/json-schema-release-notes.html) and inspired by [Schema.org/Event](https://schema.org/Event), the vocabulary is intentionally **minimal, extensible, and language-agnostic**.

---

## Why It Matters

> "A standard that nobody uses is just documentation. A standard adopted by two platforms creates value for everyone."

Omnievent Schemas is designed to be adopted incrementally. A platform doesn't need to replace its internal model — it just needs to **export and import** using these schemas. The payoff compounds as more platforms join.

### For Race Organisers
Publish your event once. Let registrations, timing providers, and results aggregators consume the same feed automatically.

### For Platform Developers
Stop writing one-off importers. Validate incoming data with a single schema. Expose a standard-compliant API and be compatible with every other adopter out of the box.

### For Athletes
Your registration data, emergency contacts, and race history travel with you — not trapped inside a vendor's database.

---

## Quick Example

```json
{
  "name": "World Marathon",
  "startDate": "2025-04-06",
  "eventStatus": "EventScheduled",
  "races": [
    { "name": "Marathon", "participation": "solo" },
    { "name": "Half Marathon", "participation": "solo" },
    { "name": "Relay 4x10km", "participation": "relay" }
  ]
}
```

Validate it instantly against the [Event schema](https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/event/schema.json).

## Phase 1 architecture proposal

The registration and endurance-sport expansion is in the research and approval phase. The documents below are proposals, not implemented schemas or adapter guarantees:

- [Canonical architecture and example payloads](architecture.md)
- [Platform field crosswalk](crosswalk.md)
- [Platform capabilities and API boundaries](platform-capabilities.md)
- [Platform model evidence](research/platform-models.md)
- [Research gaps](research/gaps.md)
- [Architecture decision records](decisions/)

---

## Get Involved

Omnievent Schemas is open source (MIT licensed) and actively seeking collaborators:

- ⭐ **Star the repo** on [GitHub](https://github.com/sportic/omnievent-schemas)
- 🐛 **Open an issue** to propose a new field, report a gap, or challenge a decision
- 🔀 **Submit a pull request** — new schemas, better examples, translations
- 💬 **Start a discussion** if you represent a platform that wants to adopt the standard

[View on GitHub →](https://github.com/sportic/omnievent-schemas){: .btn}

---

*Built by [Gabriel Solomon](https://gabrielsolomon.ro) and the Sportic team. MIT License.*
