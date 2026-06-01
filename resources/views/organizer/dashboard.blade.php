@extends('layouts.org-dashboard')

@section('dashboard-active' , 'active')

@section('recent-cards')
<div class="row">
    @foreach ($users as $user)
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" style="background-color:#161718;">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 font-weight-bold">
                                    {{ $user->email }} </p>
                                <h5 class="font-weight-bolder">
                                    {{ $user->name }}
                                </h5>
                                <p class="mb-0">
                                    @foreach ($user->roles as $role)
                                    <span class="text-success text-sm font-weight-bolder">{{$role->name}}</span>
                                    @endforeach
                                    {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <a href="">
                                    @if ($user->hasMedia('media/users'))
                                    <img src="{{ $user->getFirstMediaUrl('media/users') }}"
                                        alt="" srcset=""
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    @else
                                    <img src="{{ asset('images/avatar.jfif') }}"
                                    alt="" srcset=""
                                    class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('recent-tables')
<div class="col-lg-6 mb-lg-0 mb-4">
    <div class="card " style="background-color:#161718;width: 700px;">
        <div class="card-header pb-0 p-3" style="background-color:#161718;">
            <div class="d-flex justify-content-between">
                <h6 class="mb-2">Statistics</h6>
            </div>
        </div>
            <canvas id="myChart" width="200" height="200"></canvas>
    </div>
</div>

<div class="col-lg-6 mb-lg-0 mb-4">
    <div class="card " style="background-color:#161718;width: 700px;">
        <div class="card-header pb-0 p-3" style="background-color:#161718;">
            <div class="d-flex justify-content-between">
                <h6 class="mb-2">Statistics</h6>
            </div>
        </div>
            <canvas id="myChart2" width="200" height="200"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Users', 'Reservations', 'Events'],
            datasets: [{
                label: 'Counts',
                data: [{!! $userCount !!}, {!! $reservationCount !!}, {!! $eventCount !!}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
                duration: 3000, // Animation duration in milliseconds
                easing: 'easeInOutQuart' // Easing function for animation
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Users', 'Reservations', 'Events'],
            datasets: [{
                label: 'Counts',
                data: [{!! $userCount !!}, {!! $reservationCount !!}, {!! $eventCount !!}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
                duration: 3000, // Animation duration in milliseconds
                easing: 'easeInOutQuart' // Easing function for animation
            }
        }
    });
</script>
@endsection
