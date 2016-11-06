/*#########################################################################
*##########     This piece of code would be responsible for chnaging 
*##########     dependent Location dropdown ex. State, District, Mandal,
*##########     Panchayat, village, Habitation as of now (19-10-2016)
##########################################################################*/


$(function() {

   
    
    console.log('route address in location_dropdown_add_mvk.js is:'+route_address);

    var selected_state_id=$( "#state option:selected" ).attr('data-id');
    var selected_state_name=$( "#state option:selected" ).text().trim();
    console.log('state selected is '+selected_state_name);
     console.log("asset img is set to in location_dropdown_add_mvk.js : "+asset_img);

    $( "#state" ).change();
    $( "#district" ).change();
    $( "#mandal" ).change();
    $( "#panchayat" ).change();
    $( "#village" ).change();

    //var $final_address=route_address+'/locations/get_districts/'+selected_state_id;
    //var district_list=$final_address;
    //$.get(district_list, function( data ) {
    //$( "#district" ).html(data);
    //});





/*################################################
            On changing state event
##################################################*/

$(document).on("change","#state",function(){

// loading icon
$( "#district_area" ).html('<img class="loader"  src="'+loader_img_url+'" alt="" />');
$( "#mandal_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#panchayat_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#village_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#habitation_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');

    /*===============================================================
    * Fetching districts code starts here
    * On chnage in state dropdown list get the selected state and 
    * start fetching district list   
    ====================================================================*/



    var selected_state_id=$( "#state option:selected" ).attr('data-id');
    var selected_state_name=$( "#state option:selected" ).text().trim();
    
    if(selected_state_id!='')
    {
        console.log('selected State : '+selected_state_name);
        console.log('getting_district_list');
        var districts_list_url=base_url+'/'+sub_domain+'/locations/get_districts_dropdown/'+selected_state_id;
        
        console.log("districts_list_url is set to : "+districts_list_url);
   
  
             $.ajax({
                type: "GET",
		        headers: {
            	'X-CSRF-TOKEN':csrf_token
        	     },
                url: districts_list_url,
                data: {
                '_token':csrf_token,
                
                },
                cache: false,
                success: function(data){
                   console.log('While loading districts....');
                   

                    $( "#district_area" )
                    .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                    .fadeOut('slow',function(){

                    $( "#district_area" ).html(data).fadeIn();
                    console.log('############ district list loading finished ############');
                     });  //Mandal Dropdown Fading animation ends here

           
                /*===============================================================
                * Fetching mandals code starts here
                * On chnage in district dropdown list get the selected district and 
                * start fetching mandal list   
                ====================================================================*/


                     selected_district_id=$( "#district option:selected" ).attr('data-id');
                     var selected_district_name=$( "#district option:selected" ).text().trim();

                    console.log('Before start fetching mandals.... ')
                    console.log("selected district is "+ selected_district_name+ " with id "+selected_district_id);

                    if(selected_district_id!='')
                    {
                     console.log('selected District :'+selected_district_name);
                     console.log('getting_Mandals_list');

                        var mandals_list_url=base_url+'/'+sub_domain+'/locations/get_mandals_dropdown/'+selected_district_id;
                        
                        console.log("mandals_list_url is set to : "+mandals_list_url);
                       
                      
                     $.ajax({
                        type: "GET",
                        url: mandals_list_url,
                        data: {
                        '_token':csrf_token,
                        
                        },
                        cache: false,
                        success: function(data){
                        console.log('While loading mandals....');
                        console.log(loader_img_url);
                        $( "#mandal_area" )
                        .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                        .fadeOut('slow',function(){
            
                            $( "#mandal_area" ).html(data).fadeIn();
                            console.log('Mandal list loadeding finished');

                     }); //Mandal Dropdown Fading animation ends here

                                /*=====================================================
                                * Fetching panchayats code starts here
                                * On chnage in mandals dropdown list get the selected mandal and 
                                * start fetching panchayat list   
                                =========================================================*/

                                        var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id');     
                                        var selected_mandal_name=$( "#mandal option:selected" ).text().trim();

                                        if(selected_mandal_id!='')
                                        {
                                             console.log(' selected mandal is '+selected_mandal_name);
                                             console.log('getting_panchayat_list');
                                             
                                                
                                            var panchayats_list_url=base_url+'/'+sub_domain+'/locations/get_panchayats_dropdown/'+selected_mandal_id;
                                            console.log("panchayats_list_url is set to : "+panchayats_list_url);
                                            
                                          
                                            /*
                                            * Ajax request to fetch panchayat list from the database
                                            * csrf_token is must to send with every request
                                            */

                                             $.ajax({
                                                type: "GET",
                                                url: panchayats_list_url,
                                                data: {
                                                '_token':csrf_token,
                                                
                                                },
                                                cache: false,
                                                success: function(data){
                                                    console.log('While loading panchayat....');
                                                    $( "#panchayat_area" )
                                                    .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                    .fadeOut('slow',function(){
                            
                                                    $( "#panchayat_area" ).html(data).fadeIn();

                                                    });  //Pancahayat List Fading animation ends here  

                                                   

                                             } //fetching panchayat List Ajax success code ends here
                                                   

                                            }); // Fetching pancahayt Ajax code ends here


                                 /*=====================================================
                                * Fetching villages code starts here
                                * On chnage in mandals dropdown list get the selected mandal and 
                                * start fetching panchayat list   
                                =========================================================*/

                                        var selected_panchayat_id=$( "#panchayat option:selected" ).attr('data-id');     
                                        var selected_panchayat_name=$( "#panchayat option:selected" ).text().trim();

                                        if(selected_panchayat_id!='')
                                        {
                                             console.log(' selected panchayat is '+selected_panchayat_name);
                                             console.log('getting_villages_list');
                                             
                                                
                                            var villages_list_url=base_url+'/'+sub_domain+'/locations/get_villages_dropdown/'+selected_panchayat_id;
                                            console.log("villages_list_url is set to : "+villages_list_url);
                                            
                                          
                                                 /*
                                                * Ajax request to fetch Cluster list from the database
                                                * csrf_token is must to send with every request
                                                */

                                                console.log("bypms_cluster_list_url is set to : "+bypms_cluster_list_url+ " requesting now...");
                                                var bypms_cluster_list_url=base_url+'/'+sub_domain+'/locations/get_bypms_cluster_dropdown/'+selected_panchayat_id;
                                                 $.ajax({
                                                    type: "GET",
                                                    url:bypms_cluster_list_url,
                                                    data: {
                                                    '_token':csrf_token,
                                                    
                                                    },
                                                    cache: false,
                                                    success: function(data){
                                                        console.log('While loading bypms cluster....');
                                                        $( "#bypms_cluster_area" )
                                                        .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                        .fadeOut('slow',function(){
                                
                                                        $( "#bypms_cluster_area" ).html(data).fadeIn();

                                                        });  //bypms cluster  List Fading animation ends here  

                                                 } //fetching cluster  List Ajax success code ends here
                                                       

                                                }); // Fetching village Ajax code ends here

                                                console.log('bypms cluster fetching list request completed ');



                                            /*
                                            * Ajax request to fetch village list from the database
                                            * csrf_token is must to send with every request
                                            */

                                             $.ajax({
                                                type: "GET",
                                                url: villages_list_url,
                                                data: {
                                                '_token':csrf_token,
                                                
                                                },
                                                cache: false,
                                                success: function(data){
                                                    console.log('While loading village....');
                                                    $( "#village_area" )
                                                    .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                    .fadeOut('slow',function(){
                            
                                                    $( "#village_area" ).html(data).fadeIn();

                                                    });  //village List Fading animation ends here  

                                             } //fetching village List Ajax success code ends here
                                                   

                                            }); // Fetching village Ajax code ends here

                                                    /*=====================================================
                                                    * Fetching habitations code starts here
                                                    * On chnage in mandals dropdown list get the selected mandal and 
                                                    * start fetching village list   
                                                    =========================================================*/

                                                            var selected_village_id=$( "#village option:selected" ).attr('data-id');     
                                                            var selected_village_name=$( "#village option:selected" ).text().trim();

                                                            if(selected_village_id!='')
                                                            {
                                                                 console.log(' selected village is '+selected_village_name);
                                                                 console.log('getting_habitations_list');
                                                                 
                                                                    
                                                                var habitations_list_url=base_url+'/'+sub_domain+'/locations/get_habitations_dropdown/'+selected_village_id;
                                                                console.log("habitations_list_url is set to : "+habitations_list_url);
                                                                
                                                              
                                                                /*
                                                                * Ajax request to fetch habitation list from the database
                                                                * csrf_token is must to send with every request
                                                                */

                                                                 $.ajax({
                                                                    type: "GET",
                                                                    url: habitations_list_url,
                                                                    data: {
                                                                    '_token':csrf_token,
                                                                    
                                                                    },
                                                                    cache: false,
                                                                    success: function(data){
                                                                        console.log('While loading habitations....');
                                                                        $( "#habitation_area" )
                                                                        .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                                        .fadeOut('slow',function(){
                                                
                                                                        $( "#habitation_area" ).html(data).fadeIn();

                                                                        });  //habitation List Fading animation ends here  

                                                                 } //fetching habitation List Ajax success code ends here
                                                                       

                                                                }); // Fetching habitation Ajax code ends here


                                                            }  // if condition ends here-if selected_village_id is undefined

                                                        /*====================================================
                                                        * Fetching habitations list code ends here
                                                        =====================================================*/



                                        }  // if condition ends here-if selected_panchayat_id is undefined

                                    /*====================================================
                                    * Fetching villages list code ends here
                                    =====================================================*/


                                        }  // if condition ends here-if selected_mandal_id is undefined

                                    /*====================================================
                                    * Fetching panchayat list code ends here
                                    =====================================================*/


                             
                
                 
                            } //Fetching mandal List Ajax success code ends here

                        }); // Fetching mandal Ajax code ends here

                      }  // if conditio ends here-if selected_district_id is undefined

                      /*====================================================
                        * Fetching mandal list code ends here
                        =====================================================*/




        } //Fetching District List Ajax success code ends here
 
    }); // Fetching District Ajax code ends here
    } // if condition end here-if selected_state_id is undefined

     /*====================================================
    * Fetching district list code ends here
     =====================================================*/


});
   


         


//--------------------------
//on change district
//---------------------------


$(document).on('change',"select#district",function(){
$( "#mandal_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#panchayat_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#village_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#habitation_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');

                /*===============================================================
                * Fetching mandals code starts here
                * On chnage in district dropdown list get the selected district and 
                * start fetching mandal list   
                ====================================================================*/


                     selected_district_id=$( "#district option:selected" ).attr('data-id');
                     var selected_district_name=$( "#district option:selected" ).text().trim();

                    console.log('Before start fetching mandals.... ')
                    console.log("selected district is "+ selected_district_name+ " with id "+selected_district_id);

                    if(selected_district_id!='')
                    {
                     console.log('selected District :'+selected_district_name);
                     console.log('getting_Mandals_list');

                        var mandals_list_url=base_url+'/'+sub_domain+'/locations/get_mandals_dropdown/'+selected_district_id;
                        
                        console.log("mandals_list_url is set to : "+mandals_list_url);
                       
                      
                     $.ajax({
                        type: "GET",
                        url: mandals_list_url,
                        data: {
                        '_token':csrf_token,
                        
                        },
                        cache: false,
                        success: function(data){
                        console.log('While loading mandals....');
                        console.log(loader_img_url);
                        $( "#mandal_area" )
                        .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                        .fadeOut('slow',function(){
            
                            $( "#mandal_area" ).html(data).fadeIn();
                            console.log('Mandal list loadeding finished');

                     }); //Mandal Dropdown Fading animation ends here

                        /*=====================================================
                        * Fetching panchayats code starts here
                        * On chnage in mandals dropdown list get the selected mandal and 
                        * start fetching panchayat list   
                        =========================================================*/

                                var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id');     
                                var selected_mandal_name=$( "#mandal option:selected" ).text().trim();

                                if(selected_mandal_id!='')
                                {
                                     console.log(' selected mandal is '+selected_mandal_name);
                                     console.log('getting_panchayat_list');
                                     
                                        
                                    var panchayats_list_url=base_url+'/'+sub_domain+'/locations/get_panchayats_dropdown/'+selected_mandal_id;
                                    console.log("panchayats_list_url is set to : "+panchayats_list_url);
                                    
                                  
                                    /*
                                    * Ajax request to fetch panchayat list from the database
                                    * csrf_token is must to send with every request
                                    */

                                     $.ajax({
                                        type: "GET",
                                        url: panchayats_list_url,
                                        data: {
                                        '_token':csrf_token,
                                        
                                        },
                                        cache: false,
                                        success: function(data){
                                            console.log('While loading panchayat....');
                                            $( "#panchayat_area" )
                                            .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                            .fadeOut('slow',function(){
                    
                                            $( "#panchayat_area" ).html(data).fadeIn();

                                            });  //Pancahayat List Fading animation ends here  

                                            //  /*========================
                                            // *   refresh panchayat multipicker
                                            // ==========================*/
                                            // $("#panchayat_area_multiselect_list").html(data);
                                              
                                            // $('.selectpicker').selectpicker('refresh');  


                                     } //fetching panchayat List Ajax success code ends here
                                           

                                    }); // Fetching pancahayt Ajax code ends here


                             /*=====================================================
                            * Fetching villages code starts here
                            * On chnage in mandals dropdown list get the selected mandal and 
                            * start fetching panchayat list   
                            =========================================================*/

                                    var selected_panchayat_id=$( "#panchayat option:selected" ).attr('data-id');     
                                    var selected_panchayat_name=$( "#panchayat option:selected" ).text().trim();

                                    if(selected_panchayat_id!='')
                                    {
                                         console.log(' selected panchayat is '+selected_panchayat_name);
                                         console.log('getting_villages_list');
                                         
                                            
                                        var villages_list_url=base_url+'/'+sub_domain+'/locations/get_villages_dropdown/'+selected_panchayat_id;
                                        console.log("villages_list_url is set to : "+villages_list_url);
                                        
                                      
                                        /*
                                        * Ajax request to fetch village list from the database
                                        * csrf_token is must to send with every request
                                        */

                                         $.ajax({
                                            type: "GET",
                                            url: villages_list_url,
                                            data: {
                                            '_token':csrf_token,
                                            
                                            },
                                            cache: false,
                                            success: function(data){
                                                console.log('While loading village....');
                                                $( "#village_area" )
                                                .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                .fadeOut('slow',function(){
                        
                                                $( "#village_area" ).html(data).fadeIn();

                                                });  //village List Fading animation ends here  

                                         } //fetching village List Ajax success code ends here
                                               

                                        }); // Fetching village Ajax code ends here

                                                /*=====================================================
                                                * Fetching habitations code starts here
                                                * On chnage in mandals dropdown list get the selected mandal and 
                                                * start fetching village list   
                                                =========================================================*/

                                                        var selected_village_id=$( "#village option:selected" ).attr('data-id');     
                                                        var selected_village_name=$( "#village option:selected" ).text().trim();

                                                        if(selected_village_id!='')
                                                        {
                                                             console.log(' selected village is '+selected_village_name);
                                                             console.log('getting_habitations_list');
                                                             
                                                                
                                                            var habitations_list_url=base_url+'/'+sub_domain+'/locations/get_habitations_dropdown/'+selected_village_id;
                                                            console.log("habitations_list_url is set to : "+habitations_list_url);
                                                            
                                                            /*
                                                            * Ajax request to fetch Cluster list from the database
                                                            * csrf_token is must to send with every request
                                                            */

                                                            console.log("bypms_cluster_list_url is set to : "+bypms_cluster_list_url+ " requesting now...");
                                                            var bypms_cluster_list_url=base_url+'/'+sub_domain+'/locations/get_bypms_cluster_dropdown/'+selected_panchayat_id;
                                                             $.ajax({
                                                                type: "GET",
                                                                url:bypms_cluster_list_url,
                                                                data: {
                                                                '_token':csrf_token,
                                                                
                                                                },
                                                                cache: false,
                                                                success: function(data){
                                                                    console.log('While loading bypms cluster....');
                                                                    $( "#bypms_cluster_area" )
                                                                    .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                                    .fadeOut('slow',function(){
                                            
                                                                    $( "#bypms_cluster_area" ).html(data).fadeIn();

                                                                    });  //bypms cluster  List Fading animation ends here  

                                                             } //fetching cluster  List Ajax success code ends here
                                                                   

                                                            }); // Fetching village Ajax code ends here

                                                            console.log('bypms cluster fetching list request completed ');


                                                            
                                                            /*
                                                            * Ajax request to fetch habitation list from the database
                                                            * csrf_token is must to send with every request
                                                            */

                                                             $.ajax({
                                                                type: "GET",
                                                                url: habitations_list_url,
                                                                data: {
                                                                '_token':csrf_token,
                                                                
                                                                },
                                                                cache: false,
                                                                success: function(data){
                                                                    console.log('While loading habitations....');
                                                                    $( "#habitation_area" )
                                                                    .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                                    .fadeOut('slow',function(){
                                            
                                                                    $( "#habitation_area" ).html(data).fadeIn();

                                                                    });  //habitation List Fading animation ends here  

                                                             } //fetching habitation List Ajax success code ends here
                                                                   

                                                            }); // Fetching habitation Ajax code ends here


                                                        }  // if condition ends here-if selected_village_id is undefined

                                                    /*====================================================
                                                    * Fetching habitations list code ends here
                                                    =====================================================*/



                                    }  // if condition ends here-if selected_panchayat_id is undefined

                                /*====================================================
                                * Fetching villages list code ends here
                                =====================================================*/


                                }  // if condition ends here-if selected_mandal_id is undefined

                            /*====================================================
                            * Fetching panchayat list code ends here
                            =====================================================*/


                             
                
                 
                            } //Fetching mandal List Ajax success code ends here

                        }); // Fetching mandal Ajax code ends here

                      }  // if conditio ends here-if selected_district_id is undefined

                      /*====================================================
                        * Fetching mandal list code ends here
                        =====================================================*/

    
   
});



//--------------------------
//on change mandal/mandal
//---------------------------



$(document).on('change',"select#mandal",function(){
$( "#panchayat_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#village_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#habitation_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');



         /*=====================================================
                        * Fetching panchayats code starts here
                        * On chnage in mandals dropdown list get the selected mandal and 
                        * start fetching panchayat list   
                        =========================================================*/

                                var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id');     
                                var selected_mandal_name=$( "#mandal option:selected" ).text().trim();

                                if(selected_mandal_id!='')
                                {
                                     console.log(' selected mandal is '+selected_mandal_name);
                                     console.log('getting_panchayat_list');
                                     
                                        
                                    var panchayats_list_url=base_url+'/'+sub_domain+'/locations/get_panchayats_dropdown/'+selected_mandal_id;
                                    console.log("panchayats_list_url is set to : "+panchayats_list_url);
                                    
                                  
                                    /*
                                    * Ajax request to fetch panchayat list from the database
                                    * csrf_token is must to send with every request
                                    */

                                     $.ajax({
                                        type: "GET",
                                        url: panchayats_list_url,
                                        data: {
                                        '_token':csrf_token,
                                        
                                        },
                                        cache: false,
                                        success: function(data){
                                            console.log('While loading panchayat....');
                                            $( "#panchayat_area" )
                                            .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                            .fadeOut('slow',function(){
                    
                                            $( "#panchayat_area" ).html(data).fadeIn();

                                            });  //Pancahayat List Fading animation ends here  

                                            //  /*========================
                                            // *   refresh panchayat multipicker
                                            // ==========================*/
                                            // $("#panchayat_area_multiselect_list").html(data);
                                              
                                            // $('.selectpicker').selectpicker('refresh');  


                                     } //fetching panchayat List Ajax success code ends here
                                           

                                    }); // Fetching pancahayt Ajax code ends here


                             /*=====================================================
                            * Fetching villages code starts here
                            * On chnage in mandals dropdown list get the selected mandal and 
                            * start fetching panchayat list   
                            =========================================================*/

                                    var selected_panchayat_id=$( "#panchayat option:selected" ).attr('data-id');     
                                    var selected_panchayat_name=$( "#panchayat option:selected" ).text().trim();

                                    if(selected_panchayat_id!='')
                                    {
                                         console.log(' selected panchayat is '+selected_panchayat_name);
                                         console.log('getting_villages_list');
                                         
                                            
                                        var villages_list_url=base_url+'/'+sub_domain+'/locations/get_villages_dropdown/'+selected_panchayat_id;
                                        console.log("villagess_list_url is set to : "+villages_list_url);
 
                                             
                                            /*
                                            * Ajax request to fetch Cluster list from the database
                                            * csrf_token is must to send with every request
                                            */

                                            console.log("bypms_cluster_list_url is set to : "+bypms_cluster_list_url+ " requesting now...");
                                            var bypms_cluster_list_url=base_url+'/'+sub_domain+'/locations/get_bypms_cluster_dropdown/'+selected_panchayat_id;
                                             $.ajax({
                                                type: "GET",
                                                url:bypms_cluster_list_url,
                                                data: {
                                                '_token':csrf_token,
                                                
                                                },
                                                cache: false,
                                                success: function(data){
                                                    console.log('While loading bypms cluster....');
                                                    $( "#bypms_cluster_area" )
                                                    .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                    .fadeOut('slow',function(){
                            
                                                    $( "#bypms_cluster_area" ).html(data).fadeIn();

                                                    });  //bypms cluster  List Fading animation ends here  

                                             } //fetching cluster  List Ajax success code ends here
                                                   

                                            }); // Fetching village Ajax code ends here

                                            console.log('bypms cluster fetching list request completed ');


                                                                                   
                                      
                                        /*
                                        * Ajax request to fetch village list from the database
                                        * csrf_token is must to send with every request
                                        */

                                         $.ajax({
                                            type: "GET",
                                            url: villages_list_url,
                                            data: {
                                            '_token':csrf_token,
                                            
                                            },
                                            cache: false,
                                            success: function(data){
                                                console.log('While loading village....');
                                                $( "#village_area" )
                                                .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                .fadeOut('slow',function(){
                        
                                                $( "#village_area" ).html(data).fadeIn();

                                                });  //village List Fading animation ends here  

                                         } //fetching village List Ajax success code ends here
                                               

                                        }); // Fetching village Ajax code ends here

                                                /*=====================================================
                                                * Fetching habitations code starts here
                                                * On chnage in mandals dropdown list get the selected mandal and 
                                                * start fetching village list   
                                                =========================================================*/

                                                        var selected_village_id=$( "#village option:selected" ).attr('data-id');     
                                                        var selected_village_name=$( "#village option:selected" ).text().trim();

                                                        if(selected_village_id!='')
                                                        {
                                                             console.log(' selected village is '+selected_village_name);
                                                             console.log('getting_habitations_list');
                                                             
                                                                
                                                            var habitations_list_url=base_url+'/'+sub_domain+'/locations/get_habitations_dropdown/'+selected_village_id;
                                                            console.log("habitations_list_url is set to : "+habitations_list_url);
                                                            
                                                          
                                                            /*
                                                            * Ajax request to fetch habitation list from the database
                                                            * csrf_token is must to send with every request
                                                            */

                                                             $.ajax({
                                                                type: "GET",
                                                                url: habitations_list_url,
                                                                data: {
                                                                '_token':csrf_token,
                                                                
                                                                },
                                                                cache: false,
                                                                success: function(data){
                                                                    console.log('While loading habitations....');
                                                                    $( "#habitation_area" )
                                                                    .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                                    .fadeOut('slow',function(){
                                            
                                                                    $( "#habitation_area" ).html(data).fadeIn();

                                                                    });  //habitation List Fading animation ends here  

                                                             } //fetching habitation List Ajax success code ends here
                                                                   

                                                            }); // Fetching habitation Ajax code ends here


                                                        }  // if condition ends here-if selected_village_id is undefined

                                                    /*====================================================
                                                    * Fetching habitations list code ends here
                                                    =====================================================*/



                                    }  // if condition ends here-if selected_panchayat_id is undefined

                                /*====================================================
                                * Fetching villages list code ends here
                                =====================================================*/


                                }  // if condition ends here-if selected_mandal_id is undefined

                            /*====================================================
                            * Fetching panchayat list code ends here
                            =====================================================*/

           
 
   

});










//--------------------------
//on change panchayat
//---------------------------



$(document).on('change',"select#panchayat",function(){
$( "#bypms_cluster_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#village_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');
$( "#habitation_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');

            
            
                            /*=====================================================
                            * Fetching villages code starts here
                            * On chnage in mandals dropdown list get the selected mandal and 
                            * start fetching panchayat list   
                            =========================================================*/

                                    var selected_panchayat_id=$( "#panchayat option:selected" ).attr('data-id');     
                                    var selected_panchayat_name=$( "#panchayat option:selected" ).text().trim();

                                    if(selected_panchayat_id!='')
                                    {
                                         console.log(' selected panchayat is '+selected_panchayat_name);
                                         console.log('getting_villages_list');
                                         
                                            
                                       

                                        var villages_list_url=base_url+'/'+sub_domain+'/locations/get_villages_dropdown/'+selected_panchayat_id;
                                        console.log("villages_list_url is set to : "+villages_list_url);

               
                                        /*
                                        * Ajax request to fetch Cluster list from the database
                                        * csrf_token is must to send with every request
                                        */

                                        console.log("bypms_cluster_list_url is set to : "+bypms_cluster_list_url+ " requesting now...");
                                        var bypms_cluster_list_url=base_url+'/'+sub_domain+'/locations/get_bypms_cluster_dropdown/'+selected_panchayat_id;
                                         $.ajax({
                                            type: "GET",
                                            url:bypms_cluster_list_url,
                                            data: {
                                            '_token':csrf_token,
                                            
                                            },
                                            cache: false,
                                            success: function(data){
                                                console.log('While loading bypms cluster....');
                                                $( "#bypms_cluster_area" )
                                                .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                .fadeOut('slow',function(){
                        
                                                $( "#bypms_cluster_area" ).html(data).fadeIn();

                                                });  //bypms cluster  List Fading animation ends here  

                                         } //fetching cluster  List Ajax success code ends here
                                               

                                        }); // Fetching village Ajax code ends here

                                        console.log('bypms cluster fetching list request completed ');


                                        

                                         /*
                                        * Ajax request to fetch Cluster list from the database
                                        * csrf_token is must to send with every request
                                        */

                                        console.log("bypms_cluster_list_url is set to : "+bypms_cluster_list_url+ " requesting now...");
                                        var bypms_cluster_list_url=base_url+'/'+sub_domain+'/locations/get_bypms_cluster_dropdown/'+selected_panchayat_id;
                                         $.ajax({
                                            type: "GET",
                                            url:bypms_cluster_list_url,
                                            data: {
                                            '_token':csrf_token,
                                            
                                            },
                                            cache: false,
                                            success: function(data){
                                                console.log('While loading bypms cluster....');
                                                $( "#bypms_cluster_area" )
                                                .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                .fadeOut('slow',function(){
                        
                                                $( "#bypms_cluster_area" ).html(data).fadeIn();

                                                });  //bypms cluster  List Fading animation ends here  

                                         } //fetching cluster  List Ajax success code ends here
                                               

                                        }); // Fetching village Ajax code ends here

                                        console.log('bypms cluster fetching list request completed ');
                                      
                                        /*
                                        * Ajax request to fetch village list from the database
                                        * csrf_token is must to send with every request
                                        */

                                         $.ajax({
                                            type: "GET",
                                            url: villages_list_url,
                                            data: {
                                            '_token':csrf_token,
                                            
                                            },
                                            cache: false,
                                            success: function(data){
                                                console.log('While loading village....');
                                                $( "#village_area" )
                                                .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                .fadeOut('slow',function(){
                        
                                                $( "#village_area" ).html(data).fadeIn();

                                                });  //village List Fading animation ends here  

                                         } //fetching village List Ajax success code ends here
                                               

                                        }); // Fetching village Ajax code ends here

                                                /*=====================================================
                                                * Fetching habitations code starts here
                                                * On chnage in mandals dropdown list get the selected mandal and 
                                                * start fetching village list   
                                                =========================================================*/

                                                        var selected_village_id=$( "#village option:selected" ).attr('data-id');     
                                                        var selected_village_name=$( "#village option:selected" ).text().trim();

                                                        if(selected_village_id!='')
                                                        {
                                                             console.log(' selected village is '+selected_village_name);
                                                             console.log('getting_habitations_list');
                                                             
                                                                
                                                            var habitations_list_url=base_url+'/'+sub_domain+'/locations/get_habitations_dropdown/'+selected_village_id;
                                                            console.log("habitations_list_url is set to : "+habitations_list_url);
                                                            
                                                          
                                                            /*
                                                            * Ajax request to fetch habitation list from the database
                                                            * csrf_token is must to send with every request
                                                            */

                                                             $.ajax({
                                                                type: "GET",
                                                                url: habitations_list_url,
                                                                data: {
                                                                '_token':csrf_token,
                                                                
                                                                },
                                                                cache: false,
                                                                success: function(data){
                                                                    console.log('While loading habitations....');
                                                                    $( "#habitation_area" )
                                                                    .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                                                                    .fadeOut('slow',function(){
                                            
                                                                    $( "#habitation_area" ).html(data).fadeIn();

                                                                    });  //habitation List Fading animation ends here  

                                                             } //fetching habitation List Ajax success code ends here
                                                                   

                                                            }); // Fetching habitation Ajax code ends here


                                                        }  // if condition ends here-if selected_village_id is undefined

                                                    /*====================================================
                                                    * Fetching habitations list code ends here
                                                    =====================================================*/



                                    }  // if condition ends here-if selected_panchayat_id is undefined

                                /*====================================================
                                * Fetching villages list code ends here
                                =====================================================*/
   

});





//--------------------------
//on change panchayat
//---------------------------



$(document).on('change',"select#village",function(){


    $( "#habitation_area" ).html('<img class="loader"   src="'+loader_img_url+'" alt="" />');


        /*=====================================================
        * Fetching habitations code starts here
        * On chnage in mandals dropdown list get the selected mandal and 
        * start fetching village list   
        =========================================================*/

                var selected_village_id=$( "#village option:selected" ).attr('data-id');     
                var selected_village_name=$( "#village option:selected" ).text().trim();

                if(selected_village_id!='')
                {
                     console.log(' selected village is '+selected_village_name);
                     console.log('getting_habitations_list');
                     
                        
                    var habitations_list_url=base_url+'/'+sub_domain+'/locations/get_habitations_dropdown/'+selected_village_id;
                    console.log("habitations_list_url is set to : "+habitations_list_url);
                    
                  
                    /*
                    * Ajax request to fetch habitation list from the database
                    * csrf_token is must to send with every request
                    */

                     $.ajax({
                        type: "GET",
                        url: habitations_list_url,
                        data: {
                        '_token':csrf_token,
                        
                        },
                        cache: false,
                        success: function(data){
                            console.log('While loading habitations....');
                            $( "#habitation_area" )
                            .html('<img class="loader"  src="'+loader_img_url+'" alt="" />')
                            .fadeOut('slow',function(){
    
                            $( "#habitation_area" ).html(data).fadeIn();

                            });  //habitation List Fading animation ends here  

                     } //fetching habitation List Ajax success code ends here
                           

                    }); // Fetching habitation Ajax code ends here


                }  // if condition ends here-if selected_village_id is undefined

            /*====================================================
            * Fetching habitations list code ends here
            =====================================================*/
            

            
 
   

});








});  // jquery on load function ends here

