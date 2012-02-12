    definegrid = function() {
        var browserWidth = jQuery(window).width(); 
        if (browserWidth >= 1001) 
        {
            pageUnits = '%';
            colUnits = '%';
            pagewidth = 96;
            columns = 6;
            columnwidth = 15;
            gutterwidth = 2;
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
            columnwidth = 15;
            gutterwidth = 2;
            pagetopmargin = 30;
            rowheight = 16*1.5625;
            makehugrid();
        }
        if (browserWidth <= 768) 
        {
            pageUnits = '%';
            colUnits = '%';
            pagewidth = 96;
            columns = 1;
            columnwidth = 100;
            gutterwidth = 2;
            pagetopmargin = 30;
            rowheight = 16*1.5625;
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