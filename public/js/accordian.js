console.log("accordian");


var els = document.getElementsByClassName('collapsible-header');

for (var i=0; i < els.length; i++) {
  console.log("test");
  
  els[i].addEventListener('click', function(ev) {
    // toggle element
    var bodyEl = this.nextElementSibling;
    
    if (bodyEl.style.maxHeight) {
      bodyEl.style.maxHeight = null;
    } else {
      bodyEl.style.maxHeight = bodyEl.scrollHeight + 'px';
    }
    
    // hide others
    var els = this.parentNode.querySelectorAll('.collapsible-body');
    for (var i=0; i < els.length; i++) {
        console.log("test");
        
      if (els[i] !== bodyEl) els[i].style.maxHeight = null;
    }
  });
}
