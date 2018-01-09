(function($){
    $.fn.extend({ 
        Scfilemanagers : function(options) {      	
            var iframe    = "/medias";
            var id_iframe = "#iframe-manager";
            var modal     = null;
            var value     = [];
            var defaults = {
                _media   : false,
                base_url : "/",
                public   : "public",
                query    : {
                	type_file : "all",
                	max_files : 1
                },
                value_get : "id",
                before : function(){

                },
                beforselect : function($val){

                },
                afterselect : function($val){

                },
                beforchoose : function($val){

                },
                afferchoose : function($val){

                },
                after : function($val){

                }
            }; 

            var options = $.extend(defaults, options);
            this.init = function(){
                var _this = this;
                if(options._media == false){
                    var css = '<link rel="stylesheet" href="'+options.base_url+"/"+options.public+'/filemanager/filemanager.css" rel="stylesheet" />'
                    $("body").append('<div id="modal-filemanager" class="modal fade" role="dialog"> <div class="modal-dialog"> <!-- Modal content--> <button type="button" class="close">&times;</button><div class="modal-content"> <div class="modal-body"> <iframe id="iframe-manager" src="#"></iframe> <input type="hidden" id="data-value-choose-file"></div> </div> </div> </div>');
                    $("body").append(css);
                    modal = $("#modal-filemanager");         
                    $(document).ready(function(){
                        _this.click(function(){
                            _this.onload();
                            modal.modal();
                        });  
                    });
                    $(document).on("click","#modal-filemanager .close",function(){
                        modal.modal("hide");  
                    });
                }else{
                    $(document).on("change","#modal-filemanager #data-value-choose-file",function(){
                        alert(value);
                        options.beforselect(value); 
                        options.beforselect(value);
                    });
                }

            }
            this.onload = function (){
                var get_send = "";
                for (var i in options.query){
                    get_send +="&"+i+"="+ options.query[i];
                }
                iframe_url = options.base_url + iframe + "?is_iframe=true"+get_send;      
                modal.find(id_iframe).attr("src",iframe_url);
            }
            this.actionchange = function($val){
               value = $val;
               var modal_filemanager = window.parent.$('#modal-filemanager');
               modal_filemanager.find("#data-value-choose-file").trigger("change");
            } 
            this.init();
            return this;
        }
    });
})(jQuery);