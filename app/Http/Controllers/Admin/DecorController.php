<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DecorRequest;
use App\Repositories\DecorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DecorController extends AppBaseController
{
    private $repository;

    public function __construct(DecorRepository $baseRepo)
    {
        $this->repository = $baseRepo;
    }

    public function index(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $decors = $this->repository->paginate(15);

        return view('admin.decor.index')->with('decors', $decors);
    }

    public function create()
    {
        return view('admin.decor.create');
    }

    public function store(DecorRequest $request)
    {
        $request->merge([
            'user_id' => auth()->id()
        ]);

        $input = $request->all();

        $decor = $this->repository->create($input);

        Flash::success('Decor saved successfully.');

        return redirect(route('decors.index'));
    }

    public function edit($id)
    {
        $decor = $this->repository->findWithoutFail($id);

        if (empty($decor)) {
            Flash::error('Decor not found');
            return redirect(route('decors.index'));
        }

        return view('admin.decor.edit')->with('decor', $decor);
    }

    public function update($id, DecorRequest $request)
    {
        $decor = $this->repository->findWithoutFail($id);

        if (empty($decor)) {
            Flash::error('Decor not found');
            return redirect(route('decors.index'));
        }

        $decor = $this->repository->update($request->all(), $id);

        Flash::success('Decor updated successfully.');

        return redirect(route('decors.index'));
    }

    public function destroy($id)
    {
        $decor = $this->repository->findWithoutFail($id);

        if (empty($decor)) {
            Flash::error('Decor not found');
            return redirect(route('decors.index'));
        }

        $this->repository->delete($id);

        Flash::success('Decor deleted successfully.');

        return redirect(route('decors.index'));
    }
}