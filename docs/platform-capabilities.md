# Platform capability boundaries

This table is intentionally conservative. “Yes” means the referenced public documentation demonstrates an operation or data surface, not that every account can call it. “Unverified” is not a claim that a capability does not exist.

| Platform surface | Read/import | Create | Update | Evidence and boundary |
|---|---|---|---|---|
| RunSignup race and registration configuration | Yes, with API credentials and method-specific options | Race creation documented but permissioned; **per-field unverified** | Registration configuration writes **per-resource unverified** | [API overview](https://runsignup.com/API/DocOverview), [methods](https://runsignup.com/API/Methods), [Get Race](https://runsignup.com/API/race/:race_id/GET), [race creation help](https://help.runsignup.com/support/solutions/articles/17000065645-creating-a-race-through-the-api). |
| RunSignup participants | Yes | Add participant documented | Edit participant documented | [Get participants](https://runsignup.com/API/race/:race_id/participants/GET), [Add or edit](https://runsignup.com/API/race/:race_id/participants/POST). API key/secret, OAuth, race ownership/permissions and field restrictions apply. |
| RunSignup questions, teams/groups, coupons | Read/manage methods exist in API documentation; exact endpoints and field scope should be rechecked when implementing | Method-dependent | Method-dependent | [API methods](https://runsignup.com/API/Methods). Do not infer blanket CRUD or include these actions in an adapter capability declaration without endpoint-level verification. |
| Race Roster results API | Results integration surface is documented | Results writes may be part of the results API; not event registration | Results changes are not registration updates | [Results API reference](https://developers.raceroster.com/docs/api/results/). Registration API CRUD remains **unverified**. |
| Race Roster event/registration resources | **Unverified** | **Unverified** | **Unverified** | The accessible reference does not establish a complete event/registration API. Request current official endpoint documentation and credentials. |
| ACTIVE Activity Search API v2 | Yes: public activity/asset discovery, with registration hand-off | No in this API | No in this API | [Activity Search API](https://developer.active.com/docs/v2_Activity_API_Search), [I/O docs](https://developer.active.com/io-docs), [FAQ](https://developer.active.com/developer_faq). Do not confuse discovery with ACTIVE's separate organizer products. |
| Movemint developer API | **Unverified** | **Unverified** | **Unverified** | [Developer docs](https://docs.movemint.cc/developers) was not retrievable in this environment. Official organizer help pages describe user workflows, not API operations. |

## Adapter permissions and synchronization contract

Every adapter implementation should publish a machine-readable capability profile, scoped to the API product/version and credential:

```json
{
  "platform": "urn:omnievent:platform:runsignup",
  "apiVersion": "unverified-until-captured",
  "capabilities": {
    "event.read": "supported",
    "registrationConfiguration.read": "supported",
    "registrationConfiguration.create": "permission-dependent",
    "participant.read": "supported",
    "participant.create": "supported",
    "participant.update": "supported",
    "order.read": "unverified"
  },
  "evidence": [
    "https://runsignup.com/API/race/:race_id/participants/GET",
    "https://runsignup.com/API/race/:race_id/participants/POST"
  ]
}
```

`supported`, `unsupported`, `permission-dependent`, and `unverified` are adapter capability values, not platform-wide guarantees. A production adapter should record the documentation/API version and evidence URL, effective scopes/permissions (without secrets), last verified time, and the actual endpoint operation it can call. It must report unsupported fields and rejected writes explicitly; never silently drop them or claim a successful round trip.
