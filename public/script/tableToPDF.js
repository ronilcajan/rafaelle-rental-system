function tableToPDF(tablename){
    var date = (new Date()).toString().split(' ').splice(1,3).join(' ');
    var title = $('.card-title').text();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    // === Calculate text width ====
    var text_width = $.fn.textWidth(title,'14px');
    var half_width = (text_width/2); //times pt unit

    var totalPagesExp = '{total_pages_count_string}'
    var base64Img = base64();
    $('.hide-column').hide();

    var doc = new jspdf.jsPDF('l', 'pt');
    doc.autoTable({ 
        theme: 'grid',
        html: '#'+tablename,
        startY: 50,
        didDrawPage: function (data) {
            var pageSize = doc.internal.pageSize;
            doc.setFontSize(16);
            doc.setTextColor(40);
            doc.text(title, (doc.internal.pageSize.getWidth()/2)-half_width, 22);
            if(from_date && to_date){
                doc.setFontSize(10);
                doc.setTextColor(150);
                doc.text("as of "+from_date+" to "+to_date, (doc.internal.pageSize.getWidth()/2)-68, 35);
            }
            
            doc.setFontSize(10);
            doc.setTextColor(150);
            if (base64Img) {
                doc.addImage(base64Img, 'JPEG', 30, 8, 50,30, 'MEDIUM');
            }
               // Footer
            var str = 'Page ' + doc.internal.getNumberOfPages();
            // Total page number plugin only available in jspdf v1.0+
            if (typeof doc.putTotalPages === 'function') {
                str = str + ' of ' + totalPagesExp;
            }
            doc.setFontSize(8);
            doc.setTextColor(150);

            var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
            doc.text(str, 20, pageHeight - 10); // var msg2 = 'As such, it is intended solely for those authorized. Furthermore, any disclosure, copying, distribution or other use of content is prohibited and may be unlawful.';
            doc.text('Printed on: '+date, 20, pageHeight - 20);
        }
    })
    if (typeof doc.putTotalPages === 'function') {
        doc.putTotalPages(totalPagesExp);
    }
    //doc.save() not working on chrome
    var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
    if(isChrome){
        doc.setProperties({
          title: title
        });
        window.open(doc.output('bloburl'));
    }else{
        doc.save(title+'-'+date+".pdf");
    }

    $('.hide-column').show();
}

function base64(){
    var c = document.createElement('canvas');
    var img = document.getElementById('logo');
    c.height = img.naturalHeight;
    c.width = img.naturalWidth;
    var ctx = c.getContext('2d');

    ctx.drawImage(img, 0, 0, c.width, c.height);
    var base64String = c.toDataURL();
    return base64String;
}
// === Calculate text width ====
$.fn.textWidth = function(text, font) {
    if (!$.fn.textWidth.fakeEl) $.fn.textWidth.fakeEl = $('<span>').hide().appendTo(document.body);
    $.fn.textWidth.fakeEl.text(text || this.val() || this.text()).css('font', font || this.css('font'));
    return $.fn.textWidth.fakeEl.width();
};