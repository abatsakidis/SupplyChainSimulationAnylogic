/*var lang_toolbar_add = {$lang_toolbar_add};
var lang_toolbar_confirm_del = {$lang_toolbar_confirm_del};
var lang_toolbar_save = {$lang_toolbar_save};
*/
function nm_move_field_out_sub(str_obj) {
    $('select[name=' + str_obj + '] > option:selected').each(function (i, t) {
        if (($(t).val()).substr(0, 7) == '__GRP__' || $(t).val().substr(0, 7) != '__SUB__' )return;
        var arr_value = $(t).val().split('__SUB__');
        str_value = arr_value[1];
        $(t).val(str_value);
        $(t).html($(t).html().split('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;').join('&nbsp;&nbsp;&nbsp;'));
    });
}
function nm_move_field_to_sub(str_obj) {
    $('select[name=' + str_obj + '] > option:selected').each(function (i, t) {

        if ($(t).val().substr(0, 7) == '__GRP__' || $(t).val().substr(0, 7) =='__SUB__' || $(t).val().substr(0, 7) =='__blc__' )return;

        var arr_value = $(t).val().split('_#fld#_');
        str_value = '__SUB__' + arr_value[0] + '_#fld#_' + arr_value[1];
        $(t).val(str_value);
        $(t).html($(t).html().split('&nbsp;&nbsp;&nbsp;').join('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
    });
    nm_form_modified();

}
function nm_group_toolbar_get_name(str_obj)
{
    var max_name = parseInt(0);
    $('select[name=' + str_obj + '] > option').each(function(i, t)
    {
        if($(t).val().substr(0, 7) == '__GRP__')
        {
            var name = $.unserialize($(t).val().substr(7).split('__#!NMDATA!#__')[1]);
            name = (name.name).split('group_')[1];
            if(max_name < parseInt(name))
            {
                max_name = parseInt(name);
            }
        }
    });
    return 'group_'+ (max_name + 1);
}

function nm_addGroup_toolbar(str_obj)
{
    $('input[name=obj_selected]').val(str_obj);
    $('.form_edit_toolbar').val('');
    $('#id_toolbar_group_name').val(nm_group_toolbar_get_name(str_obj));
    $('#id_toolbar_add_save_grp').attr('onclick', 'nm_button_addGroup_toolbar()');
    $('#id_toolbar_add_save_grp').val(lang_toolbar_add);
    $('#id_overlay_metal').show();
    $('#id_form_edit_toolbar').fadeIn();
}
function nm_cancel_window_toolbar() {
    $('#id_overlay_metal').hide();
    $('#id_form_edit_toolbar').hide();
}
function nm_button_addGroup_toolbar() {
    var str_obj = $('input[name=obj_selected]').val();
    var name_grp = $('#id_toolbar_group_label').val().replace(/\"/g,'\\"');

    var option_data = '__GRP__' + name_grp + '__#!NMDATA!#__'+ $('.form_edit_toolbar').serialize()
        + '_#fld#_' + name_grp;

    var ja_entrou = 0;
    $('select[name=' + str_obj + '] > option:selected').each(function (i, t) {
        if (ja_entrou == 1) return;

        var content = "<option style='color:#008000' value='"+ option_data +"' >" +
                "&nbsp;&nbsp;&nbsp;" + name_grp + "</option>";

        if(  $(t).val().substr(0,7) == '__blc__' )
        {
            $(t).prepend().after(content);
        }
        else
        {
            $(t).prepend().before(content);
        }
        ja_entrou = 1;
    });
    if (ja_entrou == 0) {
        $('select[name=' + str_obj + ']').html(
            $('select[name=' + str_obj + ']').html() +
                "<option style='color:#008000' value='"+ option_data +"' >" +
                "&nbsp;&nbsp;&nbsp;" + name_grp + "</option>");
    }
    nm_cancel_window_toolbar();
    nm_move_field_to_sub(str_obj);
    nm_form_modified();
}
function nm_delGroup_toolbar(str_obj)
{
    if(!confirm(lang_toolbar_confirm_del))
    {
        return false;
    }
    $('select[name=' + str_obj + '] > option:selected').each(function(i,t)
    {
        if ($(t).val().substr(0, 7) == '__GRP__') {
            $(t).remove();
        }
    });
    nm_form_modified();
}
function nm_editGroup_toolbar(str_obj) {
    $('input[name=obj_selected]').val(str_obj);
    var obj_selected = $('select[name=' + str_obj + '] > option:selected');
    if (obj_selected.val().substr(0, 7) != '__GRP__') return;

    $('#id_toolbar_add_save_grp').attr('onclick', 'nm_button_saveGroup_toolbar()');
    $('#id_toolbar_add_save_grp').val(lang_toolbar_save);
    var valor = obj_selected.val().split('__#!NMDATA!#__')[1].split('_#fld#_')[0];
    obj_valor = $.unserialize(valor);

    $('#id_toolbar_group_name').val(obj_valor.name);
    $('#id_toolbar_group_label').val(prepareValues(obj_valor.label));
    $('#id_toolbar_group_hint').val(prepareValues(obj_valor.hint));
    $('#id_toolbar_group_type').val(obj_valor.type);
    $('#id_toolbar_group_icon').val(prepareValues(obj_valor.icon));
    $('#id_toolbar_group_display').val(obj_valor.display);
    $('#id_toolbar_group_display_position').val(obj_valor.display_position);

    $('#id_overlay_metal').show();
    $('#id_form_edit_toolbar').fadeIn();

}

function prepareValues(valor)
{
    return valor.replace(/\+/g," ").replace(/%2B/g,"+").replace(/\"/g,'\\"');
}

function nm_button_saveGroup_toolbar() {
    var str_obj = $('input[name=obj_selected]').val();
    var obj_selected = $('select[name=' + str_obj + '] > option:selected');
    if (obj_selected.val().substr(0, 7) == '__GRP__') {
        var option_data = '__GRP__' + $('#id_toolbar_group_label').val().replace(/\"/g,'\\"') + '__#!NMDATA!#__'+ $('.form_edit_toolbar').serialize()
            + '_#fld#_' + $('#id_toolbar_group_label').val();
        obj_selected.val(option_data);
        obj_selected.html("&nbsp;&nbsp;&nbsp;" + $('#id_toolbar_group_label').val());
    }
    nm_cancel_window_toolbar();
    nm_form_modified();
}

(function($){
    $.unserialize = function(serializedString){
        var str = decodeURI(serializedString);
        var pairs = str.split('&');
        var obj = {}, p, idx, val;
        for (var i=0, n=pairs.length; i < n; i++) {
            p = pairs[i].split('=');
            idx = p[0];

            if (idx.indexOf("[]") == (idx.length - 2)) {
                // Eh um vetor
                var ind = idx.substring(0, idx.length-2)
                if (obj[ind] === undefined) {
                    obj[ind] = [];
                }
                obj[ind].push(p[1]);
            }
            else {
                obj[idx] = p[1];
            }
        }
        return obj;
    };
})(jQuery);