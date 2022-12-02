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
    else{
        fetch(url)
        .then(function (response) {
            return response.text();
        })
        .then(function (body) {
            console.log(body);
        });
    }
}

function Test(){
    fetchdata('./test.php','POST',[['name','value'],['name1','value1']]);
}