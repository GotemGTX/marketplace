@extends('admin.layouts.master')

@section('content')
<!-- Wrapper -->
<div id="wrapper">


    @include('admin.partials.header')



    <!-- Dashboard Container -->
    <div class="dashboard-container">

        @include('admin.partials.sidebar')


        <!-- Dashboard Content
  ================================================== -->
  <div class="dashboard-content-container" data-simplebar>
    @if(Session::has('success'))
      <li class="alert alert-success">{{Session::get('success')}}</li>
    @endif
    <div class="dashboard-content-inner" >


      <!-- Row -->
      <div class="row">

        <!-- Dashboard Box -->
        <div class="col-xl-12">
          <div class="dashboard-box margin-top-0">

            <!-- Headline -->
            <div class="headline">
              <h3><i class="icon-material-outline-account-circle"></i> Verify Submit</h3>
            </div>

            <div class="content">
               <br>
                        <div class="container">
                        <div class="row">
                        <div class="col-xl-6 col-md-6">
                          <center>
            <img src="{{asset(str_replace('public','storage',$profile->passport))}}" alt="" width="50%">
          </center>
            </div>
                <div class="col-xl-6 col-md-6">
                  <center>
            <img src="{{asset(str_replace('public','storage',$profile->driving_license))}}" alt="" width="70%">
            </center>
            </div>
                        </div>





<br>
<br>
     <div class="row">
      <div class="col-xl-9 col-md-9"></div>
          <div class="col-xl-3 col-md-3">
            <center>
            <a href="{{route('update.verify.profile.admin',['profile'=>$profile->id])}}" class="button ripple-effect button-sliding-icon">Verify Now <i class="icon-feather-arrow-right"></i></a>
            </center>
            </div>

        </div>

 <br>

                        </div>









            </div>
          </div>
        </div>



      </div>
      <!-- Row / End -->

      <!-- Footer -->
      <div class="dashboard-footer-spacer"></div>


    </div>
  </div>
  <!-- Dashboard Content / End -->


<!-- Apply for a job popup / End -->
@endsection
@section('scripts')
<!-- Scripts
================================================== -->
<script src="{{asset('backstyling/js/jquery-3.4.1.min.js')}}"></script>
{{-- <script src="{{asset('backstyling/js/jquery-migrate-3.1.0.min.html')}}"></script> --}}
<script src="{{asset('backstyling/js/mmenu.min.js')}}"></script>
<script src="{{asset('backstyling/js/tippy.all.min.js')}}"></script>
<script src="{{asset('backstyling/js/simplebar.min.js')}}"></script>
<script src="{{asset('backstyling/js/bootstrap-slider.min.js')}}"></script>
<script src="{{asset('backstyling/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('backstyling/js/snackbar.js')}}"></script>
<script src="{{asset('backstyling/js/clipboard.min.js')}}"></script>
<script src="{{asset('backstyling/js/counterup.min.js')}}"></script>
<script src="{{asset('backstyling/js/magnific-popup.min.js')}}"></script>
<script src="{{asset('backstyling/js/slick.min.js')}}"></script>
<script src="{{asset('backstyling/js/custom.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https  ://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<!-- Google Autocomplete -->

<!--
<script>
function initAutocomplete() {
     var options = {
      types: ['(cities)'],
      // componentRestrictions: {country: "us"}
     };

     var input = document.getElementById('autocomplete-input');
     var autocomplete = new google.maps.places.Autocomplete(input, options);
}
</script -->

<!-- Google API & Maps -->
<!-- Geting an API Key: https://developers.google.com/maps/documentation/javascript/get-api-key -->

<!--
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaoOT9ioUE4SA8h-anaFyU4K63a7H-7bc&amp;libraries=places"></script -->
<script src="{{asset('backstyling/js/infobox.min.js')}}"></script>
<script src="{{asset('backstyling/js/markerclusterer.js')}}"></script>
<script src="{{asset('backstyling/js/maps.js')}}"></script>
<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
 <script>
        $(document).ready(function() {
  $("#example").DataTable({
    aaSorting: [],
    responsive: true,

    columnDefs: [
      {
        responsivePriority: 1,
        targets: 0
      },
      {
        responsivePriority: 2,
        targets: -1
      }
    ]
  });

  $(".dataTables_filter input")
    .attr("placeholder", "Search Forms...")
    .css({
      width: "260px",
      display: "inline-block"
    });

  $('[data-toggle="tooltip"]').tooltip();
});

    </script>
    <!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->

<script>
    // Snackbar for user status switcher
    $('#snackbar-user-status label').click(function () {
        Snackbar.show({
            text: 'Your status has been changed!',
            pos: 'bottom-center',
            showAction: false,
            actionText: "Dismiss",
            duration: 3000,
            textColor: '#fff',
            backgroundColor: '#383838'
        });
    });
</script>

<!-- Chart.js // documentation: http://www.chartjs.org/docs/latest/ -->
<script src="{{asset('backstyling/js/chart.min.js')}}"></script>
<script>
    Chart.defaults.global.defaultFontFamily = "Nunito";
    Chart.defaults.global.defaultFontColor = '#888';
    Chart.defaults.global.defaultFontSize = '14';

    var ctx = document.getElementById('chart').getContext('2d');

    var chart = new Chart(ctx, {
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June"],
            // Information about the dataset
            datasets: [{
                label: "Views",
                backgroundColor: 'rgba(42,65,232,0.08)',
                borderColor: '#2a41e8',
                borderWidth: "3",
                data: [196, 132, 215, 362, 210, 252],
                pointRadius: 5,
                pointHoverRadius: 5,
                pointHitRadius: 10,
                pointBackgroundColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointBorderWidth: "2",
            }]
        },

        // Configuration options
        options: {

            layout: {
                padding: 10,
            },

            legend: {
                display: false
            },
            title: {
                display: false
            },

            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: false
                    },
                    gridLines: {
                        borderDash: [6, 10],
                        color: "#d8d8d8",
                        lineWidth: 1,
                    },
                }],
                xAxes: [{
                    scaleLabel: {
                        display: false
                    },
                    gridLines: {
                        display: false
                    },
                }],
            },

            tooltips: {
                backgroundColor: '#333',
                titleFontSize: 13,
                titleFontColor: '#fff',
                bodyFontColor: '#fff',
                bodyFontSize: 13,
                displayColors: false,
                xPadding: 10,
                yPadding: 10,
                intersect: false
            }
        },


    });
</script>

@endsection