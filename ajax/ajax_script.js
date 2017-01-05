var mapWrapper = document.getElementById("map");

function createMap()
{
    var mapPosition = [];
    for(var i = 0; i < 100; i++)
        mapPosition[i] = 0;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/create_map.php", true);
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            var data = JSON.parse(xhr.responseText);
            var first = true;
            mapPosition.forEach(function(number, index)
            {
                var squere =  mapWrapper.appendChild(document.createElement('div'));
                var squerePlace = index;
                var squereInWidth = 10;

                if((squerePlace + 1) % squereInWidth === 0)
                {
                    var clearfixElement = mapWrapper.appendChild(document.createElement('div'));
                    clearfixElement.classList.add('clearFix');
                }

                squere.innerHTML = index;
                squere.classList.add('square');

                for(var obj in data)
                {

                    var poz = data[obj].map_position;

                    if(squerePlace === poz)
                    {
                        if(obj == 'owner')
                        {
                            squere.classList.add('villageOwner');
                            first = false;
                        }
                        else
                        {
                            squere.classList.add('village');
                            squere.addEventListener('click', function () {
                                showInfo(squerePlace);
                            }, false);
                        }
                    }

                }
            }, false);
        }
    };

    xhr.send(null);
};

function showInfo(map_position)
{
    var village_name = document.getElementById("villageName");
    var points = document.getElementById("points");
    var myVillageButton = document.getElementById("myVillageButton");
    var xhrr = new XMLHttpRequest();
    xhrr.open("POST", "ajax/show_info.php", true);
    xhrr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrr.onreadystatechange = function()
    {
        if(xhrr.readyState == 4 && xhrr.status == 200)
        {
            var data = JSON.parse(xhrr.responseText);
            with(myVillageButton){
                while(childNodes.length>0){
                    removeChild(childNodes[0])
                }
            }

            village_name.innerHTML = data.village.village_name;
            points.innerHTML ="Ma "+ data.village.points+" punktów.";
            if(data.village.owner == 1)
            {
                var village = myVillageButton.appendChild(document.createElement('li'));
                village.innerHTML =  '<a href="village.php">Wioska</a>';
            }else
            {
                var look = myVillageButton.appendChild(document.createElement('li'));
                look.innerHTML = '<a href = "war.php?enemy=' + map_position + '">Wyśli wojsko</a>';
            }


        }
    };
    xhrr.send("index="+map_position);
}

window.addEventListener("load", function(){
    createMap();
}, false);
