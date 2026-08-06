---
layout: page
title: Schemas & Examples
nav_order: 3
permalink: /schemas/
---

# Schemas & Examples

All schemas are published as JSON Schema Draft-07 documents and hosted on GitHub. They can be referenced directly via URL in any JSON Schema validator.

---

## Schema Index

| Schema | URL | Required Fields |
|--------|-----|-----------------|
| Event | [`/dist/event/schema.json`](https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/event/schema.json) | `name`, `startDate`, `eventStatus` |
| Race | [`/dist/race/schema.json`](https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/race/schema.json) | `name` |
| Course | [`/dist/course/schema.json`](https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/course/schema.json) | *(none)* |

---

## Event Schema

An **Event** is the top-level object. It describes a sporting occasion that may contain one or more races.

```json
{
  "$schema": "http://json-schema.org/draft-07/schema",
  "title": "Event schema",
  "required": ["name", "startDate", "eventStatus"],
  "properties": {
    "name":        { "type": "string" },
    "description": { "type": "string" },
    "startDate":   { "type": "string", "format": "date" },
    "endDate":     { "type": "string", "format": "date" },
    "eventStatus": {
      "enum": ["EventCancelled","EventMovedOnline","EventPostponed",
               "EventRescheduled","EventScheduled"],
      "default": "EventScheduled"
    },
    "url":   { "type": "string", "format": "uri" },
    "races": { "type": "array", "items": { "$ref": "...race/schema.json" } }
  }
}
```

### Event — minimal example

```json
{
  "name": "City Marathon 2025",
  "startDate": "2025-10-12",
  "eventStatus": "EventScheduled"
}
```

### Event — full example

```json
{
  "name": "World Marathon",
  "startDate": "2025-04-06",
  "endDate": "2025-04-06",
  "eventStatus": "EventScheduled",
  "description": "The world's most iconic 42.195 km road race.",
  "url": "https://example.com/world-marathon",
  "races": [
    {
      "name": "Marathon",
      "startTime": "2025-04-06T08:00:00Z",
      "participation": "solo"
    },
    {
      "name": "Half Marathon",
      "startTime": "2025-04-06T09:30:00Z",
      "participation": "solo"
    },
    {
      "name": "Corporate Relay",
      "startTime": "2025-04-06T10:00:00Z",
      "participation": "relay"
    }
  ]
}
```

---

## Race Schema

A **Race** is a specific competitive distance or category within an event.

```json
{
  "$schema": "http://json-schema.org/draft-07/schema",
  "title": "Race schema",
  "required": ["name"],
  "properties": {
    "name":          { "type": "string" },
    "startTime":     { "type": "string", "format": "date-time" },
    "participation": {
      "enum": ["solo", "team", "relay"],
      "default": "solo"
    }
  }
}
```

### Race — examples

**Solo road race:**
```json
{ "name": "10K Run", "participation": "solo" }
```

**Team race:**
```json
{
  "name": "Mixed Team Triathlon",
  "startTime": "2025-06-15T07:30:00Z",
  "participation": "team"
}
```

**Relay:**
```json
{
  "name": "4 x 10km Relay",
  "startTime": "2025-06-15T08:00:00Z",
  "participation": "relay"
}
```

---

## Course Schema

A **Course** describes the physical route of a race. Currently minimal — extended fields (distance, elevation, GPX reference) are on the roadmap.

```json
{
  "$schema": "http://json-schema.org/draft-07/schema",
  "title": "Course schema",
  "properties": {
    "topology": { "type": "string" }
  }
}
```

**Example:**
```json
{ "topology": "loop" }
```

---

## Using the Schemas for Validation

### PHP (via swaggest/php-json-schema)

```php
use Swaggest\JsonSchema\Schema;

$schema = Schema::import(
    json_decode(
        file_get_contents(
            'https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/event/schema.json'
        )
    )
);

$data = json_decode('{"name":"My Race","startDate":"2025-06-01","eventStatus":"EventScheduled"}');
$schema->in($data); // throws on validation failure
```

### JavaScript / Node.js (via ajv)

```javascript
import Ajv from 'ajv';
import addFormats from 'ajv-formats';
import fetch from 'node-fetch';

const ajv = new Ajv();
addFormats(ajv);

const schema = await fetch(
  'https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/event/schema.json'
).then(r => r.json());

const validate = ajv.compile(schema);

const event = {
  name: 'City 10K',
  startDate: '2025-09-20',
  eventStatus: 'EventScheduled'
};

if (!validate(event)) {
  console.error(validate.errors);
}
```

### Python (via jsonschema)

```python
import requests
import jsonschema

schema = requests.get(
    "https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/event/schema.json"
).json()

event = {
    "name": "Mountain Trail 50K",
    "startDate": "2025-08-03",
    "eventStatus": "EventScheduled"
}

jsonschema.validate(instance=event, schema=schema)
```

---

## Extending the Schemas

The schemas are intentionally minimal. Platforms can add their own fields without breaking compliance:

```json
{
  "name": "City Marathon 2025",
  "startDate": "2025-10-12",
  "eventStatus": "EventScheduled",
  "_myplatform": {
    "internalId": 12345,
    "registrationOpen": true
  }
}
```

By convention, platform-specific extensions should use a prefixed key (e.g., `_yourplatform`) to avoid collision with future standard fields.

---

## Download Schemas

- [event/schema.json](https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/event/schema.json)
- [race/schema.json](https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/race/schema.json)
- [course/schema.json](https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/course/schema.json)

Or clone the full repository:

```bash
git clone https://github.com/sportic/omnievent-schemas.git
```
