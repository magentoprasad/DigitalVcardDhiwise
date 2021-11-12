<?php

namespace App\Http\Controllers\API\Device;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Device\BulkCreateServiceAPIRequest;
use App\Http\Requests\Device\BulkUpdateServiceAPIRequest;
use App\Http\Requests\Device\CreateServiceAPIRequest;
use App\Http\Requests\Device\UpdateServiceAPIRequest;
use App\Http\Resources\Device\ServiceCollection;
use App\Http\Resources\Device\ServiceResource;
use App\Repositories\ServiceRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends AppBaseController
{
    /**
     * @var ServiceRepository
     */
    private $serviceRepository;

    /**
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Service's Listing API.
     * Limit Param: limit
     * Skip Param: skip.
     *
     * @param Request $request
     *
     * @return ServiceCollection
     */
    public function index(Request $request): ServiceCollection
    {
        $services = $this->serviceRepository->all(
            $request->all(),
            $request->get('skip', null),
            $request->get('limit', null),
        );

        return new ServiceCollection($services);
    }

    /**
     * Create Service with given payload.
     *
     * @param CreateServiceAPIRequest $request
     *
     * @return ServiceResource
     */
    public function store(CreateServiceAPIRequest $request): ServiceResource
    {
        $input = $request->all();
        $service = $this->serviceRepository->create($input);

        return new ServiceResource($service);
    }

    /**
     * Get single Service record.
     *
     * @param int $id
     *
     * @return ServiceResource
     */
    public function show(int $id): ServiceResource
    {
        $service = $this->serviceRepository->findOrFail($id);

        return new ServiceResource($service);
    }

    /**
     * Update Service with given payload.
     *
     * @param UpdateServiceAPIRequest $request
     * @param int                     $id
     *
     * @return ServiceResource
     */
    public function update(UpdateServiceAPIRequest $request, int $id): ServiceResource
    {
        $input = $request->all();
        $service = $this->serviceRepository->update($input, $id);

        return new ServiceResource($service);
    }

    /**
     * Delete given Service.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->serviceRepository->delete($id);

        return $this->successResponse('Service deleted successfully.');
    }

    /**
     * Force Delete given Service.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function forceDelete(int $id): JsonResponse
    {
        $this->serviceRepository->forceDelete($id);

        return $this->successResponse('Service deleted successfully.');
    }

    /**
     * Bulk create Service's.
     *
     * @param BulkCreateServiceAPIRequest $request
     *
     * @return ServiceCollection
     */
    public function bulkStore(BulkCreateServiceAPIRequest $request): ServiceCollection
    {
        $services = collect();

        $input = $request->get('data');
        foreach ($input as $key => $serviceInput) {
            $services[$key] = $this->serviceRepository->create($serviceInput);
        }

        return new ServiceCollection($services);
    }

    /**
     * Bulk update Service's data.
     *
     * @param BulkUpdateServiceAPIRequest $request
     *
     * @return ServiceCollection
     */
    public function bulkUpdate(BulkUpdateServiceAPIRequest $request): ServiceCollection
    {
        $services = collect();

        $input = $request->get('data');
        foreach ($input as $key => $serviceInput) {
            $services[$key] = $this->serviceRepository->update($serviceInput, $serviceInput['id']);
        }

        return new ServiceCollection($services);
    }
}
