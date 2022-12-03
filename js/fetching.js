function showDiv()
{
    
}

function fetchdata(url,method='POST', variables=null){
    if (variables != null){
        let formData = new FormData();
        variables.forEach(element => formData.append(element[0],element[1]));

        fetch(url,{method: method, body: formData})
        .then(function (response) {
            return response.text();
        })
        .then(function (body) {
            console.log(body);
        });
    }
    else if(url=='modules/harmo.json'){
        fetch(url)
        .then(function (response) {
            return response.text();
        })
        .then(function (body) {
            //return JSON.parse(body);
            console.log(JSON.parse(body).time);
            JSON.parse(body).time.forEach((repo)=>{
                console.log(`Jeste tu`);
                genTimes(repo.id,daynum,start,end,type);

            });
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
    fetchdata('./api/harmonogram.php','POST',[['type','harmonogram'],['length',range],['startday',startdate]]);
    //fetchdata('modules/harmo.json','POST');
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
    document.getElementById('main-grid').appendChild(bcg);
}
function cardGen(id,daynum,start,end,type,color,comment,title,deadline,color){

}