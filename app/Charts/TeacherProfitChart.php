<?php

declare(strict_types = 1);

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Course;
use App\Models\OrderLine;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class TeacherProfitChart extends BaseChart
{
    public ?string $name = 'profit';
    public ?string $routeName = 'teacher.profit';
    public ?string $prefix = 'teacher';
    public ?array $middlewares = ['web', 'auth', 'teacher'];
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $from = now()->subDays(15);
        $to = now();
        // dd($request->query('from'));
        if($request->query('from')!='null' && $request->query('to') != 'null') {
            $from = Carbon::createFromDate($request->query('from'));
            $to = Carbon::createFromDate($request->query('to'));
        }

        $orderLines = OrderLine::with('order','course.teacher');

        $orderLines = $orderLines->whereBetween(\DB::raw('date(created_at)'), [$from, $to]);


        $orderLines = $orderLines->whereHas('order', function($query) {
                $query->where('status', Order::SUCCESS);
            })
            ->whereHas('course', function($query) {
                $query->where('user_id', auth()->id());
                // $query->where('status', Course::PUBLISHED);
            })
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('d-m-Y');
            });

        \Log::info(json_encode($orderLines->toArray()));

        $data = [
            "labels" => [],
            "dataset" => []
        ];

        $interval = new \DateInterval('P1D');
        $to->add($interval);
        $period = new \DatePeriod($from, $interval, $to);

        foreach($period as $date) {
            $data['labels'][] = $date->format('d-m-Y');
            $data['dataset'][] = 0;
        }

        if ($orderLines->count()) {
            foreach($orderLines as $date => $orderLine) {
                // if (in_array($date, $data["labels"])) {
                //     $index = array_search($date, $data["labels"]);
                //     $data["dataset"][$index] = $orderLine->sum("price");
                // }
                // $data['labels'][] = $date;
                // $data['dataset'][] = $orderLine->sum("price");
                if( in_array($date, $data['labels']) ) {
                    $index = array_search($date, $data['labels']);
                    $data['dataset'][$index] = $orderLine->sum('price');
                }
            }
        }

        // return Chartisan::build()
        //     ->labels(['First', 'Second', 'Third'])
        //     ->dataset('Sample', [1, 2, 3])
        //     ->dataset('Sample 2', [3, 2, 1]);
        return Chartisan::build()
            ->labels($data["labels"])
            ->dataset(__("Beneficios"), $data["dataset"]);
    }
}