<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreamRequest;
use App\Repositories\CreamRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CreamController extends AppBaseController
{
    private $creamRepository;

    public function __construct(CreamRepository $baseRepo)
    {
        $this->creamRepository = $baseRepo;
    }

    public function index(Request $request)
    {
        $this->creamRepository->pushCriteria(new RequestCriteria($request));
        $creams = $this->creamRepository->paginate(15);

        return view('admin.cream.index')->with('creams', $creams);
    }

    public function create()
    {
        return view('admin.cream.create');
    }

    public function store(CreamRequest $request)
    {
        $request->merge([
            'user_id' => auth()->id()
        ]);

        $input = $request->all();

        $cream = $this->creamRepository->create($input);

        Flash::success('Cream saved successfully.');

        return redirect(route('creams.index'));
    }


    public function show($id)
    {
        $cream = $this->creamRepository->findWithoutFail($id);

        if (empty($cream)) {
            Flash::error('Cream not found');

            return redirect(route('creams.index'));
        }

        return view('admin.cream.show')->with('cream', $cream);
    }

    public function edit($id)
    {
        $cream = $this->creamRepository->findWithoutFail($id);

        if (empty($cream)) {
            Flash::error('Cream not found');

            return redirect(route('creams.index'));
        }

        return view('admin.cream.edit')->with('cream', $cream);
    }

    public function update($id, CreamRequest $request)
    {
        $cream = $this->creamRepository->findWithoutFail($id);

        if (empty($cream)) {
            Flash::error('Cream not found');

            return redirect(route('creams.index'));
        }

        $cream = $this->creamRepository->update($request->all(), $id);

        Flash::success('Cream updated successfully.');

        return redirect(route('creams.index'));
    }

    public function destroy($id)
    {
        $cream = $this->creamRepository->findWithoutFail($id);

        if (empty($cream)) {
            Flash::error('Cream not found');

            return redirect(route('creams.index'));
        }

        $this->creamRepository->delete($id);

        Flash::success('Cream deleted successfully.');

        return redirect(route('creams.index'));
    }
}