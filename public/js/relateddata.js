var relateddata = function() {
    
    function initialize()
    {
        $('select.dzongkhag-ddl').on('change', function(){

            
            var selectedDzongkhagId = $('option:selected', this).val();

            if (selectedDzongkhagId.length > 0) {
               
                var loadGewog = false;

                if ($(this).hasClass('load_gewogs')) {
                    loadGewog = true;

                    $("select.gewog-ddl option:gt(0)").remove().end();
                    $("select.village-ddl option:gt(0)").remove().end();
                   
                }
                $.ajax({
                    
                    type: 'GET',
                    url: appUrl + 'gewogByDzongkhag/' + selectedDzongkhagId,
                    dataType: 'JSON',
                    data: {load_gewogs: loadGewog},
                    beforeSend: function(){
                        $('#ajax-loading-container').removeClass('d-none');
                    },
                    complete: function() {
                        
                        $('#ajax-loading-container').addClass('d-none');
                    },
                    success: function(data) {
                        if (loadGewog) {
                            var geowgMarkUp;
                            $.each(data.gewogs, function( key, value ) {
                                geowgMarkUp = "<option value="+value['id']+">"+value['name']+"</option>";
                                $("select.gewog-ddl option:last").after(geowgMarkUp);
                            });
                        }
                    }
                });
            }
        });




        $('select.cdzongkhag-ddl').on('change', function(){

           
            var selectedDzongkhagId = $('option:selected', this).val();

            if (selectedDzongkhagId.length > 0) {
                
                var loadGewog = false;

                if ($(this).hasClass('cload_gewogs')) {
                    loadGewog = true;

                    $("select.cgewog-ddl option:gt(0)").remove().end();
                    $("select.cvillage-ddl option:gt(0)").remove().end();
                    
                }
                $.ajax({
                    
                    type: 'GET',
                    url: appUrl + 'gewogByCDzongkhag/' + selectedDzongkhagId,
                    dataType: 'JSON',
                    data: {cload_gewogs: loadGewog},
                    beforeSend: function(){
                        $('#ajax-loading-container').removeClass('d-none');
                    },
                    complete: function() {
                        
                        $('#ajax-loading-container').addClass('d-none');
                    },
                    success: function(data) {
                        if (loadGewog) {
                            var geowgMarkUp;
                            $.each(data.gewogs, function( key, value ) {
                                geowgMarkUp = "<option value="+value['id']+">"+value['name']+"</option>";
                                $("select.cgewog-ddl option:last").after(geowgMarkUp);
                            });
                        }
                    }
                });
            }
        });




        $('select.gewog-ddl').on('change', function(){

            var selectedGewogId = $('option:selected', this).val();
           
            if (selectedGewogId.length > 0) {
               
                
                var loadVillage = false;
             
                if ($(this).hasClass('load_villages')) {
                    loadVillage = true;
                    $("select.village-ddl option:gt(0)").remove().end();

                }

                $.ajax({
                    type: 'GET',
                    url: appUrl + 'villageByGewog/' + selectedGewogId,
                    data: {load_villages: loadVillage},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#ajax-loading-container').removeClass('d-none');
                    },
                    complete: function() {
                        $('#ajax-loading-container').addClass('d-none');
                    },
                    success: function(data) {
                        if (loadVillage) {
                            
                            var villageMarkUp;
                            $.each(data.villages, function( key, value ) {
                                
                                villageMarkUp = "<option value="+value['id']+">"+value['name']+"</option>";
                                $("select.village-ddl option:last").after(villageMarkUp);
                            });
                        }
                    }
                });
            }
        });


        $('select.cgewog-ddl').on('change', function(){

            var selectedGewogId = $('option:selected', this).val();
           
            if (selectedGewogId.length > 0) {
               
                
                var loadVillage = false;
             
                if ($(this).hasClass('cload_villages')) {
                    loadVillage = true;
                    $("select.cvillage-ddl option:gt(0)").remove().end();

                }

                $.ajax({
                    type: 'GET',
                    url: appUrl + 'villageByCGewog/' + selectedGewogId,
                    data: {cload_villages: loadVillage},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#ajax-loading-container').removeClass('d-none');
                    },
                    complete: function() {
                        $('#ajax-loading-container').addClass('d-none');
                    },
                    success: function(data) {
                        if (loadVillage) {
                            
                            var villageMarkUp;
                            $.each(data.villages, function( key, value ) {
                                
                                villageMarkUp = "<option value="+value['id']+">"+value['name']+"</option>";
                                $("select.cvillage-ddl option:last").after(villageMarkUp);
                            });
                        }
                    }
                });
            }
        });

    }
    return {
        Initialize:initialize
    }
}();

$(document).ready(function(){
    relateddata.Initialize();
});

