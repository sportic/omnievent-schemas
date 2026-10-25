# ADR 0008: Eligibility, age and gender semantics

- **Status:** Proposed; requires approval and domain review
- **Context:** Eligibility rules, age-based pricing and competition categories are common but are not equivalent to personal identity. Schema.org `Person.gender` must not carry race eligibility rules.
- **Options:** Reuse `gender` for event categories; encode category labels as free text only; model eligibility rules separately and preserve source values.
- **Recommendation:** Define explicit eligibility rules, inclusive bounds, reference date/age calculation method and organizer category. Keep personal participant identity separate. Preserve unrecognized gender/category labels in source extensions; never infer a person's identity from a category or eligibility rule.
- **Trade-offs:** Requires careful vocabulary/version governance and privacy review; it avoids conflating sensitive personal data with organizer rules.
- **Migration impact:** Existing `gender` values in Participant remain source values, not automatic eligibility. No legacy values should be rewritten or used to infer eligibility.
