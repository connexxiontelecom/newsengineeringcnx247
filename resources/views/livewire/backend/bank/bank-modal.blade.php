@foreach($banks as $bank)

    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal">Large</button>
    <div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Default Modal { Large}</h5>
                    <p>This is Photoshop's version of Lorem IpThis is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                    <select id="workgroup_members" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                        <option selected disabled>Add Member(s)</option>

                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <tr>
        <td>{{$serial++}}</td>
        <td>{{$bank->bank_name}}</td>
        <td>{{$bank->bank_account_number}}</td>
        <td>{{$bank->bank_gl_code}}</td>
        <td>{{$bank->bank_branch}}</td>
        <td>{{date('d F, Y', strtotime($bank->created_at))}}</td>
        <td>
            <a href="javascript:void(0);" wire:click="editBank({{$bank->id}})"> <i class="ti-pencil text-warning"></i> </a>
        </td>
    </tr>
@endforeach
