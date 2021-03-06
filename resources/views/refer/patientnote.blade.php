@section('style')

<style> 
section {
    padding: 60px 0;
}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}
#tabs{
  background: #007b5e;
    color: #eee;
}
#tabs h6.section-title{
    color: #eee;
}

#tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #f3f3f3;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 4px solid !important;
    font-size: 20px;
    font-weight: bold;
}
#tabs .nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #eee;
    font-size: 20px;
}
</style>
@endsection

  <div class="tab-pane fade" id="v-pills-patientnote" role="tabpanel" aria-labelledby="v-pills-patientnote-tab">
  
      <div class="row">
      <div style="width: 100%">
        <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa fa-user-md" style="font-size:32px;"></i></a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-user-nurse"  style="font-size:32px;"></i></a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-tooth" style="font-size:32px;"></i></a>
            <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false"><i class="fas fa-brain"  style="font-size:32px;"></i></a>
            <a class="nav-item nav-link" id="nav-social-worker-tab" data-toggle="tab" href="#nav-social-worker" role="tab" aria-controls="nav-social-worker" aria-selected="false"><i class="fas fa-user-check" style="font-size:32px;"></i></a>
          </div>
        </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

  <!--DOCTOR-->
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
             <div class="container">

                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addDoctortNotes"><button id="addDoctortNotes" name="addDoctortNotes" class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i></button></a></div>

                 <div class="table-responsive scrollAble2">
                       <table class="table table-bordered"  id="doctorsTable" width="100%" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th width="15%">Date/Time</th>
                               <th width="15%">Service Type</th>
                               <th>Notes</th>
                               <th width="15%">By</th>
                               <th width="10%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="doctor-list" name="doctor-list">
                           @foreach ($patient_notes as $patient_note)
                             @if($patient_note->role_type == "doctor")
                              <tr id="doctor_{{$patient_note->id}}">
                                    <td>{{$patient_note->date_time}}</td>
                                    <td>{{$patient_note->servicex->name}}</td>
                                    <td>{{$patient_note->notes}}</td>
                                    <td>{{$patient_note->userx->lname}}, {{$patient_note->userx->fname}}</td>
                                    <td>{{$patient_note->note_by}}</td>
                                </tr>

                             @endif
                          @endforeach
                          </tbody>
                        </table>
                     </div>
             </div>          
          </div>

  <!--nurse-->
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
             <div class="container">

                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addNurseNotes"><button id="addNurseNotes" name="addNurseNotes" class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i></button></a></div>

                 <div class="table-responsive scrollAble2">
                       <table class="table table-bordered" id="nurseTable"  width="100%" style="font-size: 12px">
                            <thead>
                              <tr>
                               <th width="15%">Date/Time</th>
                               <th width="15%">Service Type</th>
                               <th>Notes</th>
                               <th width="15%">By</th>
                               <th width="10%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="nurse-list" name="nurse-list">
                              @foreach ($patient_notes as $patient_note)
                             @if($patient_note->role_type == "nurse")
                              <tr id="{{$patient_note->id}}">
                                    <td>{{$patient_note->date_time}}</td>
                                    @if($patient_note->service_id)
                                    <td>{{$patient_note->servicex->name}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>{{$patient_note->notes}}</td>
                                    <td>{{$patient_note->userx->lname}}, {{$patient_note->userx->fname}}</td>
                                    <td>{{$patient_note->note_by}}</td>
                                </tr>
                             @endif
                          @endforeach
                          </tbody>
                        </table>
                     </div>
             </div>
          </div>


    <!--Dental-->
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
             <div class="container">

                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addDentalNotes"><button id="addDentalNotes" name="addDentalNotes" class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i></button></a></div>

                 <div class="table-responsive scrollAble2">
                       <table class="table table-bordered"  id="dentalTable" width="100%" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th width="10%">Date</th>
                               <th width="25%">Diagnosis</th>
                               <th>Tooth No.</th>
                               <th width="22%">Service Rendered</th>
                                <th width="15%">Dentist</th>
                                <th width="22%">Remarks</th>
                            </tr>
                            </thead>
                          <tbody id="dental-list" name="dental-list">
                              @foreach ($DentalNotes as $dental_notes)
                               <tr id="dental_{{$dental_notes->id}}">
                                    <td>{{$dental_notes->date_time}}</td>
                                    <td>{{$dental_notes->diagnose}}</td>
                                    <td>{{$dental_notes->tooth_no}}</td>
                                    <td>{{$dental_notes->service_rendered}}</td>
                                    <td>{{$dental_notes->userxk->lname}}, {{$dental_notes->userxk->fname}}</td>
                                    <td>{{$dental_notes->remarks}}</td>  
                                </tr>

                              @endforeach

                          </tbody>
                        </table>
                     </div>
             </div>          
          
          </div>


          <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                 <div class="container">

                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addPyschiatristNotes"><button id="addPyschiatristNotes" name="addPsychiatristNotes" class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i></button></a></div>

                 <div class="table-responsive scrollAble2">
                       <table class="table table-bordered" id="psychiatristTable" width="100%" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th width="15%">Date/Time</th>
                               <th width="15%">Service Type</th>
                               <th>Notes</th>
                               <th width="15%">By</th>
                               <th width="10%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="psychiatrist-list" name="psychiatrist-list">
                              @foreach ($patient_notes as $patient_note)
                             @if($patient_note->role_type == "psychiatrist")
                              <tr id="psychiatrist_{{$patient_note->id}}">
                                    <td>{{$patient_note->date_time}}</td>
                                    @if($patient_note->service_id)
                                    <td>{{$patient_note->servicex->name}}</td>
                                    @else
                                    <td></td>
                                    @endif                                    <td>{{$patient_note->notes}}</td>
                                    <td>{{$patient_note->userx->lname}}, {{$patient_note->userx->fname}}</td>
                                    <td>{{$patient_note->note_by}}</td>
                                </tr>

                             @endif
                          @endforeach
                          </tbody>
                        </table>
                     </div>
             </div>
          </div>

          <div class="tab-pane fade" id="nav-social-worker" role="tabpanel" aria-labelledby="nav-social-worker-tab">
                 <div class="container">

                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addSocialWorkerNotes"><button id="addSocialWorkerNotes" name="addSocialWorkerNotes" class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i></button></a></div>

                 <div class="table-responsive scrollAble2">
                       <table class="table table-bordered"  id="socialworkerTable" width="100%" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th width="15%">Date/Time</th>
                               <th width="15%">Service Type</th>
                               <th>Notes</th>
                               <th width="15%">By</th>
                               <th width="10%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="socialworker-list" name="socialworker-list">
                              @foreach ($patient_notes as $patient_note)
                             @if($patient_note->role_type =="socialworker")
                              <tr id="socialworker_{{$patient_note->id}}">
                                    <td>{{$patient_note->date_time}}</td>
                                    <td>{{$patient_note->servicex->name}}</td>
                                    <td>{{$patient_note->notes}}</td>
                                    <td>{{$patient_note->userx->lname}}, {{$patient_note->userx->fname}}</td>
                                    <td>{{$patient_note->note_by}}</td>
                                </tr>

                             @endif
                          @endforeach
                          </tbody>
                        </table>
                     </div>
             </div>
          </div>
        </div>
      
      </div>
    </div>

 </div>

    <!--<div class="modal fade" id="DoctorNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  style="width:980px;">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="DoctorNotesModal">Add Doctor Notes</h4>
                              </div>

                            <form id="DocotorNotesFormData" name="DoctorNotesFormData" class="form-horizontal" novalidate="">

                              <div class="modal-body">
                                 <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="doctorList"  name="doctorList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 3)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="note" class="form-control" placeholder="Note" name="note" required="required"></textarea>
                                  </div>


                                    
                              </div>    
                                  

                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save" name ="btn-save" value="add">Save changes
                                  </button>
                              </div>
                          </form>

                  </div>
          </div>
  </div>-->

   <div class="modal fade" id="NurseNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  style="width:980px;">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="NurseNotesModal">Add Nurse Notes</h4>
                              </div>
                          <form id="NurseNotesFormData" name="NurseNotesFormData" class="form-horizontal" novalidate="">
                              <div class="modal-body">
                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control nurseList" id="nurseList"  name="nurseList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                        <option value=" ">--NONE--</option>
                                          @foreach($service as $services)
                                          @if($services->role == 4)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="nursenote" class="form-control" placeholder="Note" name="nursenote" required="required"></textarea>
                                  </div>
                                  

                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-nursenotes" name ="btn-save-nursenotes" value="add">Save changes
                                  </button>
                                    <input type="hidden" id="id" name="id" value="0">
                                    <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                    <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                    <input type="hidden" id="creator_role" name="creator_role" value="doctor">

                              </div>
                         </form>

                  </div>
          </div>
  </div>

<!--Modal for the Check up button-->
<!--   <div class="modal fade" id="AddServiceNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddServiceNotesModal">Add Patient Service</h4>
                              </div>
                              <form id="AddServiceFormData" name="AddServiceFormData" class="form-horizontal" novalidate="">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="patientList"  name="patientList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                      @foreach($service as $services)
                                          <option value="{{$services->id}}"> {{$services->name}}</option>
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="note" class="form-control" placeholder="Note" name="note"></textarea>
                                  </div>
                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-patientnotes" name ="btn-save-patientnotes" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">

                                  <input type="hidden" id="creator_role" name="creator_role" value="doctor">



                              </div>
                  </div>
          </div>
  </div>-->

 <div class="modal fade" id="AddDoctorNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddDoctorNotesModal">Add Doctor Service</h4>
                              </div>
                              <form id="AddDoctorFormData" name="AddDoctorFormData" class="form-horizontal" novalidate="">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control doctorList" id="doctorList"  name="doctorList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 3)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="notes" class="form-control" placeholder="Note" name="notes" required="required"></textarea>
                                  </div>


                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-doctornotes" name ="btn-save-doctornotes" value="add">Save changes
                                  </button>
                                 <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="creator_role" name="creator_role" value="doctor">


                              </div>
                  </div>
          </div>
  </div>

 <div class="modal fade" id="AddDentalNotesModal" aria-hidden="true" >
      <div class="modal-dialog">
            <div class="modal-content" style="width:800px" >
                  <div class="modal-header" style="width:800px">
                       <h4 class="modal-title" id="AddDentalNotesModal">Add Dental Service</h4>
                  </div>
                       <form id="AddDentalFormData" name="AddDentalFormData" class="form-horizontal" novalidate="">
                  <div class="modal-body" style="width:800px">
                         <div class="form-group">
                                <div class="form-label-group">
                                  <h6>Tooth No.</h6>
                                  <input style="width:30%;" type="number" id="tooth_no" class="form-control" placeholder="Description" required="required" name="tooth_no">
                                </div>
                            </div>
                        <div class="form-group">
                                <div class="form-label-group">
                                  <h6>Diagnosis</h6>
                                  <input style="height:100px;word-wrap: break-word;" type="textbox" id="diagnosis" class="form-control" placeholder="Description" required="required" name="diagnosis">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                  <h6>Service Rendered</h6>
                                  <input style="height:100px;word-wrap: break-word;" type="textbox" id="service_rendered" class="form-control" placeholder="Service Rendered" required="required" name="service_rendered">
                                </div>
                              </div>
                            <div class="form-group">
                                        <h6>Remarks</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px;word-wrap: break-word;" type="text" id="remarks" class="form-control" placeholder="Note" name="remarks" required="required"></textarea>
                                  </div>

                        </div>
                       </form>
                  <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-dentalServices" name ="btn-save" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="creator_role" name="creator_role" value="social_worker">
                  </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="AddSocialWorkerNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddSocialWorkerNotesModal">Add Social Worker Service</h4>
                              </div>
                              <form id="AddSocialWorkerFormData" name="AddSocialWorkerFormData" class="form-horizontal" novalidate="">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="socialList"  name="socialList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 3)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="socialworkerNote" class="form-control" placeholder="Note" name="socialworkerNote" required="required"></textarea>
                                  </div>


                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-socialworker" name ="btn-save-socialworker" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="creator_role" name="creator_role" value="social_worker">



                              </div>
                  </div>
          </div>
  </div>

<div class="modal fade" id="AddPsychiatristNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddPsychiatristNotesModal">Add Psychiatrist Service</h4>
                              </div>
                              <form id="AddPsychiatristFormData" name="AddPsychiatristFormData" class="form-horizontal" novalidate="">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="psychiatristList"  name="psychiatristList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 3)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="notes2" class="form-control" placeholder="Note" name="notes2" required="required"></textarea>
                                  </div>


                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-psychiatristnotes" name ="btn-save-psychiatristnotes" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="creator_role" name="creator_role" value="social_worker">



                              </div>
                  </div>
          </div>
  </div>

  