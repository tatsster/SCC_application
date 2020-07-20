<div class="modal fade" id="chatBot" tabindex="-1" role="dialog" aria-labelledby="chatBotLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="create-sensor" method="post">
                {{csrf_field()}}
                <div class="modal-header">
                    <h3 class="card-title">@lang('ChatBot')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card direct-chat direct-chat-warning">
{{--                    <div class="card-header">--}}
{{--                        <h3 class="card-title">Direct Chat</h3>--}}

{{--                        <div class="card-tools">--}}
{{--                            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-warning">3</span>--}}
{{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
{{--                            </button>--}}
{{--                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">--}}
{{--                                <i class="fas fa-comments"></i></button>--}}
{{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div id="id-direct-chat-messages" class="direct-chat-messages">
                            <!-- Message. Default to the left -->
{{--                            <div class="direct-chat-msg">--}}
{{--                                <div class="direct-chat-infos clearfix">--}}
{{--                                    <span class="direct-chat-name float-left">{{ session("1752051_user")["user_fullname"] }}</span>--}}
{{--                                    <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>--}}
{{--                                </div>--}}
{{--                                <!-- /.direct-chat-infos -->--}}
{{--                                <img class="direct-chat-img" src="{{{ session("1752051_user")["user_avatar"] }}}" alt="message user image">--}}
{{--                                <!-- /.direct-chat-img -->--}}
{{--                                <div class="direct-chat-text">--}}
{{--                                    Is this template really for free? That's unbelievable!--}}
{{--                                </div>--}}
{{--                                <!-- /.direct-chat-text -->--}}
{{--                            </div>--}}
                            <!-- /.direct-chat-msg -->
{{--                            <br>--}}
                            <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">@lang('ChatBot')</span>
                                    <span id="first-time" class="direct-chat-timestamp float-left"></span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{{ session("1752051_user")["user_avatar"] }}}" alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    @lang("Welcome to SCC ChatBot. Can I help you?")
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                        </div>
                        <!--/.direct-chat-messages-->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                            <div class="input-group">
                                <input type="text" id="chat-message" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-append">
                          <button type="button" class="btn btn-warning" onclick="updateChat('{{{ session("1752051_user")["user_fullname"] }}}',$('#chat-message').val(),'{{{ session("1752051_user")["user_avatar"] }}}','@lang("Please wait a minute...")')">Send</button>
                        </span>
                            </div>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <div class="modal-footer">
                    <div class="compact marquee" id="div_language">
                        <select id="select_dialect" style="visibility: hidden;">
                            <option value="en-AU">Australia</option><option value="en-CA">Canada</option><option value="en-IN">India</option><option value="en-KE">Kenya</option><option value="en-TZ">Tanzania</option><option value="en-GH">Ghana</option><option value="en-NZ">New Zealand</option><option value="en-NG">Nigeria</option><option value="en-ZA">South Africa</option><option value="en-PH">Philippines</option><option value="en-GB">United Kingdom</option><option value="en-US">United States</option></select>&nbsp;&nbsp;
                        <select id="select_language" class="select2bs4">
                            <option value="0">Afrikaans</option><option value="1">አማርኛ</option><option value="2">Azərbaycanca</option><option value="3">বাংলা</option><option value="4">Bahasa Indonesia</option><option value="5">Bahasa Melayu</option><option value="6">Català</option><option value="7">Čeština</option><option value="8">Dansk</option><option value="9">Deutsch</option><option value="10">English</option><option value="11">Español</option><option value="12">Euskara</option><option value="13">Filipino</option><option value="14">Français</option><option value="15">Basa Jawa</option><option value="16">Galego</option><option value="17">ગુજરાતી</option><option value="18">Hrvatski</option><option value="19">IsiZulu</option><option value="20">Íslenska</option><option value="21">Italiano</option><option value="22">ಕನ್ನಡ</option><option value="23">ភាសាខ្មែរ</option><option value="24">Latviešu</option><option value="25">Lietuvių</option><option value="26">മലയാളം</option><option value="27">मराठी</option><option value="28">Magyar</option><option value="29">ລາວ</option><option value="30">Nederlands</option><option value="31">नेपाली भाषा</option><option value="32">Norsk bokmål</option><option value="33">Polski</option><option value="34">Português</option><option value="35">Română</option><option value="36">සිංහල</option><option value="37">Slovenščina</option><option value="38">Basa Sunda</option><option value="39">Slovenčina</option><option value="40">Suomi</option><option value="41">Svenska</option><option value="42">Kiswahili</option><option value="43">ქართული</option><option value="44">Հայերեն</option><option value="45">தமிழ்</option><option value="46">తెలుగు</option><option value="47">Tiếng Việt</option><option value="48">Türkçe</option><option value="49">اُردُو</option><option value="50">Ελληνικά</option><option value="51">български</option><option value="52">Pусский</option><option value="53">Српски</option><option value="54">Українська</option><option value="55">한국어</option><option value="56">中文</option><option value="57">日本語</option><option value="58">हिन्दी</option><option value="59">ภาษาไทย</option></select>
                    </div>
                    <button type="button" class="btn custom-microphone-button" id="start_button" onclick="startButton(event)" ><i style="color: #00A80E" id="start_img" class="fa fa-microphone"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var today = new Date();
    var date = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;

    $("#first-time").text(dateTime);

    function updateChat(name,message,avatar,wait){

        if ($('#chat-message').val() != '') {
            today = new Date();
            date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
            time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            dateTime = date + ' ' + time;

            finalText = $("#id-direct-chat-messages").html() + '<br>';

            $("#id-direct-chat-messages").html(finalText + '<div class="direct-chat-msg">' +
                '                                <div class="direct-chat-infos clearfix">' +
                '                                    <span class="direct-chat-name float-left">' + name + '</span>' +
                '                                    <span class="direct-chat-timestamp float-right">' + dateTime + '</span>' +
                '                                </div>' +
                '                                <img class="direct-chat-img" src="' + avatar + '" alt="message user image">' +
                '                                <div class="direct-chat-text">' + message +
                '                                </div>' +
                '                            </div>');

            $('#chat-message').val('');

            $.ajax({
                url: "chatbot",
                type: "POST",
                data: {_token: "{{csrf_token()}}", user_fullname: name, user_message: message, user_datetime: dateTime, user_timestamp: today.getTime()},
                async: true,
                success: function (data) {
                    alert(data);
                    // window.location.href = "room";
                    finalText = $("#id-direct-chat-messages").html() + '<br>';

                    $("#id-direct-chat-messages").html(finalText + '<div class="direct-chat-msg right">' +
                        '                                <div class="direct-chat-infos clearfix">' +
                        '                                    <span class="direct-chat-name float-left">' + "ChatBot" + '</span>' +
                        '                                    <span class="direct-chat-timestamp float-right">' + dateTime + '</span>' +
                        '                                </div>' +
                        '                                <img class="direct-chat-img" src="' + avatar + '" alt="message user image">' +
                        '                                <div class="direct-chat-text">' + wait +
                        '                                </div>' +
                        '                            </div>');

                }
            })
        }
    }
</script>
<input id="select2-noResults" type="hidden" value="@lang("No Results Found")">
<!-- Select2 -->
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<script nonce="">

    $(function () {

        //Initialize Select2 Elements
        $('#select_language').select2({
            theme: 'bootstrap4',
            language: {
                "noResults": function(){
                    return $('#select2-noResults').val();
                }
            }
        })

        $('#select_language').on('select2:select', function (e) {
            updateCountry();
        });

    });

    // If you modify this array, also update default language / dialect below.
    var langs =
        [['Afrikaans',       ['af-ZA']],
            ['አማርኛ',           ['am-ET']],
            ['Azərbaycanca',    ['az-AZ']],
            ['বাংলা',            ['bn-BD', 'বাংলাদেশ'],
                ['bn-IN', 'ভারত']],
            ['Bahasa Indonesia',['id-ID']],
            ['Bahasa Melayu',   ['ms-MY']],
            ['Català',          ['ca-ES']],
            ['Čeština',         ['cs-CZ']],
            ['Dansk',           ['da-DK']],
            ['Deutsch',         ['de-DE']],
            ['English',         ['en-AU', 'Australia'],
                ['en-CA', 'Canada'],
                ['en-IN', 'India'],
                ['en-KE', 'Kenya'],
                ['en-TZ', 'Tanzania'],
                ['en-GH', 'Ghana'],
                ['en-NZ', 'New Zealand'],
                ['en-NG', 'Nigeria'],
                ['en-ZA', 'South Africa'],
                ['en-PH', 'Philippines'],
                ['en-GB', 'United Kingdom'],
                ['en-US', 'United States']],
            ['Español',         ['es-AR', 'Argentina'],
                ['es-BO', 'Bolivia'],
                ['es-CL', 'Chile'],
                ['es-CO', 'Colombia'],
                ['es-CR', 'Costa Rica'],
                ['es-EC', 'Ecuador'],
                ['es-SV', 'El Salvador'],
                ['es-ES', 'España'],
                ['es-US', 'Estados Unidos'],
                ['es-GT', 'Guatemala'],
                ['es-HN', 'Honduras'],
                ['es-MX', 'México'],
                ['es-NI', 'Nicaragua'],
                ['es-PA', 'Panamá'],
                ['es-PY', 'Paraguay'],
                ['es-PE', 'Perú'],
                ['es-PR', 'Puerto Rico'],
                ['es-DO', 'República Dominicana'],
                ['es-UY', 'Uruguay'],
                ['es-VE', 'Venezuela']],
            ['Euskara',         ['eu-ES']],
            ['Filipino',        ['fil-PH']],
            ['Français',        ['fr-FR']],
            ['Basa Jawa',       ['jv-ID']],
            ['Galego',          ['gl-ES']],
            ['ગુજરાતી',           ['gu-IN']],
            ['Hrvatski',        ['hr-HR']],
            ['IsiZulu',         ['zu-ZA']],
            ['Íslenska',        ['is-IS']],
            ['Italiano',        ['it-IT', 'Italia'],
                ['it-CH', 'Svizzera']],
            ['ಕನ್ನಡ',             ['kn-IN']],
            ['ភាសាខ្មែរ',          ['km-KH']],
            ['Latviešu',        ['lv-LV']],
            ['Lietuvių',        ['lt-LT']],
            ['മലയാളം',          ['ml-IN']],
            ['मराठी',             ['mr-IN']],
            ['Magyar',          ['hu-HU']],
            ['ລາວ',              ['lo-LA']],
            ['Nederlands',      ['nl-NL']],
            ['नेपाली भाषा',        ['ne-NP']],
            ['Norsk bokmål',    ['nb-NO']],
            ['Polski',          ['pl-PL']],
            ['Português',       ['pt-BR', 'Brasil'],
                ['pt-PT', 'Portugal']],
            ['Română',          ['ro-RO']],
            ['සිංහල',          ['si-LK']],
            ['Slovenščina',     ['sl-SI']],
            ['Basa Sunda',      ['su-ID']],
            ['Slovenčina',      ['sk-SK']],
            ['Suomi',           ['fi-FI']],
            ['Svenska',         ['sv-SE']],
            ['Kiswahili',       ['sw-TZ', 'Tanzania'],
                ['sw-KE', 'Kenya']],
            ['ქართული',       ['ka-GE']],
            ['Հայերեն',          ['hy-AM']],
            ['தமிழ்',            ['ta-IN', 'இந்தியா'],
                ['ta-SG', 'சிங்கப்பூர்'],
                ['ta-LK', 'இலங்கை'],
                ['ta-MY', 'மலேசியா']],
            ['తెలుగు',           ['te-IN']],
            ['Tiếng Việt',      ['vi-VN']],
            ['Türkçe',          ['tr-TR']],
            ['اُردُو',            ['ur-PK', 'پاکستان'],
                ['ur-IN', 'بھارت']],
            ['Ελληνικά',         ['el-GR']],
            ['български',         ['bg-BG']],
            ['Pусский',          ['ru-RU']],
            ['Српски',           ['sr-RS']],
            ['Українська',        ['uk-UA']],
            ['한국어',            ['ko-KR']],
            ['中文',             ['cmn-Hans-CN', '普通话 (中国大陆)'],
                ['cmn-Hans-HK', '普通话 (香港)'],
                ['cmn-Hant-TW', '中文 (台灣)'],
                ['yue-Hant-HK', '粵語 (香港)']],
            ['日本語',           ['ja-JP']],
            ['हिन्दी',             ['hi-IN']],
            ['ภาษาไทย',         ['th-TH']]];

    for (var i = 0; i < langs.length; i++) {
        select_language.options[i] = new Option(langs[i][0], i);
    }
    // Set default language / dialect.
    select_language.selectedIndex = 10;
    updateCountry();
    select_dialect.selectedIndex = 11;
    // showInfo('info_start');

    function updateCountry() {
        for (var i = select_dialect.options.length - 1; i >= 0; i--) {
            select_dialect.remove(i);
        }
        var list = langs[select_language.selectedIndex];
        for (var i = 1; i < list.length; i++) {
            select_dialect.options.add(new Option(list[i][1], list[i][0]));
        }
        // select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';
    }

    var create_email = false;
    var final_transcript = '';
    var recognizing = false;
    var ignore_onend;
    var start_timestamp;
    if (!('webkitSpeechRecognition' in window)) {
        upgrade();
    } else {
        start_button.style.display = 'inline-block';
        var recognition = new webkitSpeechRecognition();
        recognition.continuous = true;
        recognition.interimResults = true;

        recognition.onstart = function() {
            recognizing = true;
            // showInfo('info_speak_now');
            // start_img.src = '/intl/en/chrome/assets/common/images/content/mic-animate.gif';
            start_img.style = 'color: #d31511';
        };

        recognition.onerror = function(event) {
            if (event.error == 'no-speech') {
                start_img.style = 'color: #00A80E';
                // showInfo('info_no_speech');
                ignore_onend = true;
            }
            if (event.error == 'audio-capture') {
                start_img.style = 'color: #00A80E';
                // showInfo('info_no_microphone');
                ignore_onend = true;
            }
            if (event.error == 'not-allowed') {
                if (event.timeStamp - start_timestamp < 100) {
                    // showInfo('info_blocked');
                } else {
                    // showInfo('info_denied');
                }
                ignore_onend = true;
            }
        };

        recognition.onend = function() {
            recognizing = false;
            if (ignore_onend) {
                return;
            }
            start_img.style = 'color: #00A80E';
            if (!final_transcript) {
                // showInfo('info_start');
                return;
            }
            // showInfo('');
            if (window.getSelection) {
                window.getSelection().removeAllRanges();
                var range = document.createRange();
                // range.selectNode(document.getElementById('final_span'));
                window.getSelection().addRange(range);
            }
            // if (create_email) {
            //     create_email = false;
            //     createEmail();
            // }
        };

        recognition.onresult = function(event) {
            var interim_transcript = '';
            if (typeof(event.results) == 'undefined') {
                recognition.onend = null;
                recognition.stop();
                upgrade();
                return;
            }
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                    final_transcript += event.results[i][0].transcript;
                } else {
                    interim_transcript += event.results[i][0].transcript;
                }
            }
            final_transcript = capitalize(final_transcript);
            // final_span.innerHTML = linebreak(final_transcript);
            // interim_span.innerHTML = linebreak(interim_transcript);
            // if (final_transcript || interim_transcript) {
            //     showButtons('inline-block');
            // }
            $('#chat-message').val(final_transcript);
        };
    }

    function upgrade() {
        start_button.style.visibility = 'hidden';
        // showInfo('info_upgrade');
    }

    var two_line = /\n\n/g;
    var one_line = /\n/g;
    function linebreak(s) {
        return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
    }

    var first_char = /\S/;
    function capitalize(s) {
        return s.replace(first_char, function(m) { return m.toUpperCase(); });
    }

    // function createEmail() {
    //     var n = final_transcript.indexOf('\n');
    //     if (n < 0 || n >= 80) {
    //         n = 40 + final_transcript.substring(40).indexOf(' ');
    //     }
    //     var subject = encodeURI(final_transcript.substring(0, n));
    //     var body = encodeURI(final_transcript.substring(n + 1));
    //     window.location.href = 'mailto:?subject=' + subject + '&body=' + body;
    // }

    // function copyButton() {
    //     if (recognizing) {
    //         recognizing = false;
    //         recognition.stop();
    //     }
    //     copy_button.style.display = 'none';
    //     copy_info.style.display = 'inline-block';
    //     showInfo('');
    // }
    //
    // function emailButton() {
    //     if (recognizing) {
    //         create_email = true;
    //         recognizing = false;
    //         recognition.stop();
    //     } else {
    //         createEmail();
    //     }
    //     email_button.style.display = 'none';
    //     email_info.style.display = 'inline-block';
    //     showInfo('');
    // }

    function startButton(event) {
        if (recognizing) {
            recognition.stop();
            return;
        }
        final_transcript = '';
        recognition.lang = select_dialect.value;
        recognition.start();
        ignore_onend = false;
        // final_span.innerHTML = '';
        // interim_span.innerHTML = '';
        start_img.src = '/intl/en/chrome/assets/common/images/content/mic-slash.gif';
        // showInfo('info_allow');
        // showButtons('none');
        start_timestamp = event.timeStamp;
    }

    // function showInfo(s) {
    //     if (s) {
    //         for (var child = info.firstChild; child; child = child.nextSibling) {
    //             if (child.style) {
    //                 child.style.display = child.id == s ? 'inline' : 'none';
    //             }
    //         }
    //         info.style.visibility = 'visible';
    //     } else {
    //         info.style.visibility = 'hidden';
    //     }
    // }

    // var current_style;
    // function showButtons(style) {
    //     if (style == current_style) {
    //         return;
    //     }
    //     current_style = style;
    //     copy_button.style.display = style;
    //     email_button.style.display = style;
    //     copy_info.style.display = 'none';
    //     email_info.style.display = 'none';
    // }
</script>
