# ADR 0009: Schema dialect and versioning

- **Status:** Proposed; requires approval
- **Context:** Current schemas declare Draft-07 and their URLs are fixed raw `main` references. A new contract needs versioned evolution without breaking existing validators.
- **Options:** (1) update existing documents in place; (2) keep Draft-07 for expanded v2, publish versioned schema IDs and later evaluate a draft upgrade; (3) immediately switch current schemas and references to a newer draft.
- **Recommendation:** Retain existing v1 schema URLs and Draft-07 behavior. Propose expanded schemas under an explicit v2/versioned identifier, initially Draft-07 for compatibility with repository tooling; evaluate newer drafts separately with validator and consumer evidence. Make compatibility/deprecation policy explicit before publication.
- **Trade-offs:** Supporting legacy and new schemas costs maintenance. It avoids an unreviewed semantic/dialect break and lets independent implementations select a contract.
- **Migration impact:** `generate/all.php` remains the generation path unless implementation evidence warrants change. Generated artifacts must be reproducible and checked; no in-place change to current `dist/` in Phase 1.
