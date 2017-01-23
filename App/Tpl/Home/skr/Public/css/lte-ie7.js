/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-uniF488' : '&#xf488;',
			'icon-uniF489' : '&#xf489;',
			'icon-heart' : '&#xe000;',
			'icon-uniF48A' : '&#xf48a;',
			'icon-uniF48B' : '&#xf48b;',
			'icon-home' : '&#x21b8;',
			'icon-pigpens' : '&#xf468;',
			'icon-pigpent' : '&#xf469;',
			'icon-pigpenu' : '&#xf46a;',
			'icon-pigpenv' : '&#xf46b;',
			'icon-heart-2' : '&#xe001;',
			'icon-comment' : '&#xe003;',
			'icon-chat' : '&#xe004;',
			'icon-search' : '&#xe005;',
			'icon-camera' : '&#xe006;',
			'icon-cog' : '&#xe007;',
			'icon-music' : '&#xe008;',
			'icon-type' : '&#xe009;',
			'icon-checkmark' : '&#xe00a;',
			'icon-cancel' : '&#xe00b;',
			'icon-file' : '&#xe00c;',
			'icon-copy' : '&#xe00d;',
			'icon-sun' : '&#xe002;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};