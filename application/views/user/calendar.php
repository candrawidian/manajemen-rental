<!DOCTYPE html>
<html>
 <head>
  <title>Jadwal Bulanan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: '<?= base_url('user/loaddata');?>',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    { 

      function bukaInfo()
      {
        $(‘#infoku’).modal(‘show’);
      }
     var noRFO = prompt("Enter Event noRFO");
     // var NamaPemesan = prompt("Enter Event nama");
     // var EmailEO = prompt("Enter Event email");
     // var Event = prompt("Enter Event Event");
     // var Orderan = prompt("Enter Event Orderan");
     // var Personil = prompt("Enter Event Personil");
     // var NoTlp = prompt("Enter Event No Telepon");
     // var JumlahUnit = prompt("Enter Event Jumalah Unit");
     // var LamaSewa = prompt("Enter Event LamaSewa");
     if(noRFO)
     {
      var TanggalSewa = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var TanggalAntar = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"<?= base_url('user/calendar');?>",
       type:"POST",
       data:{noRFO:noRFO,NamaPemesan:NamaPemesan,EmailEO:EmailEO,Event:Event,Orderan:Orderan,Personil:Personil,NoTlp:NoTlp,JumlahUnit:JumlahUnit,LamaSewa:LamaSewa, TanggalSewa:TanggalSewa, TanggalAntar:TanggalAntar},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
   
  </script>
 </head>
 <body>
  <br />
  <h2 align="center"><a href="#">Jadwal Bulanan Pengiriman Momototoy</a></h2>
  <br />
  <center><a href="<?= base_url('admin');?>" class="btn btn-primary"> >> Dashboard</a></center></br>
  <div class="container">
   <div id="calendar"></div>
  </div>
<!-- Modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>

<!-- Modal -->
      <div class="modal fade" id="infoku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

 </body>
</html>
