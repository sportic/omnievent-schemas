# ADR 0005: Entity identifiers, external IDs and references

- **Status:** Proposed; requires approval
- **Context:** Existing model behavior has `identifierExternal` on selected classes, and schema.org supports `identifier`; the schema structures do not define a shared canonical ID/reference contract.
- **Options:** (1) platform-local IDs only; (2) one canonical absolute URI per entity plus scoped external ID records; (3) random IDs without source mapping. Embed everything or use platform-specific references.
- **Recommendation:** Give each entity a stable absolute-URI `id`; preserve each source ID as `{system, value}` in `externalIdentifiers[]`. Embed small event snapshots and use `{ref: absolute-uri}` for normalized/cyclic relationships. JSON-LD projection emits the canonical ID as `@id`.
- **Trade-offs:** Producers must allocate stable URI namespaces and consumers must resolve refs; source identity and round trips become explicit and safe across platforms.
- **Migration impact:** Map legacy `identifierExternal` to one scoped external identifier only when its source system is known; otherwise preserve it as unscoped legacy data and do not invent a namespace. Current JSON-LD IDs can inform but not always determine canonical IDs.
