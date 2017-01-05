var wood;
var wood_p;
var stone;
var stone_p;
var food;
var food_p;
var population;
var storage;

var buttonBuildings = document.getElementById("buildingButton");

buttonBuildings.addEventListener("click", function(){
    var show = document.getElementById("buildings");
    var hide_1 = document.getElementById("army");
    show.classList.remove("hide");
    show.classList.add("show");
    hide_1.classList.remove("show");
    hide_1.classList.add("hide");


}, false)

var buttonArmy = document.getElementById("armyButton");
buttonArmy.addEventListener("click", function(){
    var hide_1= document.getElementById("buildings");
    var show = document.getElementById("army");
    show.classList.remove("hide");
    show.classList.add("show");
    hide_1.classList.remove("show");
    hide_1.classList.add("hide");
    displayBarrack();
}, false)




function generalInfo(){
    var belt = document.getElementById("belt");
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/general_village.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);
            belt.innerHTML = "Gracz: "+data.user_name+" w wiosce: "+data.village_name+" ma puntow: "+data.points;
        }
    };
    xhr.send();
}

function getMaterials()
{

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/updateMaterials.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);

            wood = data.wood;
            stone = data.stone;
            food = data.food;
            wood_p = data.wood_p;
            stone_p = data.stone_p;
            food_p = data.food_p;
            population = data.population;
            storage = data.storage;
        }
    };
    xhr.send();
}

function displayBuildings()
{

    var wrapper = document.getElementById("buildings");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/displayBuildings.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    with(wrapper){
        while(childNodes.length>0){
            removeChild(childNodes[0])
        }
    }
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);

            var list = document.createElement("ul");
            wrapper.appendChild(list);

           for (let key in data)
            {
                if(key != 'village_id')
                {
                    var listElement = list.appendChild(document.createElement("li"));
                    listElement.innerHTML = key + ": ";
                    var level = listElement.appendChild(document.createElement("span"));

                    level.innerHTML = data[key];
                    level.setAttribute('id', key);
                    var buttonElement = document.createElement("button");



                    buttonElement.innerHTML = "Up";
                    buttonElement.addEventListener('click', function () {
                        increaseLevel(key, data.village_id)
                    }, false);
                    listElement.append(buttonElement);
                    var levelCost = listElement.appendChild(document.createElement("span"));
                    levelCost.setAttribute('id', key + 'Cost');
                    showBuildingCost(key, data[key] + 1);

                }
            }


        }
    };
    xhr.send();
}

var showArmyCost = function() {
    var miecznikAmount = document.getElementById('Miecznik_Recruitment').value;
    var lucznikAmount = document.getElementById('Lucznik_Recruitment').value;
    var costSpan = document.getElementById('allCost');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../sieci/JSON/army.json", true);
    xhr.setRequestHeader("Content-type", "application/json", true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);

            var drewno = miecznikAmount * data.Miecznik.cost_wood + lucznikAmount * data.Lucznik.cost_wood;
            var kamien = miecznikAmount * data.Miecznik.cost_stone + lucznikAmount * data.Lucznik.cost_stone;
            var jedzenie = miecznikAmount * data.Miecznik.cost_food + lucznikAmount * data.Lucznik.cost_food;
            var ludzie = miecznikAmount * data.Miecznik.cost_population + lucznikAmount * data.Lucznik.cost_population;
            costSpan.innerHTML = 'Potrzebne drewno: ' + drewno + ', kamien: ' + kamien + ', jedzenia: ' + jedzenie + ', oraz ' + ludzie + ' ludzi.';

        }
    };
    xhr.send(null);
    costSpan.innerHTML = "requesting...";
};
function displayBarrack()
{

    var wrapper = document.getElementById("army");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/displayBarrack.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    with(wrapper)
        while(childNodes.length>0)
            removeChild(childNodes[0])

    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);

            var list = document.createElement("ul");
            wrapper.appendChild(list);

            for (let key in data)
            {
                if(key != 'village_id')
                {
                    var listElement = list.appendChild(document.createElement("li"));
                    var span = document.createElement("span");
                    listElement.innerHTML = key + ": "
                    span.innerHTML += data[key];
                    span.setAttribute('id', key + "_Amount");
                    listElement.append(span);
                    listElement.innerHTML += ' Wyszkol: ';

                    var textArea = document.createElement("input");
                    textArea.setAttribute("type", "number");
                    textArea.setAttribute("min", 0);
                    textArea.setAttribute('id', key+'_Recruitment');
                    textArea.setAttribute('class', 'area_Recruitment');
                    textArea.setAttribute('placeholder', 0);

                    listElement.append(textArea);


                }
            }
            var allCost = document.createElement('span');
            allCost.setAttribute('id', 'allCost');
            allCost.innerHTML = 'asd';
            wrapper.appendChild(allCost);
            var buttonElement = document.createElement("button");
            buttonElement.innerHTML = "Ok";
            buttonElement.setAttribute('id', 'recruitment_Button');
            buttonElement.addEventListener('click', function(){
                recruitmentMore(data.village_id);
            }, false);
            wrapper.appendChild(buttonElement);

            var classname = document.getElementsByClassName('area_Recruitment');

            for (var i = 0; i < classname.length; i++) {
                classname[i].addEventListener('input', showArmyCost, false);
            }
            showArmyCost();

        }
    };
    xhr.send();
}

