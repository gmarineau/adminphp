var path = '../../../';
$(function() {

    $(".page").sortable({
        connectWith: ".section",
        cursor:"move",
        placeholder: 'placehoder',
        update : function() {
            var idPage = $(this).attr("id");
            serial = $(this).sortable('serialize');
            $.ajax ({
                type: 'post',
                data: serial,
                url: path+'admin/pages/set/add/'+idPage,
                complete: function(data) {
                    //alert(data);
                }
            });
        }
    });
    
    
    $(".menu").sortable({
        connectWith: ".section",
        cursor:"move",
        placeholder: 'placehoder',
        update : function() {
            var idItem = $(this).attr("id");
            serial = $(this).sortable('serialize');
            $.ajax ({
                type: 'post',
                data: serial,
                url: path+'admin/items/position/'+idItem,
                complete: function(data) {
                    //alert(data);
                }
            });
        }
    });
    
    $('.section').sortable({
        connectWith: '.page',
        cursor:"move",
        placeholder: 'placehoder',
        update : function() {
            var idPage = $(this).attr("id");
            serial = $(this).sortable('serialize');
            $.ajax ({
                type: 'post',
                data: serial,
                url: path+'admin/pages/set/delete/'+idPage,
                complete: function(data) {
                    //alert(data);
                }
            });
        }
    });
    
    $('.page-section').sortable({
        connectWith: '.content, .page-section',
        cursor:'move',
        placeholder: 'placehoder',
        update : function() {
            var idPage = $(this).attr("id");
            serial = $(this).sortable('serialize');
            $.ajax ({
                type: 'post',
                data: serial,
                url: path+'admin/displays/setcontent/add/'+idPage,
                complete: function(data) {
                    //alert(data);
                }
            });
        }
    });
    
    $('ul.content').sortable({
        connectWith: '.page-section',
        cursor:'move',
        placeholder: 'placehoder',
        update : function() {
            var idPage = $(this).attr("id");
            serial = $(this).sortable('serialize');
            $.ajax ({
                type: 'post',
                data: serial,
                url: path+'admin/displays/setcontent/delete/'+idPage,
                complete: function(data) {
                    //alert(data);
                }
            });
        }
    });

    $('#stat,#stoot').disableSelection();

});
