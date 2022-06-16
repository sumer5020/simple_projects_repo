$(function () {
    "use strict";
    $(".adm #check_all,.adm .check_all").on("click", function () {
        var select=$(this).attr('data-target');
        if(select)
        select="."+select;
        else
        select=" ";
        if (this.checked) {
            $("tbody"+select+" input[type='checkbox']").each(function () {
                this.checked = true;
            });
        } else {
            $("tbody"+select+" input[type='checkbox']").each(function () {
                this.checked = false;
            });
        }
    });
    $(".ico_thumb>i").prop("class", $("#icon").val());
    $("#icon").on("change", function () {
        $(".ico_thumb>i").prop("class", $("#icon").val());
    });

    //chose export filter
    $('.f_group input').on('click', function() {
        var exExport=$(this).parent().parent().parent().parent().find('a[data-id="export_ex"]');
        var href=$(exExport).prop('href');
        
        $(exExport).prop('href',href.substring(0,(href.length)-1)+$(this).attr('data-filter'));
    });

});
// add loading when ajax working
window.ajaxLoading = function loading(word) {
    $('<div id="loading" ' +
            'style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);' +
            'z-index:9999;color:#fff;font-size:2.2rem;font-weight:700;display:flex;' +
            'justify-content:center;align-items:center;">' + word + '</div>').prependTo("#app")
        .ajaxStart(function () {
            $(this).show();
        })
        .ajaxStop(function () {
            $(this).remove();
        });
}
