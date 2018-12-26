<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\BasesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BaseController extends AppBaseController
{
    private $baseRepository;

    public function __construct(BasesRepository $baseRepo)
    {
        $this->baseRepository = $baseRepo;
    }

    public function index(Request $request)
    {
        $this->baseRepository->pushCriteria(new RequestCriteria($request));
        $bases = $this->baseRepository->paginate(15);

        return view('admin.base.index')->with('bases', $bases);
    }

    public function create()
    {
        return view('admin.base.create');
    }

    public function store(BaseRequest $request)
    {
        $request->merge([
            'user_id' => auth()->id()
        ]);

        $input = $request->all();

        $base = $this->baseRepository->create($input);

        Flash::success('Base saved successfully.');

        return redirect(route('bases.index'));
    }


    public function show($id)
    {
        $base = $this->baseRepository->findWithoutFail($id);

        if (empty($base)) {
            Flash::error('Base not found');

            return redirect(route('bases.index'));
        }

        return view('admin.base.show')->with('base', $base);
    }

    public function edit($id)
    {
        $base = $this->baseRepository->findWithoutFail($id);

        if (empty($base)) {
            Flash::error('Base not found');

            return redirect(route('bases.index'));
        }

        return view('admin.base.edit')->with('base', $base);
    }

    public function update($id, BaseRequest $request)
    {
        $base = $this->baseRepository->findWithoutFail($id);

        if (empty($base)) {
            Flash::error('Base not found');

            return redirect(route('bases.index'));
        }

        $base = $this->baseRepository->update($request->all(), $id);

        Flash::success('Base updated successfully.');

        return redirect(route('bases.index'));
    }

    public function destroy($id)
    {
        $base = $this->baseRepository->findWithoutFail($id);

        if (empty($base)) {
            Flash::error('Base not found');

            return redirect(route('bases.index'));
        }

        $this->baseRepository->delete($id);

        Flash::success('Base deleted successfully.');

        return redirect(route('bases.index'));
    }
}