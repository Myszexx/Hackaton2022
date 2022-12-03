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
    div.style.visibility = "visible";
    div.style.color = "#fff";
    div.style.backgroundColor = 'blue';
    div.style.textAlign = "center";
    div.style.position = "fixed";
    div.style.top = "40px";
    div.style.fontSize = "40px";
    div.style.left = "30%";
    div.style.right = "30%";
    div.style.borderRadius = "2px";
    document.querySelector('body').appendChild(div);

    setTimeout(function(){ div.style.visibility = div.style.visibility.replace("visible", "hidden"); }, 3000);
}

function getFormData()
{
    let arr=[['request_type','taskPost'],
    ['time',document.getElementById("time").value],
    ['type', document.getElementById("type").value],
    ['title', document.getElementById("title").value],
    ['priority', document.getElementById("priority").value],
    ['alerts', document.getElementById("alerts").value],
    ['colors', document.getElementById("colors").value],
    ['comment', document.getElementById("comment").value]];
    console.log(arr);
    fetchdata('/hack/api/tasksPost.php', 'POST', arr);
}

function ChangeDiv(div_id,status)
{
    document.getElementById(div_id).style.display=status;
}

function fetchdata(url,method='POST', variables=null){
    

        if (variables != null && variables[0][1]=='variables'){
        let formData = new FormData();
        variables.forEach(element => formData.append(element[0],element[1]));

        fetch(url,{method: method, body: formData})
        .then(function (response) {
            return response.text();
        })
        .then(function (body){
            //return JSON.parse(body);
            let time_arr=[[],[],[],[]]
            console.log(body)
            console.log(JSON.parse(body).time.start_date);
            console.log('Data' + gstring2);
            JSON.parse(body).time.forEach((repo)=>{
                let daynum=Math.floor((Date.parse(repo.start_date)-Date.parse(gstring2))/ (24*60*60*1000));
                console.log('day' + daynum + ' s ' + Date.parse(repo.start_date));
                let smal_arr = genTimes(repo.id,daynum,repo.start_date,repo.end_date,repo.type);
                time_arr[daynum].push(smal_arr);
                setTimeout(100);

            });
            JSON.parse(body).tasks.forEach((repo)=>{

            });
        });
    }
    else if(variables != null){
        let formData = new FormData();
        variables.forEach(element => formData.append(element[0],element[1]));

        fetch(url,{method: method, body: formData})
        .then(function (response) {
            return response.text();
        })
        .then(function (body) {
            //return JSON.parse(body);
            //return body;
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
    fetchdata('/hack/api/harmonogramGet.php','POST',[['request_type','harmonogram'],['length',range],['startday',startdate]]);
    //fetchdata('/hack/modules/harmo.json','POST');
}
function genTimes(id,daynum,start,end,type){
    let arr=[]
    let bcg = document.createElement('div')
    bcg.setAttribute('class','card');
    bcg.setAttribute('id','t'+id);
    bcg.setAttribute('ttype',type);
    console.log(start);
    start=new Date(start)
    end=new Date(end)
    //console.log('Data: ' + start);
    //console.log('DAta: ' + end);
    start=start.getHours()*12+Math.round(start.getMinutes()/5)
    end=end.getHours()*12+Math.round(end.getMinutes()/5)
    arr.push([start,end,type])
    //console.log('Pole: ' + start);
    //console.log('Pole: ' + end);
    bcg.style.cssText =`grid-column: `+(daynum+1)+`/ span  1;
                        grid-row: `+start+` / `+ end + `;
                        background-color:rgba(100,30,30,0.3);
                        z-index: 100;`;
    gnum1+=end-start;
    bcg.addEventListener('click', function() {
        location.href = 'details.php?type=time&id='+id
    }, false);
    document.getElementById('upGrid').appendChild(bcg);
    console.log(arr);
    return arr;
}
function cardGen(id,daynum,start,end,type,color,comment,title,deadline,color){

}
function GetHarmo(){
    
    generateHarmo(document.getElementById('leng').value,document.getElementById('starting').value)
}
function DivFill(){
    let i =0;
    while( i<288*4){
    let d = document.createElement('div')
    d.setAttribute('Id','D'+i)
    document.getElementById('mainGrid').appendChild(d)
    i++;
}
}