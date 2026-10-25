# ADR 0011: Namespaced extensions and synchronization metadata

- **Status:** Proposed; requires approval
- **Context:** Platforms expose unique fields and adapters need sync state, while a portable standard must prevent vendor fields from taking over its core vocabulary.
- **Options:** Allow arbitrary top-level fields; prefix keys with underscores/vendor names; use an explicit namespace-keyed extension object and adapter metadata out of band.
- **Recommendation:** Keep core fields governed by OmniEvent; retain unknown namespaced data under `extensions` keyed by a stable namespace URI. Put cursors, ETags, sync timestamps, capability profile and conflict state in adapter metadata outside canonical event/registration facts.
- **Trade-offs:** Extensions are opaque to generic consumers and require namespace governance for shared meanings; unknown fields can still round-trip without corrupting canonical semantics.
- **Migration impact:** Existing `_myplatform` or similar top-level keys should be preserved in a compatibility extension during migration, not silently discarded. Promotion to core requires crosswalk evidence and versioning.
