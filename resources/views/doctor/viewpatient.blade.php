@extends('main')
@section('content')


    <style>

      th {
      text-align: inherit;
      background-color: #343a40;
      color:white;
      }

    </style>

        <!-- Breadcrumbs-->
      @if($pid)
        @foreach($pat as $pats)
          @if($pats->department_id != Auth::user()->department)
            @foreach($transfers as $trans)
              @if($trans->status == "")
        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          <a href="{{URL::to('transfer_patient_now/'.$pats->id.'/'.$trans->to_department.'/'.$trans->transfer_id.'/'.$pid)}}" class="btn btn-primary" style="margin-left:550px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Enroll</p></a>
        </ol>
              @elseif(Auth::user()->department == $pats->department_id)
          <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          <button class="btn btn-success" style="margin-left: 10px;margin-left:400px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
        </ol>
              @endif
            @endforeach

          @include('flash::message')
        <!-- Icon Cards-->

<div class="container">
  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
          <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
                <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-3">
                           <p style="font-size: 8px"><h6>Name:</h6><span>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</span></p>
                        </div>
                        <div class="col-md-3">
                           <p style="font-size: 8px"><h6>Date of Birth:</h6> {{$pats->birthdate}}</p>
                        </div>
                        <div class="col-md-3">
                           <p style="font-size: 8px"><h6>Address:</h6> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                        </div>
                        <div class="col-md-3">
                           <p style="font-size: 8px"><h6>Marital Status:</h6> {{$pats->civil_status}}</p>
                        </div>
                        <div class="col-md-3">
                           <p style="font-size: 8px"><h6>Age:</h6> {{\Carbon\Carbon::parse($pats->birthdate)->age}}</p>
                        </div> 
                      @if($pats->birthorder != NULL)
                      @if($pats->birthorder != 'NULL')
                        <div class="col-md-3">
                           <p style="font-size: 8px"><h6>Birth Order:</h6> {{$pats->birthorder}}</p>
                        </div>
                      @endif
                    @if($pats->contact != 'NULL')
                        <div class="col-md-3">
                           <p style="font-size: 8px"><h6>Contact Number:</h6> {{$pats->contact}}</p>
                        </div>
                    @endif
                    @if($pats->nationality != 'NULL')
                        <div class="col-md-3">
                           <p style="font-size: 8px"><h6>Nationality:</h6> {{$pats->nationality}}</p>
                        </div>
                   @endif
                  @if($pats->religion != 'NULL')
                        <div class="col-md-3" style=""> 
                           <p style="font-size: 8px"><h6>Religion:</h6> {{$pats->religion}}</p>
                        </div>
                 @endif
                @endif
                    </div>
                </div>
  </fieldset>
  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
      <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Transfer Remarks</legend>
          <div class="container" style="margin-left: 10px">
            <div class="row">
            @foreach($transfers as $trans)
              <p style="margin-left: 30px">{{$trans->remarks}}</p>
            @endforeach
           </div>
          </div>
  </fieldset>
  </div>
          @endif
        @endforeach
      @elseif($pid == '0')
        @foreach($pat as $pats) 
          @if($pats->department_id == Auth::user()->department)
        @if($pats->status == 'Enrolled')
        <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><h4 style="color:#343a40"> Patient Status: <span class="text-primary">Enrolled</span></p>
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-4" style="margin-top: 10px">
    
                <button class="btn btn-success" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}" data-toggle="modal" data-target="#patientGraduate" style="margin-left:10px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" data-toggle="modal" data-patientdep="{{$pats->department_id}}" data-patientid="{{$pats->id}}" data-target="#patientDismiss" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
    
          </div>
         </div>
            @elseif($pats->status == 'For Graduate')
        <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><h4 style="color:#343a40"> Patient Status: <span class="text-warning">For Graduation</span></h4></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
            <ol class="breadcrumb" style="height: 100px;font-size:40px;text-align: center;">
              <li class="breadcrumb-item active" style="margin-left: 60px;margin-top: 20px"><span><h3>---Pending---<h3></span></li>
            </ol>
          </div>
         </div>
         @elseif($pats->status == 'Graduated')
        <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><h4 style="color:#343a40"> Patient Status: <span class="text-success">Graduated</span></h4></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
           
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}" data-toggle="modal" data-target="#patientReenroll" style="margin-left:60px;height: 60px;width: 90px;margin-top: 10px">Re-enroll</button>
            
          </div>
         </div>
          @elseif($pats->status == 'Dismissed')
        <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><h4 style="color:#343a40"> Patient Status: <span class="text-danger">Dismissed</span></h4></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
        
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-patientdep="{{Auth::user()->department}}" data-toggle="modal" data-target="#patientReenroll" style="margin-left:60px;height: 60px;width: 90px;margin-top: 10px">Re-enroll</button>
        
          </div>
         </div>
         @endif


          @include('flash::message')

          <!--Tabs-->
          <div class="row" style="margin-left: 0px">
          <div>
          <div class="col-md-12">
             <ul class="sidebar navbar-nav" style="background-color:white;border-radius: 5rem;">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-radius: 5rem">
                <li class="nav-item active"  id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="margin-top: 10px;border-radius: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Information</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Refer</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Sessions</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>History</span></h6></a>
                </li>
                <li class="nav-item"  id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="true" style="margin-top: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="true" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Intake</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="color:white;margin-bottom: 5px;height: 75px;text-align: center;border-radius: 5px"><h6><span>Drug Dependency Examination</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false" style="color:white;margin-bottom: 5px;height: 65px;text-align: center;border-radius: 5px"><h6><span>Doctor's Progress Notes</span></h6></a>
                </li>
              </div>
            </ul>
          </div>
        </div>
          <div class="col-md-9">
              <div class="tab-content" id="v-pills-tabContent" >
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <fieldset style="margin-bottom: 30px;border:solid thin gray;border-radius: 10px">
                       <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-3">
                          <p style="font-size: 8px"><h6>Name:</h6><span>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</span></p>
                         </div>
                       <div class="col-md-3">
                          <p style="font-size: 8px"><h6>Date of Birth:</h6> {{$pats->birthdate}}</p>
                       </div>
                      <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Address:</h6> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                      </div>
                      <div class="col-md-3">
                       <p style="font-size: 8px"><h6>Marital Status:</h6> {{$pats->civil_status}}</p>
                      </div>
                      <div class="col-md-3">
                         <p style="font-size: 8px"><h6>Age:</h6> {{\Carbon\Carbon::parse($pats->birthdate)->age}}</p>
                      </div> 
                      @if($pats->birthorder != NULL)
                      @if($pats->birthorder != 'NULL')
                      <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Birth Order:</h6> {{$pats->birthorder}}</p>
                      </div>
                      @endif
                    @if($pats->contact != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6>Contact Number:</h6> {{$pats->contact}}</p>
                    </div>
                    @endif
                    @if($pats->nationality != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6>Nationality:</h6> {{$pats->nationality}}</p>
                    </div>
                   @endif
                  @if($pats->religion != 'NULL')
                   <div class="col-md-3" style=""> 
                     <p style="font-size: 8px"><h6>Religion:</h6> {{$pats->religion}}</p>
                  </div>
                 @endif
                @endif
                  </div>
                </fieldset>
                 <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">General Information</legend>
                    <div class="container" style="margin-left: 10px">
                      <div class="row">
                        <div class="col-md-3">
                         <p style="font-size: 8px"><h6>Patient Type:</h6> {{$pats->type->case_name}}</p>
                      </div>
                      @if($pats->jails != "")
                      <div class="col-md-3">
                         <p style="font-size: 8px"><h6>City Jail:</h6> {{$pats->jails->name}}</p>
                      </div>
                      @endif
                      @if($pats->caseno != "")
                       <div class="col-md-3">
                         <p style="font-size: 8px"><h6>Case Number:</h6> {{$pats->caseno}}</p>
                      </div>
                      @endif  
                        <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Department:</h6> {{$pats->departments->department_name}} Department</p>
                       </div>
                       <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Date Admitted:</h6> {{$pats->date_admitted}}</p>
                       </div>
                       @if($pats->case != "")
                        <div class="col-md-2">
                        <p style="font-size: 8px"><h6>Case Type:</h6> {{$pats->case}}</p>
                       </div>
                       @endif
                       @if($pats->submission != "")
                        <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Submission Type:</h6> {{$pats->submission}}</p>
                       </div>
                       @endif
                        <div class="col-md-10">
          
                       </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <!--Patient History-->
                <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Patient History</legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                          <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th>Date</th>
                               <th>Performed By</th>
                               <th>Type</th>
                               <th>From Department</th>
                               <th>To Department</th>
                               <th>Remarks</th>
                            </tr>
                            </thead>
                          <tbody>
                            @foreach($history as $hist)
                            <tr>
                              <td>{{$hist->date}}</td>
                              <td>{{$hist->userss->fname}} {{$hist->userss->lname}}</td>
                              <td>{{$hist->type}}</td>
                              @if($hist->dep)
                              <td>{{$hist->dep->department_name}} Department</td>
                              @else
                              <td></td>
                              @endif  
                              <td>{{$hist->deps->department_name}} Department</td>
                              <td>{{$hist->remarks}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>
                      </div>
                     </div>
                </fieldset>
                </div>
          <!--Doctor's Note Tab-->
              <div class="tab-pane fade" id="v-pills-doctornote" role="tabpanel" aria-labelledby="v-pills-doctornote-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Doctor's Progress Notes </legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                           <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-print"></i>Print</button></a></div>
                          @if(Auth::user()->user_role->name == 'Doctor')
                         <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="#addNotes"><button class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i>Add Notes</button></a></div>
                          @endif
                          <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th>Date/Time</th>
                               <th>Notes</th>
                            </tr>
                            </thead>
                            <tbody>
                          @foreach($notes as $note)
                            <tr>
                              <td>{{$note->date_time}}</td>
                              <td>{{$note->notes}}</td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>
                      </div>
                     </div>
                </fieldset>
              </div>
      <!--Intake Tab-->
        <div class="tab-pane fade" id="v-pills-intake" role="tabpanel" aria-labelledby="v-pills-intake-tab">
          <fieldset style="margin-bottom: 10px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 10px;border-radius: 5px" class="bg bg-dark">Intake Form </legend>
            <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
            @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
            <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-success"><i class="fas fa-fw fa fa-pen"></i>Edit</button></a></div>
            @endif
          <div class="container scrollAble2" style="margin-top: 30px">
            <div class="container" style="border:solid thin gray;border-radius: 10px">
              <p style="float: left;margin-top: 20px"><img src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
              <p style="float: right;margin-top: 20px"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p><br><p style="text-align: center;font-size: 12px"><b>Republic of the Philippines<br> Department of Health</b><br>
              <b>DANGEROUS DRUGS ABUSE PREVENTION & TREATMENT PROGRAM</b><br><b>TREATMENT & REHABILITATION CENTER - Cebu City</b><br><b>Outpatient and Aftercare Department</b><br>Jagobiao, Mandaue City, Cebu<br>
              <font size="1px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: <u>cebu_trc@yahoo.com.ph</u></font><br>
              </p>
            <center style="margin-bottom: 40px"><h5>INTAKE FORM</h5></center>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-6"><p><b>Client's Name: </b><u style="font-size: 15px">{{$pats->fname}} {{$pats->lname}}</u></p></div>
                <div class="col-md-6"><p><b>Date: </b><u style="font-size: 15px">{{date('M-j-Y')}}</u></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-4"><p><b>Date of Birth: </b><u style="font-size: 15px">{{$pats->birthdate}}</u></p></div>
                <div class="col-md-2"><p><b>Age: </b><u style="font-size: 15px">{{\Carbon\Carbon::parse($pats->birthdate)->age}}</u></p></div>
                <div class="col-md-4"><p><b>Marital Status: </b><u style="font-size: 15px">{{$pats->civil_status}}</u></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-12"><p><b>Home Address: </b></div>
                <div class="col-md-12"><p><u style="font-size: 15px">{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</u></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                @foreach($patos as $patss)
                <div class="col-md-6"><p><b>Educational Attainment: </b><u style="font-size: 15px">{{$patss->educational_attainment}}</u></p></div>
                <div class="col-md-6"><p><b>Employement Status: </b><u style="font-size: 15px">{{$patss->employment_status}}</u></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-12"><p><b>Name of Spouse: </b><u style="font-size: 15px">{{$patss->spouse}}</u></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-12"><p><b>Parents: </b></p></div>
              </div>
              <div class="row" style="margin-left: 50px;font-size: 12px">
                <div class="col-md-12"><p><b>Father's Name: </b><u style="font-size: 15px">{{$patss->father}}</u></p></div>
                <div class="col-md-12"><p><b>Mother's Name: </b><u style="font-size: 15px">{{$patss->mother}}</u></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-12"><p><b>Whom to notify in case of emergency: </b></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-6"><p><b>Name: </b><u style="font-size: 15px">{{$patss->eperson->name}}</u></p></div>
                <div class="col-md-6"><p><b>Relationship: </b><u style="font-size: 15px">{{$patss->eperson->relationship}}</u></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-4"><p><b>Phone No. (Home): </b><u style="font-size: 15px">{{$patss->eperson->phone}}</u></p></div>
                <div class="col-md-4"><p><b>Cellphone No.: </b><u style="font-size: 15px">{{$patss->eperson->cellphone}}</u></p></div>
                <div class="col-md-4"><p><b>Email add: </b><u style="font-size: 10px">{{$patss->eperson->email}}</u></p></div>
              </div>
               <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-12"><p><b>Presenting Problems: </b></p></div>
              </div>
               <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-12"><p><u style="font-size: 15px">{{$patss->presenting_problems}}</u></p></div>
              </div>
               <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-12"><p><b>Impression: </b></p></div>
              </div>  
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-12"><p><u style="font-size: 15px">{{$patss->impression}}</u></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-6"><p><b>Intake Officer Signature: </b></p></div>
                <div class="col-md-6"><p><b>Date: </b></p></div>
              </div>
                @endforeach
            </div>
            </div>
          </fieldset>
        </div>
        <div class="tab-pane fade" id="v-pills-dde" role="tabpanel" aria-labelledby="v-pills-dde-tab">
            <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
              <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Drug Dependency Examination Report</legend>
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
                @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><button class="btn btn-success" data-toggle="modal" data-target="#ddeFormEdit"><i class="fas fa-fw fa fa-pen"></i>Edit</button></div>
                @endif
                    <div class="container" style="margin-top: 60px;margin-bottom: 30px">
                      <div class="container" style="border:solid thin gray;border-radius: 10px">
                        <div style="margin-top:30px">
                          <img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px" style="float:left;">
                          <p style="text-align:center;position:relative;"><b style="font-size: 25px">TREATMENT & REHABILITATION CENTER - CEBU</b><br><span style="font-size:20px">Drug Dependency Examination Report</span></p>
                        </div>
  
            <div class="row" style="margin-top: 50px;padding:20px">
              <div class="col-md-6" style="border: solid gray 1px;padding:20px;font-size: 12px;border-right: none">
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                  <?php $count = 0 ?>
                  @foreach($history as $hist)
                    @if($hist->type == 'Enrolled')
                      @if($hist->deps->department_name == $pats->departments->department_name)
                      <?php $count++; ?>
                      @endif
                    @endif
                  @endforeach
                    <input type="checkbox" class="custom-control-input" id="new case" name="casetype" value="New Case" {{ ($count != 1)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="new case"><b>Old Case</b></label>
                  </div>
                </div>
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="old case" name="casetype" value="Old Case" {{ ($count == 1)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="old case"><b>New Case</b></label>
                  </div>
                </div>
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="case" name="casetype" value="With Court Case" {{ ($pats->caseno != NULL)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="case"><b>With Court Case:</b>
                  @if($pats->caseno != NULL)
                    <b><u> {{$pats->caseno}}</u></b>
                  @else
                    ________________________________________
                  @endif
                    </label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-6" style="border: solid gray 1px;padding:20px;font-size: 12px">
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline" style="font-size: 50px">
                    <input type="checkbox" class="custom-control-input" id="Voluntary Submission" name="type" value="Voluntary Submission" {{ ($pats->type->case_name == 'Voluntary' || $pats->type->case_name == 'Voluntary with Court Order')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Voluntary Submission"><b>Voluntary Submission</b></label>
                  </div>
                </div>
                  <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="Compulsory Submission" name="type" value="Compulsory Submission" {{ ($pats->type->case_name == 'Plea Bargain')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Compulsory Submission"><b>Compulsory Submission</b></label>
                  </div>
                  </div>
                  <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="others" name="type" value="Others" {{ (old('type') == 'Others') ? 'checked' : '' }} disabled="true">
                    <label class="custom-control-label" for="others"><b>Others: ___________________________________</b></label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-12" style="border: solid gray 1px;font-size: 12px;border-top:none;border-right:none">
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <b><p>Last name:</p></b>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->lname}}</p>
                  </div>
                  <div class="col-md-6" style="border-right: solid gray 1px;">
                    <b><p>Address:</p></b>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>First name:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->fname}}</p>
                  </div>
                  <div class="col-md-6" style="border-right: solid gray 1px;border-bottom: solid gray 1px;">
                    <p>{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                  </div>
                 </div>
                  <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Middle name:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->mname}}</p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Contact Number:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->contact}}</p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Age:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{\Carbon\Carbon::parse($pats->birthdate)->age}}</p>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Gender:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p></p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Birthdate:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->birthdate}}</p>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Civil Status:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p></p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Birth Order:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->birthorder}}</p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Nationality:</b></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p></p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;">
                    <p><b>Religion:</b></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                 </div>
                </div> 
              </div>
              <div class="row" style="padding:20px">
                <div class="col-md-12" style="border: solid gray 1px;font-size: 12px">
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;">
                    <p><b>Referred by:</b></p>
                  </div>
                  <div class="col-md-9" style="border-right: none">
                    <p></p>
                  </div>
                </div>
              @if($patis != '[]')
                @foreach($patis as $patin)
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Accompanied By/<br>Informant</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                      <div class="col-md-6"><b>Name:</b> {{$patin->informants->name}}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Address:</b> {{$patin->informants->address}}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-5"><b>Signature:</b> _____________________________</div>
                      <div class="col-md-5"><b>Contact no:</b> {{$patin->informants->contact}}</div>
                    </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>DRUGS ABUSED<br>(Present)</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->drugs_abused}}</div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Chief Complaint</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->chief_complaint}}</div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>History of Present<br>Illness</b></p>
                  </div>
                   <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->h_present_illness}}</div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>History of Drug<br>Use</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->h_drug_abuse}}</div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>Family/Personal<br>History</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->famper_history}}</div>
                   </div>
                  </div>
                </div>
                 @endforeach
                @elseif($patis == '[]')
                    <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Accompanied By/<br>Informant</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                      <div class="col-md-6"><b>Name:</b></div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Address:</b></div>
                    </div>
                    <div class="row">
                      <div class="col-md-5"><b>Signature:</b> _____________________________</div>
                      <div class="col-md-5"><b>Contact no:</b></div>
                    </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>DRUGS ABUSED<br>(Present)</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Chief Complaint</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>History of Present<br>Illness</b></p>
                  </div>
                   <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>History of Drug<br>Use</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>Family/Personal<br>History</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
    </fieldset>
  </div>
      </div>
    </div>
    @elseif($pats->department_id != Auth::user()->department)
    <h1>Patient Not Found/Transfered/Deleted</h1>
    @endif
    @endforeach
    @endif

