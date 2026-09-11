<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request) {
        // タイムゾーンと年月設定（Carbonを使用）
        $ym = $request->input('ym', date('Y-m'));

        try {
            $timestamp = Carbon::createFromFormat('Y-m-d', $ym . '-01');
        } catch(\Exception $e) {
            $ym = date('Y-m');
            $timestamp = Carbon::createFromFormat('Y-m-d', $ym . '-01');
        }

        $today = Carbon::today()->format('Y-m-d');
        $html_title = $timestamp->format('Y年n月');

        $prev = $timestamp->copy()->subMonth()->format('Y-m');
        $next = $timestamp->copy()->addMonth()->format('Y-m');

        $day_count = $timestamp->daysInMonth;
        $youbi = $timestamp->dayOfWeek;

        // DBから該当月の予定を一括取得 (Eloquent ORM)
        $start_date = $ym . '01';
        $end_date = sprintf('%s-%02d', $ym, $day_count);

        $schedules_from_db = Schedule::whereBetween('target_date', [$start_date, $end_date])->get();

        $schedules = [];
        foreach($schedules_from_db as $row) {
            $schedules[$row->target_date] = $row->plan;
        }

        // カレンダー用の <tr>/<td> HTML組み立て
        $weeks = [];
        $week = str_repeat('<td></td>', $youbi);

        for($day = 1; $day <= $day_count; $day++, $youbi++) {
            $date = sprintf('%s-%02d', $ym, $day);

            if($today == $date) {
                $week .= '<td class="today">';
            } else {
                $week .= '<td>';
            }

            if(isset($schedules[$date])) {
                $plan_text = e($schedules[$date]);
                $week .= '<a href="' . route('detail', ['date' => $date]) . '" class="day-number">' . $day . '</a>';
                $week .= '<a href="' . route('detail', ['date' => $date]) . '">';
                $week .= '<div class="badge bg-success d-block mt-1">' . $plan_text . '</div>';
                $week .= '</a>';
            } else {
                $week .= '<a href="' . route('add', ['date' => $date]) . '" class="day-number d-block h-100">' . $day . '</a>';
            }

            $week .= '</td>';
            if($youbi % 7 == 6 || $day == $day_count) {
                if($day == $day_count) {
                    $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
                }
                $weeks[] = '<tr>' . $week . '</tr>';
                $week = '';
            }

            
        }
        return view('index', compact('html_title', 'prev', 'next', 'weeks'));

    }

    public function add(Request $request) {
        return view('add');
    }

    public function detail(Request $request) {
        return view('detail');
    }
}
