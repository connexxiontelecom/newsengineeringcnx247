@extends('layouts.app')

@section('title')
    Tenants Financials
@endsection

@section('extra-styles')
    <!-- Chartlist chart css -->
    <link rel="stylesheet" href="/assets/bower_components/chartist/css/chartist.css" type="text/css" media="all">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                @include('backend.admin.common._nav-slab')
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-money-bag bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Revenue</span>
                <h5>₦{{number_format(($overall/100),2)}}</h5>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-yellow f-16 ti-calendar m-r-10"></i>Overall
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-money-bag bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Revenue</span>
                <h5>₦{{number_format(($lastMonth/100),2)}}</h5>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-pink f-16 ti-calendar m-r-10"></i>Last Month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-money-bag bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Revenue</span>
                <h5>₦{{number_format(($thisMonth/100),2)}}</h5>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-blue f-16 ti-calendar m-r-10"></i>This Month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-money-bag bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Revenue</span>
                <h5>₦{{number_format(($thisWeek/100),2)}}</h5>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-green f-16 ti-calendar m-r-10"></i>This Week
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="card-header">
                        @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Weekly Performance</h5>
                                    <span>Pricing plan comparison for the week.</span>

                                </div>
                                <div class="card-block">
                                    <div id="main" style="height:300px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tenants</h5>
                                    <span>Top 5 Contributing tenants</span>

                                </div>
                                <div class="card-block">
                                    <div id="pie-chart" style="height:300px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Monthly performance</h5>
                                    <span>This year's monthly performance (revenue)</span>
                                </div>
                                <div class="card-block">
                                    <div id="placeholder" class="demo-placeholder" style="height:300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Revenue Chart</h5>
                                    <span>Revenue comparison across different pricing plans.</span>

                                </div>
                                <div class="card-block">
                                    <div id="morris-extra-area"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection

@section('extra-scripts')
<script src="/assets/bower_components/raphael/js/raphael.min.js"></script>
<script src="/assets/bower_components/morris.js/js/morris.js"></script>
<script src="/assets/pages/chart/morris/morris-custom-chart.js"></script>

<script src="/assets/pages/chart/echarts/js/echarts-all.js" type="text/javascript"></script>


<script src="\assets\pages\chart\float\jquery.flot.js"></script>
<script src="\assets\pages\chart\float\jquery.flot.categories.js"></script>
<script src="\assets\pages\chart\float\jquery.flot.pie.js"></script>

<script type="text/javascript" src="\assets\js\cus\float-chart-custom.js"></script>

<script>
      'use strict';
$(document).ready(function() {
       dashboardEcharts();
    });

    $(window).on('resize',function() {
        dashboardEcharts();
    });


 function dashboardEcharts() {
    /*line chart*/
var myChart = echarts.init(document.getElementById('main'));

    var option = {

    tooltip : {
        trigger: 'axis'
    },

    legend: {
        data:['Invoice','Receipt','Deals']
    },
    toolbox: {
        show : false,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
              splitLine: {
                          show: false
                    },
            boundaryGap : false,
            data : ['Monday','Tuesday','Wednesday','Thrusday','Friday','Saturday','Sunday']
        }
    ],
    color:  ["rgba(70, 128, 255, 0.95)" ,"rgba(70, 128, 255, 0.39)","rgba(70, 128, 255, 0.54)"],
    yAxis : [
        {
            type : 'value',
              splitLine: {
                          show: false
                    }
        }
    ],
    series : [
        {
            name:'Invoice',
            type:'line',
            smooth:true,
            itemStyle: {normal: {areaStyle: {type: 'macarons'}}},
            data:[10, 12, 21, 54, 260, 830, 710]
        },
        {
            name:'Receipt',
            type:'line',
            smooth:true,
            itemStyle: {normal: {areaStyle: {type: 'macarons'}}},
            data:[30, 182, 434, 791, 390, 30, 10]
        },
        {
            name:'Deals',
            type:'line',
            smooth:true,
            itemStyle: {normal: {areaStyle: {type: 'macarons'}}},
            data:[1320, 1132, 601, 234, 120, 90, 20]
        }
    ]
};

        // Load data into the ECharts instance
        myChart.setOption(option);


/*circle chart*/
var myChart = echarts.init(document.getElementById('pie-chart'));

