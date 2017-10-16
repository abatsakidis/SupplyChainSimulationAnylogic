// Title: COOLjsTree
// URL: http://javascript.cooldev.com/scripts/cooltree/
// Version: 2.8.3
// Last Modify: 12 May 2006
// Notes: Registration needed to use this script on your web site.
// Copyright (c) 2001-2005 by CoolDev.Com
// Copyright (c) 2001-2005 by Sergey Nosenko

// Options: PROFESSIONAL



(function () {

function _isFunction(_value)
{
        return typeof _value == 'function';
}

function _isUndefined(_value)
{
        return typeof _value == 'undefined';
}

function _isNumber(_value)
{
        return typeof _value == 'number';
}

function _isObject(_value)
{
        return typeof _value == 'object';
}

function _LargeString(_initialValue)
{
    this._pieces = [ _isUndefined(_initialValue) ? '' : _initialValue ];
}

_LargeString.prototype =
{
    _prepend:function (_piece) { this._pieces.splice(0, 0, [ _piece ]); return this; },
    _appendString:function (_string) { this._pieces[this._pieces.length] = _string; return this; },
    _appendLargeString:function (_string) { this._pieces = this._pieces.concat(_string._pieces); return this; },
    _compileTemplate:function ()
    {
        var _string = this._getValue(), _result = [], _pos = 0;

        while ((_pos = _string.indexOf('{', _pos)) != -1 && _string.length - _pos > 2)
            if (_string.charAt(_pos + 2) == '}')
            {
                _result[_result.length] = _string.slice(0, _pos);
                _result[_result.length] = parseInt(_string.charAt(_pos + 1));
                _string = _string.slice(_pos + 3);
                _pos = 0;
            }

        return _result.concat([ _string ]);
    },
    _expandTemplate:function (_template, _parameters)
    {
        this._appendString(_template[0]);

        for (var i = 1; i < _template.length; i += 2)
            this._appendString(_parameters[_template[i]])._appendString(_template[i + 1]);

        return this;
    },
    _getValue:function () { return this._pieces.join(''); }
};

function _Tree(_name, _nodes, _format, _static)
{
    this.name = this._name = _name;
    this.bw = new _Tree._BrowserDetector();

    with (_Tree._Node.prototype)

    {
        if (this.bw.gecko)
            _updateDimensions = _updateDimensions_gecko;
        else if (this.bw.ns4)
            _updateDimensions = _updateDimensions_ns4;
        else if (this.bw.operaNew)
            _updateDimensions = _updateDimensions_operaNew;
        else if (this.bw._operaOld)
            _updateDimensions = _updateDimensions_operaOld;
        else
            _updateDimensions = _updateDimensions_default;

        if (this.bw.ns4)
            _moveTo = _moveTo_ns4;
        else
            _moveTo = _moveTo_default;
    }

    var _fmt = {
        _left:_format[0],
        _top:_format[1],
        _show:{ nb:_format[2], nf:_format[5] },
        _buttons:_format[3],
        _blankImage:_format[3][2],
        _buttonWidth:_format[4][0],
        _buttonHeight:_format[4][1],
        _childlessNodesIndent:_format[4][2],
        _folders:_format[6],
        _iconWidth:_format[7][0],
        _iconHeight:_format[7][1],
        _indentation:_format[8],
        _cssClass:_format[10],
        _cssClasses:_format[11],
        _singleBranch:_format[12],
        _padding:_format[13][0],
        _spacing:_format[13][1]

        ,
        exp:_format[14],
        expimg:_format[15],
        expimgsize:_format[16],
        cook:_format[17],
        rel:_format[18],
        rels:_format[19],
        resize:_format[20],
        sel:_format[21],
        selC:_format[22],
        _cssClassForSelectedNode:_format[22] ? _format[22][2] : '',
        _cssClassForOpenedNode:_format[22] ? _format[22][3] : '',
        _wrappingMargin:_format[23] || 0,
        _imageAlignment:_format[24] || 'middle'

    };

    if (_fmt._show.nb)
        _preloadImages(_format[3]);

    if (_fmt._show.nf)
        _preloadImages(_format[6]);

    this._format = _fmt;
    this._selectedNodeIndex = null;

    if (!this.bw._ver3)
        this._back = new _Tree._Back(_format[9], this);
    if (_isUndefined(window.CTrees))
        window.CTrees = [];
    window.CTrees[_name] = this;
    this.jsPath = "window.CTrees['" + _name + "']";
    this.Nodes = this._nodes = [];
    this._lastLocalIndex = -1;
    this._layerIndex = 0;

    this._layersToDetach = {};

    this._backbone = this._prepareNode(([ {id:null}, '', null, null, {format:{}} ]).concat(_nodes));

    this._px = this.bw._operaOld ? '' : 'px';
    this._dynamic = !_static && this.bw.dom && !this.bw._operaOld && !this.bw.ns4;
    this._rtl = document.body && document.body.dir == 'rtl';

    this._redrawAfter = -1;

    this._templates =
    {
        _anchor:'<a onmouseover="' + this._handler('{0}', 'onmouseover', '{1}') + '" href="{2}" target="{3}" id="{4}" class="{5}">{6}</a>',
        _image:'<img src="{0}" name="{1}" id="{1}" width="{2}" height="{3}" border="0"' + (this.bw.ns4 ? '' : ' style="display:block"') + ' />',

        _square:'<td style="font-size:1px{2}" width="{0}" valign="{3}">{1}</td>',

        _nodeContent:'<table{0} cellpadding="' + this._format._padding + '" cellspacing="' + this._format._spacing + '" border="0" class="cls' + this._name + '_back{1}"><tbody><tr>{2}{3}<td{4}><div id="{5}a" style="position:relative;">{6}</div></td></tr></tbody></table>',
        _nodeWrapper:'<div onmouseover=' + this._handler('layer', 'onmouseover', '{0}') + ' id="{1}d"  style="{2}left:-10000px;top:-10000px;position:absolute;{3}">{4}</div>'
    };

    for (var i in this._templates)
        this._templates[i] = new _LargeString(this._templates[i])._compileTemplate();

}

$ = _Tree.prototype;

_Tree._redrawAllTrees = function ()
{
    if (!new _Tree._BrowserDetector().ns4)
        for (var i in window.CTrees)
        {
            window.CTrees[i]._redrawComplete = true;
            window.CTrees[i].draw();
        }
}

$.$handleEvent = function (_prefix, _suffix, _nodeIndex, _object, _event)
{
    var _node = this._nodeByIndex(_nodeIndex), _handler = _prefix + '_' + _suffix;

    if (!_node)
        return false;

    if (!_node._handlersAttached[_prefix])
    {
        this._attachHandlers(_prefix, _object, this, _nodeIndex);
        this._attachHandlers(_prefix, _object, _node._getFormat(), _nodeIndex);
        _node._handlersAttached[_prefix] = true;
    }

    this._executeHandler(_handler, _node._getFormat(), _node, _event);
    return this._executeHandler(_handler, this, _node, _event);
}

$._attachHandlers = function (_prefix, _object, _host, _nodeIndex)
{
    for (var _handler in _host)
        if (_handler.match(new RegExp('^' + _prefix + '_' + '(on.+)$')))
            _object[RegExp.$1] = new Function(this._handler(_prefix, RegExp.$1, _nodeIndex));
}

$._executeHandler = function (_handler, _host, _argument, _event)
{
    return _host[_handler] ? _host[_handler](_argument, _event) : false;
}

$._handler = function (_prefix, _event, _nodeIndex)
{
    return 'return ' + this.jsPath + '.$handleEvent(\'' + _prefix + '\',\'' + _event + '\',' + _nodeIndex + ',this,window.event||arguments[0])';
}

$.getAdditionalColumns = function (_node)
{
    return '';
}

$.getRoot = $._getRoot = function ()
{
    if (!this._root)
    {
        this._backbone._object = this._root = new _Tree._Node(this._backbone, this, null, false);
        this._root._setExpanded(true);
    }

    return this._root;
}

$._findNode = function (_index)
{
    var _path = this._nodePathBy('n', _index, this._backbone._children);

    if (!_path)
        return null;

    var _parent = this._backbone, i = 0;

    for (var i = 0; i < _path.length - 1; i++)
        _parent = _parent._children[_path[i]];

    return [ _parent, _path[i] ];
}

$._stripObjects = function (_node)
{
    if (_node == this._root)
        this._root = null;

    if (_node._object)
    {
        _node._object._detachLayers();
        _node._parentNode = null;
        _node._object = null;
    }

    for (var i in _node._children)
        if (_node._children[i]._object)
            this._stripObjects(_node._children[i]);
}

$._insertNodes = function (_parentIndex, _minorIndex, _definition, _no_children)
{
    var _parent;
	
    if (_parentIndex == this._backbone._index)
        _parent = this._backbone;
    else
    {
        var _pair = this._findNode(_parentIndex);
        if (_pair)
            _parent = _pair[0]._children[_pair[1]];
    }
	
    if (_parent)
    {
        this._stripObjects(_parent);
		
        for (var i in _definition)
        {
            _definition[i] = this._prepareNode(_definition[i], _no_children);
        }   

        
        _minorIndex = Math.max(0, Math.min(_minorIndex, _parent._children.length));
		
        if (_minorIndex == _parent._children.length)
        {
        	
            _parent._children = _parent._children.concat(_definition);
            
        }    
        else
        {
            var _children = _parent._children;
            _parent._children = [];

            
            for (var i in _children)
            {
                if (i == _minorIndex)
                    _parent._children = _parent._children.concat(_definition);
                _parent._children[_parent._children.length] = _children[i];
            }
            
        }
		
        this._redraw();
		
        return _minorIndex;
    }
    else
        return null;
}

$._replaceDefinition = function (_index, _definition, _reuseId, _reuseFormat, _reuseChildren)
{
    if (_index == this._getRoot()._index)
    {
        this._getRoot()._actuallyDetachLayers();
        this._stripObjects(this._getRoot());
        var _definition = this._prepareNode(_definition);
        if (_reuseChildren)
            _definition._children = this._backbone._children;
        this._backbone = _definition;
    }
    else
    {
        var _pair = this._findNode(_index);

        if (_pair)
        {
            var _parent = _pair[0], _children = _parent._children, _index = _pair[1];
            this._stripObjects(_parent);
            var _definition = this._prepareNode(_definition);
            if (_reuseId)
                _definition[0] = _parent._children[_index][0];
            if (_reuseFormat)
                _definition[4] = _parent._children[_index][4];
            if (_reuseChildren)
                _definition._children = _parent._children[_index]._children;
            _definition.i = _definition[0].id;
            _definition.f = _definition[4].format;
            _parent._children[_index] = _definition;
        }
    }
}

$._deleteNode = function (_parent, _index)
{
    if (!_isUndefined(_parent._children[_index]))
    {
        if (_parent._children[_index]._object)
            delete this._nodes[_parent._children[_index]._object._index];
        this._stripObjects(_parent);
        _parent._children.splice(_index, 1);
    }
}

$.getSelectedNode = function ()
{
    return this.nodeByIndex(this._selectedNodeIndex);
}

$._isNodeSelected = function (_node)
{
    return this._selectedNodeIndex === _node._index;
}

$._needAdvancedWrapping = function ()
{
    return this._dynamic && this._format._wrappingMargin && this._format.exp;
}

$._walk_ns4_layers = function (_collection)
{
    for (var i in _collection)
    {
        this._ns4_layers[_collection[i].id] = _collection[i];
        if (_collection[i].layers)
            this._walk_ns4_layers(_collection[i].layers);
    }
}

$._getElement = function (_id)
{
    if (this.bw.ns4)
    {
        if (!this._ns4_layers)
        {
            this._ns4_layers = {};
            this._walk_ns4_layers(document.layers);
        }
        return this._ns4_layers[_id];
    }
    else
        return (document.all && document.all[_id]) || document.getElementById(_id);
}

$.moveTo = function (x, y)
{
    this._back._top = y;
    this._back._left = x;
    this._back._moveTo(x, y);
    this._format._top = y;
    this._format._left = x;
    this.draw();
}

$.ensureVisible = function (_index, _noredraw)
{
    var _node = this.nodeByIndex(_index);
    var _redraw = false;
    while (_node)
    {
        _node = _node._parentNode;

        if (_node._isRoot())
            break;

        if (!_node._isExpanded())
        {
            this.expandNode(_node._index, 1);
            _redraw = true;
        }
    }

    if (_redraw && !_noredraw)
        this.draw();
}

$._nodePathBy = function (_field, _value, _nodes)
{
    for (var i in _nodes)
    {
        switch (typeof(_value))
        {
        case 'string':
        case 'number':
            if (_nodes[i][_field] == _value)
                return [i];
            break;
        default:
            if (('' + _nodes[i][_field]).match(_value))
                return [i];
        }

        var _subPath = this._nodePathBy(_field, _value, _nodes[i]._children);
        if (_subPath)
            return [i].concat(_subPath);
    }

    return null;
}

$._nodeBy = function (_field, _value)
{
    return this._getRoot()._getNodeByPath(this._nodePathBy(_field, _value, this._backbone._children));
}

$.nbn = $.nodeByName = function (_value) { return this._nodeBy('c', _value); }
$.nodeByID = function (_value) { return this._nodeBy('i', _value); }
$.nodeByURL = function (_value) { return this._nodeBy('u', _value); }

$.nodeByIndex = $._nodeByIndex = function (_value)
{
    if (!this._nodes[_value])
        this._nodes[_value] = this._nodeBy('n', _value);
    return this._nodes[_value];
}

$.nodeByXY = function (_X, _Y)
{
    for (var i in this._nodes)
        if (this._nodes[i])
            with (this._nodes[i])
                if (visible && _x <= _X && _y <= _Y && _x + w > _X && _y + h > _Y)
                    return this._nodes[i];
    return null;
}

$._redraw = function (_y)
{
    if (!this._redrawTO)
        this._redrawTO = window.setTimeout(this.jsPath + '.draw()', 1);
    if (typeof(_y) == 'number')
        this._redrawAfter = Math.min(_y, this._redrawAfter);
    else
        this._redrawAfter = -1;
}

$._detachLayers = function (_node)
{
    _node._detachLayers();
}

$._actuallyDetachLayers = function ()
{
    if (this._dynamic)
        for (var _index in this._layersToDetach)
        {
            var _node = this.nodeByIndex(_index);
            if (_node)
                _node._actuallyDetachLayers();
        }

    this._layersToDetach = {};
}

$.draw = function ()
{
    if (this.bw._ver3 || !this._redrawComplete)
        return;

    this._actuallyDetachLayers();
    this._canDetachImmediately = true;

    this._maxHeight = 0;
    this._maxWidth = 0;

    with (this._getRoot())
    {
        draw(true);
        if (this._rtl)
            draw(true);
    }

    if (!this._format.rel || this._format.resize)

        this._back._resize(this._maxWidth, this._maxHeight);

    this._redrawTO = null;
    this._redrawAfter = 10000000;

    if (this.ondraw)
        this.ondraw(this);

    this._canDetachImmediately = false;

    this._saveState();

}

$._saveState = function ()
{
    with (this)
        _setCookie('Selected', _selectedNodeIndex),
        _setCookie('State', _getState());
}

$.expandNode = function (_index, _noRedraw, _selectNode)
{
    if (!this.bw._ver3)
    {
        var _node = this.nodeByIndex(_index);
        if (_selectNode)
            this.selectNode(_index);
        if (_node && _node._isItFolder())
        {
            var _newState = !_node._isExpanded();
            if (this._format._singleBranch)
            {
                this.collapseAll(this._parentNode);
                this.ensureVisible(_node.index, true);
            }
            _node._setExpanded(_newState);
            this._redraw(_node._y);
        }
    }
}

$._selectNode = $.selectNode = function (_index)
{
    this._selectedNodeIndex = parseInt(_index);
    this._redraw();
}

$.__setStateGlobally = function (_state, _node)
{
    for (var i in _node._children)
    {
        this.__setStateGlobally(_state, _node._children[i]);
        if (_node._children[i]._children.length)
            if (_node._children[i]._object)
                _node._children[i]._object._setExpanded(_state);
            else
                _node._children[i][4].format.expanded = _state;
    }
}

$._setStateGlobally = function (_state, _node)
{
    this.__setStateGlobally(_state, _node || this._backbone);
    this._redraw();
}

$.collapseAll = function (_node)
{
    this._setStateGlobally(false, _node && _node._definition);
}

$.expandAll = function (_node)
{
    this._setStateGlobally(true, _node && _node._definition);
}

$._prepareNode = function (_node, _no_children)
{
    if (_isUndefined(_node[_node.length - 1]))
        _node = _node.slice(0, _node.length - 1);

    if (_isUndefined(_node[0].id))
        _node = ([{id:null}]).concat(_node);

    if (_isUndefined(_node[4]) || _isUndefined(_node[4].format))
        _node = _node.slice(0, 4).concat([{format:{}}]).concat(_node.slice(4));

    var _index = this._lastLocalIndex++;
    var _children = _node.slice(5);
    _node = _node.slice(0, 5);
    _node._children = [];

    if (_no_children == null || _no_children == false)
    {
	    for (var i in _children)
	    {   
	        _node._children[i] = this._prepareNode(_children[i]);
	    }
    }    
    _node[4] = _copyObject(_node[4]);
    
    _node.i = _node[0].id;
    _node.c = _node[1]; 
    _node.u = _node[2];
    _node.t = _node[3];
    _node.f = _node[4].format;
    _node.n = _node._index = _index;
    _node._object = null;

    return _node;
}

$.init = function ()
{
    var s = new _LargeString;

    this._getRoot()._getHtml(s, !this._dynamic);

    if (this._format.cook)
    {
        this._selectNode(this._getCookie('Selected'));
        this._setState(this._getCookie('State'));
    }

    if (!this.bw._ver3)
        this._back._init(s);

    if (this.bw.ns4)
        s._prepend('<div id="' + this._name + 'dummytreediv" style="position:absolute;"></div>');

    document.write(s._getValue());

    if (this.bw.ns4)
    {
        this._redrawComplete = true;
        this.draw();
    }

}

$._getCookie = function(_name)
{
    return document.cookie.match(new RegExp('(\\W|^)' + this._name + _name + '=([^;]+)')) ? RegExp.$2 : null;
}

$._setCookie = function (_name, _value)
{
    document.cookie = this._name + _name + '=' + _value + '; path=/';
}

$.__getState = function (_node)
{
    var _result = '';

    for (var i in _node._children)
        if (_node._children[i]._children.length)
            _result += (_node._children[i][4].format.expanded ? 1 : 0) + this.__getState(_node._children[i]);

    return _result;
}

$._getState = function ()
{
    return this.__getState(this._backbone);
}

$.__setState = function (_node, _state, _index)
{
    if (_state)
        for (var i in _node._children)
        {
            if (_node._children[i]._children.length)
            {
                if (_node._children[i]._object)
                    _node._children[i]._object._setExpanded(_state.charAt(_index) == '1');
                else
                    _node._children[i][4].format.expanded = _state.charAt(_index) == '1';
                _index = this.__setState(_node._children[i], _state, _index + 1);
            }
        }

    return _index;
}

$._setState = function (_state)
{
    this.__setState(this._backbone, _state || '', 0);
}

$.layer_onmousedown = function (_node, _event)
{
    _node._active = true;
    _node._updateImages();
    _node._updateVisibility();
    return true;
}

$.layer_onmouseup = $.layer_onclick = function (_node, _event)
{
    _node._active = false;
    _node._updateImages();
    _node._updateVisibility();
    return true;
}

$.layer_onmouseover = function (_node, _event)
{
    _node._hover = true;
    _node._updateImages();
    _node._updateVisibility();
    return true;
}

$.layer_onmouseout = function (_node, _event)
{
    _node._hover = false;
    _node._updateImages();
    _node._updateVisibility();
    return true;
}

$.image_onclick = $.caption_onclick = function (_node, _event)
{
    this.expandNode(_node.index, 1, 1);
    return true;
}

$.button_onclick = function (_node, _event)
{
    this.expandNode(_node.index);
    return true;
}

$.image_onmouseover = $.button_onmouseover = $.caption_onmouseover = function (_node, _event)
{
    window.status = _node.text;
    return true;
}

$.image_onmouseout = $.button_onmouseout = $.caption_onmouseout = function (node, _event)
{
    window.status = window.defaultStatus;
    return true;
}

_Tree._Node = function (_definition, _tree, _parent, _hasNext)
{
    var _index = _definition._index;
    this._definition = _definition;
    this._index = this.index = _index;
    this.jsPath = _tree.jsPath + '.nodeByIndex(' + _index + ')';
    this.treeView = this._tree = _tree;
    this._parentNode = this.parentNode = _parent;
    this._hasNext = _hasNext;
    this.text = _definition[1];
    this.url = _definition[2];
    this.target = _definition[3];
    this._layerOwner = null;
    this._handlersAttached = {};

    this.nodeID = _definition[0].id;
    this._format = _definition[4].format;

    this._previousExpanded = null;
    this._setExpanded(this._definition[4].format.expanded);
    this.children = this._children = [];
    this._level = this.level = _parent ? _parent._level + 1 : -1;
    this.visible = false;
    this._layers = {};
    this._exceeds = false;
    this._imagesToUpdate = {};

    if (_parent)
        this._initImages();
}

$ = _Tree._Node.prototype;

$._isRoot = function ()
{
    return this._tree._backbone._index == this._index;
}

$._isExpanded = function ()
{
    return this._definition[4].format.expanded;
}

$.id = function ()
{
    return this._id;
}

$._setProperties = function (_caption, _url, _target)
{
    this._tree._replaceDefinition(this._index, [ _isUndefined(_caption) ? this._getCaption() : _caption, _isUndefined(_url) ? this._getUrl() : _url, _isUndefined(_target) ? this._getTarget() : _target ], true, true, true);
    this._tree._redraw();
}

                $.getTree = function () { return this._tree; }
                $.getParent = function () { return this._parentNode; }

                $.getId = function () { return this._definition[0].id; }
$._getCaption = $.getCaption = function () { return this._definition[1]; }
$._getUrl = $.getUrl = function () { return this._definition[2]; }
$._getTarget = $.getTarget = function () { return this._definition[3]; }
$._getFormat = $.getFormat = function () { return this._definition[4].format; }

                $.setCaption = function (_value) { this._setProperties(_value, this._undefined, this._undefined); }
                $.setUrl = function (_value) { this._setProperties(this._undefined, _value, this._undefined); }
                $.setTarget = function (_value) { this._setProperties(this._undefined, this._undefined, _value); }

$.hasChildren = $._hasChildren = function ()
{
    return !!this._definition._children.length;
}

$._isItFolder = function ()
{
    return this._hasChildren() || this._definition[4].format.isFolder;
}

$._getNodeByPath = function (_path)
{
    if (_path)
        return _path.length ? this._getChild(_path[0])._getNodeByPath(_path.slice(1)) : this;

    return null;
}

$._setExpanded = function (_value)
{
    this.expanded = this._definition[4].format.expanded = !!_value;
    this._updateImages();
}

$._getButtonImage = function ()
{
    if (this._tree._format._show.nb && !this._format.nobuttons && this._hasChildren())

        if (this._tree._format.exp)
            return this._selectImage(this._tree._format.expimg, this._format.eimages, this._isExpanded() ? (this._hasNext ? 3 : 4) : (this._hasNext ? 5 : 6));
        else

            return this._selectImage(this._tree._format._buttons, this._format.buttons, this._isExpanded() ? 1 : 0);

    return null;
}

$._getIconImage = function ()
{
    if (this._tree._format._show.nf && !this._format.nofolders)
    {
        var _index = this._isItFolder() ? (this._isExpanded() ? 1 : 0) : 2;

        if (this._tree._format.exp)
            return this._selectImage(this._tree._format.expimg, this._format.eimages, _index);
        else

            return this._selectImage(this._tree._format._folders, this._format.folders, _index);
    }

    return null;
}

$._selectImage = function (_array1, _array2, _index)
{
    var _src = (_array2 && _array2[_index]) || (_array1 && _array1[_index]) || this._tree._format._blankImage;

    if (typeof _src != 'string' && _src[0])
    {
        if (this._active && this._hover && _src[2])
            _src = _src[2];
        else if (this._hover && _src[1])
            _src = _src[1];
        else
            _src = _src[0];
    }

    return _src;
}

$._updateImages = function ()
{
    if (this._layersAttached)
    {
        this._updateImage('nb', this._getButtonImage());
        this._updateImage('nf', this._getIconImage());
    }
}

$._updateImage = function (_suffix, _src)
{
    if (_src)
    {
        var _img = (this._getLayer().document || document).images[this._id + _suffix];

        if ((this._tree._format._show[_suffix] || this._tree._format.exp) && _img && _img.src != _src)

            this._imagesToUpdate[_suffix] = { _image:_img, _path:_src };
    }
}

$._initImages = function ()
{

    if (this._tree._format.exp)
    {
        var esz = this._tree._format.expimgsize;
        this.wimg = this._iconWidth = this._buttonWidth = esz[0];
        this.himg = this._iconHeight = this._buttonHeight = esz[1];
    }
    else
    {

        this._buttonWidth = _isUndefined(this._format.bsize) ? this._tree._format._buttonWidth : this._format.bsize[0];
        this._buttonHeight = _isUndefined(this._format.bsize) ? this._tree._format._buttonHeight : this._format.bsize[1];
        this._iconWidth = _isUndefined(this._format.fsize) ? this._tree._format._iconWidth : this._format.fsize[0];
        this._iconHeight = _isUndefined(this._format.fsize) ? this._tree._format._iconHeight : this._format.fsize[1];

    }

}

$._getHtml = function (_string, _recursive)
{
    this._id = 'nt' + this._tree._name + '_' + this._tree._layerIndex++;

    if (!this._isRoot())
        if (this._tree.bw._ver3)
            _string._appendString(this._getContent());
        else
            _string._expandTemplate(this._tree._templates._nodeWrapper, [ this._index, this._id, this._tree.bw.mac || this._tree.bw._operaOld ? '' : 'height:1px;width:1px;', this._tree._dynamic ? '' : 'visibility:hidden;', this._getContent() ]);

    if (_recursive)
        this._getHtmlForChildren(_string, _recursive);

    return _string;
}

$._getHtmlForChildren = function (_string, _recursive)
{
    for (var i = 0; i < this._getNumberOfChildren(); i++)
        this._getChild(i)._getHtml(_string, _recursive);

    return _string;
}

$._generateAnchorTag = function (_url, _prefix, _content, _cssClass, _needId)
{
    return new _LargeString()._expandTemplate(this._tree._templates._anchor, [ _prefix, this._index, _url || 'javascript:void(0)', _url && this.target || '', _needId && (this._id + 'an') || '', _cssClass || '', _content ])._getValue();
}

$._generateImageTag = function (_imgSrc, _name, _width, _height)
{
    return new _LargeString()._expandTemplate(this._tree._templates._image, arguments)._getValue();
}

$._square = function (_prefix, _suffix, _imgSrc, _needAnchor, _needUrl, w, h, _background)
{
    if (!w || !_imgSrc)
        return '';

    var _imageTag = this._generateImageTag(_imgSrc, _suffix && this._id + _suffix || '', w, h);

    return new _LargeString()._expandTemplate(
        this._tree._templates._square,
        [
            w,
            _needAnchor ? this._generateAnchorTag(_needUrl && this.url, _prefix, _imageTag) : _imageTag

            ,
            _background ? ';background-image:url(' + _background + ')' : '',
            this._tree._format.exp ? 'top' : this._tree._format._imageAlignment

        ]
    )._getValue();
}

$._lineSquares = function ()
{
    return this._level >= 0 ? this._parentNode._lineSquares() + this._square('', '', this._tree._format._blankImage, false, false, this._tree._format.expimgsize[0], this._tree._format.expimgsize[1], this._hasNext && this._tree._format.expimg[7]) : '';
}

$._getIndent = function ()
{
    with (this._tree._format)
        return _isUndefined(_indentation[this._level]) ? _indentation[0] * this._level : _indentation[this._level];
}

$._getContent = function ()
{
    this._lastCssClass = this._getCssClass();

    var _arguments =
    [

        this._tree._format._wrappingMargin ? ' width="' + this._tree._format._wrappingMargin + '"' : '',

        this._level,

        this._tree._format.exp ?
            this._parentNode._lineSquares() + (this._hasChildren() ? '' : this._square('', '', (this._hasNext ? this._tree._format.expimg[8] : this._tree._format.expimg[9]), false, false, this._tree._format.expimgsize[0], this._tree._format.expimgsize[1], this._hasNext && this._tree._format.exp && this._tree._format.expimg[7]))
        :

            this._square('', '', this._tree._format._blankImage, false, false, this._getIndent() + (this._hasChildren() ? 0 : this._tree._format._childlessNodesIndent), 1),
        this._square(
            'button',
            'nb',
            this._getButtonImage(),
            true,
            false,
            this._buttonWidth,
            this._buttonHeight,

            this._hasNext && this._tree._format.exp && this._tree._format.expimg[7]

        )
        +
        this._square(
            'image',
            'nf',
            this._getIconImage(),
            true,
            true,
            this._iconWidth,
            this._iconHeight,

            this._isExpanded() && this._hasChildren() && this._tree._format.exp && this._tree._format.expimg[7]

        ),

        this._tree._format._wrappingMargin ? '' : ' nowrap="nowrap"',

        this._id,
        this._generateAnchorTag(this.url, 'caption', this.text, this._lastCssClass, true)
    ];

    return new _LargeString()._expandTemplate(this._tree._templates._nodeContent, _arguments)._getValue();
}

$._getCssClass = function ()
{
    var _result;

    if (this._tree._format.sel)
        if (this._isSelected())
            _result = this._tree._format._cssClassForSelectedNode;
        else if (this._hasChildren() && this._isExpanded())
            _result = this._tree._format._cssClassForOpenedNode;

    if (!_result)

        with (this._tree._format)
            _result = _cssClasses[this._level] || _cssClass;

    if (typeof(_result) != 'string')
        _result = _result[this._level];

    return _result || '';
}

$._getBackgroundColor = function ()
{
    return this._tree._format.sel ? this._tree._format.selC[this._isSelected() ? 1 : 0] : '';
}

$._moveTo_ns4 = function (_x, _y)
{
    if (this._x != _x || this._y != _y)
    {
        this._x = _x;
        this._y = _y;

        with (this._getLayer())
            moveTo(_x, _y);
    }
}

$._moveTo_default = function (_x, _y)
{
    if (this._x != _x || this._y != _y)
    {
        this._x = _x;
        this._y = _y;

        with (this._getLayer().style)
        {
            left = _x + this._tree._px;
            top = _y + this._tree._px;
        }
    }
}

$._moveTo = null;

$._getLayerForChildren = function ()
{
    return this._layerForChildren || (this._layerForChildren = this._tree._dynamic ? this._tree._back._createChildLayer(this._getHtmlForChildren(new _LargeString)._getValue()) : this._getLayer('ch'));
}

function _destroy(_layer)
{
    _layer.parentNode.removeChild(_layer);
}

$._destroyLayerForChildren = function ()
{
    if (this._layerForChildren)
    {
        var _tmp = this._layerForChildren;
        this._layerForChildren = null;

        for (var i in this._definition._children)
            with (this._definition._children[i])
                if (_object)
                    _object._actuallyDetachLayers();

        _destroy(_tmp);
    }
}

$._detachLayers = function ()
{
    if (this._tree._canDetachImmediately)
        this._actuallyDetachLayers();
    else
    {
        this._tree._layersToDetach[this._index] = true;
        this._tree._redraw();
    }
}

$._recreate = function ()
{
    this._getLayer().innerHTML = this._getContent();
    this._handlersAttached = {};
}

$._actuallyDetachLayers = function ()
{
    if (this._layersAttached)
    {
        for (var i in this._layers)
        {
            _destroy(this._layers[i]);
            this._layers[i] = null;
        }

        this._layers = {};

        this.w = this.h = 0;
        this._x = this._y = -1;

        this._layersAttached = false;
    }

    this._handlersAttached = {};

    this._destroyLayerForChildren();

    if (!this._isRoot())
        this._parentNode._destroyLayerForChildren();
}

$._setVisibility = function (_layer, _value)
{
    if (this._tree.bw.ns4)
        _layer.visibility = _value ? 'show' : 'hide';
    else
        _layer.style.visibility = _value ? 'visible' : 'hidden';
}

$._updateVisibility = function ()
{
    if (!this._tree._dynamic)
        this._setVisibility(this._getLayer(), this.visible);

    if (this.visible)
    {
        for (var i in this._imagesToUpdate)
            with (this._imagesToUpdate[i])
                _image.src = _path;

        this._imagesToUpdate = {};
    }
}

$._updatePosition = function ()
{
    if (!this.visible)
        this._moveTo(-10000, -10000);
    else
        this._moveTo(this._tree._rtl ? (this._tree.bw.gecko ? this._tree._maxWidth : 0) - this.w : 0, this._tree._currTop);
}

$._updateStyle = function ()
{
    if (this._tree._format.sel)
    {
        if (this._isSelected() == !this._lastSelected)
        {
            var _backgroundColor = this._getBackgroundColor();

            with (this._getLayer('a'))
                if (this._tree.bw.ns4)
                    bgColor = _backgroundColor;
                else
                    style.backgroundColor = _backgroundColor;

            this._lastSelected = this._isSelected();
        }

        if (this._tree.bw.dom)
        {
            if (_isUndefined(this._originalClassName))
                this._lastCssClass = this._originalClassName = this._tree._getElement(this._id + 'an').className;

            var _cssClass = this._getCssClass();

            if (_cssClass != this._lastCssClass)
            {
                this._getLayer('an').className = this._lastCssClass = _cssClass;
                this.h = 0;
            }
        }
    }
}

$._updateDimensions_gecko = function (_force)
{
    if (!this.h || _force)
    {
        with (this._getLayer().childNodes[0])
        {
            this.w = offsetWidth;
            this.h = offsetHeight;
        }

        if (this._tree._needAdvancedWrapping())
            this._exceeds = this._tree._format.exp && this.h > this._tree._format.expimgsize[1];

    }
}

$._updateDimensions_ns4 = function (_force)
{
    if (!this.h || _force)
    {
        with (this._getLayer())
        {
            this.w = clip.width;
            this.h = clip.height;
        }

        if (this._tree._needAdvancedWrapping())
            this._exceeds = this._tree._format.exp && this.h > this._tree._format.expimgsize[1];

    }
}

$._updateDimensions_operaNew = function (_force)
{
    if (!this.h || _force)
    {
        with (this._getLayer().childNodes[0])
        {
            this.w = offsetWidth;
            this.h = offsetHeight;
        }

        if (this._tree._needAdvancedWrapping())
            this._exceeds = this._tree._format.exp && this.h > this._tree._format.expimgsize[1];

    }
}

$._updateDimensions_operaOld = function (_force)
{
    if (!this.h || _force)
    {
        with (this._getLayer())
        {
            this.w = style.pixelWidth;
            this.h = style.pixelHeight;
        }

        if (this._tree._needAdvancedWrapping())
            this._exceeds = this._tree._format.exp && this.h > this._tree._format.expimgsize[1];

    }
}

$._updateDimensions_default = function (_force)
{
    if (!this.h || _force)
    {
        with (this._getLayer())
        {
            this.w = scrollWidth || offsetWidth;
            this.h = scrollHeight || offsetHeight;
        }

        if (this._tree._needAdvancedWrapping())
            this._exceeds = this._tree._format.exp && this.h > this._tree._format.expimgsize[1];

    }
}

$._updateDimensions = function () { }

$.draw = function (_visible)
{
    var _visibilityChanged = this.visible != _visible;
    var _wasAttached = this._layersAttached;
    var _wasExceeding = this._exceeds;

    if (this._isRoot())
    {
        this._tree._currTop = 0;
        this.visible = _visible;
    }
    else if (this._y < this._tree._redrawAfter)
    {
        this._tree._currTop = this._y + this.h;
        this._tree._maxWidth = this._maxWidth;
        this._tree._maxHeight = this._maxHeight;
    }
    else if (this.visible || _visible)
    {
        this._tree._redrawAfter = -1;
        this.visible = _visible;
        this._updateVisibility();

        if (this.visible)
        {

            if (_wasAttached || this._isSelected())
                this._updateStyle();

            this._updateDimensions();
            this._updatePosition();

            if ( this._exceeds && this._previousExpanded != this._isExpanded() && _wasAttached)
            {
                this._recreate();
                this._updateDimensions();
                this._updatePosition();
                this._updateVisibility();
            }

            this._tree._maxWidth = Math.max(this.w, this._tree._maxWidth);
            this._tree._currTop += this.h;
            this._tree._maxHeight = Math.max(this._tree._currTop, this._tree._maxHeight);

            this._maxWidth = this._tree._maxWidth;
            this._maxHeight = this._tree._maxHeight;
        }
    }

    if (
        (this.visible && (this._previousExpanded || this._isExpanded()))
        || (!this.visible && _visibilityChanged && this._previousExpanded)
    )
        this._drawChildren(this._isExpanded() && this.visible);

    if (this._tree._dynamic && this._hasChildren() && (this._layerForChildren || (this._isExpanded() && this.visible)))
        this._setVisibility(this._getLayerForChildren(), this._isExpanded() && this.visible);

    this._previousExpanded = this._isExpanded();
}

$._drawChildren = function (_visible)
{
    for (var i = 0; i < this._getNumberOfChildren(); i++)
        this._getChild(i).draw(_visible);
}

$._isSelected = function ()
{
    return this._tree._isNodeSelected(this);
}

$.getNumberOfChildren = $._getNumberOfChildren = function ()
{
    return this._definition._children.length;
}

$.getChild = $._getChild = function (_minorIndex)
{
    with (this._definition._children[_minorIndex])
    {
        if (!_object)
        {
            var _raw = this._definition._children[_minorIndex];
            _object = this._tree._nodes[_raw._index] = new _Tree._Node(_raw, this._tree, this, _minorIndex < this._getNumberOfChildren() - 1);
        }

        return _object;
    }
}

$.getMinorIndex =

$._getMinorIndex = function ()
{
    var _result = 0;

    while (_result < this._parentNode._definition._children.length)
        if (this._parentNode._definition._children[_result]._index == this._index)
            return _result;
        else
            _result++;

    return null;
}

$.addNode = function (_minorIndex, _raw, _no_children)
{
    return this._tree._insertNodes(this._index, _minorIndex, [ _raw ], _no_children);
}

$.recreate = function (_raw, _reuseChildren)
{
    this._tree._replaceDefinition(this._index, _raw, false, false, _reuseChildren);
    this._tree._redraw();
}

$.deleteNode = function (_index)
{
    this._tree._deleteNode(this._definition, _index);
}

$.getLayer = $._getLayer = function (_suffix)
{
    if (!_suffix)
        _suffix = 'd';

    if (!this._layers[_suffix])
    {
        if (!this._layersAttached)
        {
            if (this._parentNode)
                this._parentNode._getLayerForChildren();
            this._layersAttached = true;
            this._layers = {};
        }

        this._layers[_suffix] = this._tree._getElement(this._id + _suffix);
    }

    return this._layers[_suffix];
}

_Tree._Back = function (_color, _tree)
{
    this._tree = _tree;
    this._left = _tree._format._left;
    this._top = _tree._format._top;
    this._name = 'cls' + _tree._name + '_back';
    this.color = _color;
}

$ = _Tree._Back.prototype;

$._getLayer = function (_suffix)
{
    return this._tree._getElement(this._name + (_suffix || ''));
}

$._createChildLayer = function (_html)
{
    var _result = document.createElement('div');

    with (_result)
    {
        style.position = 'absolute';
        style.top = style.left = 0;
        innerHTML = _html;
    }

    this._getLayer().appendChild(_result);

    return _result;
}

$._resize = function (_width, _height)
{
    if (this._tree.bw._operaOld && !this._first)
        this._first = true;
    else
    {

        with (this._getLayer())
            if (this._tree.bw.ns4)
                resizeTo(_width, _height);
            else
            {
                style.width = _width + this._tree._px;
                style.height = _height + this._tree._px;
            }
    }
}

$._moveTo = function (_left, _top)
{
    with (this._getLayer())
        if (this._tree.bw.ns4)
            moveTo(_left, _top);
        else
        {
            style.left = _left + this._tree._px;
            style.top = _top + this._tree._px;
        }
}

$._init = function (_string)
{
    var p = 'relative', w = 1, h = 1;

    if (this._tree._format.rel)
    {
        w = this._tree._format.rels[0];
        h = this._tree._format.rels[1];
    }
    else

        p = 'absolute';

    return _string._prepend(
        '<div style="overflow:'
        + (this._tree._operaOld ? 'scroll' : 'hidden') + ';'
        + (this.color == "" ? "" : (this._tree.bw.ns4 ? 'layer-' : '')
        + 'background-color:' + this.color + ";")
        + 'position:' + p + ';top:' + this._top + 'px;left:' + this._left
        + 'px;width:' + w + 'px;height:' + h + 'px;z-index:0;" id="'
        + this._name + '">'
        + (
            this._tree.bw.ns4
            ? '<img src="' + this._tree._format._blankImage
            + '" width="' + w + '" height="' + h + '" />'
            : ''
        )

    )._appendString('</div>');
}

_Tree._BrowserDetector = function ()
{
    var _is_major = parseInt(navigator.appVersion);

    this.ver = navigator.appVersion;
    this.agent = navigator.userAgent;
    this.dom = document.getElementById ? 1 : 0;
    this.opera = window.opera ? 1 : 0;
    this.ie5 = this.ver.match(/MSIE 5/) && this.dom && !this.opera;
    this.ie6 = this.ver.match(/MSIE 6/) && this.dom && !this.opera;
    this.ie4 = document.all && !this.dom && !this.opera;
    this.ie = this.ie4 || this.ie5 || this.ie6;
    this.mac = this.agent.match(/Mac/);

    this.ie3 = this.ver.match(/MSIE/) && _is_major < 4;
    this.hotjava = this.agent.match(/hotjava/i);
    this.ns4 = document.layers && !this.dom && !this.hotjava;

    this._ver3 = this.hotjava || this.ie3;
    this.operaNew = this.agent.match(/opera.[789]/i);
    this.gecko = this.agent.match(/gecko/i);
    this.oldGecko = this.agent.match(/gecko\/2002/i);
    this._operaOld = this.opera && !this.operaNew;
}

function _preloadImages(_list)
{
    for (var i in _list)
        (new Image()).src = _list[i];
}

_Tree._oldCTOnLoad = window.onload;
_Tree._oldCTOnUnLoad = window.onunload;

window.onload = function ()
{
    _Tree._redrawAllTrees();
    return !_isFunction(_Tree._oldCTOnLoad) || _Tree._oldCTOnLoad();
}

window.onunload = function ()
{
    for (var i in window.CTrees)
        with (window.CTrees[i])
            if (_format.cook)
                _saveState();

    return !_isFunction(_Tree._oldCTOnUnLoad) || _Tree._oldCTOnUnLoad();
}

function _copyObject (o)
{
    var r = {};

    for (var i in o)
        r[i] = typeof(o[i]) == 'object' && o[i] !== null ? _copyObject(o[i]) : o[i];

    return r;
}

window.COOLjsTreePRO = _Tree;

window.RedrawAllTrees = function ()
{
    _Tree._redrawAllTrees();
}

})();

