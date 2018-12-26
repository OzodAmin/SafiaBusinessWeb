<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SizeRequest;
use App\Repositories\SizeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SizeController extends AppBaseController
{
    private $repository;

    public function __construct(SizeRepository $repo)
    {
        $this->repository = $repo;
    }

    public function index(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $sizes = $this->repository->paginate(15);

        return view('admin.sizes.index')->with('sizes', $sizes);
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(SizeRequest $request)
    {
        $input = $request->all();

        $base = $this->repository->create($input);

        Flash::success('Size saved successfully.');

        return redirect(route('sizes.index'));
    }

    public function edit($id)
    {
        $size = $this->repository->findWithoutFail($id);

        if (empty($size)) {
            Flash::error('Size not found');

            return redirect(route('sizes.index'));
        }

        return view('admin.sizes.edit')->with('size', $size);
    }

    public function update($id, SizeRequest $request)
    {
        $size = $this->repository->findWithoutFail($id);

        if (empty($size)) {
            Flash::error('Size not found');
            return redirect(route('sizes.index'));
        }

        $size = $this->repository->update($request->all(), $id);

        Flash::success('Size updated successfully.');

        return redirect(route('sizes.index'));
    }

    public function destroy($id)
    {
        $size = $this->repository->findWithoutFail($id);

        if (empty($size)) {
            Flash::error('Size not found');
            return redirect(route('sizes.index'));
        }

        $this->repository->delete($id);
        Flash::success('Size deleted successfully.');
        return redirect(route('sizes.index'));
    }
}