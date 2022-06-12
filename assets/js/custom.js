
var data = document.querySelector('.data-input'); 

data.addEventListener('keyup', (e)=> {
    //8 = tecla de apagar
    if(e.keyCode != 8) {
        let valor = data.value;
        
        if(valor.length == 2 || valor.length == 5) {
            valor = valor + '/';
            data.value = valor;
            
        }
    }
});