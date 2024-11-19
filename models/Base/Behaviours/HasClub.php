<?php

namespace Sportic\OmniEvent\Models\Base\Behaviours;

use Spatie\SchemaOrg\Organization;

trait HasClub
{
    public function clubByName(?string $name): static
    {
        if (empty($name)) {
            return $this;
        }
        $clubOrganization = $this->generateClubOrganization($name);

        $affiliation = $this->getProperty('affiliation');
        if ($affiliation instanceof Organization) {
            $affiliation = [$affiliation];
            $affiliation[] = $clubOrganization;
        } elseif (is_array($affiliation)) {
        } else {
            $affiliation = [];
        }
        $affiliation[] = $clubOrganization;
        return $this->setProperty('affiliation', $affiliation);
    }

    public function getClub(): ?Organization
    {
        $affiliation = $this->getProperty('affiliation');
        if ($affiliation instanceof Organization) {
            return $affiliation;
        }
        if (is_array($affiliation)) {
            foreach ($affiliation as $organization) {
                if ($organization instanceof Organization && $organization->getProperty('additionalType') === 'club') {
                    return $organization;
                }
            }
        }
        return null;
    }

    protected function generateClubOrganization($name)
    {
        $organization = new Organization();
        $organization->name($name);
        $organization->additionalType('club');
        return $organization;
    }
}