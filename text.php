<?php
var myDate = new Date("1/1/1990");
var dayOfMonth = myDate.getDate();
myDate.setDate(dayOfMonth - 1);

document.write(myDate);