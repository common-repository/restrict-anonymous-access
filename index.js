(function() {
    tinymce.create("tinymce.plugins.shortcode_member_button", {

        //url argument holds the absolute url of our plugin directory
        init : function(ed, url) {

            //add new button    
            ed.addButton("member", {
                title : "Restrict access to members only",
                cmd : "member_command",
                image : raa_getHomeUrl() + "/wp-content/plugins/restrict-anonymous-access/img/lock.png"
            });

            //button functionality.
            ed.addCommand("member_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = "[member]" + selected_text + "[/member]";
                ed.execCommand("mceInsertContent", 0, return_text);
            });

        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : "Insert Member Shortcode",
                author : "Christian Leuenberg",
                version : "1"
            };
        }
    });

    tinymce.PluginManager.add("shortcode_member_button", tinymce.plugins.shortcode_member_button);
})();

function raa_getHomeUrl() {
    var href = window.location.href;
    var index = href.indexOf('/wp-admin');
    var homeUrl = href.substring(0, index);
    return homeUrl;
}