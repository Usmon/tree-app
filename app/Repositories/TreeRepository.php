<?php


namespace App\Repositories;

use App\Models\Tree;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TreeRepository
 *
 * @package App\Repositories
 */
class TreeRepository
{
    /**
     * @return Collection
     */
    public function getTree(): Collection
    {
        return Tree::query()
                    ->whereNull('parent_id')
                    ->with('children')
                    ->get();
    }

    /**
     * @param array $credentials
     * @return Tree
     */
    public function create(array $credentials): Tree
    {
        $tree =  new Tree($credentials);
        $tree->save();

        return $tree;
    }

    /**
     * @param array $credentials
     * @return Tree
     */
    public function update(array $credentials): Tree
    {
        $tree = $this->getById($credentials['id']);
        $tree->update(['text' => $credentials['text']]);

        return $tree->refresh();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->getById($id)->delete();
    }

    /**
     * @param array $credentials
     */
    public function move(array $credentials): void
    {
        foreach ($credentials['children'] as $position => $id) {
            $this->getById($id)
                 ->update([
                    'position' => $position,
                    'parent_id' => $credentials['parent_id']
                 ]);

        }
    }

    /**
     * @param int $id
     * @return Tree
     */
    public function getById(int $id): Tree
    {
        return Tree::find($id);
    }
}