<!--Dismiss modal-->
<div class="modal fade" id="patientDismiss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Specify a reason to dismiss</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/patientDismiss')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body" style="margin-bottom: 50px">
          <div class="form-label-group" style="height: 100px">
              <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
              <input type="hidden" id="patientdep" name="patientdep" class="form-control" value="">
                <select class="form-control" id="dismissal" placeholder="Dismissal Reason" required="required" name="dismissal">
                  <label for="dismissal">Dismissal Reason</label>
                    <option value="" disabled selected hidden>--Choose a Reason--</option>
                     @foreach($reasons as $reas)
                    <option value="{{$reas->id}}">{{$reas->reason}}</option>
                     @endforeach
                    <option value="Others">Others</option>
                </select>
                <div class="form-label-group" id="text" style="display: none;margin-top: 20px">
                  <textarea style="margin-left:0px;height: 100px;margin-bottom: 10px" type="text" id="remarks" class="form-control" placeholder="Specify Reason" name="remarks"></textarea>
                </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>  
          </div>
        </form>
      </div>
    </div>
</div>
  
<!--Choose a form for re-enrolling-->
<div class="modal fade" id="reenrollForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Choose a form to be filled-up</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      <div style="margin-bottom: 50px">
        <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="modal-body">
                <p style="font-size: 10px;margin-top: 7px"><h6>Intake Form</h6></p>             
                <button type="submit" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#intakeForms" data-patientid="{{$pats->id}}">Proceed</button>
              </div>
            </div>
        </div>
      </div>
      <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="modal-body">
                <p style="font-size: 10px;margin-top: 7px"><h6>Drug Dependency Form</h6></p>             
                <button type="submit" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#ddeForms" data-patientid="{{$pats->id}}">Proceed</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<!--Intake Re-enroll Form-->
