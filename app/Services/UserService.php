<?php

namespace App\Services;

use App\Enums\UserSortableAttributeEnum;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserService
{
    public function index(Collection $params): mixed
    {
        return Cache::tags($params->map(fn ($value, $key) => $key . '-' . $value))
            ->remember('users', 600, fn () => User::query()
                ->select([
                    'id',
                    'name',
                    'phone',
                    'created_at',
                ])
                ->when(
                    $params->get('sort_by'),
                    fn (Builder $query, string $sortableAttributeName) => $query->orderBy(
                        UserSortableAttributeEnum::fromName($sortableAttributeName)->value,
                        $params->get('sort_desc') ? 'desc' : 'asc'
                    )
                )
                ->orderByDesc('id')
                ->paginate());
    }

    public function store(array $params): void
    {
        User::query()->create($params);
    }

    public function update(Collection $params): void
    {
        User::query()
            ->where('id', $params->get('id'))
            ->update($params->only(['phone', 'name'])->toArray());
    }

    public function destroy(int $id): void
    {
        User::query()
            ->where('id', $id)
            ->delete();
    }
}