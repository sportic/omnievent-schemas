# ADR 0001: Canonical JSON and JSON-LD projection

- **Status:** Proposed; requires approval
- **Context:** The repository's exchange schemas are ordinary JSON Schema documents, while PHP models and the WordPress plugin serialize Schema.org JSON-LD. Adding a context/type to arbitrary OmniEvent JSON does not correctly map custom fields, IDs, dates or privacy.
- **Options:** (1) JSON-LD as the sole canonical payload; (2) canonical OmniEvent JSON with a separately specified JSON-LD projection; (3) Schema.org-only JSON.
- **Recommendation:** Use canonical platform-independent JSON validated by JSON Schema as the exchange format; make JSON-LD a deterministic, separately tested projection to Schema.org plus a stable OmniEvent namespace.
- **Trade-offs:** Two representations and a projector must be maintained; in return, registration concepts remain accurate and canonical data is easy to consume without JSON-LD tooling. JSON-LD consumers may not understand OmniEvent extension terms.
- **Migration impact:** Keep current schema output and Schema.org PHP serialization as the v1 compatibility baseline. Add a versioned canonical contract and an explicit converter; don't alter existing model serialization by implication.
