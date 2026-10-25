# ADR 0004: RegistrationOption and Offer are distinct

- **Status:** Proposed; requires approval
- **Context:** A single race can be sold through individual, corporate, charity, elite or relay entries and multiple price windows. A race and its product/price are not interchangeable.
- **Options:** (1) encode price/options on Race; (2) use schema.org Offer as the whole registration option; (3) define an OmniEvent RegistrationOption, with Offer/PriceTier children and separate Product add-ons.
- **Recommendation:** Choose (3). RegistrationOption defines participation and eligibility; Offer defines a commercial price/availability for that option; Product represents merchandise/add-ons. Map offers to Schema.org `Offer` when actual purchase semantics match.
- **Trade-offs:** Adds concepts and references but prevents loss of eligibility, relay/team rules and price periods. Schema.org projection cannot fully express registration policy.
- **Migration impact:** Legacy race-only records remain valid; add optional options and offers. Do not synthesize one offer per race unless the source actually reports price data.
