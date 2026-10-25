# ADR 0010: PHP reference-model architecture

- **Status:** Proposed; requires approval
- **Context:** Repository contains generated Draft-07 schemas from `structure/`, PHP Schema.org models from Spatie, and an alternate legacy generator. Replacing the architecture would risk both published schemas and JSON-LD consumers.
- **Options:** Replace generator/models; make PHP classes the normative source; maintain language-neutral JSON Schema as normative and align PHP structures/models as implementations.
- **Recommendation:** Preserve `structure/` + `generate/all.php` for schema generation and existing Schema.org models for compatibility. Extend only after the canonical contract is approved; keep JSON Schema normative and PHP as one reference implementation. Fix dependency/source-of-truth issues as separately reviewed implementation work.
- **Trade-offs:** The JSON schema and PHP models may remain distinct implementations and need consistency tests; this is preferable to making the standard PHP-specific.
- **Migration impact:** Keep current classes, aliases, serialization and fixtures passing. Add new models/projection in additive changes, introduce generation consistency and cross-language fixtures, and deprecate old paths only through a documented release.