var idx = 1;
var option_dt = {

    timeline : {
        show: true,
        data : ['06-16','05-16','04-16'],
        label : {
            formatter : function(s) {
                return s.slice(0, 5);
            }
        },
        x:10,
        y:null,
        x2:10,
        y2:0,
        width:250,
        height:50,
        backgroundColor:"rgba(0,0,0,0)",
        borderColor:"#eaeaea",
        borderWidth:0,
        padding:5,
        controlPosition:"left",
        autoPlay:true,
        loop:true,
        playInterval:2000,
        lineStyle:{
            width:1,
            color:"#bdbdbd",
            type:""
        },

    },

    options : [
        {
            color: ['#4680ff','#FC6180','#93BE52','#FFB64D','#FE8A7D','#69CEC6'],
            title : {
                text: '',
                subtext: ''
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                show: false,
                x: 'left',
                orient:'vertical',
                padding: 0,
                data:['Micromax','Xolo','Lenevo','Sony','Others']
            },
            toolbox: {
                show : false,
                color : ['#4680ff','#4680ff','#4680ff','#4680ff'],
                feature : {
                    mark : {show: false},
                    dataView : {show: false, readOnly: true},
                    magicType : {
                        show: true,
                            itemSize:12,
                            itemGap: 12,
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                x: '10%',
                                width: '80%',
                                funnelAlign: 'center',
                                max: 50
                            },
                            pie: {
                                roseType : 'none',
                            }
                        }
                    },
                    restore : {show: false},
                    saveAsImage : {show: true}
                }
            },


                            series : [
                                {
                                    name:'06-16',
                                    type:'pie',
                                    radius : [15, '70%'],
                                    roseType : 'radius',
                                    center: ['50%', '45%'],
                                    width: '50%',       // for funnel
                                    itemStyle : {
                                        normal : { label : { show : true }, labelLine : { show : true } },
                                        emphasis : { label : { show : false }, labelLine : {show : false} }
                                    },
                                    data:[{value: 35,  name:'Micromax'}, {value: 16,  name:'Xolo'}, {value: 27,  name:'Lenevo'}, {value: 29,  name:'Sony'}, {value: 12,  name:'Others'}]
                                }
                            ]
                    },
                {
                    series : [
                        {
                            name:'05-16',
                            type:'pie',
                            data:[{value: 42,  name:'Micromax'}, {value: 51,  name:'Xolo'}, {value: 39,  name:'Lenevo'}, {value: 25,  name:'Sony'}, {value: 9,  name:'Others'}]
                        }
                    ]
                },
                {
                    series : [
                        {
                            name:'04-16',
                            type:'pie',
                            data:[{value: 29,  name:'Micromax'}, {value: 16,  name:'Xolo'}, {value: 24,  name:'Lenevo'}, {value: 19,  name:'Sony'}, {value: 5,  name:'Others'}]
                        }
                    ]
                },

    ] // end options object
};

myChart.setOption(option_dt);









/*bar chart*/
 var myChart = echarts.init(document.getElementById('bar_chart'));

 option = {
    tooltip : {
        trigger: 'axis',
        axisPointer : {
            type : 'shadow'
        },
        formatter: function (params){
            return params[0].name + '<br/>'
                   + params[0].seriesName + ' : ' + params[0].value + '<br/>'
                   + params[1].seriesName + ' : ' + (params[1].value + params[0].value);
        }
    },
    legend: {
        selectedMode:false,
        data:['Acutal', 'Forecast']
    },
    toolbox: {
        show : false
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : ['Cosco','CMA','APL','OOCL','Wanhai','Zim']
        }
    ],
    yAxis : [
        {
            type : 'value',
            boundaryGap: [0, 0.1]
        }
    ],
    series : [
        {
            name:'Acutal',
            type:'bar',
            stack: 'sum',
            barCategoryGap: '50%',
            itemStyle: {
                normal: {
                    color: 'rgba(70, 128, 255, 0.54)',
                    barBorderColor: 'rgba(70, 128, 255, 0.54)',
                    barBorderWidth: 3,
                    barBorderRadius:0,
                    label : {
                        show: true, position: 'insideTop'
                    }
                }
            },
            data:[260, 200, 220, 120, 100, 80]
        },
        {
            name:'Forecast',
            type:'bar',
            stack: 'sum',
            itemStyle: {
                normal: {
                    color: '#fff',
                    barBorderColor: '#4680ff',
                    barBorderWidth: 3,
                    barBorderRadius:0,
                    label : {
                        show: true,
                        position: 'top',
                        formatter: function (params) {
                            for (var i = 0, l = option.xAxis[0].data.length; i < l; i++) {
                                if (option.xAxis[0].data[i] == params.name) {
                                    return option.series[0].data[i] + params.value;
                                }
                            }
                        },
                        textStyle: {
                            color: '#4680ff'
                        }
                    }
                }
            },
            data:[40, 80, 50, 80,80, 70]
        }
    ]
};

  myChart.setOption(option);

     myChart.setOption(option);

 }













 var months = [];
   var credit = [];
   var debit = [];
   var income = [];
   var expense = [];
   var weekly =  {!! $weekly !!};
   console.log(weekly);
/*     for (var i in weekly) {
        months.push(weekly[i].amount);
        credit.push(weekly[i].amt);
    } */
</script>
@endsection
