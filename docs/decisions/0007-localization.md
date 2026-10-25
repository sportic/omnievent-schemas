# ADR 0007: Multilingual event content

- **Status:** Proposed; requires approval
- **Context:** Event names and descriptions need translations while simple JSON and Schema.org projections remain easy to consume.
- **Options:** Replace every string with a localized object; use BCP 47-keyed translations alongside existing string fields; maintain separate event records per language only.
- **Recommendation:** Keep the default `name` and `description` as plain strings and add optional `translations` keyed by BCP 47 language tag. Use BCP 47 tags; choose an explicit default locale policy. JSON-LD projection emits selected values with language tags.
- **Trade-offs:** Default and translated values can drift; define whether the default locale must be repeated in `translations`. Multiple locale pages may need separate projection.
- **Migration impact:** Existing strings remain valid and mean default-language text. No guessed language tag is assigned to legacy content.
