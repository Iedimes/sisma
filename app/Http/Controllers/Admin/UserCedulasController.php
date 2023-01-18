<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCedula\BulkDestroyUserCedula;
use App\Http\Requests\Admin\UserCedula\DestroyUserCedula;
use App\Http\Requests\Admin\UserCedula\IndexUserCedula;
use App\Http\Requests\Admin\UserCedula\StoreUserCedula;
use App\Http\Requests\Admin\UserCedula\UpdateUserCedula;
use App\Models\UserCedula;
use App\Models\AdminUser;
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

class UserCedulasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexUserCedula $request
     * @return array|Factory|View
     */
    public function index(IndexUserCedula $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(UserCedula::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'user_id', 'cedula'],

            // set columns to searchIn
            ['id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.user-cedula.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.user-cedula.create');

        $user=AdminUser::all();

        return view('admin.user-cedula.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserCedula $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreUserCedula $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized ['user_id']=  $request->getUserId();

        // Store the UserCedula
        $userCedula = UserCedula::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/user-cedulas'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/user-cedulas');
    }

    /**
     * Display the specified resource.
     *
     * @param UserCedula $userCedula
     * @throws AuthorizationException
     * @return void
     */
    public function show(UserCedula $userCedula)
    {
        $this->authorize('admin.user-cedula.show', $userCedula);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserCedula $userCedula
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(UserCedula $userCedula)
    {
        $this->authorize('admin.user-cedula.edit', $userCedula);


        return view('admin.user-cedula.edit', [
            'userCedula' => $userCedula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserCedula $request
     * @param UserCedula $userCedula
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateUserCedula $request, UserCedula $userCedula)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values UserCedula
        $userCedula->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/user-cedulas'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/user-cedulas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyUserCedula $request
     * @param UserCedula $userCedula
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyUserCedula $request, UserCedula $userCedula)
    {
        $userCedula->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyUserCedula $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyUserCedula $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    UserCedula::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