function  recruitmentMore(village_id)
{
    getMaterials();
    var miecznik_TextArea = document.getElementById('Miecznik_Recruitment').value;
    var Lucznik_TextArea = document.getElementById('Lucznik_Recruitment').value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/recruitmentMore.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);
            if(data.errors != 'nope')
            {
                alert(data.errors);
            }
            displayBarrack();
            getMaterials();
        }
    };
        xhr.send("Miecznik="+miecznik_TextArea+"&village_id="+village_id+"&Lucznik="+Lucznik_TextArea);
}
function increaseLevel(place, village_id)
{

    var gdzie = document.getElementById(place);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/increaseLevel.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);
            gdzie.innerHTML = data.NewLevel;
            wood = data.wood;
            stone = data.stone;
            food = data.food;
            wood_p = data.wood_p;
            stone_p = data.stone_p;
            food_p = data.food_p;
            population = data.population;
            storage = data.storage;
            if(data.errors != "nope")
            {
                alert(data.errors);
            }
            showBuildingCost(place, data.NewLevel + 1);
        }
    };
    xhr.send("place="+place+"&village_id="+village_id);
}

function showBuildingCost(place, level)
{
    var costLevel = document.getElementById(place + 'Cost');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../sieci/JSON/buildings.json", true);
    xhr.setRequestHeader("Content-type", "application/json", true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);

            if(level <= data[place].max_level)
            {
                if(place != 'Dom')
                {
                    var drewno = data[place].cost_wood[level];
                    var kamien = data[place].cost_stone[level];
                    var jedzenie = data[place].cost_food[level];
                    var ludzie = data[place].cost_population[level];

                }else
                {
                    drewno = level * level;
                    kamien = level * level;
                    jedzenie = level * level;
                    ludzie = 'nie trzeba xD';
                }

                costLevel.innerHTML = 'Potrzebne drewno: ' + drewno + ', kamien: ' + kamien + ', jedzonko: ' + jedzenie  + ', ludzi: ' + ludzie;
            }else
                costLevel.innerHTML = 'Maksymalny level';
        }
    };
    xhr.send(null);
    costLevel.innerHTML = "requesting...";
}

function showMaterials()
{
    var amountBeltInfo = document.getElementById("infoBelt");
    wood += wood_p;
    stone += stone_p;
    food += food_p;

    if(wood >= storage)
    {
        wood = storage;
        wood_p = 0;
    }
    if(stone >= storage)
    {
        stone = storage;
        stone_p = 0;
    }
    if(food >= storage)
    {
        food = storage;
        food_p = 0;
    }
    amountBeltInfo.innerHTML = 'Drewno: '+wood+', Kamień: '+stone+', Jedzonko: '+food+', Masz jeszcze: '+population+' ludzi;';
}


window.addEventListener("load", function(){
    generalInfo();
    getMaterials();
    displayBuildings();

    var show = document.getElementById("buildings");
    var hide_1 = document.getElementById("army");
    show.classList.remove("hide");
    show.classList.add("show");
    hide_1.classList.remove("show");
    hide_1.classList.add("hide");
    window.setInterval(showMaterials, 1000);

}, false);
