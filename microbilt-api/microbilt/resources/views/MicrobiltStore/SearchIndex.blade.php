@extends('MicrobiltStore.layouts.default')
@section('content')

<h1>MicroBilt APIs Records</h1>

<p>
    <a class="btn btn-primary" href="{{route('microbilt.GetReportForm')}}"><span
            class="glyphicon glyphicon-plus"></span>GetReport</a>
</p>

<div class="container">
    <div class="row">
		<div class="col-md-12">
   		   <div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_default_1" data-toggle="tab">
							Bankruptcy </a>
						</li>
						<li>
							<a href="#tab_default_2" data-toggle="tab">
							Evictions </a>
						</li>
						<li>
							<a href="#tab_default_3" data-toggle="tab">
							Criminal </a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_default_1">
                        <!-- Bankruptcy -->
                              @include('MicrobiltStore.BankruptcyRecord')
                         <!-- Bankruptcy -->
						</div>
						<div class="tab-pane" id="tab_default_2">
                        <!-- Evictions -->
                              @include('MicrobiltStore.EvictionsRecord')
                        <!-- Evictions -->
						</div>

						<div class="tab-pane" id="tab_default_3">
						<!-- Criminal -->
                            @include('MicrobiltStore.CriminalRecord')
						<!-- Criminal -->
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@push('scripts')
         

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script>
  $(function() {

     console.log("GetArchiveReport call Ajex");
	 
	 $(".ArchiveReportPrview").hide();
   
     $(".GetArchiveReport").click(function(e){
 
     console.log("GetArchiveReport call");

	 var Preview =  $(this).next().next('div.ArchiveReportPrview');

	 var msg = $(this).next('p.msg');
 	
	var btn = $(this);

	$(this).attr("disabled", "disabled").text("Sending...");

       e.preventDefault();
  
       var AppId = $(this).attr('data-AppId');
       var ReportType = $(this).attr('data-Report');
	   msg.html("sending your results, please wait.").fadeIn();
       console.log("AppId",AppId);
	   $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
       $.ajax({
          type:'POST',
          url:"{{ route('microbilt.GetArchiveReport') }}",
          data:{AppId:AppId, ReportType:ReportType},
          success:function(data){
             console.log(data.success);
			 if(data.success){
				Preview.show();
				msg.html('');
				btn.hide();
			 }
			 else{
				msg.html("Report failed, please retry again.");
				btn.attr("disabled",false).text("GetArchiveReport");
			 }
          }
       });
});
 
   });
</script>

@endpush
@stop