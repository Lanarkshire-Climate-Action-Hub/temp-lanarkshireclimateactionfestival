/* jce - 2.9.83 | 2025-02-20 | https://www.joomlacontenteditor.net | Source: https://github.com/widgetfactory/jce | Copyright (C) 2006 - 2025 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
WFAggregator.add("video", {
    params: {
        width: "",
        height: ""
    },
    props: {
        autoplay: 0,
        loop: 0,
        controls: 1,
        mute: 0
    },
    setup: function() {
        $.each(this.params, function(k, v) {
            $("#video_" + k).val(v).filter(":checkbox, :radio").prop("checked", !!v);
        });
    },
    getTitle: function() {
        return this.title || this.name;
    },
    getType: function() {
        return "video";
    },
    isSupported: function(v) {
        return v = v.split("?")[0], /\.(mp4|m4v|ogv|ogg|webm)$/.test(v);
    },
    getAttributes: function(src) {
        return {
            width: this.params.width,
            height: this.params.height
        };
    }
});