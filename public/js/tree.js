var tree = {
    init: function (selector, search_selector, list_url, create_url, update_url, delete_url, move_url) {
        this.draw(selector, search_selector, list_url, create_url, update_url, delete_url, move_url);
    },
    draw: function(selector, search_selector, list_url, create_url, update_url, delete_url, move_url) {
        {
            var to = false;
            $(search_selector).keyup(function () {
                if(to) { clearTimeout(to); }
                to = setTimeout(function () {
                    var v = $(search_selector).val();
                    $(selector).jstree(true).search(v);
                }, 250);
            });

            $(selector)
                .jstree({
                    "core" : {
                        "animation" : 1,
                        "check_callback" :  true,
                        'force_text' : true,
                        "themes" : { "stripes" : true },
                        'data' : {
                            'url' : function (node) {
                                return list_url;
                            },
                            'data' : function (node) {
                                return { 'id' : node.id };
                            }
                        }
                    },
                    "types" : {
                        "root" : {"valid_children" : ["default"] },
                        "default" : { "valid_children" : ["default","file"] },
                        "file" : { "icon" : "glyphicon glyphicon-file", "valid_children" : [] }
                    },
                    "plugins" : [ "contextmenu", "dnd", "search", "state", "types", "wholerow" ]
                }).on('create_node.jstree', function (e, data) {
                var response = this.request(
                    create_url,
                    'POST',
                    { 'parent_id' : data.node.parent, 'position' : data.position+1, 'text' : data.node.text }
            )
                data.instance.set_id(data.node, response.node_id);
            }.bind(this)).on('rename_node.jstree', function (e, data) {
                this.request(
                    update_url,
                    'PUT',
                    { 'id' : data.node.id, 'text' : data.text }
            )
            }.bind(this)).on('delete_node.jstree', function (e, data) {
                this.request(
                    delete_url,
                    'DELETE',
                    { 'id' : data.node.id }
            )
            }.bind(this)).on("move_node.jstree", function(e, data) {
                var tree = $(selector).jstree(true);
                var children = tree.get_node(data.parent).children;
                this.request(
                    move_url
                    ,
                    'PATCH',
                    {
                        'children': children,
                        'parent_id': parseInt(data.parent)
                    });
            }.bind(this));
        }
    },
    request: function (url, type, data) {
        return $.ajax({
            async : false,
            url: url,
            type: type,
            data: JSON.stringify(data),
            contentType: 'application/json',
            dataType: 'JSON',
            success: function (response) {
                return response;
            }
        }).responseJSON;
    }
};
