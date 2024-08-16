@extends('dashboard')

@section('title', 'Chronologie')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\time_line\time_line.css') }}">
@endsection


@section('content')
    <section id='calendar' class="outer-bg h-100">
    </section>
@endsection

@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
        var calendarEl = document.getElementById('calendar');

        // Your event data
        var events = [{
                title: 'Meeting with Client',
                start: '2024-08-18T10:00:00',
                end: '2024-08-18T12:00:00'
            },
            {
                title: 'Project Deadline',
                start: '2024-08-20',
                allDay: true
            }
        ];

        // Initialize the calendar
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events // Pass the events data here
        });

        // Render the calendar
        calendar.render();
    </script>
@endsection
