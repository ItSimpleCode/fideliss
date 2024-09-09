@extends('dashboard')

@section('title', 'Chronologie')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/time_line/time_line.css') }}">
@endsection

@section('content')
    <section class="outer-bg h-100">
        <div class="head">
            <div class="title">
                <span>Chronologie</span>
            </div>
            <div class="options">
                <a class="head-button switcher" href="{{ Route('timeLine', ['d' => $data['date']['now']]) }}">ce
                    mois-ci</a>
                <a class="head-border-button switcher"
                   href="{{ Route('timeLine', ['d' => $data['date']['previous']]) }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 19L9 12L10.5 10.25M15 5L13 7.33333" class="stroke" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a class="head-border-button switcher" href="{{ Route('timeLine', ['d' => $data['date']['next']]) }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5L11 7.33333M9 19L15 12L13.5 10.25" class="stroke" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>

        <table class="calendar body">
            @php
                // Function Definitions with `function_exists` Check
                if (!function_exists('shortNumber')) {
                    function shortNumber($number, $precision = 1)
                    {
                        if ($number < 1000) {
                            return $number;
                        }

                        $units = ['', 'K', 'M', 'B', 'T'];
                        $power = floor(log($number, 1000));
                        $shortNumber = $number / pow(1000, $power);

                        return round($shortNumber, $precision) . $units[$power];
                    }
                }

                if (!function_exists('getRangeOfDays')) {
                    function getRangeOfDays($month, $previous_days = 0, $skip_next_days = 0)
                    {
                        $dates = [];

                        $startDate = date('Y-m-01', strtotime($month));
                        $endDate = date('Y-m-t', strtotime($month));

                        $startDate = strtotime("-$previous_days days", strtotime($startDate));
                        $currentDate = $startDate;
                        $endDate = strtotime($endDate);

                        $endDate = strtotime("+$skip_next_days days", $endDate);
                        $endDate = strtotime('-1 day', $endDate);

                        while ($currentDate <= $endDate) {
                            $dayName = date('l', $currentDate);
                            $shortDayName = substr($dayName, 0, 3);
                            $fullDate = date('Y-m-d', $currentDate);
                            $date_m = date('m', $currentDate);
                            $date_d = date('d', $currentDate);

                            $dates[] = [
                                'sort_day' => $shortDayName,
                                'date' => $fullDate,
                                'day' => $dayName,
                                'date_m' => $date_m,
                                'date_d' => $date_d,
                            ];

                            $currentDate = strtotime('+1 day', $currentDate);
                        }

                        return $dates;
                    }
                }

                if (!function_exists('countSpecificDate')) {
                    function countSpecificDate($arrayOfDates, $specificDate)
                    {
                        return array_count_values($arrayOfDates)[$specificDate] ?? 0;
                    }
                }

                $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

                $range = getRangeOfDays($data['date']['target']);

                $days_before = array_search($range[0]['sort_day'], $days) + 1;
                $days_after = 42 - ($days_before + count($range));
                $range = getRangeOfDays($data['date']['target'], $days_before, $days_after);

                $conter = 0;
            @endphp
            <thead>
            <tr>
                @foreach ($days as $col)
                    <th>
                        <div>{{ $col }}</div>
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @for ($i = 0; $i < 6; $i++)
                <tr>
                    @for ($j = 0; $j < 7; $j++)
                        <td>
                            <div>
                                <span class="day-number">{{ $range[$conter]['date_d'] }}</span>
                                <span class="links">
                                    @foreach ($data['tables'] as $table => $arr)
                                        @if(!empty($arr[$range[$conter]['date']]))
                                            <a href="{{ route('timeLine.show', ['table' => $table]) . "?d={$range[$conter]['date']}" }}">{{"$table ({$arr[$range[$conter]['date']]})"}}</a>
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </td>
                        @php
                            $conter++;
                        @endphp
                    @endfor
                </tr>
            @endfor
            </tbody>
        </table>
    </section>
@endsection

@section('script')

@endsection
