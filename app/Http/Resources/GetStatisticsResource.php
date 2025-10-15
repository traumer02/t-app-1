<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class GetStatisticsResource extends JsonResource
{

    /**
     * @var string
     */
    private string $generatedAt;

    /**
     * @var \Illuminate\Support\Collection
     */
    private Collection $totals;

    /**
     * @var \Illuminate\Support\Collection
     */
    private Collection $byStatuses;

    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->generatedAt = $resource->get('generatedAt');
        $this->totals      = $resource->get('totals');
        $this->byStatuses  = $resource->get('byStatuses');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'generated_at' => $this->generatedAt,
            'totals'       => $this->totals->toArray(),
            'byStatuses'   => $this->prepareByStatus($this->byStatuses),
        ];
    }

    /**
     * @param \Illuminate\Support\Collection $byStatuses
     *
     * @return array
     */
    private function prepareByStatus(Collection $byStatuses): array
    {
        return [
            'day'    => $this->prepareDay($byStatuses->get('day')),
            'week'   => $this->prepareWeek($byStatuses->get('week')),
            'months' => $this->prepareMonth($byStatuses->get('month')),
        ];
    }

    /**
     * @param \Illuminate\Support\Collection $byStatuses
     *
     * @return array
     */
    private function prepareDay(Collection $byStatuses): array
    {
        return [
            'new'      => $byStatuses->get(0)->count ?? 0,
            'pending'  => $byStatuses->get(1)->count ?? 0,
            'approved' => $byStatuses->get(2)->count ?? 0,
        ];
    }

    /**
     * @param \Illuminate\Support\Collection $byStatuses
     *
     * @return array
     */
    private function prepareWeek(Collection $byStatuses): array
    {
        return [
            'new'      => $byStatuses->get(0)->count ?? 0,
            'pending'  => $byStatuses->get(1)->count ?? 0,
            'approved' => $byStatuses->get(2)->count ?? 0,
        ];
    }

    /**
     * @param \Illuminate\Support\Collection $byStatuses
     *
     * @return array
     */
    private function prepareMonth(Collection $byStatuses): array
    {
        return [
            'new'      => $byStatuses->get(0)->count ?? 0,
            'pending'  => $byStatuses->get(1)->count ?? 0,
            'approved' => $byStatuses->get(2)->count ?? 0,
        ];
    }
}
