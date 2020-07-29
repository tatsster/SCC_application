<script src="../assets/js/idle-timer.js"></script>
<div id="check-session-timeout" onclick="checkSessionTimeout({{{ session('1752051_user')['user_session_timeout'] }}})"></div>
<script>
    $("#check-session-timeout").click();

    function checkSessionTimeout(timeout){

        var docTimeout = timeout * 60000;

        /*
        Handle raised idle/active events
        */
        $(document).on("idle.idleTimer", function (event, elem, obj) {

            $.ajax({
                url: "set-lockscreen",
                type: "POST",
                data: {_token: "{{csrf_token()}}" },
                async: true,
                success: function (data) {
                    // alert(data);
                    window.location.href = "lockscreen";
                }
            })

        });

        $(document).on("active.idleTimer", function (event, elem, obj, e) {

            {{--$.ajax({--}}
            {{--    url: "set-lockscreen",--}}
            {{--    type: "POST",--}}
            {{--    data: {_token: "{{csrf_token()}}", lockscreen: false },--}}
            {{--    async: true,--}}
            {{--    success: function (data) {--}}
            {{--        // alert(data);--}}
            {{--        window.location.href = "lockscreen";--}}
            {{--    }--}}
            {{--})--}}

        });

        $(document).idleTimer({
            timeout: docTimeout,
            timerSyncId: "session-timeout"
        });

    }

    /* Scoll page position session */

    $(window).scroll(function () {
        //set scroll position in session storage
        sessionStorage.scrollPos = $(window).scrollTop();
    });
    var init = function () {
        //get scroll position in session storage
        $(window).scrollTop(sessionStorage.scrollPos || 0)
    };
    window.onload = init;

</script>
