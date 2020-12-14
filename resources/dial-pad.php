<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog" style="width:280px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #404E67; padding:20px;">
                <h4 class="modal-title text-white text-uppercase" style="font-size: 14px;">Phone Dialer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form >
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div id="dialer-screen">
                                {{ $phone_number }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click.prevent="addNumber('1')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">1</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('2')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">2</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('3')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">3</button>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click="addNumber('4')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">4</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('5')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">5</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('6')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">6</button>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click="addNumber('7')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">7</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('8')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">8</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('9')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">9</button>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click="addNumber('*')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">*</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('0')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">0</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('#')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">#</button>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click="addNumber('+')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">+</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="makeCall" type="button" class="btn btn-primary btn-icon"><i class="zmdi zmdi-phone"></i></button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger btn-icon"><i class="zmdi zmdi-long-arrow-left"></i></button>
                            </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="dialer-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form >
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div id="dialer-screen">
                                {{ $phone_number }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click.prevent="addNumber('1')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">1</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('2')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">2</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('3')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">3</button>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click="addNumber('4')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">4</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('5')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">5</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('6')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">6</button>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click="addNumber('7')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">7</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('8')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">8</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('9')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">9</button>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click="addNumber('*')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">*</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('0')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">0</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="addNumber('#')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">#</button>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col-md-4">
                                <button wire:click="addNumber('+')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">+</button>
                            </div>
                            <div class="col-md-4">
                                <button wire:click="makeCall" type="button" class="btn btn-primary btn-icon"><i class="zmdi zmdi-phone"></i></button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger btn-icon"><i class="zmdi zmdi-long-arrow-left"></i></button>
                            </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
            </div>
        </div>
    </div>
</div>