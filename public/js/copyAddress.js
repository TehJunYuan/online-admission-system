function copyAddress(){
    const c_street1 = document.getElementById('c_street1');
    const c_street2 = document.getElementById('c_street2');
    const c_zipcode = document.getElementById('c_zipcode');
    const c_city = document.getElementById('c_city');
    const c_state = document.getElementById('c_state');
    const c_country = document.getElementById('c_country');
    const p_street1 = document.getElementById('p_street1');
    const p_street2 = document.getElementById('p_street2');
    const p_zipcode = document.getElementById('p_zipcode');
    const p_city = document.getElementById('p_city');
    const p_state = document.getElementById('p_state');
    const p_country = document.getElementById('p_country');
    const sameAbove = document.getElementById('sameAbove');
    
    if(sameAbove.checked){
        p_street1.value = c_street1.value;
        p_street2.value = c_street2.value;
        p_zipcode.value = c_zipcode.value;
        p_city.value = c_city.value;
        p_state.value = c_state.value;
        p_country.value = c_country.value;
    }else if(sameAbove.checked == false){
        p_street1.value = '';
        p_street2.value = '';
        p_zipcode.value = '';
        p_city.value = '';
        p_state.value = '';
        p_country.value = '';
    }
}