 // post js
 async function post(url = '', data = {}) {
    loading(true);
    const response = await fetch(baseUrl+'/'+url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    });
    loading(false);
    return response.json(); // parses JSON response into native JavaScript objects
}

// req berisi bebas
// jika null maka loading ditampilkan, jika tidak maka loading disembunyikan
const loading=(req=true)=>{
    if(req===true){
        $('.waiting').show()
    }else{
        $('.waiting').fadeOut()
    }
}

          