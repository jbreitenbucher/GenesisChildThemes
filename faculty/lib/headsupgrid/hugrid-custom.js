    definegrid = function() {
        var browserWidth = jQuery(window).width(); 
        if (browserWidth >= 1001) 
        {
            pageUnits = 'px';
            colUnits = 'px';
            pagewidth = 940;
            columns = 12;
            columnwidth = 60;
            gutterwidth = 20;
            pagetopmargin = 30;
            rowheight = 16*1.5625;
            makehugrid();
        } 
        if (browserWidth <= 960) 
        {
            pageUnits = '%';
            colUnits = '%';
            pagewidth = 96;
            columns = 6;
            columnwidth = 14.5183175;
            gutterwidth = 2.5780189;
            pagetopmargin = 15;
            rowheight = 25;
            makehugrid();
        }
        if (browserWidth <= 768) 
        {
            pageUnits = '%';
            colUnits = '%';
            pagewidth = 96;
            columns = 1;
            columnwidth = 100;
            gutterwidth = 1.2;
            pagetopmargin = 15;
            rowheight = 25;
            makehugrid();
        }
    }
    jQuery(document).ready(function() {
        definegrid();
        setgridonload();
    });    

    jQuery(window).resize(function() {
        definegrid();
    });