<?php


namespace App\Repositories;


use App\ProvidersMargin;
use Illuminate\Support\Collection;

class ProviderMarginRepository
{

    /** @var ProvidersMargin */
    private $providerMargin;

    /**
     * ProviderRepository constructor.
     * @param ProvidersMargin $providerMargin
     */
    public function __construct(ProvidersMargin $providerMargin)
    {
        $this->providerMargin = $providerMargin;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->providerMargin->get();
    }

    /**
     * @return Collection
     */
    public function getCountryWithMargin(): Collection
    {
        return $this->providerMargin->pluck('margin', 'country');
    }

    /**
     * @param array $ids
     * @return bool|null
     */
    public function destroyByIds(array $ids): ?bool
    {
        return $this->providerMargin->whereIn('id', $ids)->delete();
    }

}
