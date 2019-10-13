$(document).ready(function (){
    // Load delete record id to delete modal
    $(document).on('click','.delete_record_btn',function(){
        let id = $(this).attr('id');
        $(document).find('#delete_id').val(id);
    });

    // Display Image name on Choose file text
    $(document).on('change','.image-file', function(e){
        var fileName = e.target.files[0].name;
        $(this).next().text(fileName);
        $(document).find('.image-preview').hide();
    });

});

