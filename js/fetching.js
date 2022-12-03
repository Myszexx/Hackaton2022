let gstrin1;
let gstrin2;
let gstrin3;
let gstrin4;
let gnum1;
let gnum2;
let gnum3;

function snackbarPopup(message)
{
    var div= document.createElement("div");        
    div.innerHTML = "<div>"+ message +"</div>"; 
    div.style.visibility = "hidden";
    div.style.color = "#fff";
    div.style.backgroundColor = 'black';
    div.style.textAlign = "center";
    div.style.position = "fixed";
    div.style.bottom = "40px";
    div.style.fontSize = "20px";
    div.style.left = "50%";
    div.style.borderRadius = "2px";
    objTo.appendChild(divtest);
}

function getFormData()
{
    let arr=[['time',document.getElementById("time").value],
    ['type', document.getElementById("type").value],
    ['title', document.getElementById("title").value],
    ['priority', document.getElementById("priority").value],
    ['alerts', document.getElementById("alerts").value],
    ['colors', document.getElementById("colors").value],
    ['comment', document.getElementById("comment").value]];
    console.log(arr);
    fetchdata('/hackaton2022/api/tasksPost.php', 'POST', arr);
}

function showDiv(div_id)
{
    document.getElementById(div_id).style.display='block';
}

function fetchdata(url,method='POST', variables=null){
    
    if(url=='/hack/api/harmonogramGet.php' || url=='/hack/modules/harmo.json'){
        fetch(url)
        .then(function (response) {
            return response.text();
        })
        .then(function (body){
            //return JSON.parse(body);
            console.log(body)
            console.log(JSON.parse(body).time.start_date);
            console.log('Data' + gstring2);
            JSON.parse(body).time.forEach((repo)=>{
                let daynum=Math.floor((Date.parse(repo.start_date)-Date.parse(gstring2))/ (24*60*60*1000));
                console.log('day' + daynum + ' s ' + Date.parse(repo.start_date));
                genTimes(repo.id,daynum,repo.start_date,repo.end_date,repo.type);
                setTimeout(100);

            });
        });
    }
    else if (variables != null){
        let formData = new FormData();
        variables.forEach(element => formData.append(element[0],element[1]));

        fetch(url,{method: method, body: formData})
        .then(function (response) {
            //console.log(response.t())
            return response.text();
        })
        .then(function (body) {
            console.log(body);
        });
    }
    else{
        fetch(url)
        .then(function (response) {
            return response.text();
        })
        .then(function (body) {
            //return JSON.parse(body);
            //return body;
            console.log(body);
        });
    }
}

function Test(){
    fetchdata('./test.php','POST',[['name','value'],['name1','value1']]);
}

function generateHarmo(range, startdate){
    gstring1=range;
    gstring2=startdate;
    //fetchdata('/hack/api/harmonogramGet.php','POST',[['type','harmonogram'],['length',range],['startday',startdate]]);
    fetchdata('/hack/modules/harmo.json','POST');
}
function genTimes(id,daynum,start,end,type){
    let bcg = document.createElement('div')
    bcg.setAttribute('class','card');
    bcg.setAttribute('id','t'+id);
    bcg.setAttribute('ttype',type)
    bcg.style.gridColumn=daynum+' 1';
    bcg.style.gridRow=start+' '+end;
    bcg.style.backgroundColor='rgba(100,30,30,0.3)';
    bcg.addEventListener('click', function() {
        location.href = 'details.php?type=time&id='+id
    }, false);
    document.getElementById('mainGrid').appendChild(bcg);
}
function cardGen(id,daynum,start,end,type,color,comment,title,deadline,color){

}
function GetHarmo(){
    
    generateHarmo(document.getElementById('leng').value,document.getElementById('starting').value)
}