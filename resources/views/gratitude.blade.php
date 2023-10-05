<x-base-layout>

<!-- start page content -->
<div class="container card">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Alert-->
            <div class="text-center fs-3">
                There is still time until the day of receiving gratitude
            </div>
            <div id="demo" class="fw-boldest text-center" style="font-size: 75px"></div>
        </div>
    </div>
</div>
<!-- end page content -->
@section('scripts')

<script type="text/javascript">
var countDownDate = new Date("Dec 12, 2024 8:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
// $(document).ready(function () {
</script>

@endsection
</x-base-layout>
