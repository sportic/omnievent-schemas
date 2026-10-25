# ADR 0006: Exact money, date-time and measurement representations

- **Status:** Proposed; requires approval
- **Context:** Registration fees and event dates must survive cross-platform import without ambiguous timezone assumptions or binary floating-point loss.
- **Options:** Floating point plus currency symbol; integer minor units; decimal text plus ISO currency. Use local timestamps without zone or explicit ISO timestamps and IANA zone. Use bare measures or standardized unit codes.
- **Recommendation:** Money uses decimal strings and ISO 4217 currency, with disclosed components separate; no currency conversion. Calendar dates remain date-only; instants use ISO 8601/RFC 3339 with explicit offset and separate IANA zone when known. Measurements use numeric value plus UN/CEFACT unit code where available.
- **Trade-offs:** Decimal parsing and currency-specific precision require validation; timezone IDs and source unit provenance must be retained. Precision is preferred over convenience.
- **Migration impact:** Existing date-only event dates stay date-only. Legacy fees without currency/precision context remain unresolved; do not fabricate currency, timezone or decimals during conversion.
