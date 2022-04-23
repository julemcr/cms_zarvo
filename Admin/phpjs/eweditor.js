/**
 * HTML Editor for PHPMaker 2019
 * @license (C) 2019 e.World Technology Ltd.
 */
// Override tinyMCE.DOM.get method

tinymce.DOM.get = function(e) {
	if (e && this.doc && typeof(e) == 'string') {
		if (/^(f[\w]+)\$(x[\w]+)\$$/.test(e)) { // get the textarea
			var f = this.doc.getElementById(RegExp.$1);
			e = (f) ? ew.getElement(RegExp.$2, f) : null;
		} else { // get other elements
			e = this.doc.getElementById(e);
		}
	}
	return e;
}

// Create editor
ew.createEditor = function(formid, name, cols, rows, readonly) {
	if (typeof tinymce == "undefined" || name.indexOf("$rowindex$") > -1)
		return;
	var $ = jQuery, form = $("#" + formid)[0], el = ew.getElement(name, form);
	if (!el)
		return;
	var w = (cols ? Math.abs(cols) : 35) * 2 + "em"; // width
	var h = ((rows ? Math.abs(rows) : 4) + 4) * 1.5 + "em"; // height
	var lang = (ew.LANGUAGE_ID || "").replace("-", "_");
	if (lang == "bn")
		lang = "Bn_BD";
	else if (lang == "fr")
		lang = "fr_FR";
	else if (lang == "hi")
		lang = "hi_IN";
	else if (lang == "hi")
		lang = "hi_IN";
	else if (lang == "hu")
		lang = "hu_HU";
	else if (lang == "pt")
		lang = "pt_PT";
	else if (lang == "sl")
		lang = "sl_SL";
	else if (lang == "sv")
		lang = "sv_SE";
	else if (lang == "th")
		lang = "th_TH";
	else if (lang == "fr_CA")
		lang = "fr_FR";
	else if (lang == "de_CH")
		lang = "de";
	else if (lang == "es_419")
		lang = "es_MX";
	var settings = {

		//width: w, // DO NOT specify width
		height: h,
		language: lang,
		theme: "modern",
		plugins: [
			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars code fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste"
		],
		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		toolbar2: "print preview media | forecolor backcolor emoticons"
	};
	var args = {"id": name, "form": form, "enabled": true, "settings": settings};
	$(document).trigger("create.editor", [args]);
	if (!args.enabled)
		return;
	if (readonly) {
		args.settings.readonly = true;
		args.settings.menubar = false;
		args.settings.plugins = [];
		args.settings.toolbar = false;
		delete args.settings.toolbar1;
		delete args.settings.toolbar2;
	}
	var longname = formid + "$" + name + "$";
	var editor = {
		name: name,
		active: false,
		instance: null,
		create: function() { // create
			var ed = this.instance = tinymce.EditorManager.createEditor(longname, args.settings);
			ed.render(true);
			ed.on("init", ew.fixLayoutHeight);
			this.active = true;
		},
		set: function() { // update value from textarea to editor
			if (this.instance) this.instance.setContent(el.value);
		},
		save: function() { // update value from textarea to editor
			if (this.instance) this.instance.save();
			var args = {"id": name, "form": form, "value": ew.removeSpaces(el.value)};
			$(document).trigger("save.editor", [args]).val(args.value);
		},
		focus: function() { // focus editor
			if (this.instance) this.instance.focus(false);
		},
		destroy: function() { // destroy
			if (this.instance) tinymce.remove(this.instance);
			this.active = false;
		}
	};
	$(el).data("editor", editor).addClass("editor");
}
