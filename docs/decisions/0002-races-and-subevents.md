# ADR 0002: Canonical races and Schema.org sub-events

- **Status:** Proposed; requires approval
- **Context:** Existing canonical Event documents use `races[]`; PHP and WordPress Schema.org output use `subEvent`. Schema.org's hierarchy is general and does not label the child specifically as an endurance race.
- **Options:** (1) replace `races` with `subEvent`; (2) use `races` canonically and map to `subEvent`; (3) model races only as separate top-level nodes.
- **Recommendation:** Keep `races[]` as the canonical, typed Race collection. Project each Race to a `SportsEvent` child in Schema.org `subEvent`; use `superEvent` for a child's parent. Do not map registration options to `subEvent`.
- **Trade-offs:** The canonical name is not pure Schema.org vocabulary, but it has clear endurance meaning and retains backwards recognition. Projection must preserve IDs and parent relationships.
- **Migration impact:** Existing `races` data stays recognizable. Existing JSON-LD `subEvent` is importable only when the child can be confidently classified as a race; otherwise keep it an Event node or mark classification uncertain.
