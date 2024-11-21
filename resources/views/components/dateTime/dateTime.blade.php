<div class="dateTime">
    <div id="date"></div>
    <div id="time"></div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script>
        $(document).ready(function(){
            var interval = setInterval(function(){
                var momentNow = moment();
                $('#date').html(momentNow.format('dddd').substring(3,3).toUpperCase()+ momentNow.format('DD MMMM YYYY'));
                $('#time').html(momentNow.format('hh:mm:ss A'));
            })
        })
    </script>
</div>
