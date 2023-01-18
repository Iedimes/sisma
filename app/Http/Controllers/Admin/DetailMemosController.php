<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DetailMemo\BulkDestroyDetailMemo;
use App\Http\Requests\Admin\DetailMemo\DestroyDetailMemo;
use App\Http\Requests\Admin\DetailMemo\IndexDetailMemo;
use App\Http\Requests\Admin\DetailMemo\StoreDetailMemo;
use App\Http\Requests\Admin\DetailMemo\UpdateDetailMemo;
use App\Models\Memo;
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
use PDF;

class DetailMemosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDetailMemo $request
     * @return array|Factory|View
     */
    public function index(IndexDetailMemo $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(DetailMemo::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'memo_id', 'odependency_id', 'ddependency_id', 'date_entry', 'date_exit', 'obs', 'state_id', 'admin_user_id'],

            // set columns to searchIn
            ['id', 'obs']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.detail-memo.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.detail-memo.create');

        return view('admin.detail-memo.create');
    }

    public function pdf($id)
    {

        // return $help = Help::find(1024);

        // return $id;
        $memo = Memo::where('id', '=', $id)->first();

        $detalle = DetailMemo::where('memo_id', '=', $id)->orderBy('id')->get();

        $contar = count($detalle);


        $pdf = PDF::loadView('admin.memo.movimiento', compact('memo', 'detalle', 'contar'))->setPaper('a4', 'landscape');
        return $pdf->download('ReporteMovimiento.pdf');
        //return 'pdf';
        // retreive all records from db
        /*$data = Resume::all();

        // share data to view
        view()->share('employee', $data);
        $pdf = PDF::loadView('pdf_view', $data);

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');*/
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDetailMemo $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreDetailMemo $request)
    {
        //return $request;
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized ['state_id']=3;
        $sanitized ['admin_user_id']=1;
        $sanitized ['ddependency_id']=  $request->getDestinoId();

        // Store the DetailMemo
        $detailMemo = DetailMemo::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/memos/'.$request['memo_id'].'/show'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];

        }

        return redirect('admin/detail-memos');
    }

    /**
     * Display the specified resource.
     *
     * @param DetailMemo $detailMemo
     * @throws AuthorizationException
     * @return void
     */
    public function show(DetailMemo $detailMemo)
    {
        $this->authorize('admin.detail-memo.show', $detailMemo);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DetailMemo $detailMemo
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(DetailMemo $detailMemo)
    {
        $this->authorize('admin.detail-memo.edit', $detailMemo);


        return view('admin.detail-memo.edit', [
            'detailMemo' => $detailMemo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDetailMemo $request
     * @param DetailMemo $detailMemo
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateDetailMemo $request, DetailMemo $detailMemo)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values DetailMemo
        $detailMemo->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/detail-memos'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/detail-memos');
    }

    public function actualizar(UpdateDetailMemo $request, DetailMemo $detailMemo)
    {
        $logueado = auth()->id();
        //return $detailMemo->memo_id;
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized ['date_entry']=Carbon::now();//date('d-m-Y h:y:s');
        $sanitized ['state_id']=1;
        $sanitized ['admin_user_id']=$logueado;
        $sanitized ['obs']='DOCUMENTO RECEPCIONADO';

        // Update changed values DetailMemo
        $detailMemo->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/memos/'.$detailMemo['memo_id'].'/show'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/memos/'.$detailMemo['memo_id'].'/show');
    }

    public function enviar(UpdateDetailMemo $request, DetailMemo $detailMemo)
    {
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

        $ddependency = Dependency::all();
        //return $detailMemo->memo_id;
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized ['date_exit']=Carbon::now();//date('d-m-Y h:y:s');
        $sanitized ['state_id']=2;
        $sanitized ['admin_user_id']=$logueado;


        // Update changed values DetailMemo
        $detailMemo->update($sanitized);



        if ($request->ajax()) {
            return [
                'redirect' => url('admin/memos/'.$detailMemo['memo_id'].'/show'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return view('admin.detail-memo.createO', compact('detailMemo', 'local_dependencia', 'logueado', 'hoy', 'ddependency'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDetailMemo $request
     * @param DetailMemo $detailMemo
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyDetailMemo $request, DetailMemo $detailMemo)
    {
        $detailMemo->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyDetailMemo $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyDetailMemo $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    DetailMemo::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
