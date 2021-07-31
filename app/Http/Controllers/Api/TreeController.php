<?php

namespace App\Http\Controllers\Api;

use App\Services\TreeService;
use Illuminate\Http\JsonResponse;
use App\Repositories\TreeRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TreeRequest;

/**
 * Class TreeController
 * @package App\Http\Controllers
 */
final class TreeController extends Controller
{
    /**
     * @var TreeService
     */
    private $service;
    /**
     * @var TreeRepository
     */
    private $repository;

    /**
     * TreeController constructor.
     *
     * @param TreeService $service
     * @param TreeRepository $repository
     */
    public function __construct(TreeService $service, TreeRepository $repository)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return self::json($this->service->getList($this->repository->getTree()));
    }

    /**
     * @param TreeRequest $request
     * @return JsonResponse
     */
    public function create(TreeRequest $request): JsonResponse
    {
        return self::json($this->service->getNodeId($this->repository->create($this->service->createCredentials($request))));
    }

    /**
     * @param TreeRequest $request
     * @return JsonResponse
     */
    public function update(TreeRequest $request): JsonResponse
    {
        return self::json($this->service->getNodeId($this->repository->update($this->service->updateCredentials($request))));
    }

    /**
     * @param TreeRequest $request
     * @return JsonResponse
     */
    public function delete(TreeRequest $request): JsonResponse
    {

        return self::json(['result' => $this->repository->delete($this->service->getId($request))]);
    }

    /**
     * @param TreeRequest $request
     * @return JsonResponse
     */
    public function move(TreeRequest $request): JsonResponse
    {
        $this->repository->move($this->service->moveCredentials($request));
        return self::json(['message' => 'Moved']);
    }
}
