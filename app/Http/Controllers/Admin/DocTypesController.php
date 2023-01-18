<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocType\BulkDestroyDocType;
use App\Http\Requests\Admin\DocType\DestroyDocType;
use App\Http\Requests\Admin\DocType\IndexDocType;
use App\Http\Requests\Admin\DocType\StoreDocType;
use App\Http\Requests\Admin\DocType\UpdateDocType;
use App\Models\DocType;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DocTypesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDocType $request
     * @return array|Factory|View
     */
    public function index(IndexDocType $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(DocType::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.doc-type.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.doc-type.create');

        return view('admin.doc-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDocType $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreDocType $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the DocType
        $docType = DocType::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/doc-types'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/doc-types');
    }

    /**
     * Display the specified resource.
     *
     * @param DocType $docType
     * @throws AuthorizationException
     * @return void
     */
    public function show(DocType $docType)
    {
        $this->authorize('admin.doc-type.show', $docType);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DocType $docType
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(DocType $docType)
    {
        $this->authorize('admin.doc-type.edit', $docType);


        return view('admin.doc-type.edit', [
            'docType' => $docType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDocType $request
     * @param DocType $docType
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateDocType $request, DocType $docType)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values DocType
        $docType->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/doc-types'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/doc-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDocType $request
     * @param DocType $docType
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyDocType $request, DocType $docType)
    {
        $docType->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyDocType $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyDocType $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    DocType::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
