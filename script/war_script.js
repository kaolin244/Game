
function setMaximumSwordsman(max)
{
    var area = document.getElementById('swordsman_input');
    var area_value = area.value;
    if(area_value == max)
        area.value = 0;
    else
        area.value = max;
};
function setMaximumArcher(max)
{
    var area = document.getElementById('archer_input');
    var area_value = area.value;
    if(area_value == max)
        area.value = 0;
    else
        area.value = max;
};
function finishTime()
{

}
function countTime(condition)
{
    var span = document.getElementById('time_span');
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/countDistanceTime.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded", true);
    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);
            var time_sring = data.Time;
            span.innerHTML = time_sring;
            var hour = Number(time_sring.substring(0, 2));
            var minutes = Number(time_sring.substring(3, 5));
            var second = Number(time_sring.substring(6));
            var myDate = new Date();
            var hour_now = myDate.getHours();
            var minute_now = myDate.getMinutes();
            var second_now = myDate.getSeconds();

            myDate.setHours(hour_now + hour);
            myDate.setMinutes(minute_now + minutes);
            myDate.setSeconds(second_now + second);
            window.setInterval(function(){
                var end_time = document.getElementById('end_time');
                var wynikTxt = '';
                var second_to_add = myDate.getSeconds();
                myDate.setSeconds(second_to_add + 1);
                wynikTxt +=('0' + myDate.getHours()).slice(-2) + ":" + ('0' + myDate.getMinutes()).slice(-2) + ":" +('0' + myDate.getSeconds()).slice(-2) + ", ";

                end_time.innerHTML = wynikTxt;

            }, 1000)



        }
    };

    xhr.send("condition="+condition+'"');


    span.innerHTML = "requesting...";

};
window.addEventListener('load', function()
{





    countTime(1);
}, false);

