<?php

namespace App\Http\Controllers\Gems;

use App\Http\Controllers\Controller;
use App\Http\Requests\GemsRequest;
use App\Models\Order\Gems;
use Yajra\DataTables\DataTables;

class GemsController extends Controller
{
    public function index()
    {
        return view('dashboard.gems.index');
    }

    public function table()
    {
        $gems = Gems::latest()->get();
        return DataTables::of($gems)
            ->editColumn('gems_amount', function ($gem) {
                return '<div class="d-flex align-items-center">
                            '.$gem->gems_amount.'
                            <img src="'.asset('assets/media/gem-coin.png').'" alt="gem" class="ml-1">
                        </div>';
            })
            ->editColumn('price', function ($gem) {
                return 'Rp.'.rupiah_format($gem->price).',-';
            })
            ->editColumn('discount_amount', function ($gem) {
                if ($gem->discount_amount) {
                    return '<span class="label label-danger label-inline label-sm font-weight-bold text-white">
                            '.$gem->discount_amount.' %
                            </span>';
                } else {
                    return '<span class="label label-danger label-inline label-sm font-weight-bold text-white">No Disc</span>';
                }
            })
            ->editColumn('action', function ($gem) {
                $editGemsUrl = route('gems.edit', $gem);
                $deleteGemsUrl = route('gems.delete', $gem);
                return '
                     <div class="row">
                        <a href="'.$editGemsUrl.'" class="btn btn-sm btn-clean btn-icon" title="Edit Gem">
                            <i class="la la-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-clean btn-icon btn-delete"
                             data-remote="'.$deleteGemsUrl.'" data-name="'.$gem->title.'"
                             title="Delete">
                            <i class="la la-trash"></i>
                        </button>
                     </div>
                    ';
            })
            ->rawColumns(['gems_amount', 'discount_amount', 'action'])
            ->make();
    }

    public function create()
    {
        $gem = new Gems();
        return view('dashboard.gems.create', compact('gem'));
    }

    public function store(GemsRequest $request)
    {
        Gems::create([
            'title' => $request->title,
            'gems_amount' => $request->amount,
            'price' => $request->price,
            'description' => $request->description,
            'discount_amount' => $request->discount_amount,
            'is_discount' => $request->is_discount ? 1 : 0
        ]);

        return redirect()->back()->with("success", "New Gems has been added.");
    }

    public function edit(Gems $gem)
    {
        return view('dashboard.gems.edit', compact('gem'));
    }

    public function update(GemsRequest $request, Gems $gem)
    {
        $gem->update([
            'title' => $request->title,
            'gems_amount' => $request->amount,
            'price' => $request->price,
            'description' => $request->description,
            'discount_amount' => $request->discount_amount,
            'is_discount' => $request->is_discount ? 1 : 0
        ]);

        return redirect()->route('gems.index')->with("success", "Gems has been edited.");
    }

    public function destroy(Gems $gem)
    {
        $gem->delete();
        return redirect()->back()->with("success", "Gems has been deleted.");
    }
}
