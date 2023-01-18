<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Memo\BulkDestroyMemo;
use App\Http\Requests\Admin\Memo\DestroyMemo;
use App\Http\Requests\Admin\Memo\IndexMemo;
use App\Http\Requests\Admin\Memo\StoreMemo;
use App\Http\Requests\Admin\Memo\UpdateMemo;
use App\Models\Memo;
use App\Models\DocType;
use App\Models\DetailMemo;
use App\Models\UserCedula;
use App\Models\RHM006;
use App\Models\Dependency;
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
use Carbon\Carbon;

class MemosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMemo $request
     * @return array|Factory|View
     */
    public function index(Memo $memo, IndexMemo $request)
    {
        $id = $memo->id;

        $logueado = auth()->id();
        $obtenerci=UserCedula::where('user_id', '=', $logueado)
                                ->select('cedula')
                                ->first();

        //return $obtenerci;

        $depen=RHM006::where('FuncNro', '=', $obtenerci['cedula'])
                                ->first();
        // // create and AdminListing instance for a specific model and
       $data = AdminListing::create(Memo::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'odependency_id', 'number_memo', 'ref', 'obs', 'date_doc', 'date_entry', 'date_exit', 'ddependency_id', 'admin_user_id', 'state_id', 'type_id'],

            // set columns to searchIn
            ['id', 'number_memo', 'ref', 'obs'],

            function ($query) use ($id) {
                $query

                  ->orderBy('id', 'DESC');
            }

            // function ($query) use ($logueado) {
            //     $query
            //          ->where('admin_user_id', '=', $logueado)
            //       ->orderBy('id', 'DESC');
            // }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.memo.index', ['data' => $data, 'depen' => $depen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */

    public function create()
    {
        $this->authorize('admin.memo.create');

        $logueado = auth()->id();
        $obtenerci=UserCedula::where('user_id', '=', $logueado)
                                ->select('cedula')
                                ->first();

        //return $obtenerci;

        $depen=RHM006::where('FuncNro', '=', $obtenerci['cedula'])
                                ->first();
        $local_dependencia = Dependency::where('code' , '=' , $depen->dpto->DepenCod)
                                ->first();

        $hoy=Carbon::now();
        //$hoy = $fecha->toJSON();

        $type=DocType::all();
        $odependency = Dependency::all();


        return view('admin.memo.create', compact('local_dependencia', 'logueado', 'hoy', 'type', 'odependency'));
    }



    public function createdetail(Memo $memo)
    {
        $this->authorize('admin.detail-memo.create');

        $logueado = auth()->id();
        $obtenerci=UserCedula::where('user_id', '=', $logueado)
                                ->select('cedula')
                                ->first();

        //return $obtenerci;

        $depen=RHM006::where('FuncNro', '=', $obtenerci['cedula'])
                                ->first();
        $local_dependencia = Dependency::where('code' , '=' , $depen->dpto->DepenCod)
                                ->first();

        $hoy=Carbon::now();
        //$hoy = $fecha->toJSON();


        return view('admin.detail-memo.create', compact('memo', 'local_dependencia', 'logueado', 'hoy'));
    }










    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMemo $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMemo $request)
    {
        //return $request;
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized ['type_id']=  $request->getTypeId();
        $sanitized ['odependency_id']=  $request->getOrigenId();


        // Store the Memo
        $memo = Memo::create($sanitized);

        $logueado = auth()->id();
        $obtenerci=UserCedula::where('user_id', '=', $logueado)
                                ->select('cedula')
                                ->first();

        //return $obtenerci;

        $depen=RHM006::where('FuncNro', '=', $obtenerci['cedula'])
                                ->first();
        $local_dependencia = Dependency::where('code' , '=' , $depen->dpto->DepenCod)
                                ->first();


        $hoy=Carbon::now();
        //$hoy = $fecha->toJSON();

        $detalle = new DetailMemo();

        $detalle->memo_id = $memo->id;
        $detalle->odependency_id = $memo->odependency_id;
        $detalle->ddependency_id =$local_dependencia->id;
        $detalle->date_entry=$hoy;
        $detalle->obs='';
        $detalle->state_id=3;
        $detalle->admin_user_id=1;
        $detalle->save();



        if ($request->ajax()) {
            return ['redirect' => url('admin/memos'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/memos');
    }

    /**
     * Display the specified resource.
     *
     * @param Memo $memo
     * @throws AuthorizationException
     * @return void
     */
    public function show(Memo $memo, IndexMemo $request)
    {
        //$this->authorize('admin.memo.show', $memo);

        // TODO your code goes here
        $id = $memo->id;
        $logueado = auth()->id();
        $obtenerci=UserCedula::where('user_id', '=', $logueado)
                                ->select('cedula')
                                ->first();

        //return $obtenerci;

        $depen=RHM006::where('FuncNro', '=', $obtenerci['cedula'])
                                ->first();
        $local_dependencia = Dependency::where('code' , '=' , $depen->dpto->DepenCod)
                                ->first();

        $hoy=Carbon::now();
        //$hoy = $fecha->toJSON();

        // $detalle = DetailMemo::where('memo_id', '=', $id)
        //                         ->first();


        //return $detalle->ddependency_id;
        // // create and AdminListing instance for a specific model and
        $data = AdminListing::create(DetailMemo::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'memo_id', 'odependency_id', 'ddependency_id', 'date_entry', 'date_exit', 'obs', 'state_id', 'admin_user_id'],

            // set columns to searchIn
            ['id', 'obs'],

            function ($query) use ($id) {
                                   $query
                        ->where('detail_memos.memo_id', '=', $id);

            }


        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.memo.show', compact('memo', 'data', 'depen', 'local_dependencia'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Memo $memo
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Memo $memo)
    {
        $this->authorize('admin.memo.edit', $memo);



        $id = $memo->id;
        $logueado = auth()->id();
        $obtenerci=UserCedula::where('user_id', '=', $logueado)
                                ->select('cedula')
                                ->first();

        //return $obtenerci;

        $depen=RHM006::where('FuncNro', '=', $obtenerci['cedula'])
                                ->first();

        $type=DocType::all();
        $odependency=Dependency::all();

        return view('admin.memo.edit', [
            'memo' => $memo,
            'type' => $type,
            'odependency' => $odependency,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMemo $request
     * @param Memo $memo
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMemo $request, Memo $memo)
    {
        //return $request;
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized ['type_id']=  $request->getTypeId();
        $sanitized ['odependency_id']=  $request->getOrigenId();


        // Update changed values Memo
        $memo->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/memos'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/memos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMemo $request
     * @param Memo $memo
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMemo $request, Memo $memo)
    {
        $memo->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMemo $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMemo $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Memo::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
