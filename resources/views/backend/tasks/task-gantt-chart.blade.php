@extends('layouts.app')

@section('title')
    Task Gantt Chart
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/gantt/demo_1/gantt-material.css')}}">
<style>
    .gantt_add, .gantt_grid_head_add{
    display: none;
}
#basicForm {
    position: absolute;
    top: 100px;
    margin:0px auto;
    z-index: 3;
    display: none;
    background-color: red;
    border: 1px solid #fff;
    padding: 20px 20px 5px 20px;

    font-family: Tahoma;
    font-size: 10pt;

  }
  #basicForm input[type="button"]{
    margin: 10px;
  }

 .gantt_container{
    min-height:700px!important;
    max-height:auto!important;
}
.gantt_grid_data .gantt_cell{

}

.updColor{
        background-color:#FFF!important;
        color: #000 !important;
        font-size: 12px;
        padding: 3px;
        text-align: center;
}
.downColor{
        background-color:#F4F9FD!important;
        color: #000 !important;
        font-size: 12px;
        padding: 3px;
        text-align: center;
}
.gantt_tree_content {
    overflow:hidden;
    text-overflow: ellipsis;
}
.gantt_grid_data .gantt_cell{
    color:#757575;
}
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
        background: #9DCB5C !important;
    }
    .nav-pills .nav-link{
        border-radius: 0px !important;
    }
    .dropdown-menu{
        border:none !important;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-md-12 filter-bar">
                @include('livewire.backend.task.common._task-slab')
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div id='gantt'></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type="text/javascript" src="{{asset('/assets/js/cus/gantt.js')}}"></script>
<script>
          gantt.config.layout = {
          css: "gantt_container",
          cols:[
              {
              width:400,
              min_width:300,
              rows:[
                {view:"grid",
                  scrollX: "gridScroll",
                  scrollable:true,
                  scrollY:"scrollVer"
                },
                {
                    view:"scrollbar",
                    id: "gridScroll",
                    group: "horizontal"
                }
              ]
      },
      {resizer: true, width:1},
      {
          rows:[
              {view:"timeline", scrollX: "scrollHor", scrollY: "scrollVer"},
              {view: "scrollbar", id: "scrollHor", group: "horizontal"}
          ]
      },
      {view: "scrollbar", id:"scrollVer"}
    ]
};
gantt.config.order_branch = true;
gantt.config.order_branch_free = true;

gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
gantt.config.columns = [
		    {name: "start_date", label:"Start Date", align: "center", width: 120, resize: true},
		    {name: "end_date", label:"Deadline", align: "center", width: 120, resize: true},
		    {name: "duration", align: "center", width: 70, resize: true},
		    {name: "add", width: 44,  resize: true}
        ];
gantt.templates.grid_header_class = function(columnName, column){
if(columnName == 'first_name' || columnName == 'end_date')
    return "updColor";
if(columnName == 'text' || columnName == 'start_date' || columnName == 'duration')
    return "downColor";
};
gantt.init('gantt');
gantt.load('/task-gantt-chart');
var dp = new gantt.dataProcessor("/api");
dp.init(gantt);
dp.setTransactionMode("REST");
</script>
@endsection