<div class="modal2 fade" id="intakeForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width:1000px">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{Auth::user()->user_department->department_name}} Department (Intake Form)</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="container scrollAble2" style="margin-top: 30px">
          <form action="{{URL::to('/reenrollpatientsave_intake')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Intake Information</legend>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-4 mb-4">
                <div class="form-label-group">
                  <h6>Patient Type*</h6>
                <select class="form-control" id="ptype" placeholder="Patient Type" required="required" name="ptype">
                  @foreach($case as $cases)
                    @if($cases->case_name == $pats->type->case_name)
                    <option  id="{{$cases->court_order}}" value="{{$cases->id}}" selected>{{$cases->case_name}}</option>
                    @else
                    <option id="{{$cases->court_order}}" value="{{$cases->id}}">{{$cases->case_name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
              @if($pats->type->court_order == 0)
                <div class="form-label-group" id="textb" style="display: none;">
              @else
                <div class="form-label-group" id="textb">
              @endif
                  <h6>City Jail*</h6>
                <select class="form-control" id="jail" placeholder="Patient Type" required="required" name="jail">
              @if($pats->jail != NULL)
                @foreach($jails as $jail)
                  @if($jail->name == $pats->jails->name)
                    <option value="{{$jail->id}}" selected>{{$jail->name}}</option>
                  @else
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                  @endif
                @endforeach
              @else
                @foreach($jails as $jail)
                    <option value="" disabled selected hidden>City Jail</option>
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
              @endif
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
              @if($pats->caseno != NULL)
                @if($pats->type->court_order == 0)
                <div class="form-label-group" id="textas" style="display: none;">
                @else
                <div class="form-label-group" id="textas">
                @endif
                  <h6>Case Number*</h6>
                    <input type="text" id="caseno" class="form-control" placeholder="Case Number" required="required" autofocus="autofocus" name="caseno" value="{{$pats->caseno}}">
                </div>
              @else
                <div class="form-label-group" id="textas" style="display: none;">
                  <h6>Case Number*</h6>
                    <input type="text" id="caseno" class="form-control" placeholder="Case Number" required="required" autofocus="autofocus" name="caseno" value="">
                </div>
              @endif
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <h6>Last name*</h6>
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{{$pats->lname}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                   <h6>First name*</h6>
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{$pats->fname}}">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-label-group">
                   <h6>Age*</h6>
                  <input type="number" id="age" class="form-control" required="required" autofocus="autofocus" name="age" value="{{\Carbon\Carbon::parse($pats->birthdate)->age}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{{$pats->birthdate}}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="department" value="{{Auth::user()->user_department->id}}">
                  <input type="hidden" name="patdepartment" value="{{$pats->department_id}}">
                  <input type="hidden" name="patient_id" value="{{$pats->id}}">
                  <input type="hidden" name="patientadd" value="{{$pats->address_id}}">
                  @if($patos != NULL)
                    @foreach($patos as $patss)
                  <input type="hidden" name="emergency_id" value="{{$patss->eperson->id}}">
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
              <div class="form-label-group">
               <h6>Street Address*</h6>
              <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{{$pats->address->street}}">
            </div>
           </div>
            <div class="col-md-3  ">
              <div class="form-label-group">
               <h6>Barangay*</h6>
              <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{{$pats->address->barangay}}">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-label-group">
               <h6>City*</h6>
              <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{{$pats->address->city}}">
            </div>
           </div>
            <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Marital Status*</h6>
                 <select class="form-control" id="civils" placeholder="{{$pats->civil_status}}" required="required" name="civils">
                  <label for="civils">{{$pats->civil_status}}</label>
                    <option value="{{$pats->civil_status}}" selected hidden>{{$pats->civil_status}}</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
                </div>
              </div>
          </div>
        </div>
        </fieldset>
      @if($patos != '[]')
        @foreach($patos as $patss)
        <fieldset>
            <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Whom to notify in case of emergency:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername" value="{{$patss->eperson->name}}">
                         </div> 
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation" value="{{$patss->eperson->relationship}}">
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone" value="{{$patss->eperson->phone}}">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell" value="{{$patss->eperson->cellphone}}">
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail" value="{{$patss->eperson->email}}">
                    </div>
                  </div>
                  </div>
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-5">
                        <div class="form-label-group">
                          <h6>Educational Attainment*</h6>
                          <select class="form-control" id="eduattain" placeholder="Civil Status" required="required" name="eduattain">
                            <label for="eduattain">Educational Attainment</label>
                            <option value="{{$patss->educational_attainment}}" selected>{{$patss->educational_attainment}}</option>
                            <option value="Elementary">Elementary Graduate</option>
                            <option value="Highschool">High-school Graduate</option>
                            <option value="College">College Graduate</option>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat">
                            <label for="edstat">Employement Status</label>
                            <option value="{{$patss->employment_status}}" selected>{{$patss->employment_status}}</option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
                        </select>
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name Of Spouse*</h6>
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse" value="{{$patss->spouse}}">
                        </div>
                      </div>
                   </div>
                </div>
                <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Parents:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Father's name*</h6>
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname" value="{{$patss->father}}">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname" value="{{$patss->mother}}">
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              <textarea type="text" id="preprob" class="form-control" placeholder="Please Specify" name="preprob" value="{{$patss->presenting_problems}}">{{$patss->presenting_problems}}</textarea>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="Please Specify" name="impre" value="{{$patss->impression}}">{{$patss->impression}}</textarea>
              </div>
          </div>
        </fieldset>
      @endforeach
        @elseif($patos == '[]')
        <fieldset>
            <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Whom to notify in case of emergency:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername">
                         </div> 
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation">
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell">
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail">
                    </div>
                  </div>
                  </div>
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-5">
                        <div class="form-label-group">
                          <h6>Educational Attainment*</h6>
                          <select class="form-control" id="eduattain" placeholder="Civil Status" name="eduattain">
                            <label for="eduattain">Educational Attainment</label>
                            <option value="" disabled hidden selected></option>
                            <option value="Elementary">Elementary Graduate</option>
                            <option value="Highschool">High-school Graduate</option>
                            <option value="College">College Graduate</option>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" name="edstat">
                            <label for="edstat">Employement Status</label>
                            <option value="" disabled hidden selected></option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
                        </select>
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name Of Spouse*</h6>
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse">
                        </div>
                      </div>
                   </div>
                </div>
                <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Parents:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Father's name*</h6>
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname">
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              <textarea type="text" id="preprob" class="form-control" placeholder="Please Specify" name="preprob"></textarea>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="Please Specify" name="impre"></textarea>
              </div>
          </div>
        </fieldset>
        @endif
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Enroll">
         </form>
      </div>
    </div>
  </div>
</div>

<!--DDE Form for Re-enrolling-->
<div class=" modal2 fade" id="ddeForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Drug Dependency Examination Report</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
  <div class="container scrollAble2" style="margin-top: 30px">
        <form action="{{URL::to('/reenrollsave_dde')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Personal Information</legend>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <h6>Last name*</h6>
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{{$pats->lname}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>First name*</h6>
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{$pats->fname}}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Middle name*</h6>
                  <input type="text" id="mname" class="form-control" placeholder="Middle name" required="required" name="mname" value="{{$pats->mname}}">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-label-group">
                   <h6>Age*</h6>
                  <input type="number" id="age" class="form-control" placeholder="Age" required="required" autofocus="autofocus" name="age" value="{{\Carbon\Carbon::parse($pats->birthdate)->age}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{{$pats->birthdate}}">
                  <input type="hidden" id="department" name="department" value="{{Auth::user()->department}}">
                  <input type="hidden" name="patdepartment" value="{{$pats->department_id}}">
                  <input type="hidden" name="patient_id" value="{{$pats->id}}">
                  <input type="hidden" name="patientadd" value="{{$pats->address_id}}">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Birth Order*</h6>
                  <input type="number" id="border" class="form-control" placeholder="" required="required" autofocus="autofocus" name="border" value="{{$pats->birthorder}}">
                </div>
              </div>
              <div class="col-md-4">
              <div class="form-label-group">
               <h6>Street Address*</h6>
              <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{{$pats->address->street}}">
            </div>
           </div>
            <div class="col-md-3  ">
              <div class="form-label-group">
               <h6>Barangay*</h6>
              <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{{$pats->address->barangay}}">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-label-group">
               <h6>City*</h6>
              <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{{$pats->address->city}}">
            </div>
           </div>
          </div>
        </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Contact no.*</h6>
                  <input type="text" id="contact" class="form-control" placeholder="Contact No." required="required" name="contact" value="{{$pats->contact}}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
              </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Gender*</h6>
                 <select class="form-control" id="gender" placeholder="Gender" required="required" name="gender">
                  @if($pats->gender == 'M')
                    <option value="{{$pats->gender}}" selected>Male</option>
                  @elseif($pats->gender == 'F')
                    <option value="{{$pats->gender}}" selected>Female</option>
                  @else
                    <option value="Others" selected>Others</option>
                  @endif
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="Others">Others</option>
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Civil Status*</h6>
                 <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils">
                  <label for="civils">Civil Status</label>
                    <option value="{{$pats->civil_status}}" selected>{{$pats->civil_status}}</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Nationality*</h6>
                <input type="text" id="nation" class="form-control" placeholder="Nationality" required="required" name="nation" value="{{$pats->nationality}}">
                </div>
              </div>
               <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Religion*</h6>
                <input type="text" id="religion" class="form-control" placeholder="Nationality" required="required" name="religion" value="{{$pats->religion}}">
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset>
        <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 20px" class="bg bg-dark">General Information</legend>
        <div class="form-group" style="margin-left: 20px">
          <div class="form-row">
            <div class="col-md-4 mb-4">
              <div class="form-label-group">
               <h6>Patient Type*</h6>
                <select class="form-control" id="ddeptype" placeholder="Patient Type" required="required" name="ddeptype">
                    <option id="{{$pats->type->court_order}}" value="{{$pats->type->id}}" selected hidden>{{$pats->type->case_name}}</option> 
                  @foreach($case as $cases)
                    <option id="{{$cases->court_order}}" value="{{$cases->id}}">{{$cases->case_name}}</option>
                  @endforeach
                </select>
                </div>
              </div>
              @if($pats->type->court_order != 0)
              <div class="col-md-4 mb-4">
               <div class="form-label-group" id="ddetextas">
                  <h6>City Jail*</h6>
                <select class="form-control" id="ddejail" placeholder="Patient Type" name="ddejail">
                    <option value="{{$pats->jails->id}}" selected hidden>{{$pats->jails->name}}</option>
                @foreach($jails as $jail)
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-label-group" id="ddetextb">
                  <h6>Case Number*</h6>
                    <input type="text" id="ddecaseno" class="form-control" placeholder="Case Number" autofocus="autofocus" name="ddecaseno" value="{{$pats->caseno}}">
                </div>
              </div>
              @else
               <div class="col-md-4 mb-4">
                <div class="form-label-group" id="ddetextas" style="display: none;">
                  <h6>City Jail*</h6>
                <select class="form-control" id="ddejail" placeholder="Patient Type" name="ddejail">
                @foreach($jails as $jail)
                    <option value="" disabled selected hidden>City Jail</option>
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-label-group" id="ddetextb" style="display: none;">
                  <h6>Case Number*</h6>
                    <input type="text" id="ddecaseno" class="form-control" placeholder="Case Number" autofocus="autofocus" name="ddecaseno" value="">
                </div>
              </div>
              @endif
          </div>
        </div>
         @if($patis != '[]')
          <div class="form-group" style="margin-left: 20px">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Accompanied by/Informant</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                        @foreach($patis as $patin)
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="infoname" class="form-control" placeholder="Last name"  name="infoname" value="{{$patin->informants->name}}">
                           <input type="hidden" name="patientinfor" value="{{$patin->informant_id}}">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" id="infocontact" class="form-control" placeholder="Last name"  name="infocontact" value="{{$patin->informants->contact}}">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd" value="{{$patin->informants->address}}">
                     </div>
                    </div>
                  </div>
                 </div>
               </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <h6>Referred By*</h6>
                    <input type="text" id="referred" class="form-control" placeholder="Referred By" name="referred" value="{{$patin->referred_by}}">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <input type="text" id="dabused" class="form-control" placeholder="Drugs Abused (Present)" autofocus="autofocus" name="dabused" value="{{$patin->drugs_abused}}">
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" class="form-control" placeholder="Chief Complaint" name="ccomplaint" value="{{$patin->chief_complaint}}">
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="form-group" style="margin-left: 20px">
            <div class="form-label-group">
              <h6>History of Present Illness*</h6>
              <textarea type="text" id="pillness" class="form-control" placeholder="Please Specify" name="pillness">{{$patin->h_present_illness}}</textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" type="text" id="dused" class="form-control" placeholder="Please Specify" name="dused">{{$patin->h_drug_abuse}}</textarea>
              </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" type="text" id="background" class="form-control" placeholder="Please Specify" name="background">{{$patin->famper_history}}</textarea>
              </div>
          </div>
            @endforeach
          @elseif($patis == '[]')
            <div class="form-group" style="margin-left: 20px">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Accompanied by/Informant</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="infoname" class="form-control" placeholder="Last name"  name="infoname">
                           <input type="hidden" name="patientinfor">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" id="infocontact" class="form-control" placeholder="Last name"  name="infocontact">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd">
                     </div>
                    </div>
                  </div>
                 </div>
               </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <h6>Referred By*</h6>
                    <input type="text" id="referred" class="form-control" placeholder="Referred By" name="referred">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <input type="text" id="dabused" class="form-control" placeholder="Drugs Abused (Present)" autofocus="autofocus" name="dabused">
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" class="form-control" placeholder="Chief Complaint" name="ccomplaint">
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="form-group" style="margin-left: 20px">
            <div class="form-label-group">
              <h6>History of Present Illness*</h6>
              <textarea type="text" id="pillness" class="form-control" placeholder="Please Specify" name="pillness"></textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" type="text" id="dused" class="form-control" placeholder="Please Specify" name="dused"></textarea>
              </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" type="text" id="background" class="form-control" placeholder="Please Specify" name="background"></textarea>
              </div>
          </div>
          @endif
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Re-enroll">
            </div>
            </div>
        </fieldset>
      </form>
    </div>
    </div>
  </div>
</div>

@endsection