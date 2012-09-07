Treacle is a fixed-width three-column theme for Wordpress 1.5. Although the CSS techniques used are inspired by Root's Trident (http://atthe404.com), I coded it from scratch and any errors are entirely my own (though I hasten to add that both XHTML and CSS have been tested for validity).

Images have been kept to a minimum to reduce clutter and encourage customisation.  It is released under a Creative Commons attribution license (http://creativecommons.org/licenses/by/2.0/) a copy of which is included in the distribution. This licence is included in the GNU list of GPL-compatible licences, and if that's not free enough for you I suggest you choose another theme.

All translatable strings should be marked as such, and I'd be grateful to hear about any hardcoded English that may have slipped through. If you have any suggestions for improvement, send them to treacle@not-that-ugly.co.uk. If you have any support questions that aren't answered in the theme documentation, head to http://not-that-ugly.co.uk rather than the Wordpress forums; people do not have time to familiarise themselves with each one of the hundreds of themes now in existence, and you stand a much better chance of getting an answer if you go direct to the source. (This applies equally to any other themes you may have downloaded.)

Installation: upload the 'treacle' folder and all its contents to wp-content/themes, and activate through the presentation panel.

KNOWN ISSUES
The list of categories doesn't include 'Uncategorised'. This is a feature, not a bug; if a post is 'uncategorised' it isn't in a category and shouldn't be included in category lists. To change this behaviour, all you need to do is delete &exclude=1 from wp_list_cats (in leftcolumn.php)

The background images on the menu headers don't show up in Internet Explorer. Since the code is valid, I have no explanation for this other than IE sucks. But you knew that anyway, right?

If you have no Pages, XHTML validation will break. Either create some Pages, or remove the Pages section of the sidebar.