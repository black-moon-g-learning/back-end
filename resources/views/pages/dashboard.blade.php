@extends('layouts.master')
@inject('common', 'App\Constants\Common')
@section('content')
    @include('components.card')
    @include('components.chart')
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Top users contribute</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    @isset($response)
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Authors table</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                                    Author</th>
                                                <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                                    Total post</th>
                                                <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                                    Peding</th>
                                                <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                                    Published</th>
                                                <th class="{{ $common::DEFAULT_HEADER_STYLE }}">Future</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($response['usersContributed'] as $contribute)
                                                <tr>
                                                    <td>
                                                        <div class=" px-2 py-1">
                                                            <div class=" flex-column justify-content-center">
                                                                <h6 class="text-center"> {{ $contribute->first_name }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-center">{{ $contribute->totals }}</p>
                                                    </td>
                                                    <td class="align-middle text-center ">
                                                        <span
                                                            class="badge badge-sm bg-gradient-success">{{ $contribute->pending }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{ $contribute->published }}
                                                    </td>
                                                    <td class="align-middle  text-center">
                                                        {{ $contribute->future }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ $response['usersContributed']->links() }}
                    @endisset
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
@endsection

@section('customJs')
    <script src={{ asset('js/plugins/chartjs.min.js') }}></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", 'Dec'],
                datasets: [{
                    label: "user register",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: {{ $userRegister->pluck('user') }},
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endsection
