<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FillingRequest;
use App\Repositories\FillingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FillingController extends AppBaseController
{
    private $repository;

    public function __construct(FillingRepository $baseRepo)
    {
        $this->repository = $baseRepo;
    }

    public function index(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $fillings = $this->repository->paginate(15);

        return view('admin.filling.index')->with('fillings', $fillings);
    }

    public function create()
    {
        return view('admin.filling.create');
    }

    public function store(FillingRequest $request)
    {
        $request->merge([
            'user_id' => auth()->id()
        ]);

        $input = $request->all();

        $filling = $this->repository->create($input);

        Flash::success('Filling saved successfully.');

        return redirect(route('fillings.index'));
    }


    public function show($id)
    {
        $filling = $this->repository->findWithoutFail($id);

        if (empty($filling)) {
            Flash::error('Filling not found');
            return redirect(route('fillings.index'));
        }

        return view('admin.filling.show')->with('filling', $filling);
    }

    public function edit($id)
    {
        $filling = $this->repository->findWithoutFail($id);

        if (empty($filling)) {
            Flash::error('Filling not found');
            return redirect(route('fillings.index'));
        }

        return view('admin.filling.edit')->with('filling', $filling);
    }

    public function update($id, FillingRequest $request)
    {
        $filling = $this->repository->findWithoutFail($id);

        if (empty($filling)) {
            Flash::error('Filling not found');
            return redirect(route('fillings.index'));
        }

        $filling = $this->repository->update($request->all(), $id);

        Flash::success('Filling updated successfully.');

        return redirect(route('fillings.index'));
    }

    public function destroy($id)
    {
        $filling = $this->repository->findWithoutFail($id);

        if (empty($filling)) {
            Flash::error('Filling not found');
            return redirect(route('fillings.index'));
        }

        $this->repository->delete($id);

        Flash::success('Filling deleted successfully.');

        return redirect(route('fillings.index'));
    }
}