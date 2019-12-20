@extends('master')
@section('content')
<h3 style="">
    <i class="fa fa-arrow-circle-o-right"></i>
    Thống kê           
</h3>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
﻿<canvas id="myChart" height="100px" width="300px"></canvas>
<script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [
                @foreach($list as $l)
                    '{{$l['nam']}}',
                @endforeach
            ],
            datasets: [{
                label: 'Số sinh viên lưu trú qua các năm',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [
                    @foreach($list as $l)
                        {{$l['sosv']}},
                    @endforeach
                ]
            }]
        },

        // Configuration options go here
        options: {}
    });
</script>
@endsection