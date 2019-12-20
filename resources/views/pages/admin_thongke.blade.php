@extends('master')
@section('content')
<h3 style="">
    <i class="fa fa-arrow-circle-o-right"></i>
    Thống kê          
</h3>
﻿<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
﻿<canvas id="myChart" height="100px" width="300px"></canvas>
<script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                @foreach($list as $l)
                    '{{$l['nam']}}',
                @endforeach
            ],
            datasets: [
            @foreach($list_khu as $k)
            {
                label: 'Số sinh viên lưu trú qua các năm khu {{$k['tenkhu']}}',
                borderColor: 'rgb({{rand(0,255)}}, {{rand(0,255)}}, {{rand(0,255)}})',
                data: [
                    @foreach($k['list'] as $l)
                        {{$l['sosv']}},
                    @endforeach
                ]
            },
            @endforeach
            ]
        },
        options: {}
    });
</script>
@endsection