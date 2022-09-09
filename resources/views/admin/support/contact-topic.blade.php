@extends('include.admin')

@section('title','')
@section('content')
    <div id="app">

        <div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options">
											 <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#btn_add"><i
                        class="fa fa-plus" @click="setError()"></i> Add New
                </button>
										</div>
									</div>


            <div class="card-body">

                <div class="table-responsive table-responsive-xl table-responsive-lg table-responsive-md table-responsive-sm">
                    <table class="table table-striped">
                        <thead class="thead-primary">
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list">

                        <tr id="product" v-for="(item , index ) in items">
                            <td data-label="SL">@{{ ++index }}</td>
                            <td data-label="Name">@{{ item.name }}</td>
                            <td data-label="Action">
                                <button class="btn btn-primary btn-detail" data-toggle="modal" data-target="#editModal" @click="setVal(item)">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DelModal" @click="setVal(item)">
                                    <i class='fa fa-trash'></i>
                                </button>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="modal fade" id="btn_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i> Manage Topic</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <li v-for="value in hasErrors" v-if="hasErrors" class="text-danger" v-html="value[0]"></li>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label"><strong>Name :</strong>
                            </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control form-control-lg " id="name" v-model="newItem.name"
                                       placeholder=" Name" value="">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close
                        </button>

                        <button type="submit" class="btn btn-primary bold uppercase" @click.prevent="createSocialItem()" id="btn-save" value="add"><i
                                class="fa fa-send"></i> Save
                        </button>
                    </div>

                </div>
            </div>

        </div>


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i> Manage Topic</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <li v-for="value in hasErrors" v-if="hasErrors" v-html="value[0]" class="text-danger"></li>
                        <div class="form-group ">
                            <label for="inputName" class="col-sm-3 control-label"><strong>Name :</strong> </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control form-control-lg" v-model="oldItem.name"  placeholder="Name" value="">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>

                        <button type="submit" @click.prevent="updateSocialItem()" class="btn btn-primary" ><i class="fa fa-send"></i> Update </button>
                    </div>

                </div>
            </div>

        </div>

        <!-- Modal for DELETE -->
        <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete !</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <strong>Are you sure you want to Delete ?</strong>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" @click.prevent="deleteSocialItem(oldItem.id)" class="btn btn-danger "><i class="fa fa-trash"></i> DELETE</button>
                    </div>
                </div>
            </div>
        </div>


    </div>   </div>   </div>   </div>
@endsection


@section('javascript')
    <script src="{{asset('assets/admin/js/vue.js')}}"></script>
    <script src="{{asset('assets/admin/js/axios.js')}}"></script>
    <script>
        var app =  new Vue({
            el: "#app",
            data: {
                items : [],
                pagination: [],
                newItem : {
                    'name':''
                },
                oldItem: {
                    'name' : ''
                },
                hasErrors: [],
                alert: null,
            },

            mounted(){

                this.alert = "{{$general->alert}}"
                this.getSocialItems();
            },
            methods : {
                getSocialItems() {
                    axios.get("{{route('admin.get-topic')}}")
                        .then(response => {
                            this.items = response.data;
                        });
                },
                createSocialItem(){

                    var _this = this;
                    axios.post("{{route('admin.store.contact-topic')}}", this.newItem)
                        .then( response =>  {
                            var data =response.data;

                            if(_this.alert == 1){
                                if(data.status === 'success'){
                                    this.items.push(data.data);
                                    iziToast.success({message:data.message, position: "topRight"});
                                    this.reset();
                                }else{
                                    iziToast.error({message:data.message, position: "topRight"});
                                }

                            }else if(_this.alert == 2) {
                                if(data.status === 'success'){
                                    this.items.push(data.data);
                                    toastr.success(data.message);
                                    this.reset();
                                }else{
                                    toastr.error(data.message);
                                }
                            }


                            $('#btn_add').modal('hide');
                        })
                        .catch(err=>{
                            var getError = err.response.data.errors;
                            this.hasErrors = getError;
                        });
                },
                reset(){
                    this.newItem = {
                        'name':'',
                    },
                        this.oldItem = {
                            'name' : ''
                        }
                },
                setVal(items){
                    this.oldItem.id = items.id;
                    this.oldItem.name = items.name;
                },
                updateSocialItem(){
                    var _this = this;

                    axios.post("{{route('admin.update.contact-topic')}}", this.oldItem)
                        .then(response =>{

                            var data =response.data;

                            if(_this.alert == 1){
                                if(data.status === 'success'){
                                    $('#editModal').modal('hide');
                                    iziToast.success({message:data.message, position: "topRight"});
                                    _this.getSocialItems();
                                    _this.reset();

                                }else{
                                    $('#editModal').modal('hide')
                                    iziToast.error({message:data.message, position: "topRight"});
                                }

                            }else if(_this.alert == 2) {

                                if(data.status === 'success'){
                                    $('#editModal').modal('hide');
                                    toastr.success(data.message);
                                    _this.getSocialItems();
                                    _this.reset();

                                }else{
                                    $('#editModal').modal('hide')
                                    toastr.error(data.message);
                                }

                            }


                        })
                        .catch(err => {
                            if(err.response != undefined){
                                var getError = err.response.data.errors;
                                this.hasErrors = getError;
                            }
                        });
                },
                deleteSocialItem(id){
                    var _this = this;
                    social = {
                        'id': id
                    },
                        axios.post("{{route('admin.delete.contact-topic')}}",social)
                            .then(res => {

                                var data = res.data;

                                if(_this.alert == 1){
                                    if(data.status === 'success'){
                                        $("#DelModal").modal('hide');
                                        iziToast.success({message:data.message, position: "topRight"});
                                        this.getSocialItems();

                                    }else{
                                        $('#DelModal').modal('hide')
                                        iziToast.error({message:data.message, position: "topRight"});
                                    }

                                }else if(_this.alert == 2) {

                                    if(data.status === 'success'){
                                        $("#DelModal").modal('hide');
                                        toastr.success(data.message);
                                        this.getSocialItems();

                                    }else{
                                        $('#DelModal').modal('hide')
                                        toastr.error(data.message);
                                    }

                                }



                            })
                            .catch(err => {
                                if(err.response != undefined){
                                    var getError = err.response.data.errors;
                                    this.hasErrors = getError;
                                }
                            });
                }
            }

        });
    </script>
@endsection
