/*
* source code from https://www.plus2net.com/javascript_tutorial/clock.php
*/


function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
    var x = new Date()
    var hour=x.getHours();
    var minute=x.getMinutes();
    var second=x.getSeconds();
    if(hour <10 ){hour='0'+hour;}
    if(minute <10 ) {minute='0' + minute; }
    if(second<10){second='0' + second;}
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    var x1=x.toLocaleDateString('eng-PH', options);// changing the display to UTC string
    var y = x1+ ' ' +  hour+':'+minute+':'+second;
    document.getElementById('ct').innerHTML = y;
    //document.getElementById('time').innerHTML = y;
    tt=display_c();
 }