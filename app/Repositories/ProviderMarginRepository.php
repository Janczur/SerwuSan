<?php


namespace App\Repositories;


use App\ProvidersMargin;
use Illuminate\Database\Eloquent\Builder;
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
     * @param array $ids
     * @return bool|null
     */
    public function destroyByIds(array $ids): ?bool
    {
        return $this->providerMargin->whereIn('id', $ids)->delete();
    }

}
