(function() {
    tinymce.create('tinymce.plugins.zeetiny', {
        init : function(ed, url) {
            ed.addCommand('shortcodeGenerator', function() {

                tb_show("Starter Shortcodes", url + '/shortcodes.php?&width=630&height=600');

                
            });
            //Add button
            ed.addButton('zeescgenerator', {    title : 'Starter Shortcodes', cmd : 'shortcodeGenerator', image : url + '/shortcode-icon.png' });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : 'zee TinyMCE',
                author : 'ZeeTheme',
                authorurl : 'http://www.joomshaper.com',
                infourl : 'http://www.joomshaper.com',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });
    tinymce.PluginManager.add('zee_buttons', tinymce.plugins.zeetiny);
})();