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
                <div class="dashboard-content-inner">

                    <!-- Row -->
                    <div class="row">

                        <!-- Dashboard Box -->
                        <div class="col-xl-12">
                            <div class="dashboard-box margin-top-0">

                                <!-- Headline -->
                                <div class="headline">
                                    <h3><i class="icon-material-outline-account-circle"></i> All Users</h3>
                                </div>

                                <div class="content">
<br>



                                 <div class="container">
  <div class="row">
    <div class="col-xl-12 col-6">
      <table id="example" class="table table-hover responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
            <td>
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-blue mr-3"><span class="innner">EB</span></div>

                  <div class="">
                    <p class="font-weight-bold mb-0">{{$user->name}}</p>
                    {{-- <p class="text-muted mb-0">TD Ameritrade</p> --}}
                  </div>
                </div>
              </a>
            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->user_type==\App\User::USER_FREELANCER?'Freelancer':'EMPLOYER'}}</td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-horizontal-rounded" data-toggle="tooltip" data-placement="top"
                        title="Actions"></i>
                    </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item" href="#"><i class="bx bxs-pencil mr-2"></i> Edit Profile</a>
                  <a class="dropdown-item text-danger" href="#"><i class="bx bxs-trash mr-2"></i> Remove</a>
                </div>
              </div>
            </td>
          </tr>
          @endforeach

          {{-- <tr>
            <td>
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-pink mr-3"><span class="innner">JR</span></div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Julie Richards</p>
                    <p class="text-muted mb-0">julie_89@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>admin@admin.com</td>
            <td>Freelancer</td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-horizontal-rounded" data-toggle="tooltip" data-placement="top"
                        title="Actions"></i>
                    </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item" href="#"><i class="bx bxs-pencil mr-2"></i> Edit Profile</a>
                  <a class="dropdown-item text-danger" href="#"><i class="bx bxs-trash mr-2"></i> Remove</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-pink mr-3"><span class="innner">JR</span></div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Julie Richards</p>
                    <p class="text-muted mb-0">julie_89@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>admin@admin.com</td>
            <td>Freelancer</td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-horizontal-rounded" data-toggle="tooltip" data-placement="top"
                        title="Actions"></i>
                    </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item" href="#"><i class="bx bxs-pencil mr-2"></i> Edit Profile</a>
                  <a class="dropdown-item text-danger" href="#"><i class="bx bxs-trash mr-2"></i> Remove</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-pink mr-3"><span class="innner">JR</span></div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Julie Richards</p>
                    <p class="text-muted mb-0">julie_89@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>admin@admin.com</td>
            <td>User</td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-horizontal-rounded" data-toggle="tooltip" data-placement="top"
                        title="Actions"></i>
                    </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item" href="#"><i class="bx bxs-pencil mr-2"></i> Edit Profile</a>
                  <a class="dropdown-item text-danger" href="#"><i class="bx bxs-trash mr-2"></i> Remove</a>
                </div>
              </div>
            </td>
          </tr> --}}
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Row / End -->

                    <!-- Footer -->
                    <div class="dashboard-footer-spacer"></div>

                    <!-- Footer / End -->

                </div>
            </div>


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