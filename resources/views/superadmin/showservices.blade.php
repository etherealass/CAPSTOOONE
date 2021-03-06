@extends('main')
@section('content')

<style>

  th {
  text-align: inherit;
  background-color: #212529;
  color:white;
  }

</style>
 
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Services</li>
        </ol> 

        <!-- Icon Cards-->
        <div class="row" style="margin-left: 5px;margin-bottom: 0px">
          <div class="col-xl-8 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px">Services</p>
              </div>

                @include('flash::message')

            </div>
          </div>
          <div class="col-xl-4 col-sm-9 mb-10">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <a style="color:white" href="{{URL::to('/create_service')}}"><button class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 0px">New Service</button></a>
                </div>
              </div>
            </div>
         </div>
        <!-- <div class="card-body" style="margin-left: 10px">
               <div class="row" style="margin-left: 10px;">
                       @foreach($services as $service)
                      <div class="col-xl-4 col-sm-9 mb-10" style="height: 14rem;margin-top: 30px">
                        <div class="card border-dark mb-3 text-black o-hidden h-100">
                          <div class="card-body">
                              <p style="font-size: 40px;margin-top: 7px">{{$service->name}}</p>
                            <div class="mr-5"></div>
                          </div>
                          <a style="color:black" class="card-footer text-white clearfix small z-1" href="{{URL::to('/viewservice', $service->id)}}">
                            <span style="color:black" class="float-left">View Details</span>
                            <span  style="color:black" class="float-right">
                              <i class="fas fa-angle-right"></i>
                            </span>
                          </a>
                        </div>
                    </div>
                    @endforeach
                  </div> 
          </div>-->

          <div class="card-body" style="margin-left: 10px">
            <div class="table-responsive">
                  <table class="table table-bordered" id="serviceTable" width="100%" cellspacing="0" style="text-align: center">
                      <thead>
                          <tr>
                            <th>Service</th>
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                       @foreach($services as $service)
                            <tr>
                                <td>{{$service->name}}</td>
                                <td>
                                    <button class="btn btn-info editServices " id="editServices" name="editServices" value="{{$service->id}}">Edit</button>
                                    <button class="btn btn-danger deleteServices" id="deleteServices" name="deleteServices" value="{{$service->id}}">Inactive</button>
                                      <input type="hidden" id="service_id" name="service_id" value="{{$service->id}}"></td>
                            </tr>
                         @endforeach
                      </tbody>
              </table>
            </div>
          </div>

          <div class="modal fade" id="EditServiceModal" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="EditServiceModalLabel">Edit Service</h4>
                        </div>
                        <div class="modal-body">
                            <form id="EditServiceModalData" name="EditServiceModalData" class="form-horizontal" novalidate="">
                                <div class="form-group">
                                    <label for="servicename">Service Name</label>
                                     <input type="text" id="servicename" class="form-control" required="required" autofocus="autofocus" name="name">
                                    <label for="servicedesc">Description</label>
                                      <input style="height:100px;" type="textbox" id="servicedesc" class="form-control" required="required" name="description">                              
                                  </div>
                                  <div class="form-group">

                                        <label>Display</label>
                                      <div class="id_100">
                                        <select id="display[]" class="selectpicker form-control display_{{$service->id}}" style="font-size: 18px; width: 500px;height: 100px" name="display[]" multiple="multiple">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id}}">{{ $role['name'] }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                      <label>Notify</label>
                                      <select id="notify[]" class="selectpicker form-control notif_{{$service->id}}" style="font-size: 18px; width: 500px;height: 100px" name="notify[]" multiple="multiple">
                                      @foreach($roles as $role)
                                       <option value="{{ $role->id}}">{{ $role['name'] }}</option>
                                      @endforeach
                                
                                    </select>
                                </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"  id="btn-attended" name ="btn-attended" value="add">Save changes
                            </button>
                            


                        </div>
                    </div>
                </div>
            </div>

        

@endsection

@section('script')
<script>
      
  $(document).ready(function () {

              $('#serviceTable').DataTable();

              $(".selectpicker").selectpicker();


              $('.editServices').click(function () {
                    
                 var service_id = $(this).val();

                  $('#EditServiceModalData').trigger("reset");
                  $('#EditServiceModal').modal('show');
                   
                var ajaxurl = '{{URL::to("/view/service")}}';
                   //var data = [{'id': $(this).val()}]

              $.ajax({
                contentType: "application/json; charset=utf-8",
                type: "GET",
                url: ajaxurl,
                data: {'id': $(this).val()},

               success: function (data) {

                  $serivcename = data['service']['name'];

                  $description = data['service']['description'];


                 if (data['notify'].length> 0){ 

                      for(var a=0; a<data['notify'].length; a++) {
                          var notifId =data['notify'][a]['role'];
                        

                          $('.notif_'+service_id+' option[value='+notifId+']').attr('selected','selected');


                      }

                  }

                   if (data['display'].length> 0){ 

                      for(var a=0; a<data['display'].length; a++) {
                          var displayId =data['display'][a]['role'];

                          $('.display'+service_id+' option[value='+displayId+']').attr('selected','selected');


                      }

                  }





                  console.log($serivcename);
                 
                    $('#servicename').val($serivcename);
                    $('#servicedesc').val($description);
                },
               error: function (data) {
                    console.log('Error:', data);

                }


            
              });

              });


               $('.deleteServices').click(function () {
                    
                  

                });

              

  

  })


  </script>
@endsection