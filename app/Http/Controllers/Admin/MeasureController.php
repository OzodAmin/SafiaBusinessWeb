<?php

namespace App\Http\Controllers\Admin;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Controllers\AppBaseController;
use App\Repositories\MeasureRepository;
use App\Http\Requests\MeasureRequest;
use Illuminate\Http\Request;
use Response;
use Flash;

class MeasureController extends AppBaseController
{
    private $repository;

    public function __construct(MeasureRepository $baseRepo)
    {
        $this->repository = $baseRepo;
    }

    public function index(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $measures = $this->repository->paginate(15);

        return view('admin.measure.index')->with('measures', $measures);
    }

    public function create()
    {
        return view('admin.measure.create');
    }

    public function store(MeasureRequest $request)
    {
        $request->merge([
            'user_id' => auth()->id()
        ]);

        $input = $request->all();

        $measure = $this->repository->create($input);

        Flash::success('Measure saved successfully.');

        return redirect(route('measures.index'));
    }

    public function edit($id)
    {
        $measure = $this->repository->findWithoutFail($id);

        if (empty($measure)) {
            Flash::error('Measure not found');
            return redirect(route('measures.index'));
        }

        return view('admin.measure.edit')->with('measure', $measure);
    }

    public function update($id, MeasureRequest $request)
    {
        $measure = $this->repository->findWithoutFail($id);

        if (empty($measure)) {
            Flash::error('Measure not found');
            return redirect(route('measures.index'));
        }

        $measure = $this->repository->update($request->all(), $id);

        Flash::success('Measure updated successfully.');

        return redirect(route('measures.index'));
    }

    public function destroy($id)
    {
        $measure = $this->repository->findWithoutFail($id);

        if (empty($measure)) {
            Flash::error('Measure not found');
            return redirect(route('measures.index'));
        }

        $this->repository->delete($id);

        Flash::success('Measure deleted successfully.');

        return redirect(route('measures.index'));
    }
}