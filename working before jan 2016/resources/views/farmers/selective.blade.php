
@extends('app')

@section('head')


<script language="javascript" type="text/javascript">
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    $( ".loader_area" ).html('');

  }
</script>



  <!-- Inline -->
  <style>
    @media (max-width: 480px) {
      .panel-actions .dataTables_length {
        display: none;
      }
    }
    
    @media (max-width: 320px) {
      .panel-actions .dataTables_filter {
        display: none;
      }
    }
    
    @media (max-width: 767px) {
      .dataTables_length {
        float: left;
      }
    }
    
    #exampleTableAddToolbar {
      padding-left: 30px;
    }

  </style>

@endsection

@section('content')
   <div class="col-md-12" style="height:auto;">
            <!-- Panel Wizard Form -->
            <div class="panel" id="wizard-form">
              <div class="panel-heading">
                <h3 class="panel-title">Farmer </h3>
              </div>
              <div class="panel-body">
                <div class="wizard-pane active" id="location-filter-farmer"  role="tabpanel">
                 <form id="location-filter-farmer-form">
                 </form>

                </div>
                
                <button class="btn btn-primary submit-right" id="get_records">Get Farmres list</button>
              </div>
            </div>
            <div class="loader_area" ></div>
            <iframe id="records_area" class="records_ifr" src="" style="height:0px; width:100%;" frameborder="0"  onload='javascript:resizeIframe(this);'></iframe>
    </div>


@endsection


@section('body_bottom')

{!! Html::script("js/select_location_dropdown_plugin_updated.js") !!}
<script>
  
  $(function(){

    var base_url = window.location.origin;

    var sub_domain='/bsi';

    var route_address=base_url+sub_domain+'/';

      $('#location-filter-farmer').locationDropdown();
      
      var id='location-filter-farmer';
      $('#get_records').on('click',function(){

        $( ".loader_area" ).html('<img class="loader" src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');

            var selected_state_name=$( "#state_"+id+" option:selected" ).text().trim();
            var selected_district_name=$( "#district_"+id+" option:selected" ).text().trim();
            var selected_mandal_name=$( "#mandal_"+id+"-form option:selected" ).text().trim();
            var selected_village_name=$( "#village_"+id+"-form option:selected" ).text().trim();
           // console.log('------>'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name);
            
       var url=route_address+'farmer/getselective/'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name;
                 

        $('#records_area').attr('src',url);   

      });


  });

</script>

@endsection