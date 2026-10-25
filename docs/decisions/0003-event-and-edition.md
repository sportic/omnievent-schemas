# ADR 0003: Event and edition model

- **Status:** Proposed; requires approval
- **Context:** Recurring race brands have yearly occurrences, while platforms may call both the brand and dated occurrence an event. An extra edition wrapper adds hierarchy and migration burden.
- **Options:** (1) `Event` is the dated occurrence and optional `EventSeries` groups occurrences; (2) mandatory `EventSeries` → `EventEdition` → `Event`; (3) one Event with mutable year/date history.
- **Recommendation:** A concrete dated occurrence is one `Event`; use optional `EventSeries` for recurring series. Do not require an `EventEdition` entity. Map the series relationship to Schema.org `EventSeries` and event `superEvent`.
- **Trade-offs:** An organizer's brand and annual event may require a distinction that is not enforced. Stable IDs, series metadata and external IDs keep that mapping explicit without an unnecessary wrapper.
- **Migration impact:** Existing Event remains the root entity. Consumers that currently treat one Event as an indefinitely recurring brand may need to create one Event per dated edition and attach a series.
