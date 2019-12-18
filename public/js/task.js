$(function(){

    var show_message_task = function(response){
       
        var modal = $('.task-modal');

        $('.task-message').finish();
        
        if ( response.status == 'success' ){

            if ( modal.is(':visible') ) modal.modal('hide');

            $('.container .task-message').html(response.html).show();
            $('.container .task-message').fadeOut(2500);

            task_list();

        } else if ( response.status == 'error' ){

            if ( modal.is(':visible') ){
    
                $('.modal .task-message').html(response.html).show();
                $('.modal .task-message').fadeOut(2500);
    
            } else {

                $('.task-message').html(response.html).show();
                $('.task-message').fadeOut(2500);

            }
        }
    }

    $(document.body).on('submit','.form-task', function(e) {

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            datatype: 'json'
        }).done(function(response){
            show_message_task(response);
            $('input[name="task"]').val("");
        });
        
        e.preventDefault();

    });

    var task_list = function(){

        $.ajax({
            url: $('#task-list').data('action'),
            type: 'GET',
            datatype: 'json'
        }).done(function(response){
            $('#task-list').html(response.html);
        });

    }

    task_list();

    $(".task-modal").on("show.bs.modal", function (e) {
        
        var action = $(e.relatedTarget).data('action');
        var task = $(e.relatedTarget).data('task');

        $('.modal .form-task').attr('action',action);
        $('.modal .form-task input[name="task"]').val(task);
        $('.modal .task-message').html("");

    });

    $(document.body).on('click','.btn-delete-task', function(e) {

        var tarefa = $(this).parent().parent().find('td div.item-task').html();

        if ( confirm('Do you really want to delete the task "' + tarefa + '"?') ){
            
            $.ajax({
                url: $(this).data('action'),
                type: 'POST',
                data: {'_method':'PUT','_token':$('input[name="_token"]').val()},
                datatype: 'json'
            }).done(function(response){
               show_message_task(response);
            });

        }

        e.preventDefault();

    });

    $(document.body).on('click','.btn-close-task', function(e) {

        $.ajax({
            url: $(this).data('action'),
            type: 'POST',
            data: {'_method':'PUT','_token':$('input[name="_token"]').val()},
            datatype: 'json'
        }).done(function(response){
            show_message_task(response);
        });

        e.preventDefault();

    });

});