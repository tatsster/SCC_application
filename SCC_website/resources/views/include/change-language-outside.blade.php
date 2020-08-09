<select name="user_lang" id="select2bs4-language" style="padding-right: 30px" class="form-control select2bs4" style="width: 100%;">
    @foreach( $lang_db as $lang_each)
        @if (Cookie::get('1752051_user_lang') == $lang_each->language_code)
            <option selected value="{{{$lang_each->language_code}}}">@lang($lang_each->language_name)</option>
        @else
            <option value="{{{$lang_each->language_code}}}">@lang($lang_each->language_name)</option>
        @endif
    @endforeach
</select>
