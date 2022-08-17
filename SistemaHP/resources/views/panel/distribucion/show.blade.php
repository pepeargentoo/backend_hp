@extends('panel.layout') @section('content')
<script type="text/javascript">
$( document ).ready(function() {
    
    
     
     //console.log(eventos)
    
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'timeGridWeek'
      },
      initialDate: '2020-09-12',
      navLinks: true, // can click day/week names to navigate views
      nowIndicator: true,

      weekNumbers: false,
      weekNumberCalculation: 'ISO',

      editable: false,
      selectable: false,
      dayMaxEvents: true, // allow "more" link when too many events
      
      

      events: [
        {
          title: 'Meeting',
          start: '2020-09-12T10:30:00',
          end: '2020-09-12T12:30:00'
        }
      ]
    });

    calendar.render();
  });
    
});  
</script> 
<div class="row">
  <div id='calendar'></div>
</div>


@endsection
