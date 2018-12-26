<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CoverRequest;
use App\Repositories\CoverRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CoverController extends AppBaseController
{
    private $repository;

    public function __construct(CoverRepository $baseRepo)
    {
        $this->repository = $baseRepo;
    }

    public function index(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $covers = $this->repository->paginate(15);

        return view('admin.cover.index')->with('covers', $covers);
    }

    public function create()
    {
        return view('admin.cover.create');
    }

    public function store(CoverRequest $request)
    {
        $request->merge([
            'user_id' => auth()->id()
        ]);

        $input = $request->all();

        $cover = $this->repository->create($input);

        Flash::success('Cover saved successfully.');

        return redirect(route('covers.index'));
    }

    public function edit($id)
    {
        $cover = $this->repository->findWithoutFail($id);

        if (empty($cover)) {
            Flash::error('Cover not found');
            return redirect(route('covers.index'));
        }

        return view('admin.cover.edit')->with('cover', $cover);
    }

    public function update($id, CoverRequest $request)
    {
        $cover = $this->repository->findWithoutFail($id);

        if (empty($cover)) {
            Flash::error('Cover not found');
            return redirect(route('covers.index'));
        }

        $cover = $this->repository->update($request->all(), $id);

        Flash::success('Cover updated successfully.');

        return redirect(route('covers.index'));
    }

    public function destroy($id)
    {
        $cover = $this->repository->findWithoutFail($id);

        if (empty($cover)) {
            Flash::error('Cover not found');
            return redirect(route('covers.index'));
        }

        $this->repository->delete($id);

        Flash::success('Cover deleted successfully.');

        return redirect(route('covers.index'));
    }
}