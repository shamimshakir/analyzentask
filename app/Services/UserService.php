<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Events\UserCreatedOrUpdated;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserService Implements UserServiceInterface
{
    public function __construct(
        protected User $model
    ){}

    public function index(): array|Collection
    {
        return $this->model::query()
            ->select('id','first_name', 'last_name', 'email', 'phone', 'photo')
            ->get();
    }

    public function find(string $id): Model|Collection|Builder|array|null
    {
        return $this->model::query()->find($id);
    }

    public function singleUser(string $id): Model|Collection|Builder|array|null
    {
        return $this->model::query()->with('addresses')->find($id);
    }

    public function store(array $data): Model|Builder
    {
        $data = $this->processImageData($data);
        $data['password'] = Hash::make($data['password']);

        $user = $this->model::query()->create($data);
        $addresses = $this->processAddressData($user, $data['addresses']);

        event(new UserCreatedOrUpdated($user, $addresses));

        return $user;
    }

    public function update(array $data, string $id): Model|Collection|Builder|array|null
    {
        $data = $this->processImageData($data);
        $user = $this->find($id);
        $user->addresses()->forceDelete();

        $addresses = $this->processAddressData($user, $data['addresses']);

        $user->addresses()->createMany($addresses);

        $user->update($data);
        return $user;
    }

    public function trash(string $id): void
    {
        $user = $this->find($id);
        $user->delete();
    }

    public function trashed(): array|Collection
    {
        return $this->model::onlyTrashed()
            ->select('id','first_name', 'last_name', 'email', 'phone', 'photo')
            ->get();
    }

    public function restore(string $id): void
    {
        $user = $this->model::onlyTrashed()->find($id);
        $user->restore();
    }

    public function destroy(string $id): void
    {
        $user = $this->model::onlyTrashed()->find($id);
        $user->forceDelete();
    }

    protected function processImageData(array $data): array
    {
        if (isset($data['photo'])) {
            $imageName = time() . '.' . $data['photo']->extension();
            $data['photo']->move(public_path('images'), $imageName);
            $data['photo'] = $imageName;
        }
        return $data;
    }

    public function processAddressData(Builder|Model $user, array $data): array
    {
        return array_map(fn($address) => [
            'address' => $address,
            'user_id' => $user->id,
        ], $data);
    }
}
