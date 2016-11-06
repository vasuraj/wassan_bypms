(function($){

    var base_url = window.location.origin;

    var sub_domain='/bsi';

    var route_address=base_url+sub_domain;
    console.log(route_address);



    $.fn.locationDropdown=function(options){
        
            
        return this.each(function(){
           var settings=$.extend({

                    callback: null

                    },options);
           
            
            var id=$(this).attr('id');
            
            var locationdropdown=route_address+'/locations/locationdropdown/'+id;
            $.get(locationdropdown,function(data){

            $('#'+id).html(data);
            

          

        });
              // Fire the setup callback
           
             if ( $.isFunction( settings.callback ) ) {
                    settings.callback.call( this );
                }

     });  

}

}(jQuery));
