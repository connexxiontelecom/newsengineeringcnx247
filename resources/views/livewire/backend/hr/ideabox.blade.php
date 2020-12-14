<div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.hr.common._slab-menu')
                </div>
            </div>
        </div>
   </div>
</div>
<div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Timesheet</h5>
                </div>
                <div class="card-block accordion-block">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingOne">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <button class="btn btn-mini btn-round btn-light" type="button">
                                        <i class="icofont icofont-plus"></i> Add New Timesheet
                                    </button>
                                </a>
                            </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                                <div class="accordion-content accordion-desc">
                                   <form>
                                       <div class="container">
                                           <div class="row form-group">
                                               <label for="" class="col-md-2">Employee</label>
                                               <select class="form-control col-md-6">
                                                   <option disabled selected>Select employee</option>
                                                   <option value="1">New</option>
                                               </select>
                                           </div>
                                           <div class="row form-group">
                                               <label for="" class="col-md-2">Date</label>
                                               <input type="datetime-local" placeholder="Date" class="form-control col-4">
                                           </div>
                                           <div class="row form-group">
                                               <label for="" class="col-md-2">Hours</label>
                                               <input type="number" placeholder="Hours" class="form-control col-4">
                                           </div>
                                           <div class="row form-group">
                                               <label for="" class="col-md-2">Remark</label>
                                               <textarea name="" id="" cols="5" class="form-control col-md-6" rows="5" style="resize: none;"></textarea>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-12 d-flex justify-content-center">
                                                   <button class="btn btn-mini btn-primary" type="submit">Submit</button>
                                               </div>
                                           </div>
                                       </div>
                                   </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingTwo">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Timesheet List
                                </a>
                            </h3>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="accordion-content accordion-desc">
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="dt-responsive table-responsive">
                                                <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                                            <div class="dataTables_length" id="simpletable_length">
                                                                <label>Show <select name="simpletable_length" aria-controls="simpletable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-xs-12 col-sm-12 col-md-6"><div id="simpletable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="simpletable"></label></div></div></div><div class="row"><div class="col-xs-12 col-sm-12"><table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                                    <thead>
                                                        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 188.4px;">Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 282px;">Position</th><th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 137.2px;">Office</th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 68.4px;">Age</th><th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 140.4px;">Start date</th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 96.4px;">Salary</th></tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr role="row" class="odd">
                                                            <td class="sorting_1">Airi Satou</td>
                                                            <td>Accountant</td>
                                                            <td>Tokyo</td>
                                                            <td>33</td>
                                                            <td>2008/11/28</td>
                                                            <td>$162,700</td>
                                                        </tr><tr role="row" class="even">
                                                            <td class="sorting_1">Ashton Cox</td>
                                                            <td>Junior Technical Author</td>
                                                            <td>San Francisco</td>
                                                            <td>66</td>
                                                            <td>2009/01/12</td>
                                                            <td>$86,000</td>
                                                        </tr><tr role="row" class="odd">
                                                            <td class="sorting_1">Bradley Greer</td>
                                                            <td>Software Engineer</td>
                                                            <td>London</td>
                                                            <td>41</td>
                                                            <td>2012/10/13</td>
                                                            <td>$132,000</td>
                                                        </tr><tr role="row" class="even">
                                                            <td class="sorting_1">Brielle Williamson</td>
                                                            <td>Integration Specialist</td>
                                                            <td>New York</td>
                                                            <td>61</td>
                                                            <td>2012/12/02</td>
                                                            <td>$372,000</td>
                                                        </tr><tr role="row" class="odd">
                                                            <td class="sorting_1">Cedric Kelly</td>
                                                            <td>Senior Javascript Developer</td>
                                                            <td>Edinburgh</td>
                                                            <td>22</td>
                                                            <td>2012/03/29</td>
                                                            <td>$433,060</td>
                                                        </tr><tr role="row" class="even">
                                                            <td class="sorting_1">Charde Marshall</td>
                                                            <td>Regional Director</td>
                                                            <td>San Francisco</td>
                                                            <td>36</td>
                                                            <td>2008/10/16</td>
                                                            <td>$470,600</td>
                                                        </tr><tr role="row" class="odd">
                                                            <td class="sorting_1">Colleen Hurst</td>
                                                            <td>Javascript Developer</td>
                                                            <td>San Francisco</td>
                                                            <td>39</td>
                                                            <td>2009/09/15</td>
                                                            <td>$205,500</td>
                                                        </tr><tr role="row" class="even">
                                                            <td class="sorting_1">Dai Rios</td>
                                                            <td>Personnel Lead</td>
                                                            <td>Edinburgh</td>
                                                            <td>35</td>
                                                            <td>2012/09/26</td>
                                                            <td>$217,500</td>
                                                        </tr><tr role="row" class="odd">
                                                            <td class="sorting_1">Garrett Winters</td>
                                                            <td>Accountant</td>
                                                            <td>Tokyo</td>
                                                            <td>63</td>
                                                            <td>2011/07/25</td>
                                                            <td>$170,750</td>
                                                        </tr><tr role="row" class="even">
                                                            <td class="sorting_1">Gloria Little</td>
                                                            <td>Systems Administrator</td>
                                                            <td>New York</td>
                                                            <td>59</td>
                                                            <td>2009/04/10</td>
                                                            <td>$237,500</td>
                                                        </tr></tbody>
                                                    <tfoot>
                                                    <tr><th rowspan="1" colspan="1">Name</th><th rowspan="1" colspan="1">Position</th><th rowspan="1" colspan="1">Office</th><th rowspan="1" colspan="1">Age</th><th rowspan="1" colspan="1">Start date</th><th rowspan="1" colspan="1">Salary</th></tr>
                                                    </tfoot>
                                                </table></div></div><div class="row"><div class="col-xs-12 col-sm-12 col-md-5"><div class="dataTables_info" id="simpletable_info" role="status" aria-live="polite">Showing 1 to 10 of 20 entries</div></div><div class="col-xs-12 col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="simpletable_previous"><a href="#" aria-controls="simpletable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="simpletable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="simpletable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="simpletable_next"><a href="#" aria-controls="simpletable" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
