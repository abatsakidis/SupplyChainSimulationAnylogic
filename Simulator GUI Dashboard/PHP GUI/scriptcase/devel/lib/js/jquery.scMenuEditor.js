(function($) {

    $.fn.editMenu = function(options) {
        return this.each(function() {
            $.scMenuEditor.setMenu(this, options);
        });
    } // editMenu

    $.scMenuEditor = {

        setMenu: function(elem, options) {
            var $data        = $.scMenuEditorData,
                localOptions = {
                    menu  : this,
                    target: elem,
                    uiName: "sc-js-menu-" + options.field + "-"
                };

            $.extend($.scMenuEditorData, localOptions, options);

            $data.initTheme = $('input[name="' + $data.fieldTheme + '"]').val();

            this._renderUI();
            if (0 < $data.itemList.length) {
                $("#" + $data.uiName + "example").hide();
                this._includeInitialItems();
            }
            else {
                $("#" + $data.uiName + "example").show();
                this._updateView();
            }

            this._enableForm();
        }, // setMenu

        _renderUI: function() {
            var $data = $.scMenuEditorData,
                html, tplBasic, i, iBr, $tplList, iconId;

            if ("" != $data.initTheme) {
                tplBasic = $data.initTheme.substr(0, $data.initTheme.indexOf("_"));
            }
            else {
                tplBasic = "";
            }

            html  = "<div class=\"sc-ui-menu-editor\">";

            html +=  "<table style=\"border-collapse: collapse; border-width: 0\"><tr><td style=\"padding: 0\">";

            html +=  "<div class=\"sc-ui-menu-leftpanel\">";
            html +=   "<ul class=\"sc-ui-menu-toolbar genericBorderColor genericTitleBackground\">";
            html +=    "<li id=\"" + $data.uiName + "btn-newitem\"><img src=\""   + $data.barUrl + "me_add.png\" class=\"sc-ui-menu-toolbar-button\" alt=\""     + $data.langNewItem + "\" title=\"" + $data.langNewItem + "\" /></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-newsub\"><img src=\""    + $data.barUrl + "me_addsub.png\" class=\"sc-ui-menu-toolbar-button\" alt=\""  + $data.langNewSub  + "\" title=\"" + $data.langNewSub  + "\" /></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-remove\"><img src=\""    + $data.barUrl + "me_delete.png\" class=\"sc-ui-menu-toolbar-button\" alt=\""  + $data.langRemove  + "\" title=\"" + $data.langRemove  + "\" /></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-import\"><img src=\""    + $data.barUrl + "me_import.png\" class=\"sc-ui-menu-toolbar-button\" alt=\""  + $data.langImport  + "\" title=\"" + $data.langImport  + "\" /></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-moveup\"><img src=\""    + $data.barUrl + "me_up.png\" class=\"sc-ui-menu-toolbar-button\" alt=\""      + $data.langUp      + "\" title=\"" + $data.langUp      + "\" /></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-movedown\"><img src=\""  + $data.barUrl + "me_down.png\" class=\"sc-ui-menu-toolbar-button\" alt=\""    + $data.langDown    + "\" title=\"" + $data.langDown    + "\" /></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-moveleft\"><img src=\""  + $data.barUrl + "me_left.png\" class=\"sc-ui-menu-toolbar-button\" alt=\""    + $data.langLeft    + "\" title=\"" + $data.langLeft    + "\" /></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-moveright\"><img src=\"" + $data.barUrl + "me_right.png\" class=\"sc-ui-menu-toolbar-button\" alt=\""   + $data.langRight   + "\" title=\"" + $data.langRight   + "\" /></li>";
            html +=   "</ul>";
            html +=   "<div class=\"sc-ui-menu-itemtree genericBorderColor\">";
            html +=    "<ul id=\"" + $data.uiName + "itemtree\">";
            html +=    "</ul>";
            html +=   "</div>";
            html +=  "</div>";

            html +=  "</td><td style=\"padding: 0\">";

            html +=  "<div class=\"sc-ui-menu-centerpanel\">";
            html +=   "<div class=\"sc-ui-menu-itemdata genericBorderColor\">";
            html +=    "<span class=\"sc-ui-menu-text sc-ui-menu-header\">" + $data.langProperties  + "</span><hr class=\"sc-ui-menu-hr genericBorderColor\" />";
            html +=    "<span class=\"sc-ui-menu-text\">ID</span> <span class=\"sc-ui-menu-text\" id=\"" + $data.uiName + "ipt-id\"></span><br />";
            html +=    "<span class=\"sc-ui-menu-text\">" + $data.langLabel  + "</span><br /><input type=\"text\" id=\"" + $data.uiName + "ipt-label\" /><br />";
            html +=    "<span class=\"sc-ui-menu-text\">" + $data.langLink   + "</span><br /><input type=\"text\" id=\"" + $data.uiName + "ipt-link\" name=\"sc_item_link\" /><img src=\"" + $data.iconLink + "\" id=\"" + $data.uiName + "ipt-icon-link\" class=\"sc-ui-menu-icon-link\" /><br />";
            html +=    "<span class=\"sc-ui-menu-text\">" + $data.langHint   + "</span><br /><input type=\"text\" id=\"" + $data.uiName + "ipt-hint\" /><br />";
            html +=    "<span style=\"white-space: nowrap\"><span class=\"sc-ui-menu-text\">" + $data.langIcon   + "</span><br /><input type=\"text\" id=\"" + $data.uiName + "ipt-icon\" name=\"sc_item_icon\" /><img src=\"" + $data.iconIcon2 + "\" id=\"" + $data.uiName + "ipt-icon-icon2\" class=\"sc-ui-menu-icon-link\" alt=\"" + $data.langIcon2 + "\" title=\"" + $data.langIcon2 + "\" /></span><br />";
            html +=    "<span class=\"sc-ui-menu-text\">" + $data.langTarget + "</span><br />";
            html +=    "<select id=\"" + $data.uiName + "ipt-target\">";
            html +=     "<option value=\"_self\">"   + $data.langSelf   + "</option>";
            html +=     "<option value=\"_blank\">"  + $data.langBlank  + "</option>";
            html +=     "<option value=\"_parent\">" + $data.langParent + "</option>";
            html +=    "</select>";
            html +=   "</div>";
            html +=  "</div>";

            html +=  "</td><td style=\"padding: 0\">";

            html +=  "<div class=\"sc-ui-menu-rightpanel\">";
            html +=   "<div class=\"sc-ui-menu-style genericBorderColor\">";
            html +=    "<span class=\"sc-ui-menu-text sc-ui-menu-header\">" + $data.langTheme + "</span><hr class=\"sc-ui-menu-hr genericBorderColor\" />";
            html +=    "<select size=\"14\" id=\"" + $data.uiName + "ipt-template\">";
            html += $data.menu._getThemeOptions("scriptcase");
            html += $data.menu._getThemeOptions("sys");
            html += $data.menu._getThemeOptions("grp");
            html += $data.menu._getThemeOptions("usr");
            html +=    "</select>";
            html +=   "</div>";
            html +=  "</div>";

            html +=  "</td></tr></table>";

            html += "</div>";

            html += "<div style=\"clear: both\"><input type=\"checkbox\" id=\"" + $data.uiName + "checkall\" />" + $data.langCheckUncheck + "</div>";

            html += "<div class=\"sc-ui-menu-preview\" id=\"" + $data.uiName + "preview\" style=\"display: none\">" + $data.langPreviewMenu + "<hr class=\"sc-ui-menu-hr genericBorderColor\" /></div>";
            html += "<div class=\"sc-ui-menu-example\" id=\"" + $data.uiName + "example\" style=\"display: none\">" + $data.langExampleMenu + "<hr class=\"sc-ui-menu-hr genericBorderColor\" /></div>";
            html += "<div class=\"sc-ui-menu-view\" id=\"" + $data.uiName + "view\"></div>";

            html += "<div class=\"sc-ui-menu-icons-list genericBorderColor genericTitleBackground\" id=\"" + $data.uiName + "icons-list\">";
            html +=  "<span class=\"sc-ui-menu-text sc-ui-menu-header\">" + $data.langIconList + "</span>";
            html +=  "<div class=\"sc-ui-menu-icons-display\">";
            html +=  "</div>";
            html +=  "<span class=\"sc-ui-menu-text sc-ui-menu-header\">" + $data.langIconSize + "</span>";
            html +=  "<select id=\"" + $data.uiName + "icon-size\">";
            html +=   "<option value=\"16\">16</option>";
            html +=   "<option value=\"24\">24</option>";
            html +=   "<option value=\"32\">32</option>";
            html +=  "</select>";
            html +=  "<br />";
            html +=  "<input class=\"nmButton\" type=\"button\" value=\"" + $data.langButtonOk + "\" id=\"" + $data.uiName + "btn-icon-ok\" />";
            html +=  "<input class=\"nmButton\" type=\"button\" value=\"" + $data.langButtonCancel + "\" id=\"" + $data.uiName + "btn-icon-cancel\" />";
            html += "</div>";

            $($data.target).append(html);

            if ("" != $data.initTheme) {
                $("#" + $data.uiName + "ipt-template").val($data.initTheme);
            }

            $("#" + $data.uiName + "btn-newitem").bind("click", $data.menu._addItem);
            $("#" + $data.uiName + "btn-newsub").bind("click", $data.menu._addSubitem);
            $("#" + $data.uiName + "btn-remove").bind("click", $data.menu._removeItem);
            $("#" + $data.uiName + "btn-import").bind("click", function() { nmImportApp("checkbox", "nmReceiveApp"); });
            $("#" + $data.uiName + "btn-moveup").bind("click", $data.menu._moveUp);
            $("#" + $data.uiName + "btn-movedown").bind("click", $data.menu._moveDown);
            $("#" + $data.uiName + "btn-moveleft").bind("click", $data.menu._moveLeft);
            $("#" + $data.uiName + "btn-moveright").bind("click", $data.menu._moveRight);

            $("#" + $data.uiName + "ipt-label").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-link").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-hint").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-icon").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-target").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-template").bind("click", $data.menu._applyTemplate);

            $("#" + $data.uiName + "ipt-icon-link").bind("click", function() { nmImportApp("radio", "sc_item_link"); });
            //$("#" + $data.uiName + "ipt-icon-icon1").bind("click", function() { nm_window_image_new("ico","form_edit", "sc_item_icon", "scReceiveIcon"); });
			$("#" + $data.uiName + "ipt-icon-icon2").bind("click", function() { nm_window_image_new("ico","form_edit", "sc_item_icon", "scReceiveIcon"); });
            //$("#" + $data.uiName + "ipt-icon-icon2").bind("click", $data.menu._openIconList);

            $("#" + $data.uiName + "btn-icon-ok").bind("click", $data.menu._iconOk);
            $("#" + $data.uiName + "btn-icon-cancel").bind("click", $data.menu._iconCancel);

            $("#" + $data.uiName + "checkall").bind("click", $data.menu._checkAll);

            $data.menu._fixSize();

            $data.menu._preloadIcons();
        }, // _renderUI

        _fixSize: function() {
            var $data   = $.scMenuEditorData,
                $center = $(".sc-ui-menu-itemdata"),
                $right  = $(".sc-ui-menu-style"),
                iMax;

            if ($center.height() > $right.height()) {
                iMax = $center.height();
            }
            else {
                iMax = $right.height();
            }
            $center.css('height', iMax + 'px');
            $right.css('height', iMax + 'px');

            $(".sc-ui-menu-itemtree").css('height', iMax - $(".sc-ui-menu-toolbar").height() + 5 + 'px');
        }, // _fixSize

        _getIconUrl: function(iconFile) {
            var $data = $.scMenuEditorData,
                parts, iconModule, iconDir, iconName, imageSuffix;

            var iconFilePath;
            var icon_file_aux = iconFile.split('__NM__');
            switch(icon_file_aux.length) {
                case 1:
                    iconFilePath = $data.imagePath['scriptcase'] + 'ico/' + icon_file_aux[0];
                break;
                case 2:
                    iconFilePath = $data.imagePath[icon_file_aux[0]] + 'ico/' + icon_file_aux[1];
                break;
                default:
                    if (icon_file_aux.length > 3) { 
                        icon_file_aux[2] = icon_file_aux[2] +'/'+ icon_file_aux[3]; 
                    }            
                    iconFilePath = $data.imagePath[icon_file_aux[0]] + icon_file_aux[1] + '/' + icon_file_aux[2];
                break;
            }            
            return iconFilePath;
        }, // _getIconUrl

        _loadIcons: function() {
            var $data = $.scMenuEditorData;

            if ($data.iconsLoaded) {
                return;
            }

            $data.iconsLoaded = true;

            for (i = 0; i < $data.iconList.length; i++) {
                iconId = $data.iconList[i].substr(0, $data.iconList[i].length - 7);
                $(".sc-ui-menu-icons-display").append("<img src=\"" + $data.menu._getIconUrl($data.iconList[i]) + "\" id=\"sc-icon-" + iconId + "\" class=\"sc-ui-menu-icons-img\">");
            }

            $(".sc-ui-menu-icons-img").bind("click", $data.menu._selectIcon);
        }, // _loadIcons

        _preloadIcons: function() {
            var $data   = $.scMenuEditorData,
                imgList = [];

            for (i = 0; i < $data.iconList.length; i++) {
                imgList.push( $("<img />").attr("src", $data.menu._getIconUrl($data.iconList[i])) );
            }
        }, // _preloadIcons

        _addItem: function() {
            var $data = $.scMenuEditorData;

            $data.menu._includeItem("item");

            $data.menu._updateSubmitValue();
            $data.menu._updateView();

            nm_form_modified();
        }, // _addItem

        _addSubitem: function() {
            var $data = $.scMenuEditorData;

            $data.menu._includeItem("sub");

            $data.menu._updateSubmitValue();
            $data.menu._updateView();

            nm_form_modified();
        }, // _addSubitem

        _importItens: function(itemString) {
            var $data = $.scMenuEditorData,
                itemList, i, itemData, appData;

            if ("" == itemString) {
                return;
            }

            itemList = itemString.split("__NM__");

            for (i = 0; i < itemList.length; i++) {
                itemData = $data.menu._newItem();
                appData  = itemList[i].split("_!NM!_");

                itemData.label = appData[1];
                itemData.link  = "" != appData[0]
                               ? appData[0] + "/" + appData[1]
                               : appData[1];

                $data.importedItem = itemData;
                $data.menu._includeItem("import");

                $("#cb-" + itemData.id).prop("checked", true);
            }

            $data.menu._updateSubmitValue();
            $data.menu._updateView();

            nm_form_modified();
        }, // _importItens

        _includeInitialItems: function() {
            var $data  = $.scMenuEditorData,
                lastId = "",
                itemData, html, i;

            for (i = 0; i < $data.itemList.length; i++) {
                itemData  = $data.itemList[i];

                html = "<li class=\"sc-ui-menu-item\" id=\"" + itemData.id + "\"><input type=\"checkbox\" class=\"sc-ui-menu-item-move\" id=\"cb-" + itemData.id + "\" /> <span id=\"" + itemData.id + "-span\" style=\"padding-left: " + $data.menu._itemLabelPadding(itemData.level) + "\">" + itemData.label + "</span></li>";

                if ("" == lastId) {
                    $("#" + $data.uiName + "itemtree").append(html);
                }
                else {
                    $("#" + lastId).after(html);
                }

                lastId = itemData.id;

                $("#" + itemData.id).bind("click", $data.menu._selectItem);
            }

            $data.menu._updateSubmitValue();
            $data.menu._updateView();
        }, // _includeInitialItems

        _includeItem: function(location) {
            var $data    = $.scMenuEditorData,
                itemId   = $data.uiName + "item" + (++$data.lastItem),
                itemScId = "item_" + $data.lastItem,
                itemData = $data.menu._newItem(),
                itemPos  = 0,
                html, i;

            if ("import" == location) {
                itemData = $data.importedItem;
                location = "item";
            }
            else {
                itemData = $data.menu._newItem();

                itemData.label = "Item " + $data.lastItem;
            }

            itemData.id    = itemId;
            itemData.sc_id = itemScId;

            if ("" == $data.selectedItem) {
                itemPos = $data.itemList.length;

                $data.itemList[itemPos] = itemData;
            }
            else {
                itemPos = $data.selectedIndex + 1;

                if ("sub" == location) {
                    itemData.level = parseInt($data.itemList[ $data.selectedIndex ].level) + 1;
                }
                else {
                    itemData.level = $data.itemList[ $data.selectedIndex ].level;
                    while ($data.itemList[itemPos] && itemData.level < $data.itemList[itemPos].level) {
                        itemPos++;
                    }
                }

                $data.itemList.splice(itemPos, 0, itemData);
            }

            html = "<li class=\"sc-ui-menu-item\" id=\"" + itemId + "\"><input type=\"checkbox\" class=\"sc-ui-menu-item-move\" id=\"cb-" + itemData.id + "\" /> <span id=\"" + itemId + "-span\" style=\"padding-left: " + $data.menu._itemLabelPadding(itemData.level) + "\">" + itemData.label + "</span></li>";

            if (0 == itemPos) {
                $("#" + $data.uiName + "itemtree").append(html);
            }
            else {
                $("#" + $data.itemList[itemPos - 1].id).after(html);
            }

            $("#" + itemId).bind("click", $data.menu._selectItem);

            if ("import" != location) {
                $("#" + itemId).trigger("click");
            }
        }, // _includeItem

        _newItem: function() {
            return {
                label : "",
                level : 0,
                link  : "",
                hint  : "",
                id    : "",
                icon  : "",
                target: "_self",
                sc_id : 0
            };
        }, // _newItem

        _removeItem: function() {
            var $data         = $.scMenuEditorData,
                removeType    = $data.menu._getMoveType(),
                selectedItems = new Array(),
                itemLevel, i;

            if ("checked" == removeType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 == selectedItems.length) {
                return;
            }

            for (i = selectedItems.length - 1; i >= 0; i--) {
                itemLevel = $data.itemList[ selectedItems[i] ].level;

                $("#" + $data.itemList[ selectedItems[i] ].id).remove();
                $data.itemList.splice(selectedItems[i], 1);
            }

            $data.menu._clearForm();
            $data.menu._updateSubmitValue();
            $data.menu._updateView();

            $data.selectedIndex = -1;
            $data.selectedItem = "";

            nm_form_modified();
        }, // _removeItem

        _selectIcon: function() {
            var $data  = $.scMenuEditorData,
                itemId = $(this).attr("id");

            if ("" != $data.selectedIcon) {
                $("#" + $data.selectedIcon).removeClass("sc-ui-selected-icon");
            }

            $data.selectedIcon = itemId;

            $("#" + itemId).addClass("sc-ui-selected-icon");
        }, // _selectIcon

        _selectItem: function() {
            var $data  = $.scMenuEditorData,
                itemId = $(this).attr("id"),
                itemSel, i;

            if ("link-" == itemId.substr(0, 5)) {
                itemId = itemId.substr(5);
            }

            if ("" != $data.selectedItem) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");
            }

            if ($data.selectedItem != itemId) {
                $data.selectedItem = itemId;
                $("#" + itemId).addClass("sc-ui-menu-itemsel");

                for (i = 0; i < $data.itemList.length; i++) {
                    if ($data.selectedItem == $data.itemList[i].id) {
                        $data.selectedIndex = i;
                        itemSel             = $data.itemList[i];

                        break;
                    }
                }

                $("#" + $data.uiName + "ipt-id").html("(" + itemSel.sc_id + ")");
                $("#" + $data.uiName + "ipt-label").val(itemSel.label);
                $("#" + $data.uiName + "ipt-link").val(itemSel.link);
                $("#" + $data.uiName + "ipt-hint").val(itemSel.hint);
                $("#" + $data.uiName + "ipt-icon").val(itemSel.icon);
                $("#" + $data.uiName + "ipt-target").val(itemSel.target);
            }
            else {
                $data.selectedItem  = "";
                $data.selectedIndex = -1;

                $data.menu._clearForm();
            }

            $data.menu._enableForm();
        }, // _selectItem

        _applyTemplate: function() {
            var $data   = $.scMenuEditorData,
                tplName = $("#" + $data.uiName + "ipt-template").val(),
                tplInfo = tplName.split("__NM__");

            $("#sc-js-menu-rel").attr("href", $data.urlThemes[ tplInfo[0] ] + tplInfo[1] + ".css");
            $('input[name="' + $data.fieldTheme + '"]').val(tplName);

            nm_form_modified();
        }, // _applyTemplate

        _updateItem: function() {
            var $data = $.scMenuEditorData,
                i;

            if ("" == $data.selectedItem) {
                return;
            }

            $data.itemList[ $data.selectedIndex ].label  = $("#" + $data.uiName + "ipt-label").val();
            $data.itemList[ $data.selectedIndex ].link   = $("#" + $data.uiName + "ipt-link").val();
            $data.itemList[ $data.selectedIndex ].hint   = $("#" + $data.uiName + "ipt-hint").val();
            $data.itemList[ $data.selectedIndex ].icon   = $("#" + $data.uiName + "ipt-icon").val();
            $data.itemList[ $data.selectedIndex ].target = $("#" + $data.uiName + "ipt-target").val();

            $("#" + $data.selectedItem + "-span").html($data.itemList[ $data.selectedIndex ].label);

            $data.menu._updateSubmitValue();
            $data.menu._updateView();

            nm_form_modified();
        }, // _updateItem

        _updateView: function() {
            var $data     = $.scMenuEditorData,
                html      = "<ul id=\"css3menu1\" class=\"topmenu\">",
                level     = 0,
                itemClass = " topfirst",
                last, i, iconHtml, itemList;

            $("." + $data.uiName + "menu-click").unbind("click");

            if (0 < $data.itemList.length) {
                $("#" + $data.uiName + "preview").show();
                $("#" + $data.uiName + "example").hide();
                itemList = $data.itemList;
            }
            else {
                $("#" + $data.uiName + "preview").hide();
                $("#" + $data.uiName + "example").show();
                itemList = $data.menu._exampleMenu();
            }

            for (i = 0; i < itemList.length; i++) {
                itemList[i].level = parseInt(itemList[i].level);

                if (0 == itemList[i].level) {
                    last = itemList[i].id;
                }
            }

            for (i = 0; i < itemList.length; i++) {
                if (last == itemList[i].id) {
                    itemClass = " toplast";
                }

                htmlClass = "";
                if (0 == itemList[i].level) {
                    htmlClass = " class=\"topmenu" + itemClass;
                    if (itemList[i + 1] && itemList[i].level < itemList[i + 1].level) {
                        htmlClass += " toproot";
                    }
                    htmlClass += "\"";
                }

                html += "<li" + htmlClass + ">";

                if ("" != itemList[i].icon) {                    
                    iconHtml = "<img src=\"" + $data.menu._getIconUrl(itemList[i].icon) + "\" alt=\"" + itemList[i].sc_id + "\" />";
                    iconHtml = "<img src=\"" + $data.menu._getIconUrl(itemList[i].icon) + "\" alt=\"" + itemList[i].sc_id + "\" />";
                }
                else {
                    iconHtml = "";
                }

                if (itemList[i + 1] && itemList[i].level < itemList[i + 1].level) {
                    html += "<a href=\"#\" id=\"link-" + itemList[i].id + "\" class=\"" + $data.uiName + "menu-click\"><span>" + iconHtml + itemList[i].label + "</span></a><ul>";
                }
                else {
                    html += "<a href=\"#\" id=\"link-" + itemList[i].id + "\" class=\"" + $data.uiName + "menu-click\">" + iconHtml + itemList[i].label + "</a>";
                }

                if (itemList[i + 1] && itemList[i].level == itemList[i + 1].level) {
                    html += "</li>";
                }
                else if (itemList[i + 1] && itemList[i].level > itemList[i + 1].level) {
                    html += "</li>" + $data.menu._strRepeat("</ul></li>", itemList[i].level - itemList[i + 1].level);
                }
                else if (!itemList[i + 1] && itemList[i].level > 0) {
                    html += "</li>" + $data.menu._strRepeat("</ul></li>", itemList[i].level);
                }
                else if (!itemList[i + 1] && itemList[i].level == 0) {
                    html += "</li>";
                }

                itemClass = "";
            }

            html += "</ul>";

            $("#" + $data.uiName + "view").html(html);

            $("." + $data.uiName + "menu-click").bind("click", $data.menu._selectItem);
        }, // _updateView

        _enableForm: function() {
            var $data  = $.scMenuEditorData,
                status = "" == $data.selectedItem;

            $("#" + $data.uiName + "ipt-label").prop("disabled", status);
            $("#" + $data.uiName + "ipt-link").prop("disabled", status);
            $("#" + $data.uiName + "ipt-hint").prop("disabled", status);
            $("#" + $data.uiName + "ipt-icon").prop("disabled", status);
            $("#" + $data.uiName + "ipt-target").prop("disabled", status);
        }, // _enableForm

        _exampleMenu: function() {
            var exampleMenu = new Array(
                {
                    label : "Item 1",
                    level : 0,
                    link  : "#",
                    hint  : "Item 1",
                    id    : "item_1",
                    icon  : "",
                    target: "item_1",
                    sc_id : 0
                },
                {
                    label : "Item 2",
                    level : 0,
                    link  : "#",
                    hint  : "Item 2",
                    id    : "item_2",
                    icon  : "",
                    target: "item_2",
                    sc_id : 0
                },
                {
                    label : "Item 4",
                    level : 1,
                    link  : "#",
                    hint  : "Item 4",
                    id    : "item_4",
                    icon  : "",
                    target: "item_4",
                    sc_id : 0
                },
                {
                    label : "Item 5",
                    level : 1,
                    link  : "#",
                    hint  : "Item 5",
                    id    : "item_5",
                    icon  : "",
                    target: "item_5",
                    sc_id : 0
                },
                {
                    label : "Item 7",
                    level : 2,
                    link  : "#",
                    hint  : "Item 7",
                    id    : "item_7",
                    icon  : "",
                    target: "item_7",
                    sc_id : 0
                },
                {
                    label : "Item 8",
                    level : 2,
                    link  : "#",
                    hint  : "Item 8",
                    id    : "item_8",
                    icon  : "",
                    target: "item_8",
                    sc_id : 0
                },
                {
                    label : "Item 6",
                    level : 1,
                    link  : "#",
                    hint  : "Item 6",
                    id    : "item_6",
                    icon  : "",
                    target: "item_6",
                    sc_id : 0
                },
                {
                    label : "Item 3",
                    level : 0,
                    link  : "#",
                    hint  : "Item 3",
                    id    : "item_3",
                    icon  : "",
                    target: "item_3",
                    sc_id : 0
                }
            );

            return exampleMenu;
        }, // _exampleMenu

        _moveUp: function() {
            var $data         = $.scMenuEditorData,
                moveType      = $data.menu._getMoveType(),
                selectedItems = new Array();

            if ("checked" == moveType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 < selectedItems.length) {
                $data.menu._doMoveUp(moveType, selectedItems);
            }
        }, // _moveUp

        _moveDown: function() {
            var $data         = $.scMenuEditorData,
                moveType      = $data.menu._getMoveType(),
                selectedItems = new Array();

            if ("checked" == moveType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 < selectedItems.length) {
                $data.menu._doMoveDown(moveType, selectedItems);
            }
        }, // _moveDown

        _moveLeft: function() {
            var $data         = $.scMenuEditorData,
                moveType      = $data.menu._getMoveType(),
                selectedItems = new Array();

            if ("checked" == moveType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 < selectedItems.length) {
                $data.menu._doMoveLeft(moveType, selectedItems);
            }
        }, // _moveLeft

        _moveRight: function() {
            var $data         = $.scMenuEditorData,
                moveType      = $data.menu._getMoveType(),
                selectedItems = new Array();

            if ("checked" == moveType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 < selectedItems.length) {
                $data.menu._doMoveRight(moveType, selectedItems);
            }
        }, // _moveRight

        _getMoveType: function() {
            return 0 < $(".sc-ui-menu-item-move:checked").length
                   ? "checked" : "selected";
        }, // _getMoveType

        _getMoveItems: function() {
            var $data         = $.scMenuEditorData,
                $checkedItems = $(".sc-ui-menu-item-move:checked"),
                selectedItems = new Array,
                i, j, itemId;

            for (i = 0; i < $checkedItems.length; i++) {
                itemId = $($checkedItems[i]).attr("id").substr(3);

                for (j = 0; j < $data.itemList.length; j++) {
                    if (itemId == $data.itemList[j].id) {
                        selectedItems[ selectedItems.length ] = j;
                        break;
                    }
                }
            }

            return selectedItems;
        }, // _getMoveItems

        _doMoveUp: function(moveType, selectedItems) {
            var $data  = $.scMenuEditorData,
                bMoved = false,
                i, itemTree, itemData, itemId, otherId;

            if ("checkbox" == moveType) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");

                $data.selectedItem  = "";
                $data.selectedIndex = -1;

                $data.menu._clearForm();
                $data.menu._enableForm();
            }

            if (0 < selectedItems[0]) {
                for (i = 0; i < selectedItems.length; i++) {
                    itemData = $data.itemList[ selectedItems[i] ];
                    itemId   = itemData.id;
                    itemTree = $("#" + itemId).detach();
                    otherId  = $data.itemList[ selectedItems[i] - 1 ].id;

                    $("#" + otherId).before(itemTree);

                    $data.itemList.splice(selectedItems[i], 1);
                    $data.itemList.splice(selectedItems[i] - 1, 0, itemData);

                    if ("selected" == moveType) {
                        $data.selectedIndex--;
                    }

                    bMoved = true;
                }
            }

            if (bMoved) {
                $data.menu._updateSubmitValue();
                $data.menu._updateView();

                nm_form_modified();
            }
        }, // _doMoveUp

        _doMoveDown: function(moveType, selectedItems) {
            var $data  = $.scMenuEditorData,
                bMoved = false,
                i, itemTree, itemData, itemId, otherId;

            if ("checkbox" == moveType) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");

                $data.selectedItem  = "";
                $data.selectedIndex = -1;

                $data.menu._clearForm();
                $data.menu._enableForm();
            }

            if ($data.itemList.length - 1 > selectedItems[ selectedItems.length - 1 ]) {
                for (i = selectedItems.length - 1; i >= 0; i--) {
                    itemData = $data.itemList[ selectedItems[i] ];
                    itemId   = itemData.id;
                    itemTree = $("#" + itemId).detach();
                    otherId  = $data.itemList[ selectedItems[i] + 1 ].id;

                    $("#" + otherId).after(itemTree);

                    $data.itemList.splice(selectedItems[i], 1);
                    $data.itemList.splice(selectedItems[i] + 1, 0, itemData);

                    if ("selected" == moveType) {
                        $data.selectedIndex++;
                    }

                    bMoved = true;
                }
            }

            if (bMoved) {
                $data.menu._updateSubmitValue();
                $data.menu._updateView();

                nm_form_modified();
            }
        }, // _doMoveDown

        _doMoveLeft: function(moveType, selectedItems) {
            var $data  = $.scMenuEditorData,
                bMoved = false;

            if ("checkbox" == moveType) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");

                $data.selectedItem  = "";
                $data.selectedIndex = -1;

                $data.menu._clearForm();
                $data.menu._enableForm();
            }

            for (i = selectedItems.length - 1; i >= 0; i--) {
                if ($data.itemList[ selectedItems[i] ].level > 0) {
                    $data.itemList[ selectedItems[i] ].level--;
                    $("#" + $data.itemList[ selectedItems[i] ].id + "-span").css("padding-left", $data.menu._itemLabelPadding($data.itemList[ selectedItems[i] ].level));

                    bMoved = true;
                }
            }

            if (bMoved) {
                $data.menu._updateSubmitValue();
                $data.menu._updateView();

                nm_form_modified();
            }
        }, // _doMoveLeft

        _doMoveRight: function(moveType, selectedItems) {
            var $data  = $.scMenuEditorData,
                bMoved = false;

            if ("checkbox" == moveType) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");

                $data.selectedItem  = "";
                $data.selectedIndex = -1;

                $data.menu._clearForm();
                $data.menu._enableForm();
            }

            for (i = selectedItems.length - 1; i >= 0; i--) {
                if (0 < selectedItems[i] && $data.itemList[ selectedItems[i] ].level <= $data.itemList[ selectedItems[i] - 1 ].level) {
                    $data.itemList[ selectedItems[i] ].level++;
                    $("#" + $data.itemList[ selectedItems[i] ].id + "-span").css("padding-left", $data.menu._itemLabelPadding($data.itemList[ selectedItems[i] ].level));

                    bMoved = true;
                }
            }

            if (bMoved) {
                $data.menu._updateSubmitValue();
                $data.menu._updateView();

                nm_form_modified();
            }
        }, // _doMoveRight

        _checkAll: function() {
            var $data = $.scMenuEditorData;

            $(".sc-ui-menu-item-move").prop("checked", $("#" + $data.uiName + "checkall").prop("checked"));
        }, // _checkAll

        _openIconList: function() {
            var $data = $.scMenuEditorData,
                iconImg, iconSize, iconId;

            $data.menu._loadIcons();

            if ("" != $data.selectedIcon) {
                $("#" + $data.selectedIcon).removeClass("sc-ui-selected-icon");
                $data.selectedIcon = "";
            }

            iconImg = $("#" + $data.uiName + "ipt-icon").val();

            if ("" != iconImg) {
                iconId   = "sc-icon-" + iconImg.substr(0, iconImg.length - 7);
                iconSize = iconImg.substr(0, iconImg.length - 4).substr(iconImg.length - 6);

                $data.selectedIcon = iconId;
                $("#" + $data.selectedIcon).addClass("sc-ui-selected-icon");

                $("#" + $data.uiName + "icon-size").val(iconSize);
            }

            $("#" + $data.uiName + "icons-list").show();
        }, // _openIconList

        _iconOk: function() {
            var $data = $.scMenuEditorData,
                iconImg;

            if ("" == $data.selectedIcon) {
                return;
            }

            iconImg = $data.selectedIcon.substr(8) + "_" + $("#" + $data.uiName + "icon-size").val() + ".png";

            $("#" + $data.uiName + "ipt-icon").val(iconImg);

            $("#" + $data.uiName + "icons-list").hide();

            $data.menu._updateItem();
        }, // _iconOk

        _iconCancel: function() {
            var $data = $.scMenuEditorData;

            $data.selectedIcon = "";

            $("#" + $data.uiName + "icons-list").hide();
        }, // _iconCancel

        _clearForm: function() {
            var $data = $.scMenuEditorData;

            $("#" + $data.uiName + "ipt-id").html("");
            $("#" + $data.uiName + "ipt-label").val("");
            $("#" + $data.uiName + "ipt-link").val("");
            $("#" + $data.uiName + "ipt-hint").val("");
            $("#" + $data.uiName + "ipt-icon").val("");
            $("#" + $data.uiName + "ipt-target").val("");
        }, // _clearForm

        _updateSubmitValue: function() {
            var $data    = $.scMenuEditorData,
                itemList = new Array(),
                itemData = new Array(),
                i;

            for (i = 0; i < $data.itemList.length; i++) {
                itemData[0] = $data.itemList[i].sc_id;
                itemData[1] = $data.itemList[i].label;
                itemData[2] = $data.itemList[i].link;
                itemData[3] = $data.itemList[i].target;
                itemData[4] = $data.itemList[i].icon;
                itemData[5] = $data.itemList[i].hint;
                itemData[6] = parseInt($data.itemList[i].level) + 1;

                itemList[i] = itemData.join("_!NM!_");
            }

            $('input[name="' + $data.field + '"]').val(itemList.join("_@NM@_"));
        }, // _updateSubmitValue

        _getThemeOptions: function(moduleName) {
            var $data = $.scMenuEditorData,
                html  = "",
                themeInfo, i;

            if (!$data.themeList[moduleName] || 1 > $data.themeList[moduleName].length) {
                return html;
            }

            html += "<optgroup label=\"" + $data.langThemes[moduleName] + "\">";
            for (i = 0; i < $data.themeList[moduleName].length; i++) {
                themeInfo = $data.themeList[moduleName][i].split("__NM__");
                html += "<option value=\"" + $data.themeList[moduleName][i] + "\">" + themeInfo[1] + "</option>";
            }
            html += "</optgroup>";

            return html;
        },// _getThemeOptions

        _itemLabelPadding: function(level) {
            return 0 == level ? "0" : (level * 10) + "px";
        }, // _itemLabelPadding

        _treeViewLabel: function(label, level) {
            var $data = $.scMenuEditorData;

            return $data.menu._strRepeat("..", level) + label;
        }, // _treeViewLabel

        _urlExists: function(testUrl) {
            var http = jQuery.ajax({
                type : "HEAD",
                url  : testUrl,
                async: false
            });
            return 404 != http.status;
        }, // _urlExists

        _strRepeat: function(s, n) {
            return new Array(n + 1).join(s);
        } // _strRepeat

    } // scMenuEditor

    $.scMenuEditorData = {
        iconsLoaded     : false,
        itemList        : new Array(),
        importedItem    : {},
        lastItem        : 0,
        selectedItem    : "",
        selectedIndex   : -1,
        selectedIcon    : "",

        iconLink        : "",
        iconIcon1       : "",
        iconIcon2       : "",

        langNewItem     : "New item",
        langNewSub      : "New subitem",
        langRemove      : "Remove item",
        langImport      : "Import applications",
        langUp          : "Move up",
        langDown        : "Move down",
        langLeft        : "Move left",
        langRight       : "Move right",
        langLabel       : "Label",
        langLink        : "Link",
        langHint        : "Hint",
        langIcon        : "Icon",
        langTarget      : "Target",
        langSelf        : "This window",
        langBlank       : "Other window",
        langParent      : "Exit",
        langProperties  : "Properties",
        langTheme       : "Theme",
        langIconList    : "Icon List",
        langIconSize    : "Icon Size",
        langButtonOk    : "Select",
        langButtonCancel: "Cancel",
        langExampleMenu : "Example menu:",
        langPreviewMenu : "Preview:",
        langCheckUncheck: "Check/Uncheck All",
        langIcon1       : "Old icons",
        langIcon2       : "New icons"
    } // scMenuEditorData

}) (jQuery);