

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
  <script src="{{asset('vendor/fullcalendar/lib/jquery-ui.min.js')}}"></script>
  <script src="{{asset('vendor/fullcalendar/lib/moment.min.js')}}"></script>
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/fullcalendar/fullcalendar.min.js')}}"></script>

    <script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>


  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  
  <script src="{{asset('vendor/multi-select/js/jquery.multi-select.js')}}"></script>
 
  <!-- Page level plugin JavaScript-->
  <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>

  <script src="{{asset('js/sb-admin.min.js')}}"></script>

  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
  <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('js/demo/chart-bar-demo.js')}}"></script>


  <script src="{{asset('js/cbpFWTabs.js')}}"></script>

    @yield('script')

    <script>
      (function() {

        [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
          new CBPFWTabs( el );
        });

      })();
    </script>

  <script>
    $('#flash-overlay-modal').modal();
    </script>
    
  <script>
    $(window).on('load',function() {
      $('#loading').fadeOut('slow');
    });
</script>

  <script type="text/javascript">  
  $('#editModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var userid = button.data('userid')
    var fname = button.data('fname')
    var lname = button.data('lname')
    var username = button.data('uname')
    var email = button.data('email')
    var contact = button.data('contact')
    var department = button.data('department')
    var password = button.data('password')
    var modal = $(this)

    modal.find('.modal-body #userid').val(userid);
    modal.find('.modal-body #fname').val(fname);
    modal.find('.modal-body #lname').val(lname);
    modal.find('.modal-body #username').val(username);
    modal.find('.modal-body #email').val(email);
    modal.find('.modal-body #contact').val(contact);
    modal.find('.modal-body #department').val(department);
    modal.find('.modal-body #password').val(password);
  })

   $('#editemployeeModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var userid = button.data('userid')
    var fname = button.data('fname')
    var lname = button.data('lname')
    var mname = button.data('mname')
    var email = button.data('email')
    var contact = button.data('contact')
    var designation = button.data('designation')
    var department = button.data('department')
    var modal = $(this)

    modal.find('.modal-body #userid').val(userid);
    modal.find('.modal-body #fname').val(fname);
    modal.find('.modal-body #lname').val(lname);
    modal.find('.modal-body #mname').val(mname);
    modal.find('.modal-body #email').val(email);
    modal.find('.modal-body #contact').val(contact);
    modal.find('.modal-body #designation').val(designation);
    modal.find('.modal-body #department').val(department);
  })

  $('#deleteModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var user_id = button.data('userid')
    var modal = $(this)

    modal.find('.modal-body #user_id').val(user_id);
  })

  $('#deleteemployeeModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var employee_id = button.data('employee_id')
    var modal = $(this)

    modal.find('.modal-body #employee_id').val(employee_id);
  })

  $('#deleteCity').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var cityid = button.data('cityid')
    var modal = $(this)

    modal.find('.modal-body #cityid').val(cityid);
  })

  $('#deleteJail').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var jailid = button.data('jailid')
    var modal = $(this)

    modal.find('.modal-body #jailid').val(jailid);
  })

  $('#deleteReason').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var reasonid = button.data('reasonid')
    var modal = $(this)

    modal.find('.modal-body #reasonid').val(reasonid);
  })

  $('#deleteCase').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var caseid = button.data('caseid')
    var modal = $(this)

    modal.find('.modal-body #caseid').val(caseid);
  })

  $('#deleteRole').on('show.bs.modal', function (event) {

    var a = $(event.relatedTarget)

    var role = a.data('role')
    var modal = $(this)

    modal.find('.modal-body #role').val(role);
  })

  $('#deletePatient').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var patientid = button.data('patientid')
    var modal = $(this)

    modal.find('.modal-body #patientid').val(patientid);
  })

  $('#patientDismiss').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var patientid = button.data('patientid')
    var patientdep = button.data('patientdep')
    var modal = $(this)

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#transferPatient').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#admintransferPatient').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#adminreenrollPatient').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#adminreenrollForm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var depid = button.data('depid');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #department').val(depid);
  })

  $('#intakeForm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var department = $('#adminreenrollForm #department').val().trim();
    var modal = $(this);

    modal.find('.container #department').val(department);
  })

  $('#ddeForm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var department = $('#adminreenrollForm #department').val().trim();
    var modal = $(this);

    modal.find('.container #department').val(department);
  })

  $('#changepass').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var button1 = $("#editModal #userid").val().trim();

    var userid = $('#editModal #userid').val().trim();
    var modal = $(this);

    modal.find('.modal-body #userid').val(userid);
  })

  $('#transferReferral').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var button1 = $("#transferPatient #patientid").val().trim();
  
    var depid = button.data('depid');
    var patientid = $('#transferPatient #patientid').val().trim();
    var patientdep = $('#transferPatient #patientdep').val().trim();
    var modal = $(this);

    modal.find('.modal-body #depid').val(depid);
    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

   $('#admintransferReferral').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var button1 = $("#transferPatient #patientid").val().trim();
  
    var depid = button.data('depid');
    var patientid = $('#admintransferPatient #patientid').val().trim();
    var patientdep = $('#admintransferPatient #patientdep').val().trim();
    var modal = $(this);

    modal.find('.modal-body #depid').val(depid);
    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#patientGraduate').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#patientadminGraduate').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#patientadminReenroll').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
  })

   $('#patientReenroll').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-footer #patient_id').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

   $('#reenrollForm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
  })

    $('#addNotes').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var patientid = button.data('patientid')
    var doctorid = button.data('doctorid')
    var modal = $(this)

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #doctorid').val(doctorid);
  })

  $(function() {
  $('input[name="casetype"]').on('click', function(){

    if ($(this).val() == 'New Case') {
      document.getElementById("casetype").disabled = true;
      $('#textboxes').hide();
    }
    else if ($(this).val() == 'Old Case'){
      document.getElementById("casetype").disabled = true;
      $('#textboxes').hide();
    }
    else if($(this).val() == 'With Court Case'){
      document.getElementById("casetype").disabled = false;
      $('#textboxes').show();
     }
    });
  });


  $(function() {
  $('input[name="type"]').on('click', function(){

    if ($(this).val() == 'Voluntary Submission') {
      document.getElementById("type").disabled = true;
      $('#textbox').hide();
    }
    else if ($(this).val() == 'Compulsory Submission'){
      document.getElementById("type").disabled = true;
      $('#textbox').hide();
    }
    else if($(this).val() == 'Others'){
      document.getElementById("type").disabled = false;
      $('#textbox').show();
     }
    });
  });

  $(function() {
  $('select[id="dismissal"]').on('click', function(){

    if ($(this).val() == 'Others') {
      document.getElementById("remarks").disabled = false;
      $('#text').show();
    }
    else{
      document.getElementById("remarks").disabled = true;
      $('#text').hide();
    }

    });
  });

  $(function() {
  $('select[id="designation"]').on('click', function(){

    if ($(this).val() == 'Others') {
      document.getElementById("designat").disabled = false;
      $('#design').show();
    }
    else{
      document.getElementById("designat").disabled = true;
      $('#design').hide();
    }

    });
  });

   $(function() {
  $('select[id="ptype"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("caseno").disabled = false;
      document.getElementById("jail").disabled = false;
      $('#textas').show();
      $('#textb').show();
    }
    else{
      document.getElementById("caseno").disabled = true;
      document.getElementById("jail").disabled = true;
      $('#textas').hide();
      $('#textb').hide();
    }

    });
  });

   $(function() {
  $('select[id="sptype"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("scaseno").disabled = false;
      document.getElementById("sjail").disabled = false;
      $('#stextas').show();
      $('#stextb').show();
    }
    else{
      document.getElementById("scaseno").disabled = true;
      document.getElementById("sjail").disabled = true;
      $('#stextas').hide();
      $('#stextb').hide();
    }

    });
  });

   $(function() {
  $('select[id="patype"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("caseno").disabled = false;
      document.getElementById("jail").disabled = false;
      $('#textes').show();
      $('#textc').show();
    }
    else{
      document.getElementById("caseno").disabled = true;
      document.getElementById("jail").disabled = true;
      $('#textes').hide();
      $('#textc').hide();
    }

    });
  });

$(function() {
  $('select[id="ddeptype"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("ddecaseno").disabled = false;
      document.getElementById("ddejail").disabled = false;
      $('#ddetextas').show();
      $('#ddetextb').show();
    }
    else{
      document.getElementById("ddecaseno").disabled = true;
      document.getElementById("ddejail").disabled = true;
      $('#ddetextas').hide();
      $('#ddetextb').hide();
    }

    });
  });

$(function() {
  $('select[id="ddes"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("ddecas").disabled = false;
      document.getElementById("ddejs").disabled = false;
      $('#ddets').show();
      $('#ddetes').show();
    }
    else{
      document.getElementById("ddecas").disabled = true;
      document.getElementById("ddejs").disabled = true;
      $('#ddets').hide();
      $('#ddetes').hide();
    }

    });
  });
  
</script>