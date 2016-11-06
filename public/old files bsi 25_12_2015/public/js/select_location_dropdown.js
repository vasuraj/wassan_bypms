
$(function() {

    var base_url = window.location.origin;

    var sub_domain='/bsi';

    var route_address=base_url+sub_domain;
    console.log(route_address);

    var selected_state_id=$( "#state option:selected" ).attr('data-id');
    var selected_state_name=$( "#state option:selected" ).text().trim();
    console.log('state selected is '+selected_state_name);

    $( "#state" ).change();
    $( "#district" ).change();


    //var $final_address=route_address+'/locations/get_districts/'+selected_state_id;
    //var district_list=$final_address;
    //$.get(district_list, function( data ) {
    //$( "#district" ).html(data);
    //});

//	------------------------

//	 on change district

//	------------------------

$(document).on("change","#state",function(){

// loading icon
$( "#district_area" ).html('<img class="loader"  src="'+base_url+sub_domain+'/images/horizontal_loader.gif" alt="" />');
$( "#mandal_area" ).html('<img class="loader"   src="'+base_url+sub_domain+'/images/horizontal_loader.gif" alt="" />');



    var route_address=base_url+'/bsi/';
    console.log(route_address);

    var selected_state_id=$( "#state option:selected" ).attr('data-id');
    var selected_state_name=$( "#state option:selected" ).text().trim();
    console.log('selected State : '+selected_state_name);

    var districts_list=route_address+'/locations/get_districts_dropdown/'+selected_state_id;
     $.get(districts_list, function( data ) {
         $( "#district_area" ).html(data);


         var selected_district_id=$( "#district option:selected" ).attr('data-id');
         var selected_district_name=$( "#district option:selected" ).text().trim();
         console.log('selected District :'+selected_district_name);

         var mandals_list=route_address+'/locations/get_mandals_dropdown/'+selected_district_id;
         console.log('query on: '+mandals_list);
         $.get(mandals_list, function( data ) {
             $( "#mandal_area" ).html(data);


                var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id');
             
                var selected_mandal_name=$( "#mandal option:selected" ).text().trim();
                console.log(' selected mandal is '+selected_mandal_name);

                var villages_list=route_address+'/locations/get_select_villages_dropdown/'+selected_mandal_id;
                console.log('query on: '+villages_list);
                $.get(villages_list, function( data ) {
                $( "#village_area" ).html(data);
                var selected_village_name=$( "#village option:selected" ).text().trim();
                console.log(' selected mandal is '+selected_mandal_name);
                    
                    if($("#ngos_area").length)
                    {
                       


                        var ngos_list=route_address+'ngo/getngosbylocation/'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name;
                        $.get(ngos_list,function(data){

                            $("#ngos_area").html(data);
                        });
                    }
                });


         });
     });
});


//--------------------------
//on change district
//---------------------------


$(document).on('change',"select#district",function(){
$( "#mandal_area" ).html('<img class="loader"   src="'+base_url+sub_domain+'/images/horizontal_loader.gif" alt="" />');
$( "#village_area" ).html('<img class="loader"   src="'+base_url+sub_domain+'/images/horizontal_loader.gif" alt="" />');

    var selected_district_id=$( "#district option:selected" ).attr('data-id');
    var selected_district_name=$( "#district option:selected" ).text().trim();
    console.log(' selected district is '+selected_district_name);
   // $('option:selected', this).attr('mytag');
    var mandals_list=route_address+'/locations/get_select_mandals_dropdown/'+selected_district_id;
    console.log('query on: '+mandals_list);
    $.get(mandals_list, function( data ) {
        $( "#mandal_area" ).html(data);


var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id');
 
    var selected_mandal_name=$( "#mandal option:selected" ).text().trim();
    console.log(' selected mandal is '+selected_mandal_name);

    var villages_list=route_address+'/locations/get_select_villages_dropdown/'+selected_mandal_id;
    console.log('query on: '+villages_list);
    $.get(villages_list, function( data ) {
    $( "#village_area" ).html(data);
    var selected_village_name=$( "#village option:selected" ).text().trim();
    console.log(' selected mandal is '+selected_mandal_name);
        
        if($("#ngos_area").length)
        {
           
            var ngos_list=route_address+'ngo/getngosbylocation/'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name;

            $.get(ngos_list,function(data){
                $( "#select_ngo_table" ).html('<img class="loader"   src="'+base_url+sub_domain+'/images/horizontal_loader.gif" alt="" />');

                $("#select_ngo_table").html(data);
            });
        }

        if($("#farmers_area_multiselect_list").length)
        {
           
            var farmers_list=route_address+'farmer/getfarmersbylocation/'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name;
            alert(farmers_list);
            $.get(farmers_list,function(data){
               // $( "#select_farmer_table" ).html('<img class="loader"   src="'+base_url+sub_domain+'/images/horizontal_loader.gif" alt="" />');

                $("#farmers_area_multiselect_list").html(data);
            });


        }


    });
});
   

});



//--------------------------
//on change mandal/mandal
//---------------------------



$(document).on('change',"select#mandal",function(){
$( "#village_area" ).html('<img class="loader"   src="'+base_url+sub_domain+'/images/horizontal_loader.gif" alt="" />');


         var selected_district_id=$( "#district option:selected" ).attr('data-id');
         var selected_district_name=$( "#district option:selected" ).text().trim();
         console.log('selected District :'+selected_district_name);


var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id');
   
    var selected_mandal_name=$( "#mandal option:selected" ).text().trim();
    console.log(' selected mandal is '+selected_mandal_name);

    var villages_list=route_address+'/locations/get_select_villages_dropdown/'+selected_mandal_id;
    $.get(villages_list, function( data ) {
        $( "#village_area" ).html(data);

    var selected_village_name=$( "#village option:selected" ).text().trim();
    console.log(' selected village is '+selected_village_name);

        if($("#ngos_area").length)
        {
           
            var select_type=$(this).attr('select_type');
            var ngos_list=route_address+'ngo/getngosbylocation/'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name+'/'+select_type;
            $.get(ngos_list,function(data){

                $("#ngos_area").html(data);
            });
        }
    });

   

});




//--------------------------
//on change village
//---------------------------



$(document).on('change',"select#village",function(){

        var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id'); 
        var selected_mandal_name=$( "#mandal option:selected" ).text().trim();
        console.log(' selected mandal is '+selected_mandal_name);

         var selected_district_id=$( "#district option:selected" ).attr('data-id');
         var selected_district_name=$( "#district option:selected" ).text().trim();
         console.log('selected District :'+selected_district_name);


        var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id');   
        var selected_mandal_name=$( "#mandal option:selected" ).text().trim();
        console.log(' selected mandal is '+selected_mandal_name);
        
        var selected_village_name=$( "#village option:selected" ).text().trim();
        console.log(' selected village is '+selected_village_name);

            if($("#ngos_area").length)
            {
               
                var select_type=$(this).attr('select_type');
                var ngos_list=route_address+'ngo/getngosbylocation/'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name+'/'+select_type;
                $.get(ngos_list,function(data){

                    $("#ngos_area").html(data);
                });
            }
       

});







});

