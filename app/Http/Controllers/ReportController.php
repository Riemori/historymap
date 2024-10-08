<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\local_detail;
use App\Models\local;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $statuses = Status::all();
        return view('reports.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $local = new local($request->all());
        $local_detail = new local_detail($request->all());

        $file = $request->file('photo2');
        // ファイル名だけだと、重複の可能性があるのでランダムな値を付与
        $local_detail->photo2 = \Str::orderedUuid() . '_' . $file->getClientOriginalName();
        DB::beginTransaction();
        try {
            $local->save();  // 報告の保存

            $local_detail['local_id'] = $local['id'];
            $local_detail->save();  // 報告の保存

            if (!Storage::putFileAs('photos/reports', $file, $local_detail->photo2)) {
                throw new \Exception('写真の保存に失敗しました。');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('reports.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
