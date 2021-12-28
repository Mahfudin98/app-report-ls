<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportWebCollection;
use App\Models\ReportPage;
use App\Models\ReportWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReportWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = ReportWeb::with(['page'])->orderBy('date', 'DESC');
        return new ReportWebCollection($report->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $name = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name =
                    Str::slug($request->date) .
                    '-' .
                    time() .
                    '.' .
                    $file->getClientOriginalExtension();
                $file->storeAs('public/report-webs', $name);
            }
            $web = ReportWeb::create([
                'url' => $request->url,
                'total' => 0,
                'date' => $request->date,
                'image' => $name,
            ]);
            $webs = ReportWeb::find($web['id']);
            foreach ($data['page'] as $item => $value) {
                $page = [
                    'report_web_id' => $web->id,
                    'page' => $data['page'][$item],
                    'count' => $data['count'][$item],
                    'date' => $request->date,
                ];
                $pages = ReportPage::create($page);
                $webs->update([
                    'total' => array_sum($data['count']),
                ]);
            }
            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportWeb  $reportWeb
     * @return \Illuminate\Http\Response
     */
    public function show(ReportWeb $reportWeb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportWeb  $reportWeb
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportWeb $reportWeb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportWeb  $reportWeb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportWeb $reportWeb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportWeb  $reportWeb
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportWeb $reportWeb)
    {
        //
    }

    public function barChart()
    {
        $year = request()->year;
        $mounth = request()->month;
        $filter = $year . '-' . $mounth;

        $data = [];
        $web = ReportWeb::where('date', 'LIKE', '%' . $filter . '%')->orderBy('total', 'DESC')->get();
        foreach ($web as $rows) {
            $data[] = [
                'labels' => $rows->date,
                'total' => $rows->total
            ];
        }

        return $data;
    }
}
