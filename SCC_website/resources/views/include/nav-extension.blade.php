<input id="select2-noResults" type="hidden" value="@lang("No Results Found")">
<!-- Select2 -->
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<script>

    function formatState (state) {
        if (!state.id) { return state; }
        var $state = $(
            '<span><span class="flag-icon flag-icon-' +  state.element.value.toLowerCase() + '"></span>&ensp;' +
            state.text +     '</span>'
        );
        return $state;
    };

    $(function () {

        //Initialize Select2 Elements
        $('#select2bs4-language').select2({
            templateResult: formatState,
            templateSelection: formatState,
            theme: 'bootstrap4',
            language: {
                "noResults": function(){
                    return $('#select2-noResults').val();
                }
            }
        })

        $('#select2bs4-language').on('select2:select', function (e) {
            var data = e.params.data;
            // console.log(data);
            $.ajax({
                url: "change-language",
                type: "POST",
                data: {_token: "{{csrf_token()}}", user_lang: data.id },
                async: false,
                success: function (data) {
                    // alert(data);
                    window.location.reload();
                }
            })
        });

    });
</script>
