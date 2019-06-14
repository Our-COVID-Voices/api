<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Export;

use App\Http\Controllers\Controller;
use App\Http\Requests\Export\RequestExportRequest;
use App\Http\Resources\ExportResource;
use App\Models\Export;
use App\Services\ExportService;
use App\Support\Pagination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    /**
     * @var \App\Services\ExportService
     */
    protected $exportService;

    /**
     * RequestController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Support\Pagination $pagination
     * @param \App\Services\ExportService $exportService
     */
    public function __construct(
        Request $request,
        Pagination $pagination,
        ExportService $exportService
    ) {
        parent::__construct($request, $pagination);

        $this->middleware('auth');

        $this->exportService = $exportService;
    }

    /**
     * @param \App\Http\Requests\Export\RequestExportRequest $request
     * @param string $export
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RequestExportRequest $request, string $export): JsonResponse
    {
        $this->authorize('request', [Export::class, $export]);

        $export = DB::transaction(function () use ($request, $export): Export {
            return $this->exportService->create($export, $request->user()->admin);
        });

        return (new ExportResource($export))
            ->toResponse($request)
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
