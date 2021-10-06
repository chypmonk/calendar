function expandCalendarCell (x) {
    
    document.getElementById(x).style.minHeight = '200px';
}

function accordionToggle(bttn) { 
    var y = bttn+"-accordion";
    var x = document.getElementById(y);  
  
    if (x.style.display === "block" ) {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
 }

//Use this toggle to avoid duplicat ids
function accordionToggle1(bttn) { 
    var y = bttn+"-accordion1";
    var x = document.getElementById(y);  
  
    if (x.style.display === "block" ) {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
 }

function accordionToggle2(bttn) { 
  
   var x = document.getElementById(bttn+"-content");    
   if (x.style.display === "block"  ) {
        x.style.display = 'none';
    }
    else {
        x.style.display = 'block';
    }
 }
 

