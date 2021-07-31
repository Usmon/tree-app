<?php


namespace App\Services;

use App\Models\Tree;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TreeService
 * @package App\Services
 */
class TreeService
{
    /**
     * @param Collection $collection
     * @return array
     */
    public function getList(Collection $collection): array
    {
        return $collection->toArray();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function createCredentials(Request $request): array
    {
        return [
            'parent_id' => $request->json('parent_id'),
            'text' => $request->json('text'),
            'position' => $request->json('position')
        ];
    }

    /**
     * @param Tree $tree
     * @return array
     */
    public function getNodeId(Tree $tree): array
    {
        return ['node_id' => $tree->getAttribute('id')];
    }

    /**
     * @param Request $request
     * @return int
     */
    public function getId(Request $request): int
    {
        return $request->json('id');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function updateCredentials(Request $request): array
    {
        return [
            'id' => $request->json('id'),
            'text' => $request->json('text')
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function moveCredentials(Request $request): array
    {
        return [
            'parent_id' => $request->json('parent_id'),
            'children' => $request->json('children')
        ];
    }
}
