<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReceiptRequest;
use App\Http\Requests\StoreReceiptRequest;
use App\Http\Requests\UpdateReceiptRequest;
use App\Models\Publisher;
use App\Models\Receipt;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReceiptController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('receipt_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Receipt::with(['completed_by', 'verified_by'])->select(sprintf('%s.*', (new Receipt())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'receipt_show';
                $editGate = 'receipt_edit';
                $deleteGate = 'receipt_delete';
                $crudRoutePart = 'receipts';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('worldwide_work', function ($row) {
                return $row->worldwide_work ? $row->worldwide_work : '';
            });
            $table->editColumn('local_congregation_expenses', function ($row) {
                return $row->local_congregation_expenses ? $row->local_congregation_expenses : '';
            });
            $table->editColumn('other', function ($row) {
                return $row->other ? $row->other : '';
            });
            $table->addColumn('completed_by_name', function ($row) {
                return $row->completed_by ? $row->completed_by->name : '';
            });

            $table->addColumn('verified_by_name', function ($row) {
                return $row->verified_by ? $row->verified_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'photo', 'completed_by', 'verified_by']);

            return $table->make(true);
        }

        return view('admin.receipts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('receipt_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $completed_bies = Publisher::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verified_bies = Publisher::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.receipts.create', compact('completed_bies', 'verified_bies'));
    }

    public function store(StoreReceiptRequest $request)
    {
        $receipt = Receipt::create($request->all());

        if ($request->input('photo', false)) {
            $receipt->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $receipt->id]);
        }

        return redirect()->route('admin.receipts.index');
    }

    public function edit(Receipt $receipt)
    {
        abort_if(Gate::denies('receipt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $completed_bies = Publisher::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verified_bies = Publisher::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $receipt->load('completed_by', 'verified_by');

        return view('admin.receipts.edit', compact('completed_bies', 'receipt', 'verified_bies'));
    }

    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
        $receipt->update($request->all());

        if ($request->input('photo', false)) {
            if (!$receipt->photo || $request->input('photo') !== $receipt->photo->file_name) {
                if ($receipt->photo) {
                    $receipt->photo->delete();
                }
                $receipt->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($receipt->photo) {
            $receipt->photo->delete();
        }

        return redirect()->route('admin.receipts.index');
    }

    public function show(Receipt $receipt)
    {
        abort_if(Gate::denies('receipt_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receipt->load('completed_by', 'verified_by');

        return view('admin.receipts.show', compact('receipt'));
    }

    public function destroy(Receipt $receipt)
    {
        abort_if(Gate::denies('receipt_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receipt->delete();

        return back();
    }

    public function massDestroy(MassDestroyReceiptRequest $request)
    {
        Receipt::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('receipt_create') && Gate::denies('receipt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Receipt();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
