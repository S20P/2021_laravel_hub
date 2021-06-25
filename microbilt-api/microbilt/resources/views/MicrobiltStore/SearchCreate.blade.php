@extends('MicrobiltStore.layouts.default')
@section('content')
   


<div class="container register-form top-buffer-1">

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<p>
    <a class="btn btn-primary" href="{{route('microbilt.GetReportList')}}"><span class="glyphicon glyphicon-arrow-left"></span> View Report List</a>
</p>


		  <div class="form">
			  <div class="note">
				<p>MicroBilt APIs </p>
			  </div>
		    <div class="form-content bk">
				<form action="{{route('microbilt.GetReportSave')}}" method="POST" id="microbiltForm" class="microbiltForm">
				@csrf	

        <fieldset class="scheduler-border">
        <legend class="scheduler-border">API</legend>
           <div class="col-sm-12">
              <label for="phone">Select API Search Type</label>
							  <select class="form-control" name="api_type" id="api_type">
								<option value="Bankruptcy" selected>Bankruptcy Search</option>
								<option value="Evictions">Evictions, Suits, Liens & Judgments</option>
								<option value="Criminal">Criminal Records Search</option>
							  </select>
							</div>
					</fieldset>

             <fieldset class="scheduler-border">
						<legend class="scheduler-border">Person Information</legend>
						<div class="row">
                            <div class="col-sm-8">
							  <label for="LastName">Last Name</label>
							  <input type="text" class="form-control" id="LastName" placeholder="Last Name" name="LastName">
							</div>
							<div class="col-sm-8">
							  <label for="FirstName">First Name</label>
							  <input type="text" class="form-control" id="FirstName" placeholder="First Name" name="FirstName">
							</div>
							
                <!-- <div class="col-sm-8">
							  <label for="MiddleName">Middle Name</label>
							  <input type="text" class="form-control" id="MiddleName" placeholder="Middle Name" name="MiddleName">
							</div> -->

              <div class="col-sm-8" id="BirthDt_section">
							  <label for="yop">Birth Date</label>
							  <input name="BirthDt" class="form-control" id="BirthDt" type="date" />
							</div>

						</div>
					</fieldset>
					<!-- Contact Information -->
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Contact Information</legend>
                        <div class="row top-buffer">
							<!-- Address -->
							  <div class="form-group col-sm-3">
								<label for="inputAddress">Address</label>
								<input type="text" class="form-control" id="Addr1" name="Addr1" placeholder="Address">
							  </div>
							  <div class="form-row">
								<div class="form-group col-sm-2" id="city_field">
								  <label for="inputCity">City</label>
								  <input type="text" class="form-control" name="City" id="City" placeholder="City">
								</div>
								<div class="form-group col-sm-2" id="stateProv_field">
								  <label for="inputState">StateProv</label>
								  <input type="text" class="form-control" name="StateProv" id="StateProv" placeholder="StateProv">
								</div>
								<div class="form-group col-md-2">
								  <label for="inputZip">PostalCode</label>
								  <input type="text" class="form-control" name="PostalCode" id="PostalCode" placeholder="PostalCode">
								</div>
							  </div>
							  <!-- Address -->
						</div>
					</fieldset>
					<!--Contact Information -->
				
					<!-- TINI Information-->
					<!-- <fieldset class="scheduler-border" id="TINInfo_section">
						<legend class="scheduler-border">TINI Information</legend>
                        <div class="row">
							<div class="col-sm-6">
							  <label for="fname">TINType</label>
							  <input type="text" class="form-control" id="TINType" placeholder="TIN Type" name="TINType">
							</div>
							<div class="col-sm-6">
							  <label for="lname">TaxId</label>
							  <input type="text" class="form-control" id="TaxId" placeholder="TaxId" name="TaxId">
							</div>
						</div>
					</fieldset> -->
					<!-- TINI Information -->

                   
					<button type="submit" class="btn btn-success" value="submit"> GetReport </button>
				</form>
			</div>
		  </div>
		  </div>

@push('scripts')
    
  <script>

//   jQuery Form Validation code 
$(function() {


  $("#BirthDt_section").hide();
  // $("#TINInfo_section").show();
  $("#city_field").show();
  $("#stateProv_field").show();

  
  $("#api_type").click(function(e){
    e.preventDefault();
    
     var api_type = $(this).val();

     console.log("api_type",api_type);
     
      if(api_type=="Criminal"){
         $("#BirthDt_section").show();
         $("#city_field").hide();
         $("#stateProv_field").hide();
      }else{
         $("#BirthDt_section").hide();
         $("#city_field").show();
         $("#stateProv_field").show();
      }

      // if(api_type!=="Bankruptcy"){
      //    $("#TINInfo_section").hide();
      // }else{
      //     $("#TINInfo_section").show();
      // }
    
});
   
  $("#microbiltForm").validate({
    rules: {
        LastName : {
        required: true,
       },
       FirstName: {
        required: true,
      },
      Addr1: {
        required: true,
      },
      PostalCode: {
        required: true,
      },
    },
    messages : {
        LastName: {
        required: "Please enter your LastName",
      },
      FirstName: {
        required: "Please enter your FirstName",
      },
      Addr1: {
        required: "Please enter your Addr1",
      },
      PostalCode: {
        required: "Please enter your PostalCode",
      },
    },
    submitHandler: function(form) {

       console.log("FORM",form.submit);
            form.submit();
    }
  });

  });

</script>
@endpush

@stop



