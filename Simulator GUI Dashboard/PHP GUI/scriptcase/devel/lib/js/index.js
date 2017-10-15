//CODIGO DO GOJS - DESCONTINUADO
var diagrama;
var pallete;
var GoJs = (function () {
    function GoJs() {
        this.$ = go.GraphObject.make;
    }
    return GoJs;
})();

var createDiagram = (function () {
    function createDiagram(id, idPal) {
        this.id = id;
        if (idPal) {
            this.pallete = new createPallete(idPal);
        }
    };
    createDiagram.prototype = new GoJs();
    createDiagram.prototype.modulo = function () {
        return this.$;
    }
    createDiagram.prototype.getModo = function () {
        var info = {
            layout: {
                initialAutoScale: go.Diagram.Uniform,
                initialContentAlignment: go.Spot.Center, // Center Diagram contents
                "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
                "undoManager.isEnabled": true,
                allowHorizontalScroll: true,
                allowVerticalScroll: true,
                allowZoom: true,
                layout: {
                    type: go.LayeredDigraphLayout,
                    options: [
                                { key: "type", value: go.LayeredDigraphLayout },
                                { key: "direction", value: 90 },
                                { key: "columnSpacing", value: 10 },
                                { key: "layerSpacing", value: 30 },
                                { key: "layeringOption", value: go.LayeredDigraphLayout.LayerLongestPathSource },
                                { key: "aggressiveOption", value: go.LayeredDigraphLayout.AggressiveMore },
                                { key: "initializeOption", value: go.LayeredDigraphLayout.InitNaive }
                    ]
                }
            },
            nodes: {
                type: go.Panel.Auto,
                bind: "color",
                shapes: {
                    figure: "RoundedRectangle",
                    fill: "blue",
                    stroke: "black",
                    strokeWidth: 2,
                    bind: [
                        { key: "fill", value: "color" }
                    ]
                },
                text: {
                    margin: 3,
                    stroke: "white",
                    strokeWidth: 5,
                    bind: [
                            { key: "text", value: "name" }
                    ]
                }
            },
            links: {
                shapes: { toArrow: "Standard" },
                text: {
                    textAlign: "center",
                    width: 80,
                    alignment: go.Spot.Center,
                    bind: [
                        { key: "segmentIndex", value: "parte" },
                        { key: "segmentFraction", value: "loc" },
                        { key: "text", value: "text" }
                    ]
                }
            },
            pallete: {
                layout: {
                    value: "TreeLayout"
                },
                nodes: {
                    type: "Panel",
                    format: "Auto",
                    fill: "color",
                    shapes: {
                        figure: "RoundedRectangle",
                        fill: "blue",
                        stroke: "white",
                        bind: [
                            { key: "fill", value: "color" }
                        ]
                    },
                    text: {
                        margin: 10,
                        stroke: "white",
                        bind: [
                                { key: "text", value: "category" }
                        ]
                    }
                },
                eventos: [
                            { evento: "click", functionName: "rodar", elemento: "node"}
                        ]
            }
        };
        return info;
    };
    createDiagram.prototype.setar = function (info) {
        var $ = this.$;
        if (info.layout) {
            //var novoLay = this.montarLay(info.layout);
            dia = new go.Diagram("myDiagram");
            var keysLayout = Object.keys(info.layout);
            keysLayout.map(function (chave, i) {
                if (chave == "layout") {
                    dia.layout = new info.layout[chave].type;
                    lays = info.layout[chave].options;
                    lays.map(function (ch, x) {
                         dia.layout[ch.key] = ch.value;
                    });
                }
                else {
                    if (chave.indexOf(".") != -1) {
                        var partes = chave.split(".");
                        dia[partes[0]][partes[1]] = info.layout[chave];
                    
                    }
                    else {
                        dia[chave] = info.layout[chave];
                    }
                }
            });
            this.diagram = dia;
            /*,{
                /*initialAutoScale: go.Diagram.Uniform,
                initialContentAlignment: go.Spot.Center, // Center Diagram contents
                "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
                "undoManager.isEnabled": true,
                allowHorizontalScroll: true,
                allowVerticalScroll: true,
                allowZoom: true,
                layout: $(go.LayeredDigraphLayout, {
                    direction: 90,
                    columnSpacing: 20,
                    layerSpacing: 90,
                    layeringOption: go.LayeredDigraphLayout.LayerLongestPathSource,
                    aggressiveOption: go.LayeredDigraphLayout.AggressiveMore,
                    initializeOption: go.LayeredDigraphLayout.InitNaive
                })
            });*/
        }
        if (info.nodes) {
            var nodes = info.nodes;
            var node = new go.Node(nodes.type);
            var nodeShape = new go.Shape();
            var keysShape = Object.keys(nodes.shapes);
            keysShape.map(function (info, i) {
                if (info == "bind") {
                    var bindings = nodes.shapes[info];
                    bindings.map(function (bin, i) {
                        nodeShape.bind(new go.Binding(bin.key, bin.value));
                    });
                }
                else {
                    nodeShape[info] = nodes.shapes[info];
                }
            });
            var text = new go.TextBlock();
            var keysText = Object.keys(nodes.text);
            keysText.map(function (info, i) {
                if (info == "bind") {
                    var bindings = nodes.text[info];
                    bindings.map(function (bin, i) {
                        text.bind(new go.Binding(bin.key, bin.value));
                    });
                }
                else {
                    text[info] = nodes.text[info];
                }
            });
            node.add(nodeShape);
            node.add(text);
            this.diagram.nodeTemplate = node;
        }
        if(info.eventos){
            var even = info.eventos;
            var evento = new eventos(even, node);
            evento.montar();

        }
        if (info.links) {
            var links = info.links;
            var shape = new go.Shape();
            var link = new go.Link();
            var linkShape = new go.Shape();
            var KeysLink = Object.keys(links.shapes);
            KeysLink.map(function (info, i) {
                if (info == "bind") {
                    var bindindg = links.shapes[info];
                    bindindg.map(function (bin, x) {
                        linkShape.bind(new go.Binding(bin.key, bin.value));
                    });
                }
                else{
                    linkShape[info] =   links.shapes[info];
                }
            });
            var linkText = new go.TextBlock();
            keysText = Object.keys(links.text);
            keysText.map(function (info, i) {
                if (info == "bind") {
                    var binding = links.text[info];
                    binding.map(function (bin, x) {
                        linkText.bind(new go.Binding(bin.key, bin.value));
                    });
                }
                else {
                    linkText[info] = links.text[info];
                }
            });
            link.add(shape);
            link.add(linkShape);
            link.add(linkText);
            this.diagram.linkTemplate = link;
        }
        if(this.pallete)
        {
            this.pallete.setar(info.pallete);
        }
    };
    createDiagram.prototype.gerar = function (nodes, links) {
        var pals = [];
        var anterior = [];
        nodes.map(function (info, i) {
            if(anterior.indexOf(info.category) == -1)
            {
                pals.push(info);
            }
            anterior.push(info.category);
        });
        var newPallete = this.pallete.montar(pals);
        this.diagram.model = new go.GraphLinksModel(nodes, links);
        diagrama = this.diagram;
        pallete = newPallete;
    };
    /*createDiagram.prototype.montarLay = function (info) {
        var diagram = this.diagram;
        var keys = Object.keys(info);
        var obj = new Object();
        keys.map(function (chave, i) {
            if (chave != "layout") {
                obj[chave] = info[chave];
            }
            else if(chave == "layout"){
                
            }
        });
    };*/

    return createDiagram;
})();
var createPallete = (function () {
    function createPallete(id) {
        this.pallete = this.$(go.Palette, "myPallete", {
            initialContentAlignment: go.Spot.RightSide
        });
    }
    createPallete.prototype = new GoJs();
    createPallete.prototype.setar = function (info) {
        var nodes = info.nodes;
        if (info.layout) {
            this.pallete.layout = new go[info.layout.value];
        }
        if (info.nodes)
         {
            var node = new go.Node(go[nodes.type][nodes.format]);
            node.fill = nodes.fill;
            var palShape = new go.Shape();
            palShape.minSize = new go.Size(100, 0);
            var keysShape = Object.keys(nodes.shapes);
            keysShape.map(function (info, i) {
                if (info == "bind") {
                    var bindings = nodes.shapes[info];
                    bindings.map(function (bin, i) {
                        palShape.bind(new go.Binding(bin.key, bin.value));
                    });
                }
                else {
                    palShape[info] = nodes.shapes[info];
                }
            });
            var text = new go.TextBlock();
            var keysText = Object.keys(nodes.text);
            keysText.map(function (info, i) {
                if (info == "bind") {
                    var bindings = nodes.text[info];
                    bindings.map(function (bin, i) {
                        text.bind(new go.Binding(bin.key, bin.value));
                    });
                }
                else {
                    text[info] = nodes.text[info];
                }
            });
            node.add(palShape);
            node.add(text);
            this.pallete.nodeTemplate = node;
        }
        if(info.eventos){
            var even = info.eventos;
            var evento = new eventos(even, node);
            evento.montar();
        }
    };
    createPallete.prototype.montar = function (info) {
        this.pallete.model = new go.GraphLinksModel(info);
        return this.pallete;
    };
    
    return createPallete;
})();
var manipularDiagram = (function(){
    function manipularDiagram(){

    }
    manipularDiagram.prototype = new GoJs();
    manipularDiagram.prototype.search = function(){
        var nodes = diagrama.model.nodeDataArray;
        var links = diagrama.model.linkDataArray;
        return { nodes: nodes, links: links };
    };
    return manipularDiagram;
})();
var eventos = (function(){
    function eventos(eventos, elemento){
        this.evens = eventos;
        this.elemento = elemento;
    }
    eventos.prototype = new GoJs();
    eventos.prototype.montar = function(){
         var quant = this.evens.length;
         var info = this.evens;
         for(var i = 0; i < quant; i++){
            this[info[i].evento](this.elemento, info[i].functionName);
        }
    };
    eventos.prototype.click = function(elemento, functionName){
            elemento.click = function(e, obj){
                var mod = new modificarDiagram();
                if(obj.part.data.selected){
                    obj.part.data.selected = false;
                    obj.part.opacity = 1;
                    mod.adicionar(obj.part.data.category);
                }
                else{
                    obj.part.data.selected = true;
                    obj.part.opacity = 0.5;
                    mod.deletar(obj.part.data.category);
                }
        }
        //elemento.addDiagramListener("ObjectSingleClicked", functionName);
    };
    return eventos;
})();
var modificarDiagram = (function(){
    function modificarDiagram(){

    }
    modificarDiagram.prototype = new GoJs();
    modificarDiagram.prototype.deletar = function(value){
        var manejar = new manipularDiagram();
        var resposta = manejar.search(value);
        var restoNode = [];
        var restoLink = [];
        var nodes = resposta.nodes;
        var links = resposta.links;
        var quantNodes = nodes.length;

        var newNodes = nodes.filter(function(infor, i){
            if(infor.category != value){
                return infor;
            }
            else{
                restoNode.push(infor);
            }
        });
        var newLinks = links.filter(function(infLink, i){
            var existe;
            for(var x = 0; x < quantNodes; x++){
                existe = false;
                if(nodes[x].key == infLink.from || nodes[x].key == infLink.to){
                    if(nodes[x].category == value){
                        var existe = true;
                        break;
                    }
                }
            }
            if(existe){
                restoLink.push(infLink);
            }
            else{
                return infLink;
            }
        });
        sessionStorage[value] = JSON.stringify({ nodes: restoNode, links: restoLink });
        diagrama.model = new go.GraphLinksModel(newNodes, newLinks);
    };
    modificarDiagram.prototype.adicionar = function(value){
        var manejar = new manipularDiagram();
        var resposta = manejar.search();
        var nodes = resposta.nodes;
        var links = resposta.links;
        var old = JSON.parse(sessionStorage[value]);
        var oldNodes = old.nodes;
        var oldLinks = old.links;
        var newNodes = nodes.concat(oldNodes);
        var newLinks = links.concat(oldLinks);
        diagrama.model = new go.GraphLinksModel(newNodes, newLinks);
    };
    return modificarDiagram;
})();